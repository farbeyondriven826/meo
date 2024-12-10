<script setup>
    import BoxInput from '@/Components/forms/common/BoxInput.vue';
    import BoxOne from '@/Components/forms/requirements/building-forms/BoxOne.vue';
    import BoxTwo from '@/Components/forms/requirements/building-forms/BoxTwo.vue';
    import BoxThree from '@/Components/forms/requirements/building-forms/BoxThree.vue';
    import BoxFive from '@/Components/forms/requirements/building-forms/BoxFive.vue';
    import BoxSix from '@/Components/forms/requirements/building-forms/BoxSix.vue';
    import BoxSeven from '@/Components/forms/requirements/building-forms/BoxSeven.vue';
    import Checkbox from '@/Components/forms/common/Checkbox.vue';
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
    <div class="relative m-2">
        <span class="absolute left-0">NBC FORM NO. B-01</span>

        <form :name="props.form" :id="props.form" ref="form">
            <div>
                <p class="text-center">Republic of the Philippines</p>
                <p class="text-center">MUNICIPALITY OF BASUD</p>
                <p class="text-center">PROVINCE OF CAMARINES NORTE</p>
                <p class="text-center">OFFICE OF THE BUILDING OFFICIAL</p>
                <h1 class="text-center">APPLICATION FOR BUILDING PERMIT</h1>
                <div class="w-[300px] m-auto grid justify-center align-center grid-flow-col gap-2 my-3">
                    <Checkbox label="New" gap="max-content" name="application_type_new" :isView="props.isView"/>
                    <Checkbox label="Renewal"  gap="max-content" name="application_type_renewal" :isView="props.isView"/>
                    <Checkbox label="Ammendatory"  gap="max-content" name="application_type_ammendatory" :isView="props.isView"/>
                </div>
            </div>

            <div class="grid grid-flow-col">
                <BoxInput label="APPLICATION NO." name="application_no" :count="10" :isView="props.isView" :data="props.data"/>
                <div class="ml-[300px]">
                    <BoxInput label="AREA NO." name="area_no" :count="11" :isView="props.isView" :data="props.data"/>
                </div>
            </div>


            <BoxOne  :isView="props.isView" :data="props.data"/>
            <BoxTwo  :isView="props.isView"/>
            <BoxThree :isView="props.isView"/>
            <BoxFive :isView="props.isView"/>
            <BoxSix :isView="props.isView"/>
            <BoxSeven :isView="props.isView"/>
        </form>


    </div>
</template>
