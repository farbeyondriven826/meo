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
    <BoxLabel label="BOX 2 (PROFESSIONAL ELECTRICAL ENGINEER WHO SIGNED AND SEALED PLANS & SPECIFICATIONS)"/>

    <div class="grid grid-cols-[45%,1fr,1fr] border-x border-y border-black px-1 pb-1 pt-4 gap-1">

        <div >
            <InputInline label="NAME" name="page2box2_name" :isView="props.isView" :data="props.data"/>
            <InputInline label="ADDRESS" name="page2box2_address" :isView="props.isView" :data="props.data"/>
            <div class="grid grid-flow-col gap-1">
                <InputInline label="PTR NO." name="page2box2_ptr_no" :isView="props.isView" :data="props.data"/>
                <InputInline label="DATE ISSUED" name="page2box2_date_issued" :isView="props.isView" :data="props.data"/>
            </div>
            <div class="grid grid-flow-col gap-1">
                <InputInline label="SIGNATURE" name="page2box2_signature" :isView="props.isView" :data="props.data"/>
                <InputInline label="DATE SIGNED" name="page2box2_date_signed" :isView="props.isView" :data="props.data"/>
            </div>
        </div>
        <div>
            <InputInline label="PRC.REF.NO." name="page2box2_prc_ref" :isView="props.isView" :data="props.data"/>
            <InputInline label="TEL/FAX NO." name="page2box2_tel_no" :isView="props.isView" :data="props.data"/>
            <InputInline label="PLACED ISSUED" name="page2box2_place_issued" :isView="props.isView" :data="props.data"/>
            <InputInline label="TIN" name="page2box2_tin" :isView="props.isView" :data="props.data"/>
        </div>
        <div>
            <InputInline label="VALIDITY" name="page2box2_validity" :isView="props.isView" :data="props.data"/>
        </div>
    </div>
</template>
