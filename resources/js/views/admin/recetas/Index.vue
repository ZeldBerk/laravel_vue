<template>
    <div class="contenedorAdmins">
        <div class="grid">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between pb-2 mb-2">
                            <h5 class="card-title">Todas las tareas</h5>
                            <div>
                                <router-link :to="{ name: 'recetasAdmin.create' }" class="btn colorBoton">Nueva
                                    Receta</router-link>
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
                                <tr v-for="(receta, index) in recetas">
                                    <td class="text-center">{{ receta.id }}</td>
                                    <td>{{ receta.nombre }}</td>
                                    <td>{{ receta.raciones }}</td>
                                    <td>{{ receta.tiempo_preparacion }}</td>
                                    <th>{{ receta.categoria_id }}</th>
                                    <td class="text-center">
                                        <router-link :to="{ name: 'recetasAdmin.update', params: { id: receta.id } }"
                                            class="btn btn-warning mr-1">Edit</router-link>
                                        <button class="btn btn-danger"
                                            @click="deleteReceta(receta.id, index)">Delete</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</template>

<script setup>
import { ref, onMounted, inject } from "vue";

const recetas = ref();
const swal = inject('$swal');

// Obtener id de usuario
const data = localStorage.getItem("vuex");
const user_id = JSON.parse(data).auth.user.id;

onMounted(() => {
    axios.get('/api/recetas/RU/' + user_id)
        .then(response => {
            recetas.value = response.data;
        })
});

const deleteReceta = (id, index) => {

    swal({
        title: 'Quieres eliminar la receta?',
        text: 'Esta acción no es reversible!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        confirmButtonColor: '#ef4444',
        timer: 20000,
        timerProgressBar: true,
        reverseButtons: true
    })
        .then(result => {
            if (result.isConfirmed) {
                axios.delete('/api/recetas/' + id)
                    .then(response => {
                        recetas.value.splice(index, 1);
                        swal({
                            icon: 'success',
                            title: 'Receta eliminada correctamente'
                        });
                    })
                    .catch(error => {
                        swal({
                            icon: 'error',
                            title: 'No se ha podido eliminar la receta'
                        });
                    });
            }
        })
}

</script>
<style>
.btn-warning{
    border-radius: 0;
}
.btn-danger{
    border-radius: 0;
}
</style>