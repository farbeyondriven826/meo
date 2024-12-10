<script setup>
import ClientLayout from '../../Shared/ClientLayout.vue';
import moment from 'moment';
import { useForm, usePage } from "@inertiajs/inertia-vue3";
import { ref, computed, onMounted } from 'vue';

defineOptions({ layout: ClientLayout });
const props = defineProps({
    notification: Array
});

const userId = usePage().props.value.auth.user.id;
const formatDate = (date) => {
    return moment(date).format('MMMM DD, YYYY, h:mm A');
};

const filterType = ref(null);
const filterStatus = ref(null);
const filterDate = ref(null);

const formData = useForm({
    id: null,
    status: null,
    type: null,
    remarks: null
});

const filteredNotifications = computed(() => {
    let filtered = props.notification;

    if (filterType.value) {
        filtered = filtered.filter(item => item.application_form.type === filterType.value);
    }

    if (filterStatus.value) {
        filtered = filtered.filter(item => item.application_form.status === filterStatus.value);
    }

    if (filterDate.value) {
        filtered = filtered.filter(item => moment(item.created_at).isSame(moment(filterDate.value), 'day'));
    }

    return filtered;
});

const listenForNotifications = () => {
    Echo.private(`App.Models.User.${userId}`)
        .notification((notification) => {
            if (notification.data) {
                props.notification.unshift(notification.data);
            }
        });
};

onMounted(() => {
    listenForNotifications();
})

function getStatus(status) {
    return "Status: " + status + '.';
}
</script>

<template>
    <div class="w-full max-w-4xl mx-auto px-4 py-6">

        <Head title="Notifications" />
        <h1 class="text-2xl font-bold mb-4 text-center">Notifications</h1>
        <hr class="border-gray-300 mb-6" />

        <div style="display: flex; justify-content: flex-end; gap:10px; padding-bottom: 20px;">
            <div class="" style="display: flex; flex-direction: column; width: 100%;">
                <label for="type" class="font-medium">Type of Business</label>
                <select v-model="filterType" id="type" class="p-2 border rounded">
                    <option value="">All Types</option>
                    <option value="1">Business Permit (New)</option>
                    <option value="2">Building Permit</option>
                    <option value="3">Business Permit (Renewal)</option>
                </select>
            </div>

            <div style="display: flex; flex-direction: column; width: 100%;">
                <label for="status" class="font-medium">Status</label>
                <select v-model="filterStatus" id="status" class="p-2 border rounded">
                    <option value="">All Status</option>
                    <option value="Approved">Approved</option>
                    <option value="Rejected">Rejected</option>
                    <option value="Pending">Pending</option>
                </select>
            </div>

            <div style="display: flex; flex-direction: column;width: 100%;">
                <label for="date" class="font-medium">Date</label>
                <input v-model="filterDate" id="date" type="date" class="p-2 border rounded" />
            </div>
        </div>
        <hr class="border-gray-300 mb-6" />

        <div class="space-y-4" v-if="filteredNotifications.length > 0">
            <a :href="route('notification.getrecord', item.id)" v-for="(item, index) in filteredNotifications"
                :key="index" class="block p-4 border rounded-lg shadow-md" :class="{
                    'bg-white hover:bg-gray-200': item.is_viewed,
                    'bg-slate-400 hover:bg-gray-300': !item.is_viewed
                }">
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between cursor-pointer">
                    <span class="font-medium text-lg">{{ item.description }} {{ getStatus(item.application_form.status)
                        }}</span>
                    <small class="text-gray-500">{{ formatDate(item.created_at) }}</small>
                </div>
            </a>
        </div>
        <div class="space-y-4 text-center" v-else>
            <p>No Notifications Available </p>
        </div>
    </div>
</template>

<style scoped>
.card {
    padding: 1rem;
    border: 1px solid #e2e8f0;
    border-radius: 0.375rem;
    background-color: #ffffff;
    box-shadow: 0 0 1rem rgba(0, 0, 0, 0.1);
}

.card span {
    font-size: 1rem;
    font-weight: 500;
}

.card small {
    color: #6b7280;
}
</style>
