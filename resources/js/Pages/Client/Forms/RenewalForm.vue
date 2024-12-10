<script setup>
import { ref } from "vue";
import { useToast } from "vue-toastification";
import { useForm } from "@inertiajs/inertia-vue3";
import ClientLayout from "../../../Shared/ClientLayout.vue";
import RadioButton from "../../Components/RadioButton.vue";
import SelectBusinessInput from "../../Components/SelectBusinessInput.vue";
import Map from "../../../Components/Map.vue";
import TextInput from "../../Components/TextInput.vue";
import PdfContainer from "../../Components/PdfContainer.vue";
import Pagination from "../../../Components/Pagination.vue";
import FileAction from "../../Components/FileAction.vue";
import YearPicker from "../../Components/YearPicker.vue";
import Swal from "sweetalert2";
const props = defineProps({
    requirements: [Object, Array],
    queue: [Object, Array],
    allReq: {
        type: Number,
        required: true, // Set to `true` if this prop is mandatory
    },
});

const toast = useToast();
defineOptions({ layout: ClientLayout });

const pdfDownloadUrl = ref("https://example.com/path/to/your/pdf-file.pdf");
const showPDFtemplate = ref(false);
const togglePDFformatModal = (event) => {
    showPDFtemplate.value = event;
};
const selectOptions = props.queue
const selectedOption = ref("");
const selectedOptionDetails = ref("No Selected Category");
const selectError = ref("");

const selectedradioOption = ref(0);
const radioError = ref("");
const radioOptions = [
    { value: 1, label: "New" },
    { value: 0, label: "Renewal" },
];
const title = ref("");
const handlePdfTitle = ({ label }) => {
    title.value = label;
};

const changeSelectedDetail = (details) => {
    selectedOptionDetails.value = details;
    console.log(selectedOptionDetails.value);
};

const handleDownload = ({ downloadableFile }) => {
    pdfDownloadUrl.value = downloadableFile;
    showPDFtemplate.value = true;
};

const bldgFormdownload = ref("templates/building_permit.pdf");

const formData = useForm({
    isNew: selectedradioOption,
    category: null,
    project_title: selectedOption,
    year_established: null,
    type: 3,
    files: [],
    latitude: 14.069,
    longitude: 122.96,
});

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

    return data;
};
function checkFileUpload(inputId) {
    if (formData.files[inputId] != null) {
        return true;
    }

    return false;
}
const submit = () => {
    // Find the selected queue item based on selectedOption
    const selectedItem = props.queue.find((value) => value.project_title === selectedOption.value);
    // console.log(selectedItem.year_established);
    // Assign values directly to formData
    if (selectedItem) {
        formData.category = selectedItem.category;
        formData.year_established = selectedItem.business_established;
        formData.latitude = selectedItem.latitude;
        formData.longitude = selectedItem.longitude;
    } else {
        formData.category = null;
        formData.year_established = null;
        formData.latitude = null;
        formData.longitude = null;
    }


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
            const data = prepareFormData();
            if (formData.project_title == null) {
                toast.warning("Title must not be Empty!");
                return;
            }
            if (formData.category == null) {
                toast.warning("Category must not be Empty!");
                return;
            }
            if (formData.year_established == null) {
                toast.warning("Business Established must not be Empty!");
                return;
            }

            const uploadedFilesCount = formData.files.filter(file => file != null).length;

            if (props.allReq != uploadedFilesCount) {
                toast.error("Upload all the files First!");
                return;
            }

            formData.post("/applicationform/store", {
                data: data,
                headers: { "Content-Type": "multipart/form-data" },
                onError: (error) => {
                    console.log(error);
                    if (error.error == "Please complete your profile information to process your data.") {
                        Swal.fire({
                            title: 'Warning',
                            icon: 'error',
                            text: error.error + " Your Information is in Settings"
                        })
                    } else {
                        toast.warning("Business Permit Form must Upload a file!");
                    }
                },
                onSuccess(response) {
                    console.log(response);
                    // toast.success("Application form submitted successfully!");
                },
            });
        }
    });
};

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
    console.log(formData);
};

var currentCategory = "";
var currentSubCategory = "";
const routeName = "renewalform";

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
</script>

<template>
    <div class="w-full max-w-4xl mx-auto px-4 py-6 rounded-lg card mt-5">

        <Head title="DocumentView" />
        <h1 class="text-2xl font-bold mb-2 text-center">
            Business Permit Renewal Application Form
        </h1>
        <hr class="border-gray-300 mb-6" />
        <p class="p-4 bg-red-200 mb-6 italic">
            Note: All the requirements or scan files you upload must be in PDF
            format (.pdf).
        </p>

        <form @submit.prevent="submit">
            <div :class="{ hidden: requirements.current_page != 1 }">
                <!-- <RadioButton name="Please check(✔)applicable box:" :options="radioOptions"
                    v-model:modelValue="selectedradioOption" :message="radioError"/> -->

                <SelectBusinessInput name="Business Name" :options="selectOptions" v-model:modelValue="selectedOption"
                    @details="changeSelectedDetail" :message="selectError" />

                <!-- <div style="display: flex; width:100%; gap:10px;">
                    <TextInput name="Business Name" v-model:modelValue="formData.project_title" :isUppercase="true"
                        style="width:80%;" />
                    <YearPicker name="Business Established" v-model:modelValue="formData.year_established"
                        style="width:20%;" />

                </div>
                <div class="mb-3">
                    Proposed Location:
                    <span class="text-link italic cursor-pointer" @click="toggleMaps(true)">See Maps</span>
                </div>
                <Map :show="showMaps" @update:show="toggleMaps(false)" @newLocation="saveLocation" /> -->
            </div>
            <PdfContainer :pdfUrl="pdfDownloadUrl" :show.sync="showPDFtemplate" :title="title"
                @update:show="togglePDFformatModal" />

            <div v-for="(item, index) in requirements.data" :key="index">
                <h1 class="text-2xl font-bold mb-2" v-if="isCurrentCategory(item.category_name, index)">
                    {{ item.category_name }}
                    <hr class="border-gray-300 mb-6 mt-2" />
                </h1>
                <p class="p-4 bg-violet-200 mb-3" v-if="isCurrentSubCategory(item.subcategory_name, index)">
                    {{ item.subcategory_name }}
                </p>
                <FileAction :label="item.requirements_name" :title="item.requirements_name"
                    :inputId="item.requirements_id" @file-selected="handleFileSelected" @label="handlePdfTitle"
                    :downloadableFile="item.template_file_path" @download-url="handleDownload"
                    :hasUploadedFile="checkFileUpload(item.requirements_id)" />
            </div>

            <div class="flex items-center justify-between mb-3">
                <Pagination :currentPage="requirements.current_page" :lastPage="requirements.last_page" :url="routeName"
                    :previousPageUrl="requirements.prev_page_url" :nextPageUrl="requirements.next_page_url" />

                <div>
                    <button class="danger-btn" :class="{
                        hidden:
                            requirements.last_page !=
                            requirements.current_page,
                    }" :disabled="formData.processing">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>
