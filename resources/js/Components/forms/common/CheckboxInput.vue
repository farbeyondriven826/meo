<script setup>
import TextareaOnly from '@/Components/forms/common/TextareaOnly.vue';
import { computed, onMounted, ref, watchEffect } from 'vue';
const props = defineProps({
    label:String,
    name:String,
    isView:Boolean,
    inputName:String,
    data:Object
});

const showInput = ref(false);
const checkboxRef = ref(null);

const showInputHandler = (e) => {
    showInput.value = e.target.checked;
}
const computedName = ref(props.inputName ? props.inputName : props.name+'_others');
const defaultValue = computed(()=>props.data?.[props.name] == 1 ? 'x': '');

watchEffect(() => {
    if(defaultValue.value === 'x' && checkboxRef.value){
        checkboxRef.value.checked = true;
        showInput.value = true;
    }
});

</script>

<template>
    <template v-if="props.isView">
        <div class="grid grid-cols-[50px,1fr] align-baseline items-baseline mt-1">
            <span class="border-2 border-black h-[12px] w-[12px] grid content-center">{{ defaultValue }}</span>
            <div class="grid grid-cols-[max-content,1fr] items-baseline">
                <p class="text-xs">{{ props.label }}</p>
                &nbsp;
                <template v-if="showInput">
                    <TextareaOnly
                        :isView="props.isView"
                        :name="props.name + '_others'"
                        label=""
                        placeholder="others specify"
                        :data="props.data"
                    />
                </template>
            </div>
        </div>
    </template>


    <template v-else>
        <div class="grid grid-cols-[max-content,1fr] align-baseline items-baseline mt-1 w-[inherit]">
            <div class="w-[15px] h-[15px]">
                <input
                    type="checkbox"
                    :name="props.name"
                    :id="props.name"
                    class="!rounded-none focus:outline-none"
                    :data="props.data"
                    ref="checkboxRef"
                    @change="showInputHandler"/>
            </div>
            <div class="grid  items-baseline w-full">
                <label class="text-xs" :for="props.name">{{ props.label }}</label>
                <template v-if="showInput">
                    <TextareaOnly
                        :isView="props.isView"
                        :name="computedName"
                        :data="props.data"
                        label=""
                        placeholder=""/>
                </template>
            </div>
        </div>
    </template>


</template>
