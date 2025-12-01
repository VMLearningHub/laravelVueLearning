<template>
    <div class="flex items-center space-x-2 p-2 bg-slate-200 shadow-sm">
        <button type="button" @click.prevent="tabtype('total')" :class="[
            'cursor-pointer px-3 py-1.5 text-sm rounded-sm shadow-md',
            activeTab === 'total'
                ? 'bg-blue-600 text-white font-semibold'
                : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-100 font-medium'
        ]">
            Total {{ countUserData?.total_user ?? 0 }} ({{ countUserData?.today_user ?? 0 }})
        </button>

        <button type="button" @click.prevent="tabtype('inside')" :class="[
            'cursor-pointer px-3 py-1.5 text-sm rounded-sm transition-colors',
            activeTab === 'inside'
                ? 'bg-blue-600 text-white font-semibold'
                : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-100 font-medium'
        ]">
            Inside {{ countUserData?.active_user ?? 0 }} ({{ countUserData?.todayActiveUser ?? 0 }})
        </button>

        <button @click.prevent="tabtype('outside')" :class="[
            'cursor-pointer px-3 py-1.5 text-sm rounded-sm transition-colors',
            activeTab === 'outside'
                ? 'bg-blue-600 text-white font-semibold'
                : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-100 font-medium'
        ]">
            Outside {{ countUserData?.waiting_user ?? 0 }} ({{ countUserData?.todayWaitingUser ?? 0 }})
        </button>
        <button @click.prevent="tabtype('deactivated')" :class="[
            'cursor-pointer px-3 py-1.5 text-sm rounded-sm transition-colors',
            activeTab === 'deactivated'
                ? 'bg-blue-600 text-white font-semibold'
                : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-100 font-medium'
        ]">
            Deactivated {{ countUserData?.deactivated_user ?? 0 }} ({{ countUserData?.todayDeactiveUser ?? 0 }})
        </button>
        <button @click.prevent="tabtype('deleted')" :class="[
            'cursor-pointer px-3 py-1.5 text-sm rounded-sm transition-colors',
            activeTab === 'deleted'
                ? 'bg-blue-600 text-white font-semibold'
                : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-100 font-medium'
        ]">
            Deleted {{ countUserData?.deleted_user ?? 0 }} ({{ countUserData?.todayDeletedUser ?? 0 }})
        </button>
        <button @click.prevent="tabtype('highlighted')" :class="[
            'cursor-pointer px-3 py-1.5 text-sm rounded-sm transition-colors',
            activeTab === 'highlighted'
                ? 'bg-blue-600 text-white font-semibold'
                : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-100 font-medium'
        ]">
            Highlighted {{ countUserData?.highlighted_user ?? 0 }}
        </button>
        <button @click.prevent="tabtype('nominated_by_currently')" :class="[
            'cursor-pointer px-3 py-1.5 text-sm rounded-sm transition-colors',
            activeTab === 'nominated_by_currently'
                ? 'bg-blue-600 text-white font-semibold'
                : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-100 font-medium'
        ]">
            Nominated By Currently {{ countUserData?.totalNominatedby ?? 0 }} ({{ countUserData?.todayNominatedby ?? 0
            }})
        </button>
    </div>
</template>

<script setup lang="ts">
import axios from 'axios';
import { ref, defineEmits, onMounted } from 'vue';

const countUserData = ref<CounteUserData | null>(null);

interface CounteUserData {
    total_user: number;
    deactivated_user: number;
    deleted_user: number;
    totalNominatedby: number;
    active_user: number;
    waiting_user: number;
    highlighted_user: number;
    today_user: number;
    todayWaitingUser: number;
    todayActiveUser: number;
    todayDeactiveUser: number;
    todayDeletedUser: number;
    todayNominatedby: number;
}
const emit = defineEmits(['tabs']);

const activeTab = ref<string>("total");

const tabtype = (type: string) => {
    activeTab.value = type;
    emit('tabs', type);
};

onMounted(async () => {
    const response = await axios.post("/users/count-user-data");
    countUserData.value = response.data;
})

</script>
