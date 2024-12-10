<script setup>
import { ref, computed, onMounted } from 'vue';
import moment from 'moment';
import { useForm } from '@inertiajs/inertia-vue3';
import axios from 'axios';

const props = defineProps({
    queue: { type: Array, required: true }
});


</script>

<template>
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-center">Renew Form/s</h1>
    </div>

    <div class="card !p-2 mt-2">
        <!-- Search input -->
        <div class="flex items-center mb-4">
            <!-- <input v-model="inputText" @input="handleInput" type="text" placeholder="Search records..."
                class="border p-2 rounded w-full" /> -->
        </div>

        <!-- <div>
            <table class="w-full text-sm text-left">
                <thead class="text-md text-gray-700 uppercase">
                    <tr>
                        <th class="cursor-pointer" @click="updateSort('type')">
                            <i class="fas fa-arrow-up"></i>
                            <i class="fas fa-arrow-down"></i> Type of Permit
                        </th>
                        <th class="cursor-pointer" @click="updateSort('client.lname')">
                            <i class="fas fa-arrow-up"></i>
                            <i class="fas fa-arrow-down"></i> Name of Owner
                        </th>
                        <th class="cursor-pointer" @click="updateSort('project_title')">
                            <i class="fas fa-arrow-up"></i>
                            <i class="fas fa-arrow-down"></i> Business Name
                        </th>
                        <th class="cursor-pointer" @click="updateSort('created_at')"> 
                            <i class="fas fa-arrow-up"></i>
                            <i class="fas fa-arrow-down"></i> Application Date
                        </th>
                        <th>Remarks</th>
                        <th class="cursor-pointer" @click="updateSort('status')"> 
                            <i class="fas fa-arrow-up"></i>
                            <i class="fas fa-arrow-down"></i> Status
                        </th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    <template v-for="(item, index) in sortedQueue" :key="index">
                        <tr>
                            <td>{{ getType(item.type) }}</td>
                            <td>{{ item.client.lname }}, {{ item.client.fname }} {{ item.client.mname }}</td>
                            <td>{{ item.project_title }}</td>
                            <td>{{ formatDate(item.created_at) }}</td>
                            <td>{{ item.remarks }}</td>
                            <td class="!py-2 whitespace-nowrap">
                                <span class="p-2 rounded" :class="{
                                    'bg-green-100': item.status === 'Approved',
                                    'bg-red-100': item.status === 'Rejected',
                                    'bg-yellow-100': item.status === 'Pending'
                                }">
                                    <i class="mr-2" :class="{
                                        'fas fa-check-circle text-green-500': item.status === 'Approved',
                                        'fas fa-times-circle text-red-500': item.status === 'Rejected',
                                        'fas fa-hourglass-half text-yellow-500': item.status === 'Pending'
                                    }"></i>
                                    {{ item.status }}
                                </span>
                            </td>
                            <td class="!py-2">
                                <button @click="getRecord(item.id, item.type, item.client_id)"
                                    class="p-2 text-gray-600 hover:text-gray-900 relative">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>
                        <tr class="border-y text-sm text-gray-900"></tr>
                    </template>
                </tbody>
            </table> -->

            <!-- No data available message -->
            <!-- <div v-if="!hasContent" class="w-full bg-gray-100 text-center text-sm p-5">
                No data available
            </div> -->
            <!-- Pagination -->
            <!-- <Pagination :items="queue" /> -->
        <!-- </div> -->
    </div>
</template>
