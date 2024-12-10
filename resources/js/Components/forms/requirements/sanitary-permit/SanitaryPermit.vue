<script setup>
import BoxInput from '@/Components/forms/common/BoxInput.vue';
import BoxOne from '@/Components/forms/requirements/sanitary-permit/BoxOne.vue';
import { toFormData } from '@/utils/forms';
import { defineEmits, watchEffect, ref } from 'vue';

const props = defineProps({
    isView:{
        type:Boolean,
        required:true,
        default:false
    },
    isSubmit:{
        type:Boolean,
        required:true,
        default:false
    },
    form:{
        type:String,
        required:true,
        default:"form"
    },
    data:Object
});
const form = ref(null);
const emits = defineEmits(['submit']);

watchEffect(()=>{
    if(props.isSubmit){
        const json = toFormData(form.value,{json:true});
        console.log(38,json);
        emits('submit',json);
        props.isSubmit = false;
    }
});
</script>

<template>
    <div>
        <p class="text-xs text-center">REPUBLIC OF THE PHILIPPINES</p>
        <p class="text-xs text-center">Office of the Municipal Mayor</p>
        <p class="text-xs text-center">Basud, Camarines Norte</p>
    </div>
    <br/>
    <h1 class="font-bold text-lg text-center">SANITARY/PLUMBING PERMIT</h1>

    <div class="grid grid-flow-col p-2">
        <div>
            <BoxInput label="APPLICATION NO." name="application_no" :count="10" :isView="props.isView" :data="props.data"/>
            <div class="mt-10 grid grid-flow-row w-[250px]">
                <span class=" border-b border-black"></span>
                <p class="text-[12px] text-center">Date of Application</p>
            </div>
        </div>
        <div class="grid justify-end">
            <div>
            <BoxInput label="PERMIT NO." name="permit_no" :count="11" :isView="props.isView" :data="props.data"/>
            <div class="mt-10 grid grid-flow-row w-[250px]">
                <span class=" border-b border-black"></span>
                <p class="text-[12px] text-center">Date of Issued</p>
            </div>
        </div>
        </div>
    </div>

    <BoxOne/>
</template>
