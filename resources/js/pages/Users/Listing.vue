<template>
    <div class="flex mb-2 items-center justify-between flex-column md:flex-row flex-wrap">
        <div class="flex flex-col space-y-1.5">
            <Input type="search" v-model="search" id="searchtext" name="searchtext" placeholder="Search user" />
        </div>
    </div>

    <div
        class="relative min-h-[100vh] flex-1 rounded-sm border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
        <Table>
            <TableHeader>
                <TableRow>
                    <TableHead class="w-[100px] text-center">Id</TableHead>
                    <TableHead class="w-[20%]">Users</TableHead>
                    <TableHead>Status</TableHead>
                    <TableHead>Created At</TableHead>
                    <TableHead class="text-right">Action</TableHead>
                </TableRow>
            </TableHeader>

            <TableBody>
                <TableRow v-for="user in users_list.data" :key="user.id">
                    <TableCell class="font-sans text-center text-black">
                        {{ user.id }}
                    </TableCell>

                    <TableCell class="flex items-center px-6 py-4">
                        <Avatar class="size-12 overflow-hidden rounded-full">
                            <AvatarImage v-if="user.profile_pic" :src="user.profile_pic + '?tr=w-100,q-60,f-webp'"
                                :alt="user.username" />
                        </Avatar>
                        <div class="ps-3">
                            <div class="text-base font-semibold">{{ user.first_name }} {{ user.last_name }}</div>
                            <div class="text-gray-800">@{{ user.username }}</div>
                            <div class="font-normal text-gray-500">{{ user.phone_number }}</div>
                        </div>
                    </TableCell>

                    <TableCell>
                        <Badge :class="user.status === 'active' ? 'bg-green-600' : 'bg-red-600'">
                            {{ user.status }}
                        </Badge>
                    </TableCell>

                    <TableCell>
                        {{ user.formatted_created_at }}<br />
                        {{ user.formatted_diff_for_humans }}
                    </TableCell>

                    <TableCell class="text-right">
                        <DropdownMenu>
                            <DropdownMenuTrigger as-child>
                                <Button variant="outline">
                                    <EllipsisVertical />
                                </Button>
                            </DropdownMenuTrigger>
                            <DropdownMenuContent class="w-56">
                                <DropdownMenuLabel>Action</DropdownMenuLabel>
                                <DropdownMenuSeparator />

                                <DropdownMenuGroup>
                                    <DropdownMenuItem>Notes</DropdownMenuItem>
                                    <DropdownMenuItem>Suspend User</DropdownMenuItem>
                                    <DropdownMenuItem>
                                        <span class="text-red-500">Deactivate</span>
                                    </DropdownMenuItem>
                                    <DropdownMenuItem>Restore Streak</DropdownMenuItem>
                                </DropdownMenuGroup>
                            </DropdownMenuContent>
                        </DropdownMenu>
                    </TableCell>

                </TableRow>
            </TableBody>
        </Table>
    </div>
    <Pagination v-if="paginationShow" :currentPage="pagination.current_page" :links="pagination.links" :lastPage="pagination.last_page"
        @pageChange="fetchUsers" />

</template>


<script setup lang="ts">
// Imports
import { ref, onMounted, watch } from "vue";
import axios from "axios";
import { usePage } from "@inertiajs/vue3";
import {
    Table, TableBody, TableCell, TableHead,
    TableHeader, TableRow
} from "@/components/ui/table";
import { Button } from "@/components/ui/button";
import { Badge } from "@/components/ui/badge";
import { Input } from "@/components/ui/input";
import { Avatar, AvatarImage } from "@/components/ui/avatar";
import {
    DropdownMenu, DropdownMenuContent, DropdownMenuGroup,
    DropdownMenuItem, DropdownMenuLabel, DropdownMenuSeparator,
    DropdownMenuTrigger
} from "@/components/ui/dropdown-menu";
import { EllipsisVertical } from "lucide-vue-next";
import Pagination from "./Pagination.vue";
import { debounce } from "lodash-es";

// -------- Props --------
const props = defineProps<{
    tabvalue: any;
}>();

// ------------ Types ------------
interface UserList {
    id: number;
    profile_pic: string;
    first_name: string;
    last_name: string;
    username: string;
    phone_number: number;
    gender: string;
    dob: string;
    nominated_by: string;
    nominated_by_id: number;
    status: string;
    last_launch_time: string;
    createdAt: string;
    isHighlighted: number;
    profile_visibility: string;
    deactivated_by_type: string;
    deleted_by_id: string;
    user_level: number;
    formatted_created_at: string;
    formatted_diff_for_humans: string;
}

interface ApiPaginatedResponse<T> {
    data: T[];
    total: number;
    per_page: number;
    current_page: number;
    last_page: number;
}
interface PaginationLink {
    url: string | null
    label: string
    active: boolean
}
interface PaginationData {
  current_page: number
  last_page: number
  links: PaginationLink[]
  total: number
  per_page: number
}

// ------------ State ------------
const search = ref<string>((usePage().props.search as string) || "");
const users_list = ref<UserList[]>([]);
const paginationShow = ref<boolean>(false);

const pagination = ref<PaginationData>({
  current_page: 1,
  last_page: 1,
  links: [],
  total: 0,
  per_page: 10
})


let controller: AbortController | null = null;
const fetchUsers = async (page = 1, keyword = search.value, tabbingValue = props.tabvalue ) => {
    // console.log('Fetching users with:', { page, keyword, tabbing });

    if (controller) controller.abort();
    controller = new AbortController();
    try {
        paginationShow.value = false
        const res = await axios.get<ApiPaginatedResponse<UserList>>(
            `/users/user-list?page=${page}&search=${keyword}&tabbing=${tabbingValue}`,
        );

        users_list.value = res.data.data

        pagination.value.current_page = res.data.data.current_page
        pagination.value.last_page = res.data.data.last_page
        pagination.value.links = res.data.data.links
        pagination.value.total = res.data.data.total
        pagination.value.per_page = res.data.data.per_page
        // users_list.value = res.data.data;
        // pagination.value.current_page = res.data.data.current_page;
        // pagination.value.links = res.data.data.links;
        // pagination.value.last_page = res.data.data.last_page;

        paginationShow.value = true


    } catch (error) {
        console.error("Error:", error);
    }
};

const debouncedFetch = debounce((value: string) => {
    fetchUsers(1, value, props.tabvalue);
}, 500); // wait 500ms after typing ends

watch(search, (value) => {
    debouncedFetch(value);
});
watch(() => props.tabvalue, (newTabValue) => {
    fetchUsers(1, search.value, newTabValue);
});
// ------------ API Fetch ------------
onMounted(async () => {
    await fetchUsers();
});
</script>
