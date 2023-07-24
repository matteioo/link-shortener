<style scoped>

</style>

<template>
    <section>
        <header>
            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">Shorten a URL</h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                Enter a URL which you want to be shortened.
            </p>
        </header>

        <form @submit.prevent="shortenUrl" class="mt-6 space-y-6">
            <div class="flex gap-x-4">
                <div class="w-7/12">
                    <InputLabel for="url" value="URL" />

                    <TextInput
                        id="url"
                        ref="urlInput"
                        v-model="form.url"
                        type="text"
                        class="mt-1 block w-full"
                        autocomplete="url"
                        placeholder="https://domain.example" />

                    <InputError :message="form.errors.url" class="mt-2" />
                </div>

                <div class="w-5/12">
                    <InputLabel for="duration" value="Duration in days" />

                    <TextInput
                        id="duration"
                        ref="durationInput"
                        v-model="form.duration"
                        type="number"
                        class="mt-1 block w-full" />

                    <InputError :message="form.errors.duration" class="mt-2" />
                </div>
            </div>

            <div class="flex gap-x-4">
                <div class="w-1/2">
                    <InputLabel for="password" value="Password" />

                    <TextInput
                        id="password"
                        ref="passwordInput"
                        v-model="form.password"
                        type="password"
                        class="mt-1 block w-full"
                        autocomplete="" />

                    <InputError :message="form.errors.password" class="mt-2" />
                </div>

                <div class="w-1/2">
                    <InputLabel for="password_confirmation" value="Confirm Password" />

                    <TextInput
                        id="password_confirmation"
                        v-model="form.password_confirmation"
                        type="password"
                        class="mt-1 block w-full"
                        autocomplete="" />

                    <InputError :message="form.errors.password_confirmation" class="mt-2" />
                </div>
            </div>

            <div class="flex items-center gap-4">
                <PrimaryButton :disabled="form.processing">Save</PrimaryButton>

                <Transition
                    enter-active-class="transition ease-in-out"
                    enter-from-class="opacity-0"
                    leave-active-class="transition ease-in-out"
                    leave-to-class="opacity-0"
                >
                    <p v-if="form.recentlySuccessful" class="text-sm text-gray-600 dark:text-gray-400">Saved.</p>
                </Transition>
            </div>
        </form>
    </section>
</template>

<script setup>
import {useForm} from "@inertiajs/vue3";
import InputLabel from "@/Components/InputLabel.vue";
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ref} from "vue";

const urlInput = ref(null);
const durationInput = ref(null);
const passwordInput = ref(null);

const form = useForm({
    url: '',
    duration: '1',
    password: '',
    password_confirmation: '',
})

const shortenUrl = () => {
    form.post(route('links.store'), {
        preserveScroll: true,
        onSuccess: () => {
            form.reset();
        },
        onError: () => {
            if (form.errors.url) {
                urlInput.value.focus();
            }
            if (form.errors.duration) {
                durationInput.value.focus();
            }
            if (form.errors.password) {
                passwordInput.value.focus();
            }

            form.reset('password', 'password_confirmation');
        },
    })
}
</script>
