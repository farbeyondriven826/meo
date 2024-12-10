<script setup>
import { computed, onMounted, ref, watchEffect } from 'vue';


    const props = defineProps({
        label:String,
        name:String,
        isView:Boolean,
        gap:{
            type:String,
            default:"50px"
        },
        data:Object
    });

    const checkboxRef = ref(null);

    const defaultValue = computed(()=>{
        return props.data?.[props.name] == 1 ? 'x': '';
    });

    watchEffect(() => {
        if(defaultValue.value === 'x' && checkboxRef.value){
            checkboxRef.value.checked = true;
        }
    });

</script>

<template>

    <template v-if="props.isView">
        <div :class="`grid grid-cols-[${props.gap},1fr] align-baseline items-baseline mt-1`">
            <span class="border-2 border-black h-[12px] w-[12px] grid content-center">{{ defaultValue }}</span>
            <p class="text-xs">{{ props.label }}</p>
        </div>
    </template>

    <template v-else>
        <div class="grid grid-cols-[max-content,1fr] align-baseline items-baseline mt-1">
            <div class="w-[15px] h-[15px]">
                <input
                    ref="checkboxRef"
                    type="checkbox"
                    :name="props.name"
                    :id="props.name"
                    :data="props.data"
                    class="!rounded-none focus:outline-none" />
            </div>
            <label class="text-xs" :for="props.name">{{ props.label }}</label>
        </div>
    </template>
</template>
