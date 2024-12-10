<script setup>
    import InputBlock from '@/Components/forms/common/InputBlock.vue';
    import Checkbox from '@/Components/forms/common/Checkbox.vue';
    import CheckboxInputInline from '@/Components/forms/common/CheckboxInputInline.vue';
    import CheckboxInput from '@/Components/forms/common/CheckboxInput.vue';
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
    <BoxLabel label="BOX 1(TO BE ACCOMPLISHED BY A DULY QUALIFIED ELECTRICAL PRACTITIONER)"/>

    <div class="grid grid-flow-col border-t border-x gap-1 border-black h-max min-h-[46px]">
        <InputBlock
            label="NAME OF OWNER/ APPLICANT"
            name="page2box1_owner"
            :isView="props.isView"
            placeholder=""
            labelStyle="italic"
            :data="props.data"
        />
        <InputBlock
            label="LAST NAME,"
            name="page2box1_last_name"
            :isView="props.isView"
            placeholder=""
            :data="props.data"
        />
        <InputBlock
            label="FIRST NAME"
            name="page2box1_first_name"
            :isView="props.isView"
            placeholder=""
            :data="props.data"
        />
        <InputBlock
            label="MIDDLE NAME"
            name="page2box1_middle_name"
            :isView="props.isView"
            placeholder=""
            :data="props.data"
        />
        <InputBlock
            label="TIN"
            name="page2box1_tax_identification_no"
            :isView="props.isView"
            placeholder=""
            :data="props.data"
        />
    </div>
    <div class="grid grid-flow-col border-t border-x gap-1 border-black h-max min-h-[46px]">
        <InputBlock
            label="ADDRESS NO:"
            name="page2box1_address_no"
            :isView="props.isView"
            placeholder=""
            labelStyle="italic"
            :data="props.data"
        />
        <InputBlock
            label="STREET"
            name="page2box1_street"
            :isView="props.isView"
            placeholder=""
            :data="props.data"
        />
        <InputBlock
            label="BARANGAY"
            name="page2box1_barangay"
            :isView="props.isView"
            placeholder=""
            :data="props.data"
        />
        <InputBlock
            label="MUNICIPALITY"
            name="page2box1_municipality"
            defaultValue="BASUD"
            :isView="true"
            placeholder=""
            :data="props.data"
        />
        <InputBlock
            label="TEL/FAX NO."
            name="page2box1_tel_no"
            :isView="props.isView"
            placeholder=""
            :data="props.data"
        />
    </div>
    <div class="grid grid-flow-col border-t border-x gap-1 border-black h-max min-h-[46px]">
        <InputBlock
            label="LOCATION OF INSTALLATION:"
            name="page2box1_location_installation"
            :isView="props.isView"
            placeholder=""
            :data="props.data"
        />
        <InputBlock
            label="NO."
            name="page2box1_street_no"
            :isView="props.isView"
            placeholder=""
            :data="props.data"
        />
        <InputBlock
            label="STREET"
            name="page2box1_street"
            :isView="props.isView"
            placeholder=""
            :data="props.data"
        />
        <InputBlock
            label="BARANGAY"
            name="page2box1_barangay"
            :isView="props.isView"
            placeholder=""
            :data="props.data"
        />
        <InputBlock
            label="MUNICIPALITY"
            name="page2box1_municipality"
            defaultValue="BASUD"
            :isView="true"
            placeholder=""
            :data="props.data"
        />



    </div>

    <div class="grid grid-flow-col border-x border-t gap-2 border-black p-1">
        <div>
            <p class="text-xs italic">SCOPE OF WORK</p>
            <Checkbox
                label="NEW INSTALLATION"
                name="page2box1_scope_new_installation"
                :isView="props.isView"
                :data="props.data"
            />
            <Checkbox
                label="ANNUAL INSTALLATION"
                name="page2box1_scope_annual_installation"
                :isView="props.isView"
                :data="props.data"
            />
        </div>
        <div>
            <CheckboxInputInline
                label="ADDITION OF"
                name="page2box1_scope_addition_of"
                :isView="props.isView"
                :data="props.data"
            />
            <CheckboxInputInline
                label="REPAIR OF"
                name="page2box1_scope_repair_of"
                :isView="props.isView"
                :data="props.data"
            />
            <CheckboxInputInline
                label="REMOVAL OF"
                name="page2box1_scope_removal_of"
                :isView="props.isView"
                :data="props.data"
            />
        </div>
        <div>
            <CheckboxInput
                label="OTHERS SPECIFY"
                name="page2box1_scope_others_specify"
                :isView="props.isView"
                :data="props.data"
            />
        </div>
    </div>
    <div class="grid grid-flow-col border-x border-t gap-2 border-black p-1">
        <div>
            <p class="text-xs italic">TYPE OF OCCUPANCY OR USE:</p>
            <Checkbox
                label="A. RESIDENTIAL DWELLING"
                name="page2box1_type_a_redidential_dwelling"
                :isView="props.isView"
                :data="props.data"
            />
            <Checkbox
                label="B. RESIDENTIAL, HOTEL APARTMENT"
                name="page2box1_type_b_residential_hotel_apartment"
                :isView="props.isView"
                :data="props.data"
            />
            <Checkbox
                label="C. EDUACATION &amp; RECREATION"
                name="page2box1_type_c_education_recreation"
                :isView="props.isView"
                :data="props.data"
            />
            <Checkbox
                label="D. INSTITUTIONAL"
                name="page2box1_type_d_institutional"
                :isView="props.isView"
                :data="props.data"
            />
        </div>
        <div>
            <Checkbox
                label="E. BUSINESS &amp; MERCANTILE"
                name="page2box1_type_e_business_mercantile"
                :isView="props.isView"
                :data="props.data"
            />
            <Checkbox
                label="F. INDUSTRIAL"
                name="page2box1_type_f_industrial"
                :isView="props.isView"
                :data="props.data"
            />
            <Checkbox
                label="G. STORAGE &amp; HAZARDOUS"
                name="page2box1_type_g_storage_hazardous"
                :isView="props.isView"
                :data="props.data"
            />
            <CheckboxInputInline
                label="H. ASSEMBLY OTHER THAN GROUP"
                name="page2box1_type_h_assembly_other_than_group"
                :isView="props.isView"
                :data="props.data"
            />
        </div>
        <div>
            <Checkbox
                label="I. ASSEMBLY LOAD 1000 OR MORE"
                name="page2box1_type_i_assembly_load_1000_or_more"
                :isView="props.isView"
                :data="props.data"
            />
            <Checkbox
                label="J. ACCESSORY"
                name="page2box1_j_accessory"
                :isView="props.isView"
                :data="props.data"
            />
            <CheckboxInput
                label="K. OTHERS (SPECIFY)"
                name="page2box1_type_others_specify"
                :isView="props.isView"
                :data="props.data"
            />
        </div>
    </div>

    <div class="grid grid-cols-[35%,1fr] p-1 border-x border-b gap-2 border-black">
        <div>
            <p class="italic text-xs">NUMBER OF OUTLETS</p>
            <div>
                <InputBlock
                label=""
                name="page2box1_no_of_outlet"
                :isView="props.isView"
                placeholder=""
                :data="props.data"/>
                <div class="border-b border-black w-full"></div>
            </div>
            <InputInline
                label="LIGHTS"
                name="page2box1_no_of_lights"
                :isView="props.isView"
                placeholder=""
                :data="props.data"
                position="reversed"/>
            <InputInline
                label="FA DETECTORS"
                name="page2box1_no_of_fa_detectors"
                :isView="props.isView"
                placeholder=""
                :data="props.data"
                position="reversed"/>
            <InputInline
                label="CONVINIENCE/RECEPTACLE"
                name="page2box1_no_of_receptacle"
                :isView="props.isView"
                placeholder=""
                :data="props.data"
                position="reversed"/>
            <InputInline
                label="OTHERS"
                name="page2box1_no_of_others"
                :isView="props.isView"
                placeholder=""
                :data="props.data"
                position="reversed"/>
            <InputInline
                label="SPO, AIRCON"
                name="page2box1_no_of_aircon"
                :isView="props.isView"
                placeholder=""
                :data="props.data"
                position="reversed"/>
        </div>
        <div>
            <p class="italic text-xs">NUMBER OF EQUIPMENT/WIRING DEVICES</p>
            <div class="grid grid-flow-col gap-2">
                <div>
                    <InputInline
                    label="SPO, COOKING UNIT"
                    name="page2box1_no_of_cooking_unit"
                    :isView="props.isView"
                    placeholder=""
                    :data="props.data"
                    position="reversed"/>
                    <InputInline
                    label="SPO, WATER HEATER"
                    name="page2box1_no_of_water_heater"
                    :isView="props.isView"
                    placeholder=""
                    :data="props.data"
                    position="reversed"/>
                    <InputInline
                    label="SPO, WATER PUMP"
                    name="page2box1_no_of_water_pump"
                    :isView="props.isView"
                    placeholder=""
                    :data="props.data"
                    position="reversed"/>
                </div>
                <div>
                    <InputInline
                    label="TOGGLE SWITCH"
                    name="page2box1_no_of_switch"
                    :isView="props.isView"
                    placeholder=""
                    :data="props.data"
                    position="reversed"/>
                    <InputInline
                    label="BELLS/BUZZER"
                    name="page2box1_no_of_bells"
                    :isView="props.isView"
                    placeholder=""
                    :data="props.data"
                    position="reversed"/>
                    <InputInline
                    label="SPO, PUSH BUTTONS"
                    name="page2box1_no_of_push_buttons"
                    :isView="props.isView"
                    placeholder=""
                    :data="props.data"
                    position="reversed"/>
                </div>
            </div>
        </div>
    </div>

</template>
