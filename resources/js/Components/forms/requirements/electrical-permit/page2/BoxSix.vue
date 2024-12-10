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
    <BoxLabel label="BOX 6 (TO BE RECEIVED BY RECEIVING/RECORDING SECTION)"/>

    <div class="grid grid-cols-[60%,1fr] gap-1 border-y border-black border-x ">
        <div class="grid grid-flow-col pt-4 pb-1 px-1 gap-4">
            <div class="grid grid-rows-[1fr,max-content]">
                <div></div>
                <p class="text-xs">ELECTRICAL PLANS &amp; SPECIFICATION (5 SETS)</p>
            </div>
        </div>
        <div class="pt-4 pb-1 px-1">
            <div class="w-[300px]">
                <div class="grid grid-rows-[max-content,1fr,max-content,max-content]">
                    <p class="text-xs">RECEIVED BY:</p>
                    <div></div>
                    <div class="mb-3">
                        <p class="text-xs font-semibold text-center">JESSIE B. INTIA</p>
                        <p class="text-[10px] text-center">Signature Over Printed Name</p>
                    </div>
                    <InputInline label="DATE RECEIVED" name="page2box6_date_received" :isView="props.isView" :data="props.data"/>
                </div>
            </div>
        </div>
    </div>

</template>
