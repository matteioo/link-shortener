<template>
    <section class="w-full sm:w-auto">
        <form @submit.prevent="shortenUrl" class="flex flex-col gap-y-4 sm:gap-x-4 sm:gap-y-0 sm:flex-row items-start">
            <div class="w-full">
                <TextInput
                    id="url"
                    ref="urlInput"
                    v-model="form.url"
                    type="text"
                    class="w-full sm:w-96 block"
                    autocomplete="url"
                    autofocus
                    tabindex="1"
                    placeholder="https://domain.example"
                    v-on:update:model-value="form.clearErrors('url')" />

                <InputError :message="form.errors.url" class="mt-2" />
            </div>

            <Button
                type="submit"
                class="w-full sm:w-auto"
                button-type="primary"
                tabindex="1"
                :loading="form.processing"
                :disabled="form.processing">Generate</Button>
        </form>
    </section>
</template>

<script setup>
import TextInput from "@/Components/TextInput.vue";
import InputError from "@/Components/InputError.vue";
import {useForm} from "@inertiajs/vue3";
import {ref} from "vue";
import Button from "@/Components/Button.vue";

const urlInput = ref(null);

const form = useForm({
    url: '',
});

const shortenUrl = () => {
    form.post(route('links.store'), {
        preserveScroll: true,
        onSuccess: () => {

        },
        onError: () => {
            if (form.errors.url) {
                urlInput.value.focus();
            }
        }
    });
}
</script>

<style scoped>

</style>
