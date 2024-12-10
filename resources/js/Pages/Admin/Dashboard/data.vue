<script setup>
import { ref, computed, onMounted } from 'vue';
import moment from 'moment';
import { useForm } from '@inertiajs/inertia-vue3';
import axios from 'axios';

const props = defineProps({
    queue: { type: Array, required: true },
    type: { type: [String, Object], required: true },
});

// Form data for changing status
const formData = useForm({
    id: null,
    status: null,
    type: null,
    clientId: null,
    remarks: null,
    data: null,
});

// Reactive variables
const openMenuIndex = ref(null);
const showRejectModal = ref(false);
const searchQuery = ref('');
const inputText = ref('');
const hasContent = ref(true);
const searchData = ref([]);
const sortColumn = ref('application_date'); // default sort column
const sortOrder = ref('asc'); // default sort order

// Toggle menu
const toggleMenu = (index) => {
    openMenuIndex.value = openMenuIndex.value === index ? null : index;
};

// Toggle reject modal
const toggleRejectModal = () => {
    showRejectModal.value = !showRejectModal.value;
};

// Sorting logic
const sortedQueue = computed(() => {
    const data = [...props.queue]; // make a copy of the queue to avoid mutating the original

    return data.sort((a, b) => {
        const aValue = getSortValue(a, sortColumn.value);
        const bValue = getSortValue(b, sortColumn.value);

        if (aValue === null || bValue === null) return 0;

        if (typeof aValue === 'string' && typeof bValue === 'string') {
            // If both are strings, sort lexicographically
            return sortOrder.value === 'asc' ? aValue.localeCompare(bValue) : bValue.localeCompare(aValue);
        } else if (typeof aValue === 'number' && typeof bValue === 'number') {
            // If both are numbers, sort numerically
            return sortOrder.value === 'asc' ? aValue - bValue : bValue - aValue;
        } else if (aValue instanceof Date && bValue instanceof Date) {
            // If both are dates, sort by date
            return sortOrder.value === 'asc' ? aValue - bValue : bValue - aValue;
        }

        return 0; // If the values can't be compared, don't change order
    });
});

// Get value for sorting (handling nested properties)
const getSortValue = (item, column) => {
    const keys = column.split('.'); // to handle nested keys like 'client.lname'
    let value = item;

    for (const key of keys) {
        value = value ? value[key] : null;
    }

    if (column === 'created_at') {
        return moment(value).isValid() ? new Date(value) : null; // Convert 'created_at' to Date
    }

    return value;
};

// Update sorting order when clicking on a column
const updateSort = (column) => {
    sortOrder.value = sortColumn.value === column && sortOrder.value === 'asc' ? 'desc' : 'asc';
    sortColumn.value = column;
};

// Handle search input
const handleInput = async () => {
    const response = await axios.get('approval/search', { params: { search: inputText.value } });
    searchData.value = response.data;
    hasContent.value = response.data.length > 0;
};

// Utility functions
const getType = (type) => {
    const types = {
        '1': 'Business Permit (New)',
        '2': 'Building Permit',
        default: 'Business Permit (Renewal)',
    };
    return types[type] || types.default;
};

const formatDate = (date) => moment(date).format('MMMM DD, YYYY h:mm a');

const checkedBy = (person) => person ? `${person.lname}, ${person.fname} ${person.mname}` : '';

// Fetch and set record data
const getRecord = (id, type, clientId) => {
    formData.id = id;
    formData.type = type;
    formData.clientId = clientId;
    formData.post('/admin/approval/getRecord');
};

// Initial setup on mounted
onMounted(() => {
    if (performance.navigation.type === performance.navigation.TYPE_RELOAD) {
        const localID = localStorage.getItem('localID');
        const localType = localStorage.getItem('localtype');
        const clientID = localStorage.getItem('clientID');
        if (localID && localType && clientID) {
            formData.id = localID;
            formData.type = localType;
            formData.clientId = clientID;
            formData.post('/admin/approval/getRecord');
        }
    }
});
</script>

<template>
    <div class="flex items-center justify-between">
        <h1 class="text-2xl font-bold text-center">{{ type }}</h1>
    </div>

    <div class="card !p-2 mt-2">
        <!-- Search input -->
        <div class="flex items-center mb-4">
            <input v-model="inputText" @input="handleInput" type="text" placeholder="Search records..."
                class="border p-2 rounded w-full" />
        </div>

        <div>
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
            </table>

            <!-- No data available message -->
            <div v-if="!hasContent" class="w-full bg-gray-100 text-center text-sm p-5">
                No data available
            </div>
            <!-- Pagination -->
            <Pagination :items="queue" />
        </div>
    </div>
</template>
