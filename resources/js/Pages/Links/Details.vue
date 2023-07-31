<template>
    <Head title="Details" />

    <div
        class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-dots-lighter dark:bg-gray-900 selection:bg-indigo-500 selection:text-white"
    >
        <div v-if="route().has('login')" class="sm:fixed sm:top-0 sm:right-0 p-6 text-right">
            <Link
                v-if="$page.props.auth.user"
                :href="route('dashboard')"
                tabindex="3"
                class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500"
            >Dashboard</Link
            >

            <template v-else>
                <Link
                    :href="route('login')"
                    tabindex="4"
                    class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500"
                >Log in</Link>

                <Link
                    v-if="route().has('register')"
                    :href="route('register')"
                    tabindex="5"
                    class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-indigo-500"
                >Register</Link>
            </template>
        </div>

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
    </div>
</template>

<script setup>
import {Head, Link} from "@inertiajs/vue3";
import GuestLayout from "@/Layouts/GuestLayout.vue";
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";

dayjs.extend(relativeTime);

defineProps({
    link: {
        type: Object,
        required: true,
    },
    canLogin: {
        type: Boolean,
    },
    canRegister: {
        type: Boolean,
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
