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

        <InputBlock
            label="OWNER:"
            name="owner"
            :isView="props.isView"
            placeholder=""
            labelStyle="italic"
            :data="props.data"
        />

        <InputBlock
            label="LAST NAME"
            name="last_name"
            :isView="props.isView"
            placeholder=""
            :data="props.data"
        />

        <InputBlock
            label="FIRST NAME"
            name="first_name"
            :isView="props.isView"
            placeholder=""
            :data="props.data"
        />

        <InputBlock
            label="MIDDLE NAME"
            name="middle_name"
            :isView="props.isView"
            placeholder=""
            :data="props.data"
        />


        <div class="border-l border-black">
            <div class="ml-1">
                <InputBlock
                    label="TAX IDENTIFICATION NO."
                    name="tax_identification_no"
                    :isView="props.isView"
                    placeholder=""
                    :data="props.data"
                />
            </div>
        </div>
    </div>

    <div class="grid grid-flow-col gap-1 border-t border-x border-black h-max min-h-[46px]">

        <InputBlock
            label="FOR CONSTRUCTION OWNED BY AN ENTERPRISE"
            name="for_construction_owned_by_an_enterprise"
            :isView="props.isView"
            placeholder=""
            :data="props.data"
        />
        <InputBlock
            label="FORM OF OWNERSHIP"
            name="form_of_ownership"
            :isView="props.isView"
            placeholder=""
            :data="props.data"
        />


    </div>

    <div class="border border-black ">
        <div class="text-xs italic font-medium px-2 ">LOCATION OF CONSTRUCTION:</div>

        <div class="grid grid-cols-[120px,140px,1fr,1fr] gap-1 h-max px-2 ">
            <div class=" mt-3">
                <InputInline
                    label="LOT NO."
                    name="lot_no"
                    :isView="props.isView"
                    placeholder=""
                    :data="props.data"
                />
            </div>

            <div class=" mt-3">
                <InputInline
                    label="BLOCK NO"
                    name="block_no"
                    :isView="props.isView"
                    placeholder=""
                    :data="props.data"
                />
            </div>

            <div class=" mt-3">
                <InputInline
                    label="TCT NO"
                    name="tct_no"
                    :isView="props.isView"
                    placeholder=""
                    :data="props.data"
                />
            </div>
            <div class=" mt-3">
                <InputInline
                    label="TAX DEC. NO."
                    name="tax_dec_no"
                    :isView="props.isView"
                    placeholder=""
                    :data="props.data"
                />
            </div>
        </div>

        <div class="grid gap-1 grid-cols-[150px,1fr,350px,max-content]  h-[50px] px-2 items-baseline">
            <div class=" mt-3">
                <InputInline
                    label="ZONE"
                    name="zone"
                    :isView="props.isView"
                    placeholder=""
                    :data="props.data"
                />
            </div>

            <div class=" mt-3">
                <InputInline
                    label=","
                    name="zone_other"
                    :isView="props.isView"
                    placeholder=""
                    :data="props.data"
                />
            </div>

            <div class=" mt-3">
                <InputInline
                    label="STREET, BARANGAY"
                    name="street_barangay"
                    :isView="props.isView"
                    placeholder=""
                    :data="props.data"
                />
            </div>
            <div class="grid grid-cols-[max-content] align-bottom mt-3">
                <div class="text-xs">CITY/MUNICIPALITY OF BASUD</div>
            </div>
        </div>

        <div class="font-medium bg-slate-400 border-t border-b border-black italic text-xs pl-4">SCOPE OF WORK:</div>
        <br/>
        <div class="grid grid-cols-[25%,25%,50%] px-2">
            <div class="">
                <Checkbox name="scope_new_construction" label="NEW CONSTRUCTION" :isView="props.isView" :data="props.data"/>
                <Checkbox name="scope_erection" label="ERECTION" :isView="props.isView" :data="props.data"/>
                <Checkbox name="scope_addition" label="ADDITION" :isView="props.isView" :data="props.data"/>
                <Checkbox name="scope_alteration" label="ALTERATION" :isView="props.isView" :data="props.data"/>
            </div>
            <div >

                <Checkbox name="scope_addition" label="ADDITION" :isView="props.isView" :data="props.data"/>
                <Checkbox name="scope_conversion" label="CONVERSION" :isView="props.isView" :data="props.data"/>
                <CheckboxInput name="scope_repairs" :isView="props.isView" label="REPAIR" :data="props.data"/>
                <CheckboxInput name="scope_moving" :isView="props.isView" label="MOVING" :data="props.data"/>

            </div>
            <div class="pl-3">
                <Checkbox name="scope_raising" label="RAISING" :isView="props.isView" :data="props.data"/>
                <CheckboxInput name="scope_accessory_building_structure" :isView="props.isView" label="ACCESSORY BUILDING STRUCTURE" :data="props.data"/>
                <CheckboxInput name="scope_others" :isView="props.isView" label="OTHERS (SPECIFY)" :data="props.data"/>
            </div>
        </div>

        <br/>
        <div class="font-medium bg-slate-400 border-t border-b border-black italic text-xs pl-4">USE OR CHARACTER OF OCCUPANCY:</div>
        <br/>
        <div class="grid grid-cols-[35%,35%,30%] px-2">
            <Checkbox name="characted_of_occupancy_group_a" label="GROUP A: RESIDENTIAL, DWELLINGS" :isView="props.isView" :data="props.data"/>
            <Checkbox name="characted_of_occupancy_group_f" label="GROUP F: INDUSTRIAL" :isView="props.isView" :data="props.data"/>
            <div class="pl-3">
                <CheckboxInput name="characted_of_occupancy_others" label="OTHERS (SPECIFY)" :isView="props.isView" :data="props.data"/>
            </div>
        </div>
        <div class="grid grid-cols-[35%,1fr] px-2">
            <div class="">
                <Checkbox name="characted_of_occupancy_group_b" label="GROUP B: RESIDENTIAL HOTEL, APPARTMENT" :isView="props.isView" :data="props.data"/>
                <Checkbox name="characted_of_occupancy_group_c" label="GROUP C: EDUCATIONAL, RECREATE" :isView="props.isView" :data="props.data"/>
                <Checkbox name="characted_of_occupancy_group_d" label="GROUP D: INSTITUTIONAL" :isView="props.isView"/>
                <Checkbox name="characted_of_occupancy_group_e" label="GROUP E: BUSINESS AND MERCHANTILE" :isView="props.isView" :data="props.data"/>
            </div>
            <div >
                <Checkbox name="characted_of_occupancy_group_g" label="GROUP G: INDUSTRIAL STORAGE AND HAZARDOUS" :isView="props.isView" :data="props.data"/>
                <Checkbox name="characted_of_occupancy_group_h" label="GROUP H: RECREATIONAL, ASSEMBLY OCCUPANT LOAD LESS THAN 1000" :isView="props.isView" :data="props.data"/>
                <Checkbox name="characted_of_occupancy_group_i" label="GROUP I: RECREATIONAL, ASSEMBLY OCCUPANTS LOAD 1000 OR MORE" :isView="props.isView" :data="props.data"/>
                <Checkbox name="characted_of_occupancy_group_j" label="GROUP J: AGRICULTURAL, ACCESSORY" :isView="props.isView" :data="props.data"/>
            </div>
        </div>


        <br/>
        <div class="border-t  border-black">
            <div class="grid grid-flow-col ">
                <div class="pt-5 pb-[100px] px-4">
                    <div class="mt-1">
                        <CheckboxInputInline
                            label="OCCUPANCY CLASSIFIED"
                            name="occupancy_classified"
                            :isView="props.isView"
                            placeholder=""
                            :data="props.data"
                        />
                    </div>
                    <div class="mt-1">
                        <CheckboxInputInline
                            label="NUMBER OF UNITS"
                            name="number_of_units"
                            :isView="props.isView"
                            placeholder=""
                            :data="props.data"
                        />
                    </div>
                    <div class="mt-1">
                        <div class="grid grid-cols-[1fr,max-content] items-baseline">
                            <CheckboxInputInline
                                label="TOTAL FLOOR AREA"
                                name="total_floor_area"
                                :isView="props.isView"
                                placeholder=""
                                :data="props.data"
                            />
                            <p class="text-xs">SQUARE METERS</p>
                        </div>
                    </div>
                </div>
                <div class="pt-5 pb-[100px] px-4 border-l border-black">
                    <div class="mt-1">

                        <CheckboxInputInline
                            label="TOTAL ESTIMATED COST"
                            name="total_estimated_cost"
                            :isView="props.isView"
                            placeholder=""
                            :data="props.data"
                        />

                    </div>
                    <div class="mt-1">
                        <CheckboxInputInline
                            label="PROPOSED DATE OF CONSTRUCTION"
                            name="proposed_date_of_construction"
                            :isView="props.isView"
                            placeholder=""
                            type="date"
                            :data="props.data"
                        />
                    </div>
                    <div class="mt-1">

                        <CheckboxInputInline
                            label="EXPECTED DATE OF COMPLETION"
                            name="expected_date_of_completion"
                            :isView="props.isView"
                            placeholder=""
                            type="date"
                            :data="props.data"
                        />

                    </div>
                </div>
            </div>
        </div>

    </div>


</template>
