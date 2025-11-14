<template>
    <div
        class="main-modal fixed w-full min-w-sm h-full inset-0 z-50 overflow-hidden flex justify-center items-center animated fadeIn faster bg-black/50">
        <div
            class="border border-black-500 shadow-lg modal-container bg-white w-11/12 md:max-w-md mx-auto rounded z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left">
                <!--Title-->
                <div class="flex justify-between items-center pb-3 px-6 border-b border-gray-200">
                    <!-- <p>{{ admin.id }}</p> -->
                    <p class="text-2xl font-bold">Create Admin</p>
                    <div class="modal-close cursor-pointer z-50" @click="closeModal()">
                        <svg class="fill-current text-black" xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                            viewBox="0 0 18 18">
                            <path
                                d="M14.53 4.53l-1.06-1.06L9 7.94 4.53 3.47 3.47 4.53 7.94 9l-4.47 4.47 1.06 1.06L9 10.06l4.47 4.47 1.06-1.06L10.06 9z">
                            </path>
                        </svg>
                    </div>
                </div>

                <!--Body-->
                <div class=" max-w-3xl m-auto w-full  rounded-xl px-6 py-4">
                    <form @submit.prevent="form.post('/admins')">
                        <div class="grid items-center w-full gap-4">
                            <div class="flex flex-col space-y-1.5">
                                <Label for="name">Name</Label>
                                <Input v-model="form.name" id="name" name="name" :value="admin.name" placeholder="Enter Name" />
                                <p v-if="form.errors.name" class=" text-red-500 text-sm mt-1">{{ form.errors.name }}

                                </p>
                            </div>
                            <div class="flex flex-col space-y-1.5">
                                <Label for="email">Email</Label>
                                <Input v-model="form.email" :value="admin.email" id="email" name="email" placeholder="Enter Email" />
                                <p v-if="form.errors.email" class=" text-red-500 text-sm mt-1">{{ form.errors.email }}
                                </p>
                            </div>

                            <div class="flex flex-col space-y-1.5">
                                <Label for="password">Password</Label>
                                <Input v-model="form.password" id="password" type="password" name="password"
                                    placeholder="Enter Password" />
                                <p v-if="form.errors.password" class=" text-red-500 text-sm mt-1">{{ form.errors.password }}</p>
                            </div>

                            <div class="flex flex-col space-y-1.5">
                                <Label for="roles">Select Roles</Label>
                                <select id="roles" name="roles" v-model="form.roles" multiple
                                    class="block w-full px-3 py-2.5 bg-neutral-secondary-medium border border-default-medium text-heading text-sm rounded-base focus:ring-brand focus:border-brand shadow-xs placeholder:text-body">
                                    <option value="">select Role</option>
                                    <option v-for="(role, index) in roles" :key="index" :value="role"  :selected="(admin.roles.name == role.name) ? true: false ">{{ role }}
                                    </option>
                                </select>

                                <p v-if="form.errors.roles" class=" text-red-500 text-sm mt-1">{{ form.errors.roles
                                }}</p>
                            </div>
                        </div>
                        <!--Footer-->
                        <div class="flex justify-end pt-4">
                            <button
                                class="focus:outline-none modal-close bg-gray-400 px-4 p-2 ml-4 rounded-lg text-black hover:bg-gray-300 cursor-pointer">Cancel</button>
                            <button type="submit"
                                class=" cursor-pointer focus:outline-none bg-teal-500 px-4  p-2 ml-4 rounded-lg text-white hover:bg-teal-400">Submit</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</template>

<script setup lang="ts">
// Imports
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { useForm } from '@inertiajs/vue3';
import { onMounted } from 'vue';
const events = defineEmits(['close-modal']);

onMounted(() => {
    alert('HELO')
})
// uses
const form = useForm({
    name: "",
    email: "",
    password: "",
    roles: [],
})

// --- Types ---


// Refs
const closeModal = () => {
    events('close-modal')
}

// Props & Emit
defineProps<{
    roles: any[],
    admin: any
}>()


// Computed

// Methods

// hooks

</script>
