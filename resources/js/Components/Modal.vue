<template>
    <div v-if="show" class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-4xl">

            <div class="flex justify-between items-center p-4 border-b">
                <h3 class="text-lg font-semibold">{{ title }}</h3>
                <span  @click="close" style="cursor: pointer;" class="text-gray-500 hover:text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                        xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </span>
            </div>

            <div>
                <slot name="content"></slot>
            </div>

            <div>
                <slot name="footer"></slot>
            </div>

            <!-- <div class="flex justify-end mt-4">
                <button @click="printPdf" class="mr-2 bg-blue-500 text-white px-4 py-2 rounded">Print</button>
                <button @click="downloadPdf" class="bg-green-500 text-white px-4 py-2 rounded">Download</button>
            </div> -->
        </div>
    </div>
</template>

<script setup>
import { ref, watch, onMounted } from 'vue';

const props = defineProps({

    title: {
        type: String,
        required: true,
    },
    show: {
        type: Boolean,
        required: true,
    },
});

const emit = defineEmits(['update:show']);

// Function to close modal
const close = () => {
    emit('update:show', false);
};


</script>

<style scoped>
/* Optional: Custom styling for the modal */
</style>
