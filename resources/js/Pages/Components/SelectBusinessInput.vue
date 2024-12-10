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

const internalValue = ref(props.modelValue);
const selectedOption = ref(props.options.find(opt => opt.project_title === props.modelValue) || null);
const isDropdownOpen = ref(false);
const tooltipVisible = ref(false);
const hoveredOption = ref(null);
const tooltipContent = ref('');

// Watch changes to sync with parent component
watch(internalValue, (newValue) => {
    emit('update:modelValue', newValue);
    const selected = props.options.find(option => option.project_title === newValue);
    if (selected) {
        emit('details', selected.details);
        tooltipContent.value = selected.details;
    }
    selectedOption.value = selected;
});

function toggleDropdown() {
    isDropdownOpen.value = !isDropdownOpen.value;
}

function selectOption(option) {
    internalValue.value = option.project_title;
    selectedOption.value = option;
    isDropdownOpen.value = false;
    hideTooltip();
}

function showTooltip(option) {
    hoveredOption.value = option;
    tooltipContent.value = option.details || 'No details available';
}

function hideTooltip() {
    hoveredOption.value = null;
}
</script>

<template>
    <div class="mb-3" :class="{ hidden: !isVisible }">
        <label class="block mb-2">{{ name }}</label>
        <div class="dropdown-container relative">
            <div @click="toggleDropdown" class="dropdown-header flex justify-between items-center">
                <span>{{ selectedOption ? selectedOption.project_title : 'Select Business Name' }}</span>
                <svg :class="{ 'rotate-180': isDropdownOpen }" class="dropdown-arrow w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </div>
            <div v-if="isDropdownOpen" class="dropdown-list">
                <div
                    v-for="option in options"
                    :key="option.project_title"
                    @mouseenter="showTooltip(option)"
                    @mouseleave="hideTooltip"
                    @click="selectOption(option)"
                    class="dropdown-item"p
                >
                    {{ option.project_title }}
                    <span v-if="hoveredOption === option" class="tooltip">
                        {{ tooltipContent }}
                    </span>
                </div>
            </div>
        </div>
        <small class="error" v-if="message">{{ message }}</small>
    </div>
</template>

<style scoped>
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
    justify-content: space-between;
    align-items: center;
}

.dropdown-list {
    position: absolute;
    top: 100%;
    left: 0;
    max-height: 315px;
    overflow-y: auto;
    overflow-x: hidden;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-color: #fff;
    z-index: 1000;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    width: 100%;
}

.dropdown-item {
    padding: 8px;
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

.tooltip {
    position: absolute;
    z-index: 1001;
    background-color: #fff;
    border: 1px solid #ccc;
    border-radius: 4px;
    padding: 8px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
    left: 100%;
    top: 0;
    margin-left: 10px;
}
</style>
