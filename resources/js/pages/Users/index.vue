<template>

    <Head title="Users" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div>
            <UserTabbing @tabs="tabbing($event)" />
        </div>

        <div>
            <div class="h-full flex-1 flex-col gap-4 overflow-x-auto rounded-sm p-4">
                <Listing :tabvalue="tabvalue" />
            </div>
        </div>

    </AppLayout>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { Head, usePage } from '@inertiajs/vue3';

// Layouts & Components
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import UserTabbing from './UserTabbing.vue';
import Listing from './Listing.vue';

// Breadcrumbs
const breadcrumbs: BreadcrumbItem[] = [{ title: 'Users', href: '/users' }];

// --- Reactive State ---
// const search = ref<string>((usePage().props.search as string) || '');

// const pageNumber = ref<number>(Number((usePage().props as any).page || 1) || 1);
const tabvalue = ref<string>((usePage().props.tabbing as string) || 'total');

    const tabbing = (type: string) => {
        tabvalue.value = type;
};

</script>
