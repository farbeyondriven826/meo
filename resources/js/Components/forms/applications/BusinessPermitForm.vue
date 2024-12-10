<script setup>
    import { onMounted, onUnmounted, ref } from "vue";
    import Map from "@/Components/Map.vue";
    import GMap from "@/Components/GMap.vue";
    import { useForm } from "@inertiajs/inertia-vue3";

    const props = defineProps({
        application: Number,
    });


    const showMaps = ref(false);
    const selectEl = ref(null);
    const form = useForm({
        category: props?.application?.category || null,
        project_title: props?.application?.project_title || null,
        year_established: props?.application?.year_established || null,
        type: props?.application?.type || "1",
        longitude:parseFloat(props?.application?.longitude) || 122.96,
        latitude:parseFloat(props?.application?.latitude) || 14.069,
        address:props?.application?.address || null,
    });

    const categoryOptions = [
        {
            value: "Category A — Residential Dwellings",
            label: "Category A — Residential Dwellings",
            details: "Residential Dwellings",
        },
        {
            value: "Category B — Residentials, Hotels and Apartments",
            label: "Category B — Residentials, Hotels and Apartments",
            details:
                "Multiple dwelling units including boarding or lodging houses, hotels, apartment buildings, row houses, convents, monasteries, and other similar building each of which accommodates more than ten persons.",
        },
        {
            value: "Category C — Education and Recreation",
            label: "Category C — Education and Recreation",
            details:
                "Buildings used for school or day-care purposes, involving assemblage for instruction, education, or recreation, and not classified in Group I or in Division 1 and 2 or Group H Occupancies.",
        },
        {
            value: "Category D Division 1 — Institutional",
            label: "Category D Division 1 — Institutional",
            details:
                "Mental hospitals, mental sanitaria, jails, prisons, reformatories, and buildings where personal liberties of inmates are similarly restrained",
        },
        {
            value: "Category D Division 2 — Institutional",
            label: "Category D Division 2 — Institutional",
            details:
                "Nurseries for full-time care of children under kindergarten age, hospitals, sanitaria, nursing homes with non-ambulatory patients, and similar buildings each accommodating more than five persons",
        },
        {
            value: "Category D Division 3 — Institutional",
            label: "Category D Division 3 — Institutional",
            details:
                "Nursing homes for ambulatory patients, homes for children of kindergarten age or over, each accommodating more than five persons: Provided, that Group D Occupancies shall not include buildings used only for private or family group dwelling purposes",
        },
        {
            value: "Category E Division 1 — Business and Mercantile",
            label: "Category E Division 1 — Business and Mercantile",
            details:
                "Gasoline filling and service stations, storage garages and boot storage structures where no work is done except exchange of parts and maintenance requiring no open flame, welding, or the use of highly flammable liquids",
        },
        {
            value: "Category E Division 2 — Business and Mercantile",
            label: "Category E Division 2 — Business and Mercantile",
            details:
                "Wholesale and retail stores, office buildings, drinking and dining establishments having an occupant load of less than one hundred persons, printing plants, police and fire stations, factories and workshops using not highly flammable or combustible materials and paint stores without bulk handlings",
        },
        {
            value: "Category E Division 3 — Business and Mercantile",
            label: "Category E Division 3 — Business and Mercantile",
            details:
                "Aircraft hangars and open parking garage with no repair work is done except exchange of parts and maintenance requiring no open flame, welding or the use of highly flammable liquids",
        },
        {
            value: "Category F — Industrial",
            label: "Category F — Industrial",
            details:
                "Ice plants, power plants, pumping plants, cold storage, and creameries, factories and workshops using incombustible and non-explosive materials, and storage and sale rooms for incombustible and non-explosive materials",
        },
        {
            value: "Category G Division 1 — Storage and Hazardous",
            label: "Category G Division 1 — Storage and Hazardous",
            details:
                "Storage and handling of hazardous and highly flammable material",
        },
        {
            value: "Category G Division 2 — Storage and Hazardous",
            label: "Category G Division 2 — Storage and Hazardous",
            details:
                "Storage and handling of flammable materials, dry cleaning plants using flammable liquids; paint stores with bulk handling, paint shops and spray painting rooms.",
        },
        {
            value: "Category G Division 3 — Storage and Hazardous",
            label: "Category G Division 3 — Storage and Hazardous",
            details:
                "Wood working establishments, planning mills and box factories, shops, factories where loose combustible fibers or dust are manufactured, processed or generated; warehouses where highly combustible material is store",
        },
        {
            value: "Category G Division 4 — Storage and Hazardous",
            label: "Category G Division 4 — Storage and Hazardous",
            details: "Repair garages",
        },
        {
            value: "Category G Division 5 — Storage and Hazardous",
            label: "Category G Division 5 — Storage and Hazardous",
            details: "Aircraft repair hangers",
        },
        {
            value: "Category H Division 1 — Assembly Other Than Group I",
            label: "Category H Division 1 — Assembly Other Than Group I",
            details:
                "Any assembly building with a stage and an occupant load of less than 1000 in the building",
        },
        {
            value: "Category H Division 2 — Assembly Other Than Group I",
            label: "Category H Division 2 — Assembly Other Than Group I",
            details:
                "Any assembly building without stage and having an occupant load of 300 or more in the building",
        },
        {
            value: "Category H Division 3 — Assembly Other Than Group I",
            label: "Category H Division 3 — Assembly Other Than Group I",
            details:
                "Any assembly building without a stage and having an occupant load of less than 300 in the building",
        },
        {
            value: "Category H Division 4 — Assembly Other Than Group I",
            label: "Category H Division 4 — Assembly Other Than Group I",
            details:
                "Stadia, reviewing stands, amusement park structures not included within Group I or in Division 1, 2, and 3 of this Group",
        },
        {
            value: "Category I — Assembly Occupant Load 1000 or More",
            label: "Category I — Assembly Occupant Load 1000 or More",
            details:
                "Any assembly building with an age and an occupant load of 1000 or more in the building",
        },
        {
            value: "Category J Division 1 — Accessory",
            label: "Category J Division 1 — Accessory",
            details: "Private garage, carports, sheds and agriculture buildings",
        },
        {
            value: "Category J Division 2 — Accessory",
            label: "Category J Division 2 — Accessory",
            details: "Fences over 1.80 meters high, tanks, and towers",
        },
    ]

    function toggleMaps(value) {
        showMaps.value = value;
    }

    function saveLocation(e){
        form.longitude = e.lng;
        form.latitude = e.lat;
        form.address = e.address;
    }
    async function submitHandler(e){
        try {

            if(form.longitude == 122.96 || form.latitude == 14.069){
                alert("Please select a location on the map");
                return;
            }
            if(form.address == null){
                alert("Please select a location on the map");
                return;
            }

            form.post(route('applicationform.store'), {
                onError(error) {
                    console.log(error);
                },
                onSuccess(response) {
                    console.log(response);
                    window.location.reload();
                },
            });
        } catch (error) {
            console.error('Error submitting form:', error);
        }
    }

    function updateCategory(e){
        form.category = e.target.value;
    }

    onMounted(()=>{
        VirtualSelect.init({
            selectedValue:form.category,
            placeholder:'select category',
            ele:selectEl.value,
            maxWidth:"100%",
            search: true,
            options:JSON.parse(JSON.stringify(categoryOptions)).map(item=>{
                item.description = item.details;
                return item;
            }),
            hasOptionDescription: true,
            name:"category",
        });
        selectEl.value.addEventListener('change', updateCategory);
    })


    onUnmounted(()=>{
        selectEl.value.removeEventListener('change', updateCategory);
        selectEl.value.destroy();
    })
</script>

<style>

    .vscomp-search-container input{
        margin:0px!important;
    }
    .vscomp-option-description{
        white-space: normal;
    }
    .vscomp-option-text{
        font-weight: 600!important;
    }
    .vscomp-toggle-button{
        border-radius: 0.375rem!important;
    }
    .vscomp-option{
        height: max-content!important;
    }

</style>


    <template>
            <form @submit.prevent="submitHandler" class="mb-6">
            <div>

                <div class="mb-1">
                    <!-- <label>Select Category</label>
                    <select placeholder="Select Category" name="category" id="category" required v-model="form.category">
                        <option v-for="option in categoryOptions" :value="option.value" :key="option.value">
                            {{ option.label }}
                        </option>
                    </select> -->
                    <label>Select Category</label>
                    <div id="select" ref="selectEl"></div>


                </div>

                <div>
                    <label>Business Name</label>
                    <input name="project_title" id="project_title" type="text" v-model="form.project_title" placeholder="business name">
                </div>

                <div>
                    <label>Year Established</label>
                    <input name="year_established" id="year_established" type="date" required v-model="form.year_established">
                </div>


                <div class="mb-3">
                    Proposed Location:
                    <span class="text-link italic cursor-pointer" @click="toggleMaps(true)">See Maps</span>
                </div>

                <GMap :lat="form.latitude" :lng="form.longitude" :show="showMaps"  @update:show="toggleMaps(false)" @newLocation="saveLocation"/>

                    <button
                        type="submit"
                        class="text-white text-sm px-3 py-1 rounded cursor-pointer"
                        :class=" 'bg-green-600'"
                    >
                        {{ props.application ? 'Update' : 'Submit' }}
                    </button>
            </div>

        </form>
</template>
