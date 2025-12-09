<template>
    <div class="h-full flex-1 flex-col gap-4 overflow-x-auto rounded-sm p-4">
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-6 p-4 ">
            <!-- Card Header -->
            <div v-for="moment in moments_list" :key="moment.id"
                class="bg-white rounded-xl shadow-sm border overflow-hidden flex flex-col">
                <div class="flex items-center justify-between p-3 border-b">
                    <span class="text-sm font-medium bg-gray-200 rounded-full px-2 py-0.5">
                        {{ moment.category }} {{ moment.subcategory ? '- ' + moment.subcategory : '' }}
                    </span>

                    <div class="space-x-2">
                        <button class="text-xs bg-yellow-400 px-2 py-1 rounded" @click="suspendUser(moment.id)">Suspend</button>
                        <button class="text-xs bg-red-600 text-white px-2 py-1 rounded" @click="deleteMoment(moment.userId)">Delete</button>
                    </div>
                </div>

                <!-- Counter Section -->
                <div class="flex items-center justify-center gap-2 py-3 border-b">
                    <div v-if="moment.moderation_score !== null">

                        <!-- Decrease -->
                        <button @click="updateScore(moment.id, -5)"
                            class="cursor-pointer bg-gray-200 w-7 h-7 rounded-full text-lg leading-none">
                            -
                        </button>

                        <!-- Display -->
                        <span class="font-semibold text-lg">
                            {{ Number(moment.updated_moderation_score??moment.moderation_score).toFixed(2) }}
                        </span>

                        <!-- Increase -->
                        <button @click="updateScore(moment.id, 5)"
                            class="cursor-pointer bg-gray-200 w-7 h-7 rounded-full text-lg leading-none">
                            +
                        </button>
                    </div>

                    <div v-else>
                        <span class="font-semibold text-lg">Moment</span>
                    </div>
                </div>

                <!-- IMAGE -->
                <div class="flex justify-center">
                    <img v-if="moment.media_type === 'image'" :src="moment.media_back + '?tr=w-360,q-60,f-webp'"
                        class="h-[400px] w-fit  object-cover">
                    <img v-if="moment.media_type === 'video'" :src="moment.video_thumbnail + '?tr=w-360,q-60,f-webp'"
                        class="h-[400px] w-fit  object-cover">
                </div>

                <!-- Bottom Section -->
                <div class="flex items-center gap-3 p-3 border-t">
                    <img :src="moment.user.profile_pic + '?tr=w-360,q-60,f-webp'"
                        class="w-10 h-10 rounded-full object-cover">

                    <div class="flex-1">
                        <h4 class="text-sm font-semibold">{{ moment.user.first_name }} {{ moment.user.last_name }}</h4>
                        <p class="text-xs text-gray-600">@{{ moment.user.username }}</p>
                        <p class="text-[10px] text-gray-500">{{ moment.user.phone_number }}</p>
                    </div>

                    <div class="text-xs text-right">
                        <p class="text-gray-500 text-[10px]">{{ formatDate(moment.createdAt) }}</p>
                    </div>
                </div>
            </div>
            <!-- Duplicate more cards -->
        </div>
        <!-- <Listing :tabvalue="tabvalue" /> -->
    </div>
    <!-- Card Component -->
</template>

<script setup lang="ts">
import axios from "axios";
import { onMounted, onUnmounted, ref } from "vue";

const formatDate = (dateStr: string) => {
    const date = new Date(dateStr);
    return new Intl.DateTimeFormat("en-IN", {
        day: "2-digit", month: "short", year: "2-digit",
        hour: "2-digit", minute: "2-digit"
    }).format(date);
};

// ---- Types ----
interface MomentList {
    id: number;
    userId: number;
    media_type: string;
    media_back: string;
    video_thumbnail: string;
    createdAt: string;
    category: string;
    moderation_score: number;
    updated_moderation_score: number;
    subcategory: string;
    user: {
        profile_pic: string;
        first_name: string;
        last_name: string;
        username: string;
        phone_number: string;
    }
}

interface PaginationLink {
    url: string | null;
    label: string;
    active: boolean;
}

interface ApiPaginatedResponse<T> {
    data: T[];
    current_page: number;
    last_page: number;
    links: PaginationLink[];
    total: number;
    per_page: number;
}

const search = ref("");
const moments_list = ref<MomentList[]>([]);
const isLoading = ref(false);

const pagination = ref({
    current_page: 1,
    last_page: 1,
    links: [] as PaginationLink[],
    total: 0,
    per_page: 10
});

let controller: AbortController | null = null;

// Update Score Function
const updateScore = (id: number, value: number) => {
    const index = moments_list.value.findIndex(m => m.id === id);
    if (index !== -1) {

        if (moments_list.value[index].updated_moderation_score) {
            if (moments_list.value[index].updated_moderation_score + value >=100) {
                moments_list.value[index].updated_moderation_score = 100
            }else if(moments_list.value[index].updated_moderation_score + value <=0){
                moments_list.value[index].updated_moderation_score = 0
            } else {
                moments_list.value[index].updated_moderation_score += value;
            }
        }else {
            if (moments_list.value[index].moderation_score + value >=100) {
                moments_list.value[index].moderation_score = 100
                moments_list.value[index].updated_moderation_score = 100
            }else if(moments_list.value[index].moderation_score + value <=0){
                moments_list.value[index].moderation_score = 0
                moments_list.value[index].updated_moderation_score = 0
            } else {
                moments_list.value[index].moderation_score += value;
                moments_list.value[index].updated_moderation_score += value;
            }

        }
        // Optional: You can call API to update backend
        axios.post(`/moments/update-moderation-score`, { id, score: moments_list.value[index].updated_moderation_score })
            .catch(() => console.error("Failed to update score"));
    }

};

const suspendUser = async (id: number) => {
    if (!confirm("Are you sure you want to suspend this user?")) return;

    try {
        await axios.post(`/users/suspend-user`, {id:id})
            .catch(() => console.error("Failed to suspend user"));

        // Remove moment from list UI instantly
        moments_list.value = moments_list.value.filter(m => m.id !== id);

    } catch (err) {
        console.error("Failed to suspend user", err);
        alert("suspend failed. Try again.");
    }
};
const deleteMoment = async (id: number) => {
    if (!confirm("Are you sure you want to delete this moment?")) return;

    try {
        await axios.delete(`/moments/delete/${id}`);

        // Remove moment from list UI instantly
        moments_list.value = moments_list.value.filter(m => m.id !== id);

    } catch (err) {
        console.error("Failed to delete moment", err);
        alert("Delete failed. Try again.");
    }
};

const fetchMoments = async (page = 1) => {
    if (isLoading.value) return;
    isLoading.value = true;

    if (controller) controller.abort();
    controller = new AbortController();

    try {
        const res = await axios.get<ApiPaginatedResponse<MomentList>>(
            `/moments/watch-list?page=${page}&search=${search.value}`,
            { signal: controller.signal }
        );


        if (page === 1) {
            moments_list.value = res.data.data.data;


        } else {
            moments_list.value = [...moments_list.value, ...res.data.data.data];
        }

        pagination.value.current_page = res.data.data.current_page;
        pagination.value.last_page = res.data.data.last_page;

    } catch (err) {
        console.error("Error:", err);
    } finally {
        isLoading.value = false;
    }
};

const loadMoreMoments = () => {
    if (pagination.value.current_page >= pagination.value.last_page) return;
    fetchMoments(pagination.value.current_page + 1);
};

// ---- Infinite Scroll Event ----
const handleScroll = () => {
    if (window.innerHeight + window.scrollY >= document.body.offsetHeight - 1000) {
        loadMoreMoments();
    }
};

onMounted(() => {
    fetchMoments();
    window.addEventListener("scroll", handleScroll);
});

onUnmounted(() => {
    window.removeEventListener("scroll", handleScroll);
});
</script>
