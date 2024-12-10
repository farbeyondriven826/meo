<script setup>
import { computed } from 'vue';

const props = defineProps({
    name: {
        type: String,
        required: true,
    },
    modelValue: {
        type: [String, Number],
        default: "", // Allow for an initial empty state
    },
});

const emit = defineEmits(['update:modelValue']);

// Define the range of years
const startYear = 1900;
const endYear = new Date().getFullYear();

// Create an array of years from endYear to startYear
const years = computed(() => {
    const yearArray = [];
    for (let year = endYear; year >= startYear; year--) {
        yearArray.push(year);
    }
    return yearArray;
});
</script>

<template>
   <div class="mb-1">
        <label class="block" style="color: #0F172A;">{{ name }}</label>
        <select
            :value="modelValue"
            @change="$emit('update:modelValue', $event.target.value)"
            style="border: 1px solid #CBD5E1; padding:4.5px; border-radius: 6px; width:100%;"
        >
            <option value="">Select Year</option>
            <option
                v-for="year in years"
                :key="year"
                :value="year"
                style="color: #0F172A;"
            >
                {{ year }}
            </option>
        </select>
    </div>
</template>
