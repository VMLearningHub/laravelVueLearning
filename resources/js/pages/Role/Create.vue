<template>

    <Head title="Create Role" />
    <AppLayout :breadcrumbs="breadcrumbs">
        <div class="h-full flex flex-col gap-4 overflow-x-auto rounded-xl p-4">
            <div class="max-w-3xl m-auto w-full p-8 border border-gray-200 rounded-xl">
                <form @submit.prevent="form.post('/roles')">
                    <div class="grid items-center w-full gap-4">
                        <div class="flex flex-col space-y-1.5">
                            <Label for="name">Name</Label>
                            <Input v-model="form.name" id="name" name="name" placeholder="Name of your project" />
                            <p v-if="form.errors.name" class=" text-red-500 text-sm mt-1">{{ form.errors.name }}</p>
                        </div>

                        <div class="grid grid-cols-3 gap-4">
                            <!-- <div v-for="permission in permissions" :key="permission" class="flex gap-1 items-start"> -->
                            <label v-for="permission in permissions" :key="permission" class="flex items-center space-x-2">
                                <input
                                    id="{{ permission }}"
                                    type="checkbox"
                                    class="form-check-input"
                                    :value="permission"
                                    v-model="form.per"
                                />
                                <span for="{{ permission }}" class="text-gray-800 capitalize">{{ permission }}</span>
                            </label>

                            <!--<Label :for="permission" class="text-sm font-medium leading-none">
                                    {{ permission }}
                                </Label>
                            </div> -->
                            <p v-if="form.errors.permissions" class=" text-red-500 text-sm mt-1">
                                {{ form.errors.permissions }}</p>
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
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import AppLayout from '@/layouts/AppLayout.vue';
import { BreadcrumbItem } from '@/types';
import { Head, useForm } from '@inertiajs/vue3';

// uses
const breadcrumbs: BreadcrumbItem[] = [{
    title: "Roles",
    href: "/roles"
}, {
    title: "Create Role",
    href: "/roles/create"

}]

// Props & Emit
defineProps({
    permissions: Array
})

const form = useForm({
    name: "",
    per: [],
})
</script>
