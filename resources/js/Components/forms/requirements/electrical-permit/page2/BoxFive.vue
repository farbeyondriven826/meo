<script setup>
import InputInline from '@/Components/forms/common/InputInline.vue';
import InputBlock from '@/Components/forms/common/InputBlock.vue';
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
    <BoxLabel label="BOX 5 (OWNER/AUTHORIZED REPRESENTATIVE)"/>

    <div class="grid grid-cols-[1fr,300px] gap-1 border-y border-black border-x ">
        <div class="grid grid-flow-col border-r border-black pt-4 pb-1 px-1 gap-4">
            <div class="grid grid-rows-[1fr,max-content]">
                <p class="text-center text-xs">NAME</p>

                <div>
                    <InputBlock label="" name="page2box5_name" :isView="props.isView" :data="props.data"/>
                    <div class="border-black border-b w-full"></div>
                </div>
            </div>
            <div class="grid grid-rows-[1fr,max-content]">
                <p class="text-center text-xs">SIGNATURE</p>
                <div>
                    <InputBlock label="" name="page2box5_signature" :isView="true" :data="props.data"/>
                    <div class="border-black border-b w-full"></div>
                </div>
            </div>
        </div>
        <div class="pt-4 pb-1 px-1">
            <div class="w-[250px]">
                <InputInline label="TIN" name="page2box5_tin" :isView="props.isView" :data="props.data"/>
                <InputInline label="CTC. NO." name="page2box5_ctc_no" :isView="props.isView" :data="props.data"/>
                <InputInline label="DATE ISSUED" name="page2box5_date_issued" :isView="props.isView" :data="props.data"/>
                <InputInline label="PLACE ISSUED" name="page2box5_place_issued" :isView="props.isView" :data="props.data"/>
            </div>
        </div>
    </div>

</template>
