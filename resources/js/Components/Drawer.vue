<script setup>
    const props = defineProps({
        show: {
            type: Boolean,
            required: true,
        },
    })

    const emit = defineEmits(['update:show']);

    const close = () => {
        emit('update:show', false);
    };


</script>


<template>
    <div v-if="show" class="fixed left-0 right-0 bottom-0 top-0 z-[100]">
        <div class="relative h-full w-full">
            <div class="absolute z-10 w-full h-full opacity-50 bg-slate-500" @click="close"></div>
            <div class="h-full w-[90vw] z-20 bg-white relative">
                <div class="">
                    <slot name="content"></slot>
                </div>

                <div>
                    <slot name="footer"></slot>
                </div>
            </div>
        </div>
    </div>
</template>
