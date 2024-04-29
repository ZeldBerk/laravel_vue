<template>
    <div class="contenedorAdmins">
        <div class="grid">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between pb-2 mb-2">
                            <h5 class="card-title">Todos los ingredeientes</h5>
                            <div>
                                <button class="btn colorBoton" @click="addIngrediente">Añadir ingrediente</button>
                            </div>
                        </div>

                        <table class="table table-hover table-sm">
                            <thead class="bg-dark text-light">
                                <tr>
                                    <th width="50" class="text-center">#</th>
                                    <th>Nombre</th>
                                    <th class="text-center" width="200">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(ingrediente, index) in ingredientList">
                                    <td class="text-center">{{ ingrediente.id }}</td>
                                    <td>{{ ingrediente.nombre }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-warning mr-1"
                                            @click="editIngrediente(ingrediente.id, ingrediente.nombre, index)">Edit</button>
                                        <button class="btn btn-danger"
                                            @click="deleteIngrediente(ingrediente.id, index)">Delete</button>
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

const swal = inject('$swal');
const ingredientList = ref([]);
const ingredeinte = ref({}); // Añadir ingredeinte
const ingredeinteUpdate = ref({}); // Actualizar ingrediente

// Obtener todo los comentraios de la receta
onMounted(() => {
    axios.get('/api/ingredientes')
        .then(response => {
            ingredientList.value = response.data;
        });
});

function addIngrediente() {
    swal({
        title: 'Añadir Ingrediente',
        text: 'Introduce el nombre del nuevo ingrediente:',
        html: `
            <label class="form-label">Introduce el nuevo ingrediente:</label>
            <input id="nombre_ingrediente" type="text" class="form-control placeholder="Nombre del ingrediente">
            `,
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Añadir',
        didOpen: () => {
            // Aplicar clases de Bootstrap a los botones de la alerta
            const confirmButton = document.querySelector('.swal2-confirm');
            const cancelButton = document.querySelector('.swal2-cancel');
            confirmButton.classList.add('btn', 'btn-success');
            cancelButton.classList.add('btn', 'btn-danger');
            confirmButton.classList.remove('swal2-styled');
            cancelButton.classList.remove('swal2-styled');
        }
    }).then((result) => {
        if (result.isConfirmed) {
            // Recojemos el valor que el usuario quiere añadi
            const nombre_ingrediente = document.getElementById('nombre_ingrediente').value;

            // Guardamos el valor en ingredeinte
            ingredeinte.value.nombre = nombre_ingrediente;

            // Insert del ingredeiente
            axios.post('/api/ingredientes', ingredeinte.value)
                .then(response => {
                    swal({
                        icon: 'success',
                        title: 'Ingrediente añadido correctamente'
                    })
                        .then(() => {
                            axios.get('/api/ingredientes')
                                .then(response => {
                                    ingredientList.value = response.data;
                                });
                        });
                })
                .catch(error => {
                    swal({
                        icon: 'error',
                        title: 'No se ha añadido el ingrediente'
                    });
                });
        }
    });
}

function editIngrediente(id, nombreActual, index) {
    swal({
        title: 'Editar Ingrediente',
        text: 'Introduce el nuevo nombre para el ingrediente:',
        html: `
            <label class="form-label">Nombre actual:</label>
            <input id="nombre_ingrediente" type="text" class="form-control" value="${nombreActual}">
            `,
        showCancelButton: true,
        cancelButtonText: 'Cancelar',
        confirmButtonText: 'Guardar',
        didOpen: () => {
            // Aplicar clases de Bootstrap a los botones de la alerta
            const confirmButton = document.querySelector('.swal2-confirm');
            const cancelButton = document.querySelector('.swal2-cancel');
            confirmButton.classList.add('btn', 'btn-warning');
            cancelButton.classList.add('btn', 'btn-danger');
            confirmButton.classList.remove('swal2-styled');
            cancelButton.classList.remove('swal2-styled');
        }
    }).then((result) => {
        if (result.isConfirmed) {
            const nuevoNombre = document.getElementById('nombre_ingrediente').value;

            // Guardamos el valor en ingredeinte
            ingredeinteUpdate.value.nombre = nuevoNombre;

            axios.put('/api/ingredientes/update/' + id, ingredeinteUpdate.value)
                .then(response => {
                    swal({
                        icon: 'success',
                        title: 'Ingrediente actualizado correctamente'
                    })
                        .then(() => {
                            axios.get('/api/ingredientes')
                                .then(response => {
                                    ingredientList.value = response.data;
                                });
                        });
                })
                .catch(error => {
                    swal({
                        icon: 'error',
                        title: 'No se ha podido actualizar el ingrediente'
                    });
                });
        }
    });
}

const deleteIngrediente = (id, index) => {

    swal({
        title: 'Quieres eliminar el ingrediente?',
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
                axios.delete('/api/ingredientes/' + id)
                    .then(response => {
                        ingredientList.value.splice(index, 1);
                        swal({
                            icon: 'success',
                            title: 'Ingrediente eliminado correctamente'
                        });
                    })
                    .catch(error => {
                        swal({
                            icon: 'error',
                            title: 'No se ha podido eliminar el ingrediente'
                        });
                    });
            }
        })
}
</script>