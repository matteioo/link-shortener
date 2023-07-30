<template>
    <Head title="Details" />

    <GuestLayout>
        <div class="flex flex-col gap-y-4 text-gray-900 dark:text-gray-100">
            <h1 class="text-center font-medium">
                <a :href="route('link.redirect', link.identifier)" target="_blank" rel="noreferrer noopener"
                   class="underline text-indigo-500">{{ link.url }}</a>
            </h1>

            <table class="mx-auto">
                <tr>
                    <td>Identifier:</td>
                    <td>{{ link.identifier }}</td>
                </tr>
                <tr>
                    <td>Expiration:</td>
                    <td>{{ expiresAt(link.expires_at) }}</td>
                </tr>
                <tr>
                    <td>Clicks:</td>
                    <td>{{ link.clicks }}</td>
                </tr>
            </table>
        </div>
    </GuestLayout>
</template>

<script setup>
import {Head} from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";

dayjs.extend(relativeTime);

defineProps({
    link: {
        type: Object,
        required: true,
    },
})

// Dayjs difference between two dates, function which takes a dateTime object as input and returns string
const expiresAt = (dateTime) => {
    return dayjs(dateTime).fromNow();
}
</script>

<style scoped lang="scss">
    tr {
        td {
            @apply py-1 px-8 first:font-semibold last:text-right;
        }
    }
</style>
