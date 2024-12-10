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
    <BoxLabel label="BOX 1(TO BE ACCOMPLISHED IN PRINT BY THE OWNER/APPLICANT)"/>

    <div class="grid grid-cols-[1fr,180px] border-t border-x gap-1 border-black h-max min-h-[46px]">
        <div class="grid grid-flow-col">
            <InputBlock
                label="NAME OF OWNER/APPLICANT:"
                name="page1box1_owner"
                :isView="props.isView"
                placeholder=""
                labelStyle="italic"
                :data="props.data"
            />
            <InputBlock
                label="LAST NAME"
                name="page1box1_last_name"
                :isView="props.isView"
                placeholder=""
                :data="props.data"
            />
            <InputBlock
                label="FIRST NAME"
                name="page1box1_first_name"
                :isView="props.isView"
                placeholder=""
                :data="props.data"
            />
            <InputBlock
                label="MIDDLE NAME"
                name="page1box1_middle_name"
                :isView="props.isView"
                placeholder=""
                :data="props.data"
            />
        </div>
        <div class="border-l border-black">
            <div class="ml-1">
                <InputBlock
                    label="TIN"
                    name="page1box1_tax_identification_no"
                    :isView="props.isView"
                    placeholder=""
                    :data="props.data"
                />
            </div>
        </div>
    </div>
    <div class="grid grid-cols-[1fr,180px] border-t border-x gap-1 border-black h-max min-h-[46px]">
        <div class="grid grid-flow-col">
            <InputBlock
                label="ADDRESS NO:"
                name="page1box1_address_no"
                :isView="props.isView"
                placeholder=""
                labelStyle="italic"
                :data="props.data"
            />
            <InputBlock
                label="STREET"
                name="page1box1_street"
                :isView="props.isView"
                placeholder=""
                :data="props.data"
            />
            <InputBlock
                label="BARANGAY"
                name="page1box1_barangay"
                :isView="props.isView"
                placeholder=""
                :data="props.data"
            />
            <InputBlock
                label="MUNICIPALITY"
                name="page1box1_municipality"
                defaultValue="BASUD"
                :isView="true"
                placeholder=""
                :data="props.data"
            />
        </div>
        <div class="border-l border-black w-[120px]">
            <div class="ml-1">
                <InputBlock
                    label="TEL/FAX NO."
                    name="page1box1_tel_no"
                    :isView="props.isView"
                    placeholder=""
                    :data="props.data"
                />
            </div>
        </div>
    </div>
    <div class="grid grid-cols-[1fr,180px] border-t border-x gap-1 border-b border-black h-max min-h-[46px]">
        <div class="grid grid-flow-col">
            <InputBlock
                label="LOCATION OF INSTALLATION:"
                name="page1box1_location_installation"
                :isView="props.isView"
                placeholder=""
                :data="props.data"
            />
            <InputBlock
                label="NO."
                name="page1box1_street_no"
                :isView="props.isView"
                placeholder=""
                :data="props.data"
            />
            <InputBlock
                label="STREET"
                name="page1box1_street"
                :isView="props.isView"
                placeholder=""
                :data="props.data"
            />
            <InputBlock
                label="BARANGAY"
                name="page1box1_barangay"
                :isView="props.isView"
                placeholder=""
                :data="props.data"
            />
        </div>
        <div class="border-l border-black w-[120px]">
            <div class="ml-1">
                <InputBlock
                    label="MUNICIPALITY"
                    name="page1box1_municipality"
                    defaultValue="BASUD"
                    :isView="true"
                    placeholder=""
                    :data="props.data"
                />
            </div>
        </div>
    </div>


</template>
