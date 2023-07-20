<style scoped lang="scss">
    th, td {
        @apply p-4 first:pl-8 last:pr-8;
    }

    th {
        @apply font-medium text-gray-800 dark:text-gray-200;
    }

    td {
        @apply text-gray-600 dark:text-gray-400 first:text-gray-700 dark:first:text-gray-300 first:font-medium;
    }
</style>

<template>
    <Head title="Link overview" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Link Overview</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
                <div class="rounded-lg overflow-hidden shadow-sm">
                    <table class="w-full shadow-sm rounded divide-y divide-gray-300 dark:divide-gray-600">
                        <thead class="text-left bg-gray-50 dark:bg-gray-950/30">
                            <tr>
                                <th>Identifier</th>
                                <th>URL</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                            <tr v-for="link in links">
                                <td>{{ link.identifier }}</td>
                                <td>
                                    <a :href="link.url" target="_blank" rel="noreferrer noopener"
                                       class="underline text-indigo-500">{{ link.url }}</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';

defineProps({
    links: Array,
})
</script>
