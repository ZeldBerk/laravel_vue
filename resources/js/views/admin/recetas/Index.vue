<template>
    <div class="contenedorAdmins">
        <div class="grid">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-sm-12 col-md-4">
                                <h5 class="card-title mt-2">Todas las tareas</h5>
                            </div>
                            <div
                                class="col-sm-12 col-md-4 d-flex align-items-center justify-content-center justify-content-md-start mt-2">
                                <form action="#" class="w-100">
                                    <div class="d-flex">
                                        <label for="filtro" class="mr-2 d-flex align-items-center">Filtrar:</label>
                                        <input type="text" id="filtro" name="filtro" class="form-control"
                                            v-model="filtro">
                                    </div>
                                </form>
                            </div>
                            <div
                                class="col-sm-12 col-md-4 d-flex align-items-center justify-content-right justify-content-md-end mt-2">
                                <router-link :to="{ name: 'recetasAdmin.create' }" class="btn colorBoton">Nueva
                                    Receta</router-link>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-hover table-sm">
                                <thead class="bg-dark text-light">
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th>Nombre</th>
                                        <th>Raciones</th>
                                        <th>Tiempo de preparación</th>
                                        <th>Categoria</th>
                                        <th class="text-center" width="200">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(receta, index) in recetas" :key="receta.id">
                                        <td class="text-center">{{ receta.id }}</td>
                                        <td>{{ receta.nombre }}</td>
                                        <td>{{ receta.raciones }}</td>
                                        <td>{{ receta.tiempo_preparacion }}</td>
                                        <td>{{ receta.categoria_id }}</td>
                                        <td class="text-center">
                                            <router-link
                                                :to="{ name: 'recetasAdmin.update', params: { id: receta.id } }"
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
    </div>
</template>

<script setup>
import { ref, onMounted, inject, watch } from "vue";

const recetas = ref();
const swal = inject('$swal');
const filtro = ref('');

// Obtener id de usuario
const data = localStorage.getItem("vuex");
const user_id = JSON.parse(data).auth.user.id;

onMounted(() => {
    cargarRecetas();
});

watch(filtro, (newValue, oldValue) => {
    cargarRecetas(newValue);
})

const cargarRecetas = (filtro = '') => {

    let url = `/api/recetas/RU/${user_id}`;



    if (filtro) {
        url += `?filtro=${filtro}`;
    }

    axios.get(url)
        .then(response => {
            recetas.value = response.data;
        })
        .catch(error => {
            console.error(error);
        });
}

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
.btn-warning {
    border-radius: 0;
}

.btn-danger {
    border-radius: 0;
}
</style>