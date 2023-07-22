<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
import CreateLinkForm from "@/Pages/Links/Partials/CreateLinkForm.vue";
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="p-4 sm:p-8 shadow-sm sm:rounded-lg bg-white dark:bg-gray-800">
                    <CreateLinkForm class="max-w-3xl" />
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
