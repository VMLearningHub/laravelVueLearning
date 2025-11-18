<template>

    <Head title="Admin" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <!-- Search + Create -->
            <div class="mb-2 flex items-center justify-between flex-column md:flex-row flex-wrap">
                <div class="flex flex-col space-y-1.5">
                    <Input type="search" v-model="search" id="searchtext" name="searchtext"
                        placeholder="Search admin" />
                </div>

                <!-- <div class="flex flex-col space-y-1.5" v-if="can('public-activity-create')"> -->
                <div class="flex flex-col space-y-1.5">
                    <!-- <Button variant="outline">
                        <Link href="/admins/create">Create</Link>
                    </Button> -->

                    <Button type="button" variant="outline" @click="setShow({})">
                        <!-- <Link href="/admins/create">Create</Link> -->
                        Create
                    </Button>
                </div>
            </div>

            <!-- Table -->
            <div
                class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-[100px] text-center">Id</TableHead>
                            <TableHead class="w-[20%]">Admin</TableHead>
                            <TableHead>Email</TableHead>
                            <TableHead>Roles</TableHead>
                            <TableHead>Created At</TableHead>
                            <TableHead class="text-right">Action</TableHead>
                        </TableRow>
                    </TableHeader>

                    <TableBody>
                        <TableRow v-for="admin in admins" :key="admin.id">
                            <!-- id -->
                            <TableCell class="font-sans text-center text-black">
                                {{ admin.id }}
                            </TableCell>

                            <!-- name -->
                            <TableCell class="flex items-center px-6 py-4">
                                {{ admin.name }}
                            </TableCell>

                            <!-- email -->
                            <TableCell>
                                {{ admin.email }}
                            </TableCell>

                            <!-- roles -->
                            <TableCell>
                                <div class="m-1" v-for="(role, index) in admin.roles" :key="index">
                                    <Badge class="bg-green-600">{{ role.name }}</Badge>
                                </div>
                            </TableCell>

                            <!-- created -->
                            <TableCell>
                                {{ admin.formatted_created_at }}
                                <br />
                                {{ admin.formatted_diff_for_humans }}
                            </TableCell>

                            <!-- actions -->
                            <TableCell class="text-right">
                                <DropdownMenu>
                                    <DropdownMenuTrigger as-child>
                                        <Button variant="outline" >
                                            <EllipsisVertical />
                                        </Button>
                                    </DropdownMenuTrigger>
                                    <DropdownMenuContent class="w-56">
                                        <DropdownMenuLabel>Action</DropdownMenuLabel>
                                        <DropdownMenuSeparator />
                                        <DropdownMenuGroup>
                                            <DropdownMenuItem @click=setShow(admin)>
                                                Edit
                                                <!-- <Link :href="`/admins/${admin.id}/edit`">Edit</Link> -->
                                            </DropdownMenuItem>
                                            <DropdownMenuItem>
                                                <span class="text-red-500 cursor-pointer"
                                                    @click="handleDeleteAdmin(admin.id)">
                                                    Deactivate
                                                </span>
                                            </DropdownMenuItem>
                                        </DropdownMenuGroup>
                                    </DropdownMenuContent>
                                </DropdownMenu>
                            </TableCell>
                        </TableRow>
                    </TableBody>
                </Table>
                <CreateModel v-if="show" @close-modal="setShow" :admin="selectedAdmin  " :roles="[]" />
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
// Vue & Inertia imports
import { ref } from 'vue'
import { Head, Link, router } from '@inertiajs/vue3'

// Layouts & Components
import AppLayout from '@/layouts/AppLayout.vue'
import { Button } from '@/components/ui/button'
import {
    Table,
    TableBody,
    TableCell,
    TableHead,
    TableHeader,
    TableRow,
} from '@/components/ui/table'
import {
    DropdownMenu,
    DropdownMenuContent,
    DropdownMenuGroup,
    DropdownMenuItem,
    DropdownMenuLabel,
    DropdownMenuSeparator,
    DropdownMenuTrigger,
} from '@/components/ui/dropdown-menu'
import { EllipsisVertical } from 'lucide-vue-next'
import { Input } from '@/components/ui/input'
import { Badge } from '@/components/ui/badge'

// Helpers
// import { can } from '@/lib/can'
import type { BreadcrumbItem } from '@/types'
import CreateModel from './CreateModel.vue'

const show = ref(false)
const selectedAdmin = ref()

const setShow = (admin: any) => {
    if (!admin) {
        show.value = false
        return
    }
    selectedAdmin.value = admin
    show.value = true
}

// --- Types ---
interface Role {
    id: number
    name: string
}

interface Admin {
    id: number
    name: string
    email: string
    roles: Role[]
    formatted_created_at: string
    formatted_diff_for_humans: string
}

// --- Props ---
defineProps<{
    admins: Admin[]
}>()

// --- State ---
const search = ref<string>('')

// --- Breadcrumbs ---
const breadcrumbs: BreadcrumbItem[] = [
    { title: 'Admin', href: '/admin' },
]

// --- Methods ---
const handleDeleteAdmin = (id: number): void => {
    if (confirm('Do you want to delete this admin?')) {
        router.delete(`/admins/${id}`)
    }
}
</script>
