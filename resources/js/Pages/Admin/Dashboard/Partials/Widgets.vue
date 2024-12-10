<script setup>
import AuthenticatedLayout from '../../../../Admin/Layouts/AuthenticatedLayout.vue';
defineOptions({ layout: AuthenticatedLayout });

const props = defineProps({
  totals: { type: Object, required: true },
  totalsToday: { type: Object, required: true },
  totalsApproved:{type:Object,required:false}
});
console.log(props.totalsApproved)
</script>

<template>
  <div class="card">
    <h2 class="font-bold text-lg text-typography leading-tight mb-2">Dashboard</h2>
    <div class="flex">
      <div class="flex-1 overflow-hidden rounded-lg shadow-lg m-1 p-4 bg-custom-coral" style="display: flex; flex-direction: column;">
        <p class="text-center text-white mt-2 " style="font-weight: bold; font-size: 1.3em;">Business Permit</p>
        <a href="approved/1" class="text-center text-white mt-2">Total Approved: {{ totalsApproved.businessPermit }}</a>
        <a href="total/1" class="text-center text-white mt-2">Total Application: {{ totals.businessPermit }}</a>
        <a href="today/1" class="text-center text-white mt-2">Today: {{ totalsToday.businessPermit }}</a>
      </div>
      <div class="flex-1 overflow-hidden rounded-lg shadow-lg m-1 p-4 bg-custom-yellow"  style="display: flex; flex-direction: column;">
        <p class="text-center text-white mt-2" style="font-weight: bold; font-size: 1.3em;">Building Permit</p>
        <a href="approved/2" class="text-center text-white mt-2">Total Approved: {{totalsApproved.building }}</a>
        <a href="total/2" class="text-center text-white mt-2">Total Application: {{ totals.building }}</a>
        <a href="today/2" class="text-center text-white mt-2">Today: {{ totalsToday.building }}</a>
      </div>
      <div class="flex-1 overflow-hidden rounded-lg shadow-lg m-1 p-4 bg-custom-teal"  style="display: flex; flex-direction: column;">
        <p class="text-center text-white mt-2" style="font-weight: bold; font-size: 1.3em;">Business Permit Renewal</p>
        <a href="approved/3" class="text-center text-white mt-2">Total Approved: {{totalsApproved.renewal }}</a>
        <a href="total/3" class="text-center text-white mt-2">Total Application: {{ totals.renewal }}</a>
        <a href="today/3" class="text-center text-white mt-2">Today: {{ totalsToday.renewal }}</a>
      </div>
      
    </div>
  </div>
</template>
