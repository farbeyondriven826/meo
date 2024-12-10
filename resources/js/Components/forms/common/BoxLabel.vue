<script setup>

const props = defineProps({
    label:String,
})
</script>
<template>
    <p class="text-sm">{{ props.label }}</p>
</template>
