<template>
    <Head  title="Roles"/>
    <AppLayout :breadcrumbs="breadcrumbs">
          <div class=" h-full flex-1 flex-col gap-4 overflow-x-auto rounded-xl p-4">
              <div class=" mb-2 flex items-center justify-between flex-column md:flex-row flex-wrap">
                <div class="flex flex-col space-y-1.5">
                    <!-- <Input type="search" v-model="search" id="searchtext" name="searchtext" placeholder="Search admin" /> -->
                    <Button variant="outline">
                        <Link :href="'/roles/create'">Create</Link>
                    </Button>
                </div>
            </div>
            <div class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 md:min-h-min dark:border-sidebar-border">
                <Table>
                    <TableHeader>
                        <TableRow>
                            <TableHead class="w-[100px] text-center">Id</TableHead>
                            <TableHead class="w-[20%]">Roles</TableHead>
                            <TableHead>Guard name</TableHead>
                            <TableHead>Created At</TableHead>
                            <TableHead>Permissions</TableHead>
                        </TableRow>
                    </TableHeader>
                    <TableBody>
                        <TableRow v-for="role in roles" :key="role.id">
                            <!-- id -->
                            <TableCell class="font-sans text-center text-black">
                                {{ role.id }}
                            </TableCell>
                            <!-- roles -->
                            <TableCell>
                                <Badge class="bg-green-600">{{ role.name}}</Badge>
                            </TableCell>
                            <!-- guard -->
                            <TableCell >
                                {{ role.guard_name }}
                            </TableCell>
                            <!-- created at -->
                             <TableCell>
                                {{ deteformat(role.created_at) }}
                            </TableCell>
                            <!-- permissions -->
                            <TableCell class="grid grid-cols-6 gap-4">
                                <div v-for="per in role.permissions" :key="per.id">
                                    <Badge  class="bg-green-600 m-1">{{ per.name }}</Badge>
                                </div>
                            </TableCell>

                        </TableRow>
                    </TableBody>
                </Table>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
// Imports
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import { type BreadcrumbItem } from '@/types';
import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Badge } from '@/components/ui/badge';
import { useDateFormat } from '@vueuse/core';
import { Button } from '@/components/ui/button';

const breadcrumbs: BreadcrumbItem[] = [{
    title:'Roles',
    href:'/roles'
}]
// Refs

// Props & Emit
defineProps({
    roles:Array
})

// Computed


// Methods
function deteformat (date:Date){
    return useDateFormat(date, 'YYYY/MMM/DD - HH:mm')

}

// hooks

</script>
