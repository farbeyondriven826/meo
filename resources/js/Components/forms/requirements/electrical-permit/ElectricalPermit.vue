<script setup>
    import BoxInput from '@/Components/forms/common/BoxInput.vue';
    import InputBlock from '@/Components/forms/common/InputBlock.vue';
    import BoxOnePage1 from '@/Components/forms/requirements/electrical-permit/page1/BoxOne.vue';
    import BoxTwoPage1 from '@/Components/forms/requirements/electrical-permit/page1/BoxTwo.vue';
    import BoxThreePage1 from '@/Components/forms/requirements/electrical-permit/page1/BoxThree.vue';
    import BoxOnePage2 from '@/Components/forms/requirements/electrical-permit/page2/BoxOne.vue';
    import BoxTwoPage2 from '@/Components/forms/requirements/electrical-permit/page2/BoxTwo.vue';
    import BoxThreePage2 from '@/Components/forms/requirements/electrical-permit/page2/BoxThree.vue';
    import BoxFourPage2 from '@/Components/forms/requirements/electrical-permit/page2/BoxFour.vue';
    import BoxFivePage2 from '@/Components/forms/requirements/electrical-permit/page2/BoxFive.vue';
    import BoxSixPage2 from '@/Components/forms/requirements/electrical-permit/page2/BoxSix.vue';
    import { toFormData } from '@/utils/forms';
    import { defineEmits, watchEffect, ref } from 'vue';

    const props = defineProps({
        isView:{
            type:Boolean,
            required:true,
            default:false
        },
        isSubmit:{
            type:Boolean,
            required:true,
            default:false
        },
        form:{
            type:String,
            required:true,
            default:"form"
        },
        data:Object
    });
    const form = ref(null);
    const emits = defineEmits(['submit']);

    watchEffect(()=>{
        if(props.isSubmit){
            const json = toFormData(form.value,{json:true});
            console.log(38,json);
            emits('submit',json);
            props.isSubmit = false;
        }
    });
</script>

<template>
    <form :name="props.form" :id="props.form" ref="form">
        <div class="relative m-2">
            <div>
                <div>
                    <p class="text-xs text-center">Republic of the Philippines</p>
                    <p class="text-xs text-center">DEPARTMENT OF PUBLIC WORKS AND HIGHWAYS</p>
                    <p class="text-xs text-center">OFFICE OF THE LOCAL BUILDING OFFICIAL</p>
                </div>
                <div>
                    <h2 class="text-center">BASUD</h2>
                    <p class="text-center text-xs">DISTRICT/MUNICIPALITY</p>
                    <p class="text-center text-xs">AREA CODE:&nbsp;<span class="text-xs border-b border-black">4608</span></p>
                </div>

                <div class="grid grid-flow-col">
                    <BoxInput label="APPLICATION NO." name="application_no" :count="9" :isView="props.isView" :data="props.data"/>
                    <div class="grid justify-end">
                        <BoxInput label="AREA NO." name="area_no" :count="10" :isView="props.isView" :data="props.data"/>
                    </div>
                </div>
                <br/>

                <div class="grid justify-end grid-cols-[max-content,1fr] w-[300px]">
                    <p class="text-xs">Date Issued</p><p class="border-b border-black"></p>
                </div>
                <div class="grid justify-end grid-cols-[max-content,1fr] w-[300px]">
                    <p class="text-xs">Paid Under O.R No.</p><p class="border-b border-black"></p>
                </div>
                <div class="grid justify-end grid-cols-[max-content,1fr] w-[300px]">
                    <p class="text-xs">Amount</p><p class="border-b border-black"></p>
                </div>
                <div class="grid justify-end grid-cols-[max-content,1fr] w-[300px]">
                    <p class="text-xs">Date</p><p class="border-b border-black"></p>
                </div>
                <br/>

                <h1 class="text-center font-bold text-lg">ELECTRICAL PERMIT</h1>
                <p class="text-[10px] text-center">( To be accomplished by the office Concerned )</p>
                <br/>

                <BoxOnePage1 :isView="props.isView" :data="props.data"/>
                <BoxTwoPage1 :isView="props.isView" :data="props.data"/>
                <BoxThreePage1 :isView="props.isView" :data="props.data"/>
            </div>

        </div>


        <br/>
        <br/>
        <br/>
        <br/>
        <div class="relative m-2">
            <div>
                <div>
                    <p class="text-xs text-center">Republic of the Philippines</p>
                    <p class="text-xs text-center">DEPARTMENT OF PUBLIC WORKS AND HIGHWAYS</p>
                    <p class="text-xs text-center">OFFICE OF THE LOCAL BUILDING OFFICIAL</p>
                </div>
                <div>
                    <h2 class="text-center">BASUD</h2>
                    <p class="text-center text-xs">DISTRICT/MUNICIPALITY</p>
                    <p class="text-center text-xs">AREA CODE:&nbsp;<span class="text-xs border-b border-black">4608</span></p>
                </div>

                <div class="grid grid-flow-col">
                    <div>
                        <BoxInput label="APPLICATION NO." name="application_no" :count="9" :isView="props.isView" :data="props.data"/>
                        <div class="mt-10 grid grid-flow-row w-[250px]">
                            <span class=" border-b border-black"></span>
                            <p class="text-[12px] text-center">Date of Proposed Start of Installation</p>
                        </div>
                    </div>
                    <div class="grid justify-end">
                        <div>
                            <InputBlock
                                label="DATE APPLICATION FILED"
                                name="date_application_filed"
                                :isView="props.isView"
                                :data="props.data"/>
                            <div>
                                <div class="mt-10 grid grid-flow-row w-[250px]">
                                    <span class=" border-b border-black"></span>
                                    <p class="text-[12px] text-center">Date of Proposed Start of Installation</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br/>


                <br/>

                <h1 class="text-center font-bold text-lg">APPLICATION FOR ELECTRICAL PERMIT</h1>
                <p class="text-[10px] text-center">( Accoplishment in print and in duplicate )</p>
                <br/>

                <BoxOnePage2 :isView="props.isView" :data="props.data"/>
                <BoxTwoPage2 :isView="props.isView" :data="props.data"/>
                <BoxThreePage2 :isView="props.isView" :data="props.data"/>
                <BoxFourPage2 :isView="props.isView" :data="props.data"/>
                <BoxFivePage2 :isView="props.isView" :data="props.data"/>
                <BoxSixPage2 :isView="props.isView" :data="props.data"/>
                <BoxTwoPage2 :isView="props.isView" :data="props.data"/>

            </div>

        </div>
    </form>
</template>
