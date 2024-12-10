<script setup>
import { computed, ref } from "vue";
import ClientLayout from "@/Shared/ClientLayout.vue";
import Modal from "@/Components/Modal.vue";
import Drawer from "@/Components/Drawer.vue";
import RequirementForm from "@/Components/forms/requirements/RequirementForm.vue";
import BusinessPermitForm from "@/Components/forms/applications/BusinessPermitForm.vue";
import Requirements from "@/Components/Requirements.vue";
import { useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    application: Object,
    requirements: [Object, Array],
    allReq: {
        type: Number,
        required: true, // Set to `true` if this prop is mandatory
    },
    showRequirements:Boolean
});



defineOptions({ layout: ClientLayout });
const requirements = computed(()=>{
    return {
        data:props.requirements.data.reduce((accu, item)=>{
            const {category_id, category_name, requirements_name, subcategory_name, requirements_id,input_type} = item;
            if(!accu[category_name]){
                accu[category_name] = {
                    subcategory_name,
                    requirements:[]
                };
            };
            accu[category_name].requirements.push({requirements_name,requirements_id, category_id,input_type});
            return accu;
        },{}),
        lastPage:props.requirements.last_page,
        routeName:route("renderBusinessPermitForm")+"/"+props.application.id,
        nextPageUrl:props.requirements.next_page_url,
        currentPage:props.requirements.current_page,
        previousPageUrl:props.requirements.prev_page_url
    }
});
const application = computed(()=>{
    return props?.application;
});

const requirementId = ref(null);

const requirementData = ref({});
const isSubmit = ref(false);
const isView = ref(true);
const showRequirementForm = ref(false);
const showEditInformationForm = ref(false);
const title = ref("");
const form = useForm({
    application_id:application.value?.id,
    requirement_id:requirementId.value,
});


const getRequirementsData = (requirement_id)=> fetch(route('getClientApplicationRequirementData', {
            application_id: application.value?.id,
            requirement_id: requirement_id
        }))
            .then((response) => response.json())
            .then(data=>data.reduce((accu, item)=>{
                accu[item.key] = item.value;
                return accu;
            },{}))
            .catch((error) => {
                console.error("Error:", error);
                return {};
            })


const actionClickHandler = async (d) => {
    const {action,requirement_id} = d;
    requirementId.value = requirement_id;
    form.requirement_id = requirement_id;



    if(action == 'view'){
        requirementData.value = await getRequirementsData(requirement_id);

        //TODO - new page;
        showRequirementForm.value = true;
    }
};
function clickEditInformationHandler(){
    if(!isView.value){
        isSubmit.value = true;
    } else {
        isSubmit.value = false;
        isView.value = !isView.value;
    }
}
function submitHandler(data){
    try {
        form.transform((formData)=>{
            return {
                ...formData,
                ...data
            }
        })

        form.post(route("storeApplicationData"), {
            onError(error) {
                console.log(error);
            },
            onSuccess(response) {
                console.log(response);
                getRequirementsData(requirementId.value)
                .then(res=>{
                    requirementData.value = res
                    setTimeout(()=>isView.value = !isView.value,10)
                });
            },
        });
    } catch (error) {
        console.error('Error submitting form:', error);
    }



}

</script>

<template>
    <div class="w-full max-w-4xl mx-auto px-4 py-6 rounded-lg card mt-5">
        <Head title="DocumentView" />
        <h1 class="text-2xl font-bold mb-2 text-center">
            Business Permit Application Form
        </h1>
        <hr class="border-gray-300 mb-6" />
        <p class="p-4 bg-red-200 mb-6 italic">
            Note: All the requirements or scan files you upload must be in PDF
            format (.pdf).
        </p>
        <BusinessPermitForm :application="application"/>

        <Modal v-model:show="showRequirementForm" :title="title">
            <template v-slot:content>
                <div class="flex justify-end m-4">
                    <button
                        class="bg-green-500 text-white text-sm px-4 py-2 rounded"
                        @click="clickEditInformationHandler">
                        {{isView ? 'Edit Information': 'Save Changes'}}
                    </button>
                </div>
                <div class="h-[70vh] overflow-auto">
                    <RequirementForm
                        :isView="isView"
                        :isSubmit="isSubmit"
                        :requirementId="requirementId"
                        @submit="submitHandler"
                        :requirementData="requirementData"/>
                </div>
            </template>
            <template v-slot:footer>
                <div class="flex justify-end m-4">
                    <template v-if="isView">
                        <button @click="printPdf" class="mr-2 bg-blue-500 text-white text-sm px-4 py-2 rounded">Print</button>
                        <button @click="downloadPdf" class="bg-yellow-500 text-white text-sm px-4 py-2 rounded">Download</button>
                    </template>
                </div>
            </template>
        </Modal>
        <Drawer v-model:show="showEditInformationForm">
            <template v-slot:content>
                <h1>Hello world</h1>
            </template>
        </Drawer>


        <template v-if="showRequirements">
            <Requirements
                :data="requirements.data"
                :lastPage="requirements.lastPage"
                :routeName="requirements.routeName"
                :nextPageUrl="requirements.nextPageUrl"
                :currentPage="requirements.currentPage"
                :previousPageUrl="requirements.previousPageUrl"
                @actionClick="actionClickHandler"
            />
        </template>

    </div>
</template>
