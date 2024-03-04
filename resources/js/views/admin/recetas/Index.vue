<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-2">
                        <h5 class="card-title">Todas las tareas</h5>
                        <div>
                            <!-- <router-link :to="{name: 'recetasAdmin.Create'}" class="btn btn-success">Nueva Tarea</router-link> -->
                        </div>
                    </div>
                    {{ recetas }}
                    <table class="table table-hover table-sm">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th width="50" class="text-center">#</th>
                                <th>Nombre</th>
                                <th>Raciones</th>
                                <th>Tiempo de preparación</th>
                                <th>Categoria</th>
                                <th class="text-center" width="200">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(receta, index) in recetas">
                                <td class="text-center">{{receta.id}}</td>
                                <td>{{receta.nombre}}</td>
                                <td>{{receta.raciones}}</td>
                                <td>{{receta.tiempo_preparacion}}</td>
                                <th>{{receta.categoria_id }}</th>
                                <!-- <td class="text-center">
                                    <router-link :to="{name: 'tasks.update', params: {id:receta.id}}" class="btn btn-warning mr-1">Edit</router-link>
                                    <button class="btn btn-danger" @click="deleteTask(receta.id, index)">Delete</button>
                                </td> -->
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
    import axios from "axios";
    import {ref, onMounted} from "vue";

    const recetas = ref();

    onMounted(()=>{
        axios.get('api/recetas')
        .then(response =>{
            recetas.value = response.data;
            console.log(response); 
        })
    });
    
</script>