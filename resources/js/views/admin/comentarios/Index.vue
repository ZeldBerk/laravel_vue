<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-2">
                        <h5 class="card-title">Todos los comentarios</h5>
                        <div>
                            <router-link :to="{name: 'recetasAdmin.create'}" class="btn btn-success">Nuevo Comentario</router-link>
                        </div>
                    </div>

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
                            <tr v-for="(comentario, index) in comentarios">
                                {{ comentario }}
                                <!-- <td class="text-center">{{receta.id}}</td>
                                <td>{{receta.nombre}}</td>
                                <td>{{receta.raciones}}</td>
                                <td>{{receta.tiempo_preparacion}}</td>
                                <th>{{receta.categoria_id }}</th>
                                <td class="text-center">
                                    <router-link :to="{name: 'recetasAdmin.update', params: {id:receta.id}}" class="btn btn-warning mr-1">Edit</router-link>
                                    <button class="btn btn-danger" @click="deleteReceta(receta.id, index)">Delete</button>
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
    import {ref, onMounted, inject} from "vue";

    
</script>