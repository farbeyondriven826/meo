<script setup>
import ClientLayout from '../../Shared/ClientLayout.vue';

defineOptions({ layout: ClientLayout });
const businessPermitImg = '/storage/images/busperm.png';
const bldgPermitImg = '/storage/images/bldgperm.png';
const renewalImg = '/storage/images/renewal.png';
</script>
<template>
    <div class="w-full max-w-4xl mx-auto px-4 py-6">

        <Head title="DocumentView" />
        <h1 class="text-2xl font-bold mb-2 text-center">List of Requirements</h1>
        <hr class="border-gray-300 mb-6" />
        <div class="card">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
            <div class="overflow-hidden rounded-lg shadow-lg m-5 p-6 bg-custom-coral m-auto">
                <Link :href="route('documentviewbusiness')" class="overflow-hidden rounded-lg shadow-lg">
                    <img class="w-full h-50 object-cover bg-custom-coral" :src="businessPermitImg" alt="Business Permit Image" />
                    <p class="text-center text-white mt-2"> Business Permit</p>
                </Link>
            </div>
            <div class="overflow-hidden rounded-lg shadow-lg m-5 p-6 bg-custom-yellow m-auto">
                <Link :href="route('documentviewbldg')" class="overflow-hidden rounded-lg shadow-lg">
                    <img class="w-full h-50 object-cover bg-custom-yellow" :src="bldgPermitImg" alt="Building Permit Image" />
                    <p class="text-center text-white mt-2"> Building Permit</p>
                </Link>
            </div>
            <div class="overflow-hidden rounded-lg shadow-lg m-5 p-6 bg-custom-teal m-auto">
                <Link :href="route('documentviewrenewal')" class="overflow-hidden rounded-lg shadow-lg">
                    <img class="w-full h-50 object-cover bg-custom-teal" :src="renewalImg" alt="Renewal Business Permit Image" />
                    <p class="text-center text-white mt-2"> Business Permit Renewal</p>
                </Link>
            </div>
        </div>
        </div>
    </div>
</template>