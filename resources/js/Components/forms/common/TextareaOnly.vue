<script setup>
import { computed } from 'vue';

    const props = defineProps({
        label:String,
        name:String,
        placeholder:String,
        isView:Boolean,
        data:Object
    });

    const defaultValue = computed(()=>{
        return props.data?.[props.name] ?? '';
    });

</script>

<template>
    <template v-if="props.isView">
        <div class="border-b border-black text-xs">{{ defaultValue }}</div>
    </template>

    <template v-else>
        <textarea
            :name="props.name"
            :id="props.name"
            :placeholder="props.placeholder"
            type="text"
            class="!w-full text-xs"
            :value="defaultValue"
        ></textarea>
    </template>
</template>
