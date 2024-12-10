<script setup>
import InputInline from '@/Components/forms/common/InputInline.vue';
import BoxLabel from '@/Components/forms/common/BoxLabel.vue';

const props = defineProps({
    isView:{
        type:Boolean,
        required:true,
        default:true
    },
    data:Object
});
</script>

<template>
    <BoxLabel label="BOX 4 (PERSON-IN-CHARGE OF INSTALLATION)"/>

    <div class="grid grid-flow-col gap-1 p-1 border-t border-black border-x pt-4">
        <InputInline position="reversed" label="PROFESSIONAL ELECTRICAL ENGINEER" name="page2box4_professional_electrical_engineer" :isView="props.isView" :data="props.data"/>
        <InputInline position="reversed" label="REGISTERED ELECTRICAL ENGINEER" name="page2box4_registered_electrical_engineer" :isView="props.isView" :data="props.data"/>
        <div>
            <InputInline position="reversed" label="REGISTERED MASTER ELECTRICIAN" name="page2box4_registered_master_electrician" :isView="props.isView" :data="props.data"/>
            <p class="text-xs text-center">( Not exceeding 800 volts &amp; 500 kvs )</p>
        </div>
    </div>


    <div class="grid grid-cols-[45%,1fr,1fr] border-x  border-black px-1 pb-1 pt-4 gap-1 border-b">
        <div >
            <InputInline label="NAME" name="page2box4_name" :isView="props.isView" :data="props.data"/>
            <InputInline label="ADDRESS" name="page2box4_address" :isView="props.isView" :data="props.data"/>
            <div class="grid grid-flow-col gap-1">
                <InputInline label="PTR NO." name="page2box4_ptr_no" :isView="props.isView" :data="props.data"/>
                <InputInline label="DATE ISSUED" name="page2box4_date_issued" :isView="props.isView" :data="props.data"/>
            </div>
            <div class="grid grid-flow-col gap-1">
                <InputInline label="SIGNATURE" name="page2box4_signature" :isView="props.isView" :data="props.data"/>
                <InputInline label="DATE SIGNED" name="page2box4_date_signed" :isView="props.isView" :data="props.data"/>
            </div>
        </div>
        <div>
            <InputInline label="PRC.REF.NO." name="page2box4_prc_ref" :isView="props.isView" :data="props.data"/>
            <InputInline label="TEL/FAX NO." name="page2box4_tel_no" :isView="props.isView" :data="props.data"/>
            <InputInline label="PLACED ISSUED" name="page2box4_place_issued" :isView="props.isView" :data="props.data"/>
            <InputInline label="TIN" name="page2box4_tin" :isView="props.isView" :data="props.data"/>
        </div>
        <div>
            <InputInline label="VALIDITY" name="page2box4_validity" :isView="props.isView" :data="props.data"/>
        </div>
    </div>
</template>
