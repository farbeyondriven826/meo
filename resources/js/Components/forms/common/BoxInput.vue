<script setup>
import { computed, ref } from 'vue';

const props = defineProps({
    label:String,
    name:String,
    count:Number,
    isView:Boolean,
    data:Object
})

const defaultValue = computed(()=>{
    const data = props.data?.[props.name]?.split('') ?? '';
    return data || Array(props.count).fill('');
})


const value = computed(()=>defaultValue.value.join(''));


function inputHandler(e){
    const target = e.target;
    const index = parseInt(target.dataset.index);
    const value = target.value;
    const str = defaultValue.value;
    str[index] = value;
    defaultValue.value = str;
}

</script>

<template>

    <div>
        <p class="text-xs">{{label}}</p>
        <div class="grid w-max grid-flow-col" >

            <template v-if="props.isView">
                <template v-for="(item, index) in defaultValue" :key="index">
                    <span class="border border-black w-[25px] h-[30px] grid content-center justify-center text-xs">{{ item }}</span>
                </template>
            </template>

            <template v-else>
                <template v-for="(item, index) in defaultValue" :key="index">
                    <div class="w-[25px]">
                        <input  type="text"  class="!rounded-none focus:outline-none " maxlength="1" :data-index="index" @input="inputHandler" :value="item"/>
                    </div>
                </template>
            </template>

            <input type="hidden" :name="props.name"  :id="props.name" :value="value"/>
        </div>
    </div>
</template>

