<script setup>
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
    <BoxLabel label="BOX 2 (TO BE ACCOMPLISHED BY THE RECEIVING & RECORDING SECTION)"/>

    <div class="grid grid-cols-[1fr,200px] border-t border-x gap-1 border-black">
        <p class="text-xs italic">ASSESSED FEES</p>
        <p class="text-xs ">DATE PAID</p>
    </div>

    <div class="grid grid-cols-[1fr,200px] border-t border-x gap-1 border-black border-b h-max min-h-[46px]">
        <div class="grid grid-flow-col">
            <InputBlock
                label="AMOUNT DUE"
                name="page1box2_amount_due"
                defaultValue=""
                :isView="true"
                placeholder=""
                :data="props.data"
            />
            <InputBlock
                label="ASSESSED BY"
                name="page1box2_assessed_by"
                defaultValue=""
                :isView="true"
                placeholder=""
                :data="props.data"
            />
            <InputBlock
                label="O.R. NUMBER"
                name="page1box2_or_no"
                defaultValue=""
                :isView="true"
                placeholder=""
                :data="props.data"
            />
        </div>
        <div class="border-l border-black">
            <div class="ml-1">
                <InputBlock
                    label="REVIEWED"
                    name="page1box2_reviewed"
                    defaultValue="CHIEF PROCESSING DIV/SEC."
                    :isView="true"
                    placeholder=""
                    :data="props.data"
                />
            </div>
        </div>
    </div>



</template>
