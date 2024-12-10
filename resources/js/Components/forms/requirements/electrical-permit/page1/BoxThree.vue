<script setup>
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
<style scoped>
    ol{
        font-size:10px;
        margin-left:2rem;
    }
    ol li p{
        font-size:10px;
        display:inline;
        padding-left:1.5rem;
    }

</style>
<template>
    <BoxLabel label="BOX 3 (TO BE ACCOMPLISHED BY THE BUILDING OFFICIAL)"/>

    <div class="border-t border-x gap-1 border-b border-black p-5">
        <p class="text-xs">PERMIT IS HEREBY GRANTED TO INSTALL THE ELECTRICAL WIRING, DEVICES AND EQUIPMENT</p>
        <p class="text-xs">ENUMERATED IN THE APPLICATIONS SUBJECT TO THE FOLLOWING CONDITIONS:</p>

        <br/>
        <ol class="list-decimal list-inside">
            <li>
                <p>
                    THAT THE PROPOSED INSTALLATION BE IN ACCORDANCE WITH THE APPROVED PLANS FILED WITH THIS OFFICE
AND IN COMFORMITY WITH THE PROVISIONS OF THE LATEST EDITION OF THE ELECTRICAL CODE.
                </p>
            </li>
            <li>
                <p>
                    THAT THE DULY LICENSED ELECTRICAL PRACTITIONER BE INCHARGE OF THE INSTALLATION/CONSTRUCTION.
                </p>
            </li>
            <li>
                <p>
                    THAT A CERTIFICATE OF COMPLETION DULY SIGNED BY THE ELECTRICAL PRACTITIONER INCHARGE OF THE
INSTALLATION BE SUBMITTED NOT LATER THAN SEVEN (7) DAYS AFTER C0OMPLETION OF THE INSTALLATION.
                </p>
            </li>
            <li>
                <p>
                    THAT A CERTIFICATE FINAL ELECTRICAL INSPECTION BE SECURED PRIOR TO THE ACTUAL OCCUPANCY OF THE
BUILDING.
                </p>
            </li>
            <li>
                <p>
                    THIS PERMIT SHALL BE POSTED AT THE DOOR OR SITE WORK:
                </p>
            </li>
        </ol>

        <br/>

        <p class="text-xs italic">RECOMMENDING &amp; APPROVAL:</p>
        <br/>

        <div>
            <div class="grid grid-cols-[50px,1fr,150px]">
                <div></div>
                <div>
                    <p class="text-xs text-center">MARICAR P. PARALE, REE</p>
                    <p class="text-[10px] text-center">Electrical Engineer of the Building Office</p>
                </div>
                <div>
                    <p class="w-full border-b border-black"></p>
                    <p class="text-[10px] text-center">DATE SIGNED</p>
                </div>
            </div>
            <br/>
            <div class="grid grid-cols-[50px,1fr,150px]">
                <div></div>
                <div>
                    <div class="grid grid-cols-[max-content,300px]">
                        <span class="text-xs text-center">0073342 - </span>
                        <span class="border-b border-black"></span>
                    </div>
                    <p class="text-[10px]">PRC REG. NO. & VALIDITY</p>
                </div>
                <div></div>
            </div>
            <br/>
            <p class="text-xs">NOTED:</p>
            <br/>
            <div class="grid grid-cols-[50px,1fr,150px]">
                <div></div>
                <div>
                    <p class="text-xs text-center">ENGR. HECTOR G. UBANA</p>
                    <p class="text-[10px] text-center">Building Official/ Municipal Engineer</p>
                </div>
                <div>
                    <p class="w-full border-b border-black"></p>
                    <p class="text-[10px] text-center">DATE SIGNED</p>
                </div>
            </div>
        </div>
    </div>

    <p class="text-xs">Note 1: This permit may be cancelled or revoked pursuant to Section 305 and 303 if the National Building Code</p>
    <p class="text-xs">Note 2: Alteration on this form not allowed.</p>




</template>
