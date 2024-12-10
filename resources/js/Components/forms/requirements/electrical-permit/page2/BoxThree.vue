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
    <BoxLabel label="BOX 3 (ELECTRICAL CONTRACTOR 200 AMPERE MAIN AND ABOVE)"/>

    <div class="grid grid-cols-[45%,1fr,1fr] border-x border-y border-black px-1 pb-1 pt-4 gap-1">
        <div >
            <InputInline label="NAME" name="page2box3_name" :isView="props.isView" :data="props.data"/>
            <InputInline label="ADDRESS" name="page2box3_address" :isView="props.isView" :data="props.data"/>
        </div>
        <div>
            <InputInline label="PCAB LIC. NO." name="page2box3_pcab_lic" :isView="props.isView" :data="props.data"/>
            <InputInline label="TIN" name="page2box3_tin" :isView="props.isView" :data="props.data"/>
        </div>
        <div>
            <InputInline label="SPECIALTY ELECTRICAL" name="page2box3_specialty_electrical" :isView="props.isView" :data="props.data"/>
            <InputInline label="VALIDITY" name="page2box3_validity" :isView="props.isView" :data="props.data"/>
            <InputInline label="TELE/FAX NO." name="page2box3_tel_no" :isView="props.isView" :data="props.data"/>
        </div>
    </div>
</template>
