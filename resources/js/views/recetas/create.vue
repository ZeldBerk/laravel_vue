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
                            {{ receta}}

                            <div class="mb-3">
                                {{ categorias }}
                                <label for="receta_categoria_id" class="form-label">Selecciona la categoría</label>
                                <Dropdown v-model="receta.categoria_id" :options="categorias" optionValue="id" optionLabel="nombre" placeholder="Select a City" checkmark  class="w-100"/>

                                <select v-model="receta.categoria_id" id="receta_categoria_id" class="form-control"></select>
                            </div>
                            <!-- Imagen receta -->
                            <div class="mb-3">
                                <label for="receta_ruta_imagen" class="form-label">Imagen</label>
                                <DropZone v-model="receta.thumbnail"/>
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
import DropZone from "@/components/DropZone.vue";

const categorias = ref();
const receta = ref({});
const swal = inject('$swal');
const router = useRouter()

// Obtener id de usuario
const data = localStorage.getItem("vuex");
const user_id = JSON.parse(data).auth.user.id;

receta.value.user_id = user_id;

// Carga de las categorias en el desplegable
onMounted(() => {
    axios.get('/api/categorias')
    .then(response => {
        categorias.value = response.data;
    });
});

// Añade la receta y muestra una alerta en funcion de la respuesta de la api hacer formdata
function addReceta() {
    let r = receta.value;
    let serializedReceta = new FormData()
    for (let item in r) {
        if(r.hasOwnProperty(item)){
            serializedReceta.append(item, r[item])
        }
    }

    axios.post('/api/recetas', serializedReceta, {
        headers: {
            "content-type": "multipart/form-data"
        }
    })
        .then(response => {
            swal({
                icon: 'success',
                title: 'Receta añadida correctamente'
            })
            .then(() => {
                // Redireccionar a la página después de cerrar la alerta
                //router.push({name: 'recetas.index'})
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