<template>

    <Head title="Users" />

    <AppLayout :breadcrumbs="breadcrumbs">
        <div>
            <MomentList />
        </div>
    </AppLayout>
</template>

<script setup lang="ts">

import { Head } from '@inertiajs/vue3';
// Layouts & Components
import AppLayout from '@/layouts/AppLayout.vue';
import { type BreadcrumbItem } from '@/types';
import MomentList from './MomentList.vue';

// Breadcrumbs
const breadcrumbs: BreadcrumbItem[] = [{ title: 'Moments', href: '/moments' }];


</script>
