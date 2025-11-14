<template>

    <Head title="Create Admin" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="h-full flex flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="max-w-3xl m-auto w-full p-8 border border-gray-200 rounded-xl">
                <form @submit.prevent="form.post('/admins')">
                    <div class="grid items-center w-full gap-4">
                        <div class="flex flex-col space-y-1.5">
                            <Label for="name">Name</Label>
                            <Input v-model="form.name" id="name" name="name" placeholder="Enter Name" />
                            <p v-if="form.errors.name" class=" text-red-500 text-sm mt-1">{{ form.errors.name }}</p>
                        </div>
                        <div class="flex flex-col space-y-1.5">
                            <Label for="email">Email</Label>
                            <Input v-model="form.email" id="email" name="email" placeholder="Enter Email" />
                            <p v-if="form.errors.email" class=" text-red-500 text-sm mt-1">{{ form.errors.email }}</p>
                        </div>

                         <div class="flex flex-col space-y-1.5">
                            <Label for="password">Password</Label>
                            <Input v-model="form.password" id="password" type="password" name="password" placeholder="Enter Password" />
                            <p v-if="form.errors.password" class=" text-red-500 text-sm mt-1">{{ form.errors.password }}</p>
                        </div>

                        <div class="flex flex-col space-y-1.5">
                            <!-- <select name="roles" id="roles" multiple>
                                <option value=""></option>
                            </select> -->
                            <Label for="roles">Select Roles</Label>
                            <select id="roles" name="roles" v-model="form.roles" multiple
                                class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
                                <option value="">select Role</option>
                                <option v-for="role in roles" :key="role" :value="role"  >{{role}}</option>
                            </select>

                            <p v-if="form.errors.roles" class=" text-red-500 text-sm mt-1">{{ form.errors.roles }}</p>
                        </div>
                        <Button type="submit"
                            class="py-2 px-4 rounded-md bg-gray-700 text-white hover:bg-gray-500 cursor-pointer"
                            role="button">Submit</Button>

                    </div>
                </form>
            </div>
        </div>
    </AppLayout>
</template>

<script setup lang="ts">
// Imports
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import { BreadcrumbItem } from '@/types';
import { Label } from '@/components/ui/label';
import { Input } from '@/components/ui/input';

const breadcrumbs: BreadcrumbItem[] = [{
    title: "create Admin",
    href: "/admins/create"
}]

// uses
const form = useForm({
    name:"",
    email:"",
    password:"",
    roles:[],
})

// Refs

// Props & Emit
defineProps({
    roles: Array
})
// Computed

// Methods

// hooks

</script>
