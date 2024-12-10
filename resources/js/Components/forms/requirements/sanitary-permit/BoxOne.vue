<script setup>
    import Checkbox from '@/Components/forms/common/Checkbox.vue';
    import CheckboxInput from '@/Components/forms/common/CheckboxInput.vue';
    import CheckboxInputInline from '@/Components/forms/common/CheckboxInputInline.vue';
    import InputInline from '@/Components/forms/common/InputInline.vue';
    import InputBlock from '@/Components/forms/common/InputBlock.vue';

    const props = defineProps({
        isView:{
            type:Boolean,
            required:true,
            default:false
        },
        data:Object
    })
</script>


<template>
    <h1 class="text-xs">BOX 1 (TO BE ACCOMPLISHED IN PRINT BY THE APPLICANT)</h1>

    <div class="grid grid-flow-col border-t border-x gap-1 border-black h-max min-h-[46px]">
        <div class="grid grid-cols-[1fr,150px]">
            <div class="grid grid-flow-col">
                <InputBlock label="NAME OF OWNER/APPLICANT:" name="owner" :isView="props.isView" :data="props.data"/>
                <InputBlock label="LAST NAME" name="last_name" :isView="props.isView" :data="props.data"/>
                <InputBlock label="FIRST NAME" name="first_name" :isView="props.isView" :data="props.data"/>
                <InputBlock label="MIDDLE NAME" name="middle_name" :isView="props.isView" :data="props.data"/>
            </div>
            <div>
                <InputBlock label="TAX IDENTIFICATION NO." name="tax_identification_no" :isView="props.isView" :data="props.data"/>
            </div>
        </div>
        <div class="grid grid-cols-[1fr,150px]">
            <div class="grid grid-flow-col">
                <InputBlock label="ADDRESS NO." name="address_no" :isView="props.isView" :data="props.data"/>
                <InputBlock label="STREET" name="street" :isView="props.isView" :data="props.data"/>
                <InputBlock label="BARANGAY" name="barangay" :isView="props.isView" :data="props.data"/>
                <InputBlock label="MUNICIPALITY" name="municipality" :isView="props.isView" :data="props.data"/>
            </div>
            <div>
                <InputBlock label="TELEPHONE NO." name="tel_no" :isView="props.isView" :data="props.data"/>
            </div>
        </div>
    </div>


</template>
