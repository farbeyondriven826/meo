<script setup>
    import TextareaOnly from '@/Components/forms/common/TextareaOnly.vue';
    import InputOnly from '@/Components/forms/common/InputOnly.vue';

    const props = defineProps({
        label:String,
        name:String,
        isView:Boolean,
        placeholder:String,
        type:{
            type:String,
            default:"text"
        },
        data:Object,
        position:{
            type:String,
            default:""
        },
        inputWidth:{
            type:String,
            default:""
        }
    });


</script>

<template>

    <template v-if="props.isView">
        <div class="grid items-baseline" :class="props.position == 'reversed' ? `grid-cols-[80px,1fr]` : 'grid-cols-[max-content,1fr]'">
            <template v-if="props.position != 'reversed'">
                <p class="text-xs">{{ props.label }}</p>
            </template>
            <InputOnly
                :isView="props.isView"
                :name="props.name"
                label=""
                :type="props.type"
                :placeholder="props.placeholder"
                :data="props.data"
            />
            <template v-if="props.position == 'reversed'">
                <p class="text-xs">{{ props.label }}</p>
            </template>
        </div>
    </template>
    <template v-else>
        <div class="grid  gap-2 items-end w-[inherit]" :class="props.position == 'reversed' ? `grid-cols-[80px,1fr]` : 'grid-cols-[max-content,1fr]'">
            <template v-if="props.position != 'reversed'">
                <label class="text-xs" :for="props.name">{{ props.label }}</label>
            </template>
            <InputOnly
                :isView="props.isView"
                :name="props.name"
                label=""
                :type="props.type"
                :placeholder="props.placeholder"
                :data="props.data"
            />
            <template v-if="props.position == 'reversed'">
                <label class="text-xs" :for="props.name">{{ props.label }}</label>
            </template>
        </div>
    </template>


</template>
