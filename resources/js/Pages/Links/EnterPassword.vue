<template>
    <GuestLayout>
        <Head title="Enter password" />

        <form @submit.prevent="submit">
            <div class="mt-4">
                <InputLabel for="password" value="Password" />
                <TextInput @keydown="form.clearErrors()"
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Submit
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>

<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, useForm } from '@inertiajs/vue3';

const props = defineProps({
    identifier: String,
});

const form = useForm({
    password: '',
});

const submit = () => {
    form.post(route('link.redirect', props.identifier), {
        onError: () => {
            form.reset('password');
        },
    });
};
</script>
