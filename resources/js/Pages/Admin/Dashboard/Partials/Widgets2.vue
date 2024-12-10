<script setup>
import AuthenticatedLayout from '../../../../Admin/Layouts/AuthenticatedLayout.vue';
defineOptions({ layout: AuthenticatedLayout });
const businessPermitImg = '/storage/images/busperm.png';
const bldgPermitImg = '/storage/images/bldgperm.png';
const renewalImg = '/storage/images/renewal.png';
</script>
<template>
	<div class="card mt-2">
		<h2 class="font-bold text-lg text-typography leading-tight mb-2">List of Requirements</h2>
		<div class="grid grid-cols-1 md:grid-cols-3 gap-3">
			<div class="overflow-hidden rounded-lg shadow-lg m-5 p-6 bg-custom-coral m-auto">
				<Link :href="route('admin.documentviewbusiness')" class="overflow-hidden rounded-lg shadow-lg">
				<img class="w-full h-50 object-cover bg-custom-coral" :src="businessPermitImg" alt="Business Permit Image" />
				<p class="font-bold text-center text-white mt-2"> Business Permit</p>
				</Link>
			</div>
			<div class="overflow-hidden rounded-lg shadow-lg m-5 p-6 bg-custom-yellow m-auto">
				<Link :href="route('admin.documentviewbldg')" class="overflow-hidden rounded-lg shadow-lg">
				<img class="w-full h-50 object-cover bg-custom-yellow" :src="bldgPermitImg" alt="Building Permit Image" />
				<p class="font-bold text-center text-white mt-2"> Building Permit</p>
				</Link>
			</div>
			<div class="overflow-hidden rounded-lg shadow-lg m-5 p-6 bg-custom-teal m-auto">
				<Link :href="route('admin.documentviewrenewal')" class="overflow-hidden rounded-lg shadow-lg">
				<img class="w-full h-50 object-cover bg-custom-teal" :src="renewalImg"
					alt="Renewal Business Permit Image" />
				<p class="font-bold text-center text-white mt-2"> Business Permit Renewal</p>
				</Link>
			</div>
		</div>
	</div>
</template>