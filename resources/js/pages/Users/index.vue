<template>

    <Head title="Users" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <UserTabbing @tabs ="tabbing($event)"></UserTabbing>
        <div class=" h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="flex mb-2 items-center justify-between flex-column md:flex-row flex-wrap">
                <div class="flex flex-col space-y-1.5">
                    <Input type="search" v-model="search" id="searchtext" name="searchtext" placeholder="Search user" />
                </div>
            </div>
            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                <Table>
                    <!-- <TableCaption>A list of your recent invoices.</TableCaption> -->
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
                        <TableRow v-for="user in props.users_lists.data" :key="user.id">
                            <!-- id -->
                            <TableCell class="font-sans text-center text-black">
                                {{ user.id }}
                            </TableCell>
                            <!-- users -->
                            <TableCell class="flex items-center px-6 py-4">
                                <Avatar class="size-12 overflow-hidden rounded-full">
                                    <AvatarImage v-if="user.profile_pic"
                                        :src="user.profile_pic + '?tr=w-100,q-60,f-webp'" :alt="user.username" />
                                </Avatar>
                                <div class="ps-3">
                                    <div class="text-base font-semibold">{{ user.last_name }} {{ user.last_name }}</div>
                                    <div class=" text-gray-800">@{{ user.username }}</div>
                                    <div class="font-normal text-gray-500">{{ user.phone_number }}</div>
                                </div>
                            </TableCell>
                            <!-- status -->
                            <TableCell>
                                <Badge :class="(user.status == 'active') ? 'bg-green-600' : 'bg-red-600'">{{ user.status
                                }}</Badge>
                            </TableCell>
                            <!-- created At -->
                            <TableCell>
                                {{ user.formatted_created_at }}
                                <br>
                                {{ user.formatted_diff_for_humans }}
                            </TableCell>
                            <!-- action -->
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
                                            <DropdownMenuItem>
                                                <span>Notes</span>
                                                <!-- <DropdownMenuShortcut>⇧⌘P</DropdownMenuShortcut> -->
                                            </DropdownMenuItem>
                                            <DropdownMenuItem>
                                                <span>Suspend User</span>
                                            </DropdownMenuItem>
                                            <DropdownMenuItem>
                                                <span class="text-red-500"
                                                    @click="handleDeactivate(user.id)">Deactivate</span>
                                            </DropdownMenuItem>
                                            <DropdownMenuItem>
                                                <span>Restore Streak</span>
                                            </DropdownMenuItem>
                                        </DropdownMenuGroup>
                                    </DropdownMenuContent>
                                </DropdownMenu>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>

            </div>
            <div
                class=" mt-2 p-2 relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                <Paginate :parameter = "Parameter" :dataval="users_lists" />
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
import { computed, ref, watch } from 'vue';
import { Head, router, usePage } from '@inertiajs/vue3';

// Layouts & Components
import AppLayout from '@/layouts/AppLayout.vue';

import { Input } from "@/components/ui/input";
import { Button } from "@/components/ui/button";
import { Badge } from "@/components/ui/badge";
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from "@/./components/ui/table";
import {
    Avatar,
    AvatarImage
} from '@/components/ui/avatar';
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuGroup,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from "@/components/ui/dropdown-menu";
import { EllipsisVertical } from 'lucide-vue-next';
import Paginate from '@/components/custom/Paginate.vue';

import { type BreadcrumbItem } from '@/types';
import UserTabbing from './UserTabbing.vue';



// --- type ---
interface User {
    id: number
    username: string
    first_name: string
    last_name: string
    phone_number: string
    profile_pic: string | null
    status: 'active' | 'inactive' | string
    formatted_created_at: string
    formatted_diff_for_humans: string
}

interface Props {
    users_lists: User
}

// --- Props ---
const props = defineProps<Props>()
const { users_lists } = props

// --- Reactive State ---
const search = ref<string>((usePage().props.search as string) || '')
const pageNumber = ref<number>(1)
const tabvalue = ref<string>('total');

// --- Breadcrumbs ---
const breadcrumbs: BreadcrumbItem[] = [{ title: 'Users', href: '/users' }]


const tabbing = (type: string) => {
  tabvalue.value = type;
};
// --- Computed URL ---
const filterUrl = computed(() => {
    const url = new URL('/users', window.location.origin)
    url.searchParams.set('page', pageNumber.value.toString())
    url.searchParams.set('tabbing', tabvalue.value.toString())
    if (search.value) url.searchParams.set('search', search.value)
    return url.toString()
})

const Parameter = computed(() => ({
    search: search.value,
    tabbing: tabvalue.value,
}));

// --- Watchers ---
watch(filterUrl, (updatedUrl) => {
    router.visit(updatedUrl, {
        preserveScroll: true,
        replace: true,
    })
})


// --- Methods ---
const handleDeactivate = (id: number) => {
  if (confirm('Do you want to deactivate this user?')) {
    router.delete(`/users/deactive/${id}`)
  }
}

</script>
