<template>
    <div id="recetas" class="container">
        <div class="d-flex justify-content-between pb-2 mb-2">
            <h5 class="card-title">Añade una nueva receta</h5>
        </div>
        <form @submit.prevent="addReceta">
            <div class="row my-5">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <!-- Nombre receta -->
                            <div class="mb-3">
                                <label for="receta_nombre" class="form-label">Nombre de la receta:</label>
                                <input v-model="receta.nombre" id="receta_nombre" type="text" class="form-control">
                            </div>
                            <!-- Contenido receta -->
                            <div class="mb-3">
                                <label for="receta_descripcion" class="form-label">Pasos de la receta</label>
                                <TextEditorComponent v-model="receta.descripcion" />
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 mb-4">Añadir receta</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <!-- Raciones receta -->
                            <div class="mb-3">
                                <label for="receta_raciones" class="form-label">Raciones</label>
                                <input v-model="receta.raciones" id="receta_raciones" type="number" min="1" class="form-control">
                            </div>
                            <!-- Tiempo receta -->
                            <div class="mb-3">
                                <label for="receta_tiempo_preparacion" class="form-label">Tiempo de preparación</label>
                                <input v-model="receta.tiempo_preparacion" id="receta_tiempo_preparacion" type="number" min="1" class="form-control">
                            </div>
                            <!-- Categoria receta -->
                            <div class="mb-3">
                                <label for="receta_categoria_id" class="form-label">Selecciona la categoría</label>
                                <select v-model="receta.categoria_id" id="receta_categoria_id" class="form-control"></select>
                            </div>
                            <!-- Imagen receta -->
                            <div class="mb-3">
                                <label for="receta_ruta_imagen" class="form-label">Imagen</label>
                                <input v-model="receta.ruta_imagen" id="receta_ruta_imagen" type="text" class="form-control">
                            </div>
                            <!-- User receta -->
                            <div class="mb-3">
                                <label for="receta_user_id" class="form-label">User_id = 1</label>
                                <input v-model="receta.user_id" id="receta_user_id" type="number" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>


<script setup>
import { ref, inject , onMounted } from "vue";
import { useRouter } from 'vue-router';
import TextEditorComponent from "@/components/TextEditorComponent.vue";

const categorias = ref();
const receta = ref({});
const swal = inject('$swal');
const router = useRouter()

// Carga de las categorias en el desplegable
onMounted(() => {
    axios.get('/api/categorias')
    .then(response => {
        categorias.value = response.data;
        // Agregar una opción vacía al principio
        const emptyOption = document.createElement('option');
        emptyOption.value = '';
        emptyOption.textContent = '';
        document.getElementById('receta_categoria_id').appendChild(emptyOption);

        categorias.value.forEach(categoria => {
            const option = document.createElement('option');
            option.value = categoria.id;
            option.textContent = categoria.nombre;
            document.getElementById('receta_categoria_id').appendChild(option);
        });
    });
});

// Añade la receta y muestra una alerta en funcion de la respuesta de la api
function addReceta() {

    axios.post('/api/recetas', receta.value)
        .then(response => {
            swal({
                icon: 'success',
                title: 'Receta añadida correctamente'
            })
            .then(() => {
                // Redireccionar a la página después de cerrar la alerta
                router.push({name: 'recetas.index'})
            });
        })
        .catch(error => {
            swal({
                icon: 'error',
                title: 'No se ha añadido la receta'
            });
        });
}

</script>