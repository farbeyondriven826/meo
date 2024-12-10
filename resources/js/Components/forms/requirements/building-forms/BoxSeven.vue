<script setup>
    import { createReusableTemplate } from '@vueuse/core'

    const TemplateYear = createReusableTemplate();
    const TemplateBorderBottom = createReusableTemplate();
</script>

<style scoped>
    ol{
        font-size:10px;
    }
    ol li p{
        font-size:10px;
        display:inline;
        padding-left:1.5rem;
    }

    ol.alpha{
        list-style-type: lower-alpha;
        margin:0.5rem 0rem;
    }
</style>

<template>
    <TemplateBorderBottom.define>
        <div class="border-b border-black"></div>
    </TemplateBorderBottom.define>
    <TemplateYear.define>
        <div class="border-black border-y border-r  h-[26px] grid grid-flow-col">
            <div>
                <div class="border-l border-black w-[23px] h-[25px] inline-block"></div>
                <p class="text-center">M</p>
            </div>
            <div>
                <div class="border-l border-black w-[23px] h-[25px] inline-block"></div>
                <p class="text-center">M</p>
            </div>
            <div>
                <div class="border-l border-black w-[23px] h-[25px] inline-block"></div>
                <p class="text-center">D</p>
            </div>
            <div>
                <div class="border-l border-black w-[23px] h-[25px] inline-block"></div>
                <p class="text-center">D</p>
            </div>
            <div>
                <div class="border-l border-black w-[23px] h-[25px] inline-block"></div>
                <p class="text-center">Y</p>
            </div>
            <div>
                <div class="border-l border-black w-[23px] h-[25px] inline-block"></div>
                <p class="text-center">Y</p>
            </div>
        </div>
    </TemplateYear.define>

    <h1>BOX 7 (TO BE ACCOMPLISHED BY THE BUILDING OFFICIAL)</h1>

    <h1 class="border-x border-t border-black text-center">BUILDING PERMIT</h1>
    <div class="border border-black text-xs p-4">
        <div class="grid grid-cols-[max-content,1fr,max-content]">
            <div>
                <p>BUILDING PERMIT NO.</p>
                <div class="border-black border-y border-r  h-[26px]">
                    <template v-for="i in 8" :key="i">
                        <div class="border-l border-black w-[23px] h-[25px] inline-block"></div>
                    </template>
                </div>
            </div>
            <div></div>
            <div>
                <p>OFFICIAL RECEIPT NO.</p>
                <div class="border-black border-y border-r  h-[26px]">
                    <template v-for="i in 8" :key="i">
                        <div class="border-l border-black w-[23px] h-[25px] inline-block"></div>
                    </template>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-[max-content,1fr,max-content] h-[80px]">
            <div>
                <p>DATE ISSUED</p>
                <TemplateYear.reuse/>
            </div>
            <div></div>
            <div>
                <p>DATE PAID</p>
                <TemplateYear.reuse/>
            </div>
        </div>

        <div class="grid grid-cols-[max-content,1fr,max-content,1fr] pl-5">
            <p class="text-xs">Permit is issued to</p>
            <TemplateBorderBottom.reuse/>
            <p class="text-xs">the PROPOSED</p>
            <TemplateBorderBottom.reuse/>
        </div>
        <div class="grid grid-cols-[200px,max-content,150px,max-content,1fr,max-content,1fr,max-content,1fr]">
            <TemplateBorderBottom.reuse/>
            <p class="text-xs">under</p>
            <TemplateBorderBottom.reuse/>
            <p class="text-xs">, of Group</p>
            <TemplateBorderBottom.reuse/>
            <p class="text-xs">. located at Lot No.</p>
            <TemplateBorderBottom.reuse/>
            <p class="text-xs">Block-</p>
            <TemplateBorderBottom.reuse/>
        </div>

        <div class="grid grid-cols-[max-content,30%,max-content,1fr] ">
            <p class="text-xs">OCT/TCT No.</p>
            <TemplateBorderBottom.reuse/>
            <p class="text-xs">Tax Declaration No.</p>
            <TemplateBorderBottom.reuse/>
        </div>
        <div class="grid grid-cols-[50%,max-content,1fr,max-content] ">
            <TemplateBorderBottom.reuse/>
            <p class="text-xs">Street, Barangay</p>
            <TemplateBorderBottom.reuse/>
            <p class="text-xs">, City/Municipality of BASUD subject to</p>
        </div>

        <div>
            <p>The following:</p>
            <ol class="list-decimal list-inside">
                <li>
                    <p>That the Article 1723 of the Civil Code of the Philippines, the engineer or architect who drew up the plans and specifications for a building/structure is liable for
    Damages if within fifteen (15) tears from the completion of the building/structure, the same should collapse due to defect in the plans or specifications or defects in
    The ground. The engineer or architect who supervises the construction shall be liable with the contractor should be edifice collapse due to defect in the construction or
    the use of inferior materials.</p>
                </li>

                <li>
                    <p>
                    This permit shall be accompanied by the various applicable ancillary and accessory permits, plans and specifications signed and sealed by the corresponding design
    Professionals who shall be responsible for the comprehensive and correctness of the plans in compliance to the Code and is IRR and to all applicable referral codes
    and professional regulatory laws.
                </p>
                </li>

                <li>
                    <p>
                    That the proposed construction /erection/addition/alteration/renovation/conversion/repair/moving/demolition, etc. shall be in conformity with the provisions of the
    National Building Code and its IRR.
                </p>
                    <ol class="alpha list-inside pl-5">
                        <li>
                            <p>That prior to the commencement of the proposed projects and construction an actual relocation survey shall be conducted by a duly licensed Geodetic Engineer.</p>
                        </li>
                        <li>
                            <p>That before commencing the excavation the person making or causing the excavation to be made shall notify in writing the owner of adjoining property not less
                                than ten (10) days before such excavation is to be made and show the adjoining property should be protected.</p>
                        </li>
                        <li>
                            <p>
                                That no person shall use or occupy a street, alley or public sidewalk for the performance of work covered by a building permit.
                            </p>
                        </li>
                        <li>
                            <p>
                                That no person shall perform any work on any building or structure adjacent to a public way in general use for pedestrian travel, unless the pedestrians are
                                protected.
                            </p>
                        </li>
                        <li>
                            <p>
                                That the supervising Architect/Civil Engineer shall keep at the jobsite at all times a logbook of daily construction activities wherein the actual daily progress of
                                construction including tests conducted, weather and other pertinent data are to be recorded, same shall be made available for scrutiny and comments by the OBO
                                representative during the conduct of his/her inspection pursuant to Section 207 of the National Building Code.
                            </p>
                        </li>
                        <li>
                            <p>
                                That upon completion of the construction, the said licensed supervising Architect/Civil Engineer shall submit to the Building Official duly signed and sealed
                                logbook, as-built plans and other documents and shall also prepare and submit a Certificate of Completion of the project stating that the construction of the
                                building/structure conform to the provision of the Code, its IRR as well as the plans and specifications.
                            </p>
                        </li>
                        <li>
                            <p>
                                All such changes, modification and alteration shall like be submitted to the Building Official and the subsequent amendatory permit therefore issued before any
                                work on said changes, modifications and alteration shall be started. The as-built plans and specifications maybe just an orderly and comprehensive compilation of
                                all documents which the originally submitted plans and specifications of all amendments therefore as actually built or they may be an entirely new set of plans and
                                specification accurately describing and /or reflecting therein the building as actually built.
                            </p>
                        </li>
                    </ol>
                </li>
                <li>
                    <p>
                        That no building/structure shall be used until the Building Official has issued a Certificate of Occupancy therefor as provided in the Code. However, a partial
                        Certificate of Occupancy may be issued for the Use/Occupancy of a portion or portion of a building/structure prior to the completion of the entire building/structure.
                    </p>
                </li>
                <li>
                    <p>
                        That this permit shall not serve as an exemption from securing written clearances from various government authorities exercising regulatory function affecting
                        building/structures.
                    </p>
                </li>
                <li>
                    <p>
                        When the construction is undertaken by contract, the work shall be done by a duly licensed and registered contractor pursuant to the provisions of the
                        Contractor's License Law (RA 4566).
                    </p>
                </li>
                <li>
                    <p>
                        The owner /Permittee shall submit a duly accomplished “Notice of Construction” to the Office of the Building Official prior to any construction activity.
                    </p>
                </li>
                <li>
                    <p>
                        The Owner/Permittee shall put a Building Permit sign which complies with the prescribed dimensions and information, which shall remain posted on the
                        construction site for the duration of the construction.
                    </p>
                </li>
            </ol>
        </div>

    </div>
    <div class="border-b border-x border-black text-xs p-4">
        <p class="text-xs">PERMIT ISSUED BY:</p>

        <br/>
        <br/>
        <br/>
        <div class="w-[250px] m-auto">
            <p class="text-center border-b border-black">ENGR. HECTOR G. UBANA</p>
            <p class="text-center font-semibold">BUILDING OFFICIAL/MUNICIPAL ENGINEER</p>
            <div class="grid grid-cols-[max-content,1fr]">
                <p class="text-center">DATE</p>
                <TemplateBorderBottom.reuse/>
            </div>
        </div>

    </div>
    <div class="border-b border-x border-black">
        <div class="p-2">
            <span class="italic text-[10px]">NOTE:</span>
            <span class="text-[10px]">THIS PERMIT MAY BE CANCELLED OR REVOKE PURSUANT TO SECTIONS 305 AND 306 OF THE “NATIONAL BUILDING CODE”.</span>
        </div>
    </div>




</template>
