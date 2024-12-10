<script setup>
import { ref, watch } from 'vue';

const props = defineProps({
    name: {
        type: String,
        required: true
    },
    options: {
        type: Array,
        required: true
    },
    modelValue: {
        type: [String, Number],
        required: true
    },
    message: {
        type: String
    },
    isVisible: {
        type: Boolean,
        default: true
    },
    details: {
        type: String,
    },
});

const emit = defineEmits(['update:modelValue', 'details']);

// Track selected option and dropdown visibility
const internalValue = ref(props.modelValue);
const selectedOption = ref(props.options.find(opt => opt.value === props.modelValue) || null);
const isDropdownOpen = ref(false);

// Tooltip properties
const tooltipVisible = ref(false);
const hoveredOption = ref(null); // Track the option being hovered over
const tooltipContent = ref('');

// Watch for changes to sync with the parent component
watch(internalValue, (newValue) => {
    emit('update:modelValue', newValue);
    const selected = props.options.find(option => option.value === newValue);
    if (selected) {
        emit('details', selected.details);
        tooltipContent.value = newValue + " includes " + selected.details;
    }
    selectedOption.value = selected;
});

// Toggle dropdown visibility
function toggleDropdown() {
    isDropdownOpen.value = !isDropdownOpen.value;
}

// Select an option from the dropdown
function selectOption(option) {
    internalValue.value = option.value;
    selectedOption.value = option;
    isDropdownOpen.value = false;
    hideTooltip()
}

// Show tooltip when hovering over a dropdown item
function showTooltip(option) {
    hoveredOption.value = option;
    tooltipContent.value = option.details; // Assuming the option has a 'details' field
}

// Hide tooltip when not hovering
function hideTooltip() {
    hoveredOption.value = null;
}
</script>

<template>
    <div class="mb-3" :class="{'hidden' : !isVisible}">
        <!-- Label and Tooltip Icon -->
        <label class="block flex items-center">
            {{ name }}
            <span class="ml-2 text-blue-500 cursor-pointer" @click="toggleTooltip" title="Information">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12 6.477 2 12 2z"></path>
                </svg>
            </span>
        </label>

        <!-- Custom Dropdown -->
        <div class="dropdown-container">
            <div @click="toggleDropdown" class="dropdown-header flex justify-between items-center">
                <span>{{ selectedOption ? selectedOption.label : 'Select Category' }}</span>
                <svg :class="{'rotate-180': isDropdownOpen}" class="dropdown-arrow w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>

            <!-- Tooltip for hovered option -->
            <div v-if="hoveredOption" class="tooltip absolute max-w-4xl mt-5 p-2 bg-white border rounded shadow-lg">
                {{ hoveredOption.details }}
            </div>

            <div v-if="isDropdownOpen" class="dropdown-list">
                <div v-for="option in options" :key="option.value" 
                     @mouseenter="showTooltip(option)" 
                     @mouseleave="hideTooltip"
                     @click="selectOption(option)" class="dropdown-item">
                    {{ option.label }}
                </div>
            </div>
        </div>

        <small class="error" v-if="message">{{ message }}</small>
    </div>
</template>

<style scoped>
/* Tooltip styling */
.tooltip {
    position: absolute;
    z-index: 1001; /* Set higher than dropdown-list's z-index */
    max-width: 100%;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
}

/* Custom dropdown styling */
.dropdown-container {
    position: relative;
    width: 100%;
}

.dropdown-header {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    cursor: pointer;
    background-color: #fff;
    display: flex;
    justify-content: space-between; /* Aligns text and arrow to opposite ends */
    align-items: center; /* Centers items vertically */
}

.dropdown-list {
    position: absolute;
    top: 100%;
    left: 0;
    max-height: 315px;
    overflow-y: auto;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #fff;
    z-index: 1000;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    width: 100%;
}

.dropdown-item {
    padding: 4px;
    cursor: pointer;
}

.dropdown-item:hover {
    background-color: #f0f0f0;
}

.dropdown-arrow {
    transition: transform 0.3s ease;
}

.rotate-180 {
    transform: rotate(180deg);
}
</style>
