<script setup>
defineProps({
    name: {
        type: String,
        required: true
    },
    type: {
        type: String,
        default: "text"
    },
    modelValue: {
        type: null,
        required: true
    },
    message: {
        type: String
    },
    readonly: {
        type: Boolean,
        default: false
    },
    isUppercase: {
        type: Boolean,
        default: false
    },
    placeholder: {  // Add placeholder prop here
        type: String,
        default: ""   // Optional default value
    },
})
const emit = defineEmits(['update:modelValue']);
</script>

<template>
    <div class="mb-1">
        <label class="block">{{name}}</label>
        <input 
            :type="type" 
            :value="modelValue"
            :readonly="readonly"
            :placeholder="placeholder"
            @input="$emit('update:modelValue', $event.target.value)"
            :class="{'!ring-red-500' : message, 'uppercase' : isUppercase}"
        >
        <small class="error" v-if="message">{{ message }}</small>
    </div>
</template>