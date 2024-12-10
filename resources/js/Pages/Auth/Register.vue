<script setup>
import { ref } from 'vue'; // Import ref for reactivity
import { useForm } from "@inertiajs/inertia-vue3";
import TextInput from "../Components/TextInput.vue";
import ClientLayout from "../../Shared/ClientLayout.vue";
import { useToast } from 'vue-toastification';

defineOptions({ layout: ClientLayout });
const params = defineProps({
    type: Number,
});
const toast = useToast();
// Create formData using useForm
const formData = useForm({
    fname: null,
    mname: null,
    lname: null,
    sex: null,
    street: null,
    brgy: null,
    municipality: null,
    province: "Camarines Norte",
    contact_number: null,
    email: null,
    password: null,
    password_confirmation: null,
    type: params.type,
});

// Password validation state
const passwordError = ref("");

const submit = () => {
    // Validate password before submitting
    if (!isPasswordValid(formData.password)) {
        passwordError.value = "Password must be at least 8 characters long, contain upper and lower case letters, a number, and a special character.";
        return;
    }

    passwordError.value = ""; // Reset error if password is valid
    formData.post("/register", {
        onSuccess:()=>{
            toast.success("Account created Successfully!");
        },
        onError: (e) => {
            console.log(e)
            formData.reset("password", "password_confirmation");
        },
    });
};

function isPasswordValid(password) {
    // Regular expression for password validation
    const passwordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    return passwordPattern.test(password);
}

function getType(type) {
    return type == 0 ? "User" : "Admin";
}
const loginForm = useForm({
    type: params.type,
});
function gotoLogin() {
    loginForm.get(route("login.index"));
}

// Municipality and Barangay Data
const municipalities = {
    "Basud": [
        "Angas", "Bactas", "Binatagan", "Caayunan", "Guinatungan",
        "Hinampacan", "Langa", "Laniton", "Lidong", "Mampili",
        "Mandazo", "Mangcamagong", "Manmuntay", "Mantugawe", "Matnog",
        "Mocong", "Oliva", "Pagsangahan", "Pinagwarasan", "Plaridel",
        "Poblacion 1", "Poblacion 2", "San Felipe", "San Jose", 
        "San Pascual", "Taba-taba", "Tacad", "Taisan", "Tuaca",
    ],
    "Capalonga": [
        "Alayao", "Binawangan", "Calabaca", "Camagsaan", "Catabaguangan", "Catioan", 
        "Del Pilar", "Itok", "Lucbanan", "Mabini", "Mactang", "Mataque", "Old Camp", 
        "Poblacion", "Magsaysay", "San Antonio", "San Isidro", "San Roque", "Tanauan", 
        "Ubang", "Villa Aurora", "Villa Belen"
    ],
    "Daet": [
        "Alawihao", "Awitan", "Bagasbas", "Barangay I (Hilahod)", "Brgy II (Pasig)",
        "Brgy III (Iraya)", "Brgy IV (Mantagbac)", "Brgy V (Pandan)", "Brgy VI (Centro)",
        "Brgy VII (Diego Liñan)", "Brgy VIII (Salcedo)", "Bibirao", "Borabod", "Calasgasan",
        "Camambugan", "Cobangbang", "Dogongan", "Gahonon", "Gubat", "Lag-on", "Magang",
        "Mambalite", "Pamorangon", "Mancruz", "San Isidro"
    ],
    "Jose Panganiban": [
        "Bagong Bayan", "Calero", "Dahican", "Dayhagan", "Larap", 
        "Luklukan Norte", "Luklukan Sur", "Motherlode", "Nakalaya", 
        "Osmeña", "Pag-Asa", "Parang", "Plaridel", "North Poblacion", 
        "South Poblacion", "Salvacion", "San Isidro", "San Jose", 
        "San Martin", "San Pedro", "San Rafael", "Santa Cruz", 
        "Santa Elena", "Santa Milagrosa", "Santa Rosa Norte", 
        "Santa Rosa Sur", "Tamisan"
    ],
    "Labo": [
        "Anahaw", "Anameam", "Awitan", "Baay", "Bagacay", "Bagong Silang I", 
        "Bagong Silang II", "Bagong Silang III", "Bakiad", "Bautista", "Bayabas", 
        "Bayan-bayan", "Benit", "Bulhao", "Cabatuhan", "Cabusay", "Calabasa", 
        "Canapawan", "Daguit", "Dalas", "Dumagmang", "Exciban", "Fundado", 
        "Guinacutan", "Guisican", "Gumamela", "Iberica", "Kalamunding", "Lugui", 
        "Mabilo I", "Mabilo II", "Macogon", "Mahawan-hawan", "Malangcao-Basud", 
        "Malasugui", "Malatap", "Malaya", "Malibago", "Maot", "Masalong", "Matanlang", 
        "Napaod", "Pag-Asa", "Pangpang", "Pinya", "San Antonio", "San Francisco", 
        "Santa Cruz", "Submakin", "Talobatib", "Tigbinan", "Tulay Na Lupa"
    ],
    "Mercedes": [
        "Apuao", "Barangay I (Poblacion)", "Barangay II (Poblacion)", "Barangay III (Poblacion)", 
        "Barangay IV (Poblacion)", "Barangay V (Poblacion)", "Barangay VI (Poblacion)", 
        "Barangay VII (Poblacion)", "Caringo", "Catandunganon", "Cayucyucan", "Colasi", 
        "Del Rosario (Tagongtong)", "Gaboc", "Hamoraon", "Hinipaan", "Lalawigan", 
        "Lanot", "Mambungalon", "Manguisoc", "Masalongsalong", "Matoogtoog", "Pambuhan", 
        "Quinapaguian", "San Roque", "Tarum"
    ],
    "Paracale": [
        "Awitan", "Bagumbayan", "Bakal", "Batobalani", "Calaburnay", "Capacuan", 
        "Casalugan", "Dagang", "Dalnac", "Dancalan", "Gumaus", "Labnig", 
        "Macolabo Island", "Malacbang", "Malaguit", "Mampungo", "Mangkasay", "Maybato", 
        "Palanas", "Pinagbirayan Malaki", "Pinagbirayan Munti", "Poblacion Norte", 
        "Poblacion Sur", "Tabas", "Talusan", "Tawig", "Tugos"
    ],
    "San Lorenzo Ruiz": [
        "Daculang Bolo", "Dagotdotan", "Langga", "Laniton", "Maisog", "Mampurog", 
        "Manlimonsito", "Matacong (Pob.)", "Salvacion", "San Antonio", "San Isidro", "San Ramon"
    ],
    "San Vicente": [
        "Asdum", "Cabanbanan", "Calabagas", "Fabrica", "Iraya Sur", "Man-Ogob", 
        "Poblacion District I (Silangan/Barangay 1)", "Poblacion District II (Kanluran/Barangay 2)", 
        "San Jose"
    ],
    "Santa Elena": [
        "Basiad", "Bulala", "Don Tomas", "Guitol", "Kabuluan", "Kagtalaba", 
        "Maulawin", "Patag Ibaba", "Patag Ilaya", "Plaridel", "Polungguitguit", 
        "Rizal", "Salvacion", "San Lorenzo", "San Pedro", "San Vicente", 
        "Santa Elena (Poblacion)", "Tabugon", "Villa San Isidro"
    ],
    "Talisay": [
        "Binanuaan", "Caawigan", "Cahabaan", "Calintaan", "Del Carmen", "Gabon", 
        "Itomang", "Poblacion", "San Francisco", "San Isidro", "San Jose", 
        "San Nicolas", "Santa Cruz", "Santa Elena", "Santo Niño"
    ],
    "Vinzons": [
        "Aguit-It", "Banocboc", "Cagbalogo", "Calangcawan Norte", "Calangcawan Sur", 
        "Guinacutan", "Mangcayo", "Mangcawayan", "Manlucugan", "Matango", 
        "Napilihan", "Pinagtigasan", "Barangay I (Pob.)", "Barangay II (Pob.)", 
        "Barangay III (Pob.)", "Sabang", "Santo Domingo", "Singi", "Sula"
    ],
};

// State for Municipality and Barangay dropdowns
const isOpenMunicipality = ref(false);
const selectedMunicipality = ref("Select Municipality");
const municipalityOptions = Object.keys(municipalities);

const isOpenBrgy = ref(false);
const selectedBarangay = ref("Select Barangay");
const barangayOptions = ref([]); // Dynamically update based on municipality selection

function selectMunicipality(option) {
    selectedMunicipality.value = option; // Update selected municipality
    formData.municipality = option; // Update formData

    // Update Barangay options based on selected municipality
    barangayOptions.value = municipalities[option];
    selectedBarangay.value = "Select Barangay"; // Reset Barangay selection
    isOpenMunicipality.value = false;
}

function toggleDropdownMunicipality() {
    isOpenMunicipality.value = !isOpenMunicipality.value;
}

function selectBarangay(option) {
    selectedBarangay.value = option;
    formData.brgy = option;
}

function toggleDropdownBrgy() {
    if (selectedMunicipality.value !== "Select Municipality") {
        isOpenBrgy.value = !isOpenBrgy.value;
    }
}

// Dropdown state
const isOpen = ref(false);
const selectedOption = ref("Select");
const options = ["Male", "Female"];

function toggleDropdownSex() {
    isOpen.value = !isOpen.value; // Toggle dropdown visibility
}

function selectOption(option) {
    selectedOption.value = option; // Update selected option
    formData.sex = option; // Update formData
    isOpen.value = false; // Close dropdown after selection
}

</script>

<template>
    <Head title="Register" />
    <div class="relative w-full min-h-screen flex flex-col items-center justify-center">
        <div class="absolute inset-0 bg-cover bg-center bg-fixed bg-no-repeat" style="background-image: url('/storage/images/home_bg.png')"></div>
        <div class="relative flex flex-col items-center justify-center w-full max-w-4xl mx-auto px-3">
            <div class="w-full max-w-lg bg-white px-6 py-6 rounded-lg shadow-lg mt-10 mb-10">
                <div class="flex justify-between px-1">
                    <div class="flex items-center space-x-4">
                        <span class="p-2 rounded-full bg-white border-2 border-gray-500 cursor-pointer" @click="gotoLogin">
                            <i class="fas fa-arrow-left w-5 h-5 text-center text-gray-500"></i>
                        </span>
                        <span>{{ getType(params.type) }} Registration</span>
                    </div>
                    <div>
                        <img src="/storage/images/meo_home_logo.png" alt="Additional Image" class="w-40 h-auto" />
                    </div>
                </div>

                <h1 class="text-xl font-semibold text-center mb-3">Register a new account</h1>
                <form @submit.prevent="submit">
                    <div class="grid grid-cols-2 gap-4">
                        <TextInput name="First Name" v-model:modelValue="formData.fname" :message="formData.errors.fname" />
                        <TextInput name="Middle Name" v-model:modelValue="formData.mname" :message="formData.errors.mname" />
                        <TextInput name="Last Name" v-model:modelValue="formData.lname" :message="formData.errors.lname" />
                        <div @click="toggleDropdownSex">
                            Sex
                            <div v-if="!isOpen" class="selectBox">{{ selectedOption }}</div>
                            <ul v-if="isOpen" class="dropdown-menu" @click="toggleDropdownSex">
                                <li v-for="(option, index) in options" :key="index" @click="selectOption(option)" class="dropdown-item">{{ option }}</li>
                            </ul>
                            <span v-if="formData.errors.sex" class="text-red-500 text-sm">{{ formData.errors.sex }}</span>
                        </div>

                        <TextInput name="Province" v-model:modelValue="formData.province" :message="formData.errors.province" :readonly="true" />
                        <div>
                            <div @click="toggleDropdownMunicipality">
                                Municipality
                                <div v-if="!isOpenMunicipality" class="selectBox">{{ selectedMunicipality }}</div>
                                <ul v-if="isOpenMunicipality" class="dropdown-menus" @click="toggleDropdownMunicipality">
                                    <li v-for="(option, index) in municipalityOptions" :key="index" @click="selectMunicipality(option)" class="dropdown-item">{{ option }}</li>
                                </ul>
                                <span v-if="formData.errors.municipality" class="text-red-500 text-sm">{{ formData.errors.municipality }}</span>
                            </div>
                        </div>
                        <div>
                            <div v-if="selectedMunicipality.value !== 'Select Municipality'" @click="toggleDropdownBrgy">
                                Barangay
                                <div v-if="!isOpenBrgy" class="selectBox">{{ selectedBarangay }}</div>
                                <ul v-if="isOpenBrgy" class="dropdown-menus">
                                    <li v-for="(option, index) in barangayOptions" :key="index" @click="selectBarangay(option)" class="dropdown-item">{{ option }}</li>
                                </ul>
                                <span v-if="formData.errors.brgy" class="text-red-500 text-sm">{{ formData.errors.brgy }}</span>
                            </div>
                        </div>
                        <TextInput name="Street" v-model:modelValue="formData.street" :message="formData.errors.street" />
                        <TextInput name="Mobile Number" v-model:modelValue="formData.contact_number" :message="formData.errors.contact_number" placeholder="09123456789" />
                        <TextInput name="Email" type="email" v-model:modelValue="formData.email" :message="formData.errors.email" />
                        <TextInput name="Password" type="password" v-model:modelValue="formData.password" :message="formData.errors.password" />
                        <TextInput name="Confirm Password" type="password" v-model:modelValue="formData.password_confirmation" />
                        
                        <!-- Display password error if present -->
                        <p v-if="passwordError" class="text-red-500 text-xs italic">{{ passwordError }}</p>
                    </div>
                    <div class="mt-5">
                        <button class="primary-btn" :disabled="formData.processing">Register</button>
                        <p class="text-slate-600 mt-2 text-center">
                            Already a user? <a @click="gotoLogin" class="text-link cursor-pointer">Signin now</a>
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>

<style>
/* Ensure the background image covers the full viewport */
.bg-cover {
    background-size: cover;
}

.bg-center {
    background-position: center;
}

.bg-fixed {
    position: fixed;
}

.bg-no-repeat {
    background-repeat: no-repeat;
}

.dropdown-menu {
    position: absolute;
    background: white;
    overflow-x: scroll;
    border:1px solid  rgba(0, 0, 0, 0.1);
}

.dropdown-menu li {
    width: 100%;
    padding: 10px 80px;
    cursor: pointer;
}

.dropdown-menus {
    position: absolute;
    background: white;
    height: 200px;
    overflow-x: scroll;
    border:1px solid  rgba(0, 0, 0, 0.1);
}

.dropdown-menus li {
    width: 100%;
    padding: 10px 80px;
    cursor: pointer;
}

.selectBox {
    border: 1px solid #cbd5e1;
    padding: 5px 0px;
    padding-left: 10px;
    border-radius: 4px;
    box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

</style>
