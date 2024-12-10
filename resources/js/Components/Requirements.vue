<script setup>
import Pagination from '@/Components/Pagination.vue';

const props = defineProps({
    data:Object,
    lastPage:Number,
    routeName:String,
    nextPageUrl:String,
    currentPage:String,
    previousPageUrl:String,
});

const emits= defineEmits(['actionClick']);
const actionHandler = function(requirement_id){
    return (e)=>emits('actionClick', {action:e.target.dataset.action, requirement_id});

}

</script>

<template>
    <div>
        <div v-for="(value, key, index) in props.data" :key="index">
            <h1 class="text-2xl font-bold mb-2">
                {{ key }}
                <hr class="border-gray-300 mb-6 mt-2" />
            </h1>
            <p class="p-4 bg-violet-200 mb-3" >
                {{ value.subcategory_name }}
            </p>
            <div v-for="(item, index) in value.requirements" :key="index">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex-1">{{ item.requirements_name }}</div>
                    <div class="flex-shrink-0 flex space-x-3" @click="actionHandler(item.requirements_id)($event)">

                        <button
                            v-if="item.input_type == 'form'"
                            type="button"
                            class="text-white px-3 py-1 rounded cursor-pointer text-xs"
                            :class=" 'bg-red-600'"
                            data-action="view"
                        >
                            View
                        </button>

                        <button
                            v-if="item.input_type == 'file'"
                            type="button"
                            class="text-white px-3 py-1 rounded cursor-pointer text-xs"
                            :class=" 'bg-blue-400'"
                            data-action="upload"
                        >
                            Upload
                        </button>
                        <button
                            v-if="item.input_type == 'file'"
                            type="button"
                            class="text-white px-3 py-1 rounded cursor-pointer text-xs"
                            :class=" 'bg-green-600'"
                            data-action="form"
                        >
                            Download Form
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="flex items-center justify-between mb-3">
            <Pagination :currentPage="props.currentPage" :lastPage="props.lastPage" :url="props.routeName"
                :previousPageUrl="props.previousPageUrl" :nextPageUrl="props.nextPageUrl"
                    />
        </div>
    </div>
</template>
