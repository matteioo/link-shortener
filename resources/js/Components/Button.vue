<script>
import {defineComponent} from 'vue'

export default defineComponent({
    props: {
        size: {
            type: String,
            default: 'base',
        },
        buttonType: {
            type: String,
            default: 'primary',
        },
        loading: {
            type: Boolean,
            default: false,
        },
    },
    computed: {
        sizeClasses() {
            const sizeClasses = {
                'sm': 'px-4 py-2 text-xs',
                'base': 'px-4 py-2 text-base',
            }

            return sizeClasses[this.size] ?? sizeClasses['base'];
        },
        styleClasses() {
            const styleClasses = {
                'primary': 'border-transparent bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-800 enabled:hover:bg-gray-700 enabled:dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300',
                'secondary': 'border-gray-300 dark:border-gray-500 bg-white dark:bg-gray-800 text-gray-700 dark:text-gray-300 shadow-sm enabled:hover:bg-gray-50 enabled:dark:hover:bg-gray-700'
            }

            return styleClasses[this.buttonType] ?? styleClasses['primary'];
        }
    }
})
</script>

<template>
    <button :class="`${sizeClasses} ${styleClasses}`"
        class="inline-flex justify-center items-center rounded-md font-semibold uppercase tracking-widest border focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150"
    >
        <svg v-if="loading" class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <slot />
    </button>
</template>

<style scoped>

</style>
