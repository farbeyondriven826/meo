<script setup>
import BuildingFormsView from '@/Components/forms/requirements/building-forms/BuildingFormsView.vue';
import ElectricalPermit from '@/Components/forms/requirements/electrical-permit/ElectricalPermit.vue';
import SanitaryPermit from './sanitary-permit/SanitaryPermit.vue';
const props = defineProps({
    isView: Boolean,
    isSubmit: Boolean,
    requirementId: Number,
    requirementData:Object
});

const emits = defineEmits(["submit"]);


function submitHandler(e) {
    emits('submit',e);
}


</script>


<template>

<template v-if="props.requirementId == 1">
    <BuildingFormsView
        :isView="isView"
        :isSubmit="isSubmit"
        :data="props.requirementData"
        @submit="submitHandler" :form="`form${props.requirementId}`"/>
</template>
<template v-else-if="props.requirementId == 2">
    <ElectricalPermit
        :isView="isView"
        :isSubmit="isSubmit"
        :data="props.requirementData"
        @submit="submitHandler" :form="`form${props.requirementId}`"/>
</template>
<template v-else-if="props.requirementId == 3">
    <SanitaryPermit
        :isView="isView"
        :isSubmit="isSubmit"
        :data="props.requirementData"
        @submit="submitHandler" :form="`form${props.requirementId}`"/>
</template>
<template v-else>
    <div>
        <h1>No Requirement Form for requirementId {{ props.requirementId }}</h1>
    </div>
</template>

</template>
