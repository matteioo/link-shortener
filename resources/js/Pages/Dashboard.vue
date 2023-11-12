<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import {Head, usePage} from '@inertiajs/vue3';
import CreateLinkForm from "@/Pages/Links/Partials/CreateLinkForm.vue";

console.log(usePage().props.auth);
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12 space-y-6">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 shadow-sm sm:rounded-lg bg-white dark:bg-gray-800">
                    <CreateLinkForm class="max-w-3xl" />
                </div>
            </div>

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sp:p-8 shadow-sm sm:rounded-lg bg-white dark:bg-gray-800">
                    <div class="mb-4" v-if="$page.props.auth.roles.includes('admin')">
                        <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-200">Admin</h3>
                        <p class="text-sm text-gray-500 dark:text-gray-400">You're an admin.</p>

                        {{ $page.props.auth.roles }}
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
