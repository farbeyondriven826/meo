<script setup>
import { computed } from 'vue';

    const props = defineProps({
        label:String,
        name:String,
        placeholder:String,
        type:{
            type:String,
            default:"text"
        },
        isView:Boolean,
        data:Object
    });

    const defaultValue = computed(()=>{
        return props.data?.[props.name] ?? '';
    });
</script>

<template>
    <template v-if="props.isView">
        <div class="border-b border-black px-2 text-xs"> {{ defaultValue }} </div>
    </template>

    <template v-else>
        <input
            :name="props.name"
            :id="props.name"
            :placeholder="props.placeholder"
            :type="props.type"
            class="!w-full !px-1 !py-[4px] !rounded-none focus:outline-none text-xs"
            :value="defaultValue">
    </template>
</template>
