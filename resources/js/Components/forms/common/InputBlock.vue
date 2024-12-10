<script setup>
    import InputOnly from '@/Components/forms/common/InputOnly.vue';
import { computed } from 'vue';

    const props = defineProps({
        label:String,
        name:String,
        isView:Boolean,
        placeholder:String,
        labelStyle:{
            type:String,
            default:""
        },
        type:{
            type:String,
            default:"text"
        },
        data:Object,
        defaultValue:String
    });

    const defaultValue = computed(()=>{
        return props?.defaultValue || (props.data?.[props.name] ?? '');
    });



</script>

<template>
    <template v-if="props.isView">
        <div class="grid align-baseline items-baseline mt-1">
            <div class="text-xs p-1" :class="props.labelStyle">{{ props.label }}</div>
            <div class="text-xs px-1"> {{ defaultValue }} </div>
        </div>
    </template>


    <template v-else>
        <div class="grid mt-1">
            <label class="text-xs" :for="props.name">{{ props.label }}</label>
            <InputOnly
                :isView="props.isView"
                :name="props.name"
                label=""
                :type="props.type"
                :placeholder="props.placeholder"
                :data="props.data"
            />
        </div>
    </template>


</template>
