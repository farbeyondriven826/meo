<script setup>
import { ref } from 'vue';
import { useForm } from "@inertiajs/inertia-vue3";
import TextInput from '../Components/TextInput.vue';
import { useToast } from 'vue-toastification';
import axios from 'axios';

const isOpen = ref(false);
const selectedOption = ref("Select");
const options = ["Male", "Female"];
const passwordError = ref("");
const toast = useToast();

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
    type: 1,
});

function toggleDropdownSex() {
    isOpen.value = !isOpen.value; // Toggle dropdown visibility
}
function selectOption(option) {
    selectedOption.value = option; // Update selected option
    formData.sex = option; // Update formData
    isOpen.value = false; // Close dropdown after selection
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

// Submit validation
const submit =  () => {
    // Validate password before submitting
    if (!isPasswordValid(formData.password)) {
        passwordError.value = "Password must be at least 8 characters long, contain upper and lower case letters, a number, and a special character.";
        return;
    }
 

    passwordError.value = ""; // Reset error if password is valid

        // await axios.get(route('adminreg'),formData).then((res)=>{
        //     console.log(res)
        // })
    formData.post('registeradmin', {
        onSuccess:(e)=>{
    console.log(e)
            // window.location.href=route("admin.showAdmin");
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

</script>
<template>
    <div class="container">
        <h1>Create Admin</h1>
        <div class="adminContainer">
            <form class="forms" @submit.prevent="submit">
                <div class="row">
                        <TextInput class="input" name="First Name" v-model:modelValue="formData.fname" :message="formData.errors.fname" />
                        <TextInput class="input" name="Middle Name" v-model:modelValue="formData.mname" :message="formData.errors.mname" />
                        <TextInput class="input" name="Last Name" v-model:modelValue="formData.lname" :message="formData.errors.lname" />
                </div>
                <div class="row">
                    <div @click="toggleDropdownSex" class="input">
                        Sex
                        <div v-if="!isOpen" class="selectBox">{{ selectedOption }}</div>
                        <ul v-if="isOpen" class="dropdown-menu" @click="toggleDropdownSex">
                            <li v-for="(option, index) in options" :key="index" @click="selectOption(option)" class="dropdown-item">{{ option }}</li>
                        </ul>
                        <span v-if="formData.errors.sex" class="text-red-500 text-sm">{{ formData.errors.sex }}</span>
                    </div>
                    <TextInput class="input"  v-model:modelValue="formData.province" :message="formData.errors.province" :readonly="true" name="Province"/>
                    <div @click="toggleDropdownMunicipality" class="input">
                        Municipality
                        <div v-if="!isOpenMunicipality" class="selectBox">{{ selectedMunicipality }}</div>
                        <ul v-if="isOpenMunicipality" class="dropdown-menus" @click="toggleDropdownMunicipality">
                            <li v-for="(option, index) in municipalityOptions" :key="index" @click="selectMunicipality(option)" class="dropdown-item">{{ option }}</li>
                        </ul>
                        <span v-if="formData.errors.municipality" class="text-red-500 text-sm">{{ formData.errors.municipality }}</span>
                    </div>
                </div>      
                <div class="row">
                    <div v-if="selectedMunicipality.value !== 'Select Municipality'" @click="toggleDropdownBrgy" class="input">
                        Barangay
                        <div v-if="!isOpenBrgy" class="selectBox">{{ selectedBarangay }}</div>
                        <ul v-if="isOpenBrgy" class="dropdown-menus">
                            <li v-for="(option, index) in barangayOptions" :key="index" @click="selectBarangay(option)" class="dropdown-item">{{ option }}</li>
                        </ul>
                        <span v-if="formData.errors.brgy" class="text-red-500 text-sm">{{ formData.errors.brgy }}</span>
                    </div>
                    <TextInput class="input" v-model:modelValue="formData.street" :message="formData.errors.street" name="Street"/>
                    <TextInput class="input" v-model:modelValue="formData.contact_number" :message="formData.errors.contact_number" placeholder="09123456789" name="Mobile Number"/>
                </div>      
                <div class="row">
                    <TextInput class="input" v-model:modelValue="formData.email" :message="formData.errors.email" name="Email"/>
                    <TextInput class="input" v-model:modelValue="formData.password" :message="formData.errors.password" type="password" name="Password"/>
                    <TextInput class="input" v-model:modelValue="formData.password_confirmation"  type="password" name="Confirm Password"/>
                    
                </div>  
                <p v-if="passwordError" class="text-red-500 text-xs italic">{{ passwordError }}</p>

                <div class="action">
                    <button type="submit" class="submit">
                        <i class="fas fa-save"></i>
                        Submit</button>
                </div>
            </form>
        </div>
    </div>
</template>
<style scoped>
.input{
    width: 100%;
}

.container{
    width: 100%;
    height:100%;
    padding-left:20px;
}

h1{
    padding-left:20px;
    font-family: sans-serif;
    font-size: 2em;
    font-weight: bold;
    color: rgb(29, 26, 26);
}

.adminContainer{
    width: 100%;
    height:90%;
    background-color: white;
    border-radius: 10px;
    margin-top: 20px;
    padding:20px;
}

.action{
    width:100%;
    display:flex;
    justify-content: flex-end;
    padding-top: 20px;
}

.submit{
    background:#1DA247;
    color:white;
    font-size: 20px;
    padding:10px 30px;
    border-radius: 10px;
}

.row{
    width: 100%;
    display:flex;
    justify-content: space-evenly;
    gap:20px;
    /* justify-content: space-evenly */
}

.selectBox {
    border: 1px solid #cbd5e1;
    padding: 5px 0px;
    padding-left: 10px;
    border-radius: 4px;
    box-shadow: 0px 0px 1px rgba(0, 0, 0, 0.1); /* Subtle shadow */
}

.dropdown-menu {
    position: absolute;
    background: white;
    border:1px solid  rgba(0, 0, 0, 0.1);
    overflow-x: scroll;
}

.forms{
    display:flex;
    flex-direction: column;
    justify-content: space-evenly;
    gap:10px;
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
    overflow-x: hidden;
    border:1px solid  rgba(0, 0, 0, 0.1);
}

.dropdown-menus li {
    width: 100%;
    padding: 10px 80px;
    cursor: pointer;
}
</style>
