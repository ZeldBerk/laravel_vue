<template>
    <div class="grid">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between pb-2 mb-2">
                        <h5 class="card-title">Todos los comentarios</h5>
                        <div>
                            <router-link :to="{ name: 'comentAdmin.create' }" class="btn btn-success">Nuevo
                                Comentario</router-link>
                        </div>
                    </div>

                    <table class="table table-hover table-sm">
                        <thead class="bg-dark text-light">
                            <tr>
                                <th width="50" class="text-center">#</th>
                                <th>Usuario</th>
                                <th>Receta</th>
                                <th>Comentario</th>
                                <th>Valoración</th>
                                <th class="text-center" width="200">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(comentario, index) in comentList">
                                <td class="text-center">{{comentario.id}}</td>
                                <td>{{comentario.name}}</td>
                                <td>{{comentario.nombre}}</td>
                                <td>{{comentario.contenido}}</td>
                                <td>{{comentario.puntuacion }}</td>
                                <td class="text-center">
                                    <router-link :to="{name: 'comentAdmin.update', params: {id:comentario.id}}" class="btn btn-warning mr-1">Edit</router-link>
                                    <button class="btn btn-danger" @click="deleteReceta(comentario.id, index)">Delete</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, inject } from "vue";

const swal = inject('$swal');
const comentList = ref([]);

// Obtener todo los comentraios de la receta
onMounted(() => {
    axios.get('/api/comentarios')
        .then(response => {
            comentList.value = response.data;
        });
});
</script>