<script setup>
import { ref, watchEffect } from "vue";
import { useToast } from "vue-toastification";
import { useForm } from "@inertiajs/inertia-vue3";
import Swal from "sweetalert2";
import ClientLayout from "../../Shared/ClientLayout.vue";
import SelectInput from "../Components/SelectInput.vue";
import TextInput from "../Components/TextInput.vue";
import Map from "../../Components/Map.vue";
import PdfContainer from "../Components/PdfContainer.vue";
import FileAction from "../Components/FileAction.vue";
import Pagination from "../../Components/Pagination.vue";
const toast = useToast()
const props = defineProps({
    title: [Object, String],
    datas: [Object, Array],
    requirements: [Object, Array],
    id: [Object, Number],

});
const title = ref("");
const pdfDownloadUrl = ref("https://example.com/path/to/your/pdf-file.pdf");
const showPDFtemplate = ref(false);
const togglePDFformatModal = (event) => {
    showPDFtemplate.value = event;
};
const handlePdfTitle = ({ label }) => {
    title.value = label;
};
const handleDownload = ({ downloadableFile }) => {
    pdfDownloadUrl.value = downloadableFile;
    console.log(downloadableFile);
    showPDFtemplate.value = true;
};
defineOptions({ layout: ClientLayout });
function getType(type) {
    var text = "";
    switch (type) {
        case "1":
            text = "Business Permit New";
            break;
        case "2":
            text = "Building Permit";
            break;
        default:
            text = "Business Permit Renewal";
            break;
    }
    return text;
}
const selectedOption = ref(props.datas[0].form.category);
const selectedradioOption = ref(1);
const formData = useForm({
    isNew: selectedradioOption,
    category: selectedOption,
    project_title: props.datas[0].form.project_title,
    type: 2,
    files: [],
    latitude: props.datas[0].form.latitude,
    longitude: props.datas[0].form.longitude,
});

const selectOptions = [
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
];
// const routeName = `returned/${props.title}/${props.datas[0].application_form_id}`;
const routeName = "renderBusinessPermitForm";

const showMaps = ref(false);
// const toggleMaps = (event) => {
//     showMaps.value = event;
// }
function toggleMaps(value) {
    showMaps.value = value;
}
const saveLocation = (event) => {
    formData["latitude"] = event.lat;
    formData["longitude"] = event.lng;
};

var currentCategory = "";
var currentSubCategory = "";

function isCurrentCategory(category, index) {
    if (currentCategory != category || index == 0) {
        currentCategory = category;

        return true;
    }

    return false;
}
function isCurrentSubCategory(subcategory, index) {
    if (currentSubCategory != subcategory || index == 0) {
        currentSubCategory = subcategory;

        return true;
    }

    return false;
}
function checkFileUpload(inputId) {
    console.log(formData.files);
    if (formData.files[inputId] != null) {
        return true;
    }

    return false;
}
const handleFileSelected = ({ file, inputId }) => {
    formData.files[inputId] = file;
};
const prepareFormData = () => {
    const data = new FormData();
    // data.append('isNew', formData.isNew);
    // data.append('category', formData.category);
    // data.append('project_title', formData.project_title);
    // data.append('type', formData.type);

    Object.keys(formData).forEach((key) => {
        if (formData[key] !== undefined) {
            data.append(key, formData[key]);
        }
    });
    // data.append('files', formData.files);

    // formData.files.forEach((file, index) => {
    //     data.append(`files[${index}]`, file);
    // });

    return formData;
};

const submit = () => {
    const data = prepareFormData();
    // console.log(formData,data.files[0]);
    // alert("jester")
    Swal.fire({
        title: "Confirm Upload",
        text: "Are you sure you want to upload this form?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Upload It!",
    }).then((result) => {
        if (result.isConfirmed) {
            if (formData.project_title == null) {
                toast.warning("Title must not be Empty!");
                return;
            }
            if (formData.category == null) {
                toast.warning("Category must not be Empty!");
                return;
            }

            formData.post(`/applicationform/update/${props.id}`, {
                data: data,
                onError(error) {

                    console.log(error);
                },
                onSuccess(response) {
                    console.log(response);
                },
            });
        }
    });
};
</script>

<template>
    <div class="w-full max-w-4xl mx-auto px-4 py-6 rounded-lg card mt-5">
        <Head title="DocumentView" />
        <h1 class="text-2xl font-bold mb-2 text-center">
            {{getType(title)}}
        </h1>
        <hr class="border-gray-300 mb-6" />
        <p class="p-4 bg-red-200 mb-6 italic">
            Note: All the requirements or scan files you upload must be in PDF
            format (.pdf).
        </p>

        <form
            @submit.prevent="submit"
            method="POST"
            enctype="multipart/form-data"
        >
            <div :class="{ hidden: requirements.current_page != 1 }">
                <!-- <RadioButton name="Please check(✔)applicable box:" :options="radioOptions"
                    v-model:modelValue="selectedradioOption" :message="radioError"/> -->

                <SelectInput
                    name="Select Category"
                    :options="selectOptions"
                    v-model:modelValue="selectedOption"
                />

                <TextInput
                    name="Business Name"
                    v-model:modelValue="formData.project_title"
                    :isUppercase="true"
                />
                <div class="mb-3">
                    Proposed Location:
                    <span
                        class="text-link italic cursor-pointer"
                        @click="toggleMaps(true)"
                        >See Maps</span
                    >
                </div>
                <Map
                    :lat="formData.latitude"
                    :lng="formData.longitude"
                    :show="showMaps"
                    @update:show="toggleMaps(false)"
                    @newLocation="saveLocation"
                />
            </div>
            <PdfContainer
                :pdfUrl="pdfDownloadUrl"
                :show.sync="showPDFtemplate"
                :title="title"
                @update:show="togglePDFformatModal"
            />

            <div v-for="(item, index) in datas" :key="index">
                <h1
                    class="text-2xl font-bold mb-2"
                    v-if="isCurrentCategory(item.requirement.subcat.category.category_name, index)"
                >
                    {{ item.requirement.subcat.category.category_name }}
                    <hr class="border-gray-300 mb-6 mt-2" />
                </h1>
                <p
                    class="p-4 bg-violet-200 mb-3"
                    v-if="isCurrentSubCategory(item.requirement.subcat.subcategory_name, index)"
                >
                    {{ item.requirement.subcat.subcategory_name }}
                </p>

                <FileAction
                    :label="item.requirement.name"
                    :title="item.requirement.name"
                    :inputId="item.requirement_id"
                    @file-selected="handleFileSelected"
                    @label="handlePdfTitle"
                    :downloadableFile="item.file_path"
                    @download-url="handleDownload"
                    :hasUploadedFile="checkFileUpload(item.requirement_id)"
                />
            </div>

            <div class="flex items-center justify-between mb-3">
                <!-- <Pagination
                    :currentPage="requirements.current_page"
                    :lastPage="requirements.last_page"
                    :url="routeName"
                    :previousPageUrl="requirements.prev_page_url"
                    :nextPageUrl="requirements.next_page_url"
                /> -->
                <div>
                    <button
                    type="submit"
                        class="danger-btn"
                        :class="{
                            hidden:
                                requirements.last_page !=
                                requirements.current_page,
                        }"
                        :disabled="formData.processing"
                    >
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>
