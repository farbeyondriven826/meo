<script setup>
import AuthenticatedLayout from '@/Admin/Layouts/AuthenticatedLayout.vue';
const props = defineProps({
  queue: [Object, Array],
});
defineOptions({ layout: AuthenticatedLayout });
</script>

<template>
    
    <div class="container">
        <div class="box">
            <h1>Admin</h1>
            <div class="left">
                <a href="create" class="button">
                    <i class="fas fa-plus"></i>
                    Create
                </a>
            </div>
        </div>
        <div class="adminContainer">
            <table>
                <thead style="background-color: #698FA5; color:white;">
                    <tr>
                        <!-- <th>No.</th> -->
                        <th>Username</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Sex</th>
                        <th>Street</th>
                        <th>Brgy</th>
                        <th>Municipality</th>
                        <th>Province</th>
                    </tr>
                </thead>
                <tbody>
                    
                    <template v-for="(item, index) in queue" :key="index">
                        <tr>
                            <!-- <td>{{ index }}</td> -->
                            <td>{{ item.username }}</td>
                            <td>{{ item.client.lname+", "+item.client.fname+" "+item.client.mname }}</td>
                            <td>{{ item.email }}</td>
                            <td>{{ item.client.sex }}</td>
                            <td>{{ item.client.street }}</td>
                            <td>{{ item.client.brgy }}</td>
                            <td>{{ item.client.municipality }}</td>
                            <td>{{ item.client.province }}</td>
                            
                        </tr>
                    </template>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style scoped>
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
    }
    .box{
        display: flex;
        width: 100%;
    }
    .button{
        background: #1DA247;
        padding: 10px 20px;
        border-radius: 5px;
        color:white;
        font-size: 18px;
        position: absolute;
        right: 40px;
        
    }
</style>