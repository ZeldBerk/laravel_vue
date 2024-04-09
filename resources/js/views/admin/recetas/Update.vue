<template>
    <div id="recetas" class="container">
        <div class="d-flex justify-content-between pb-2 mb-2">
            <h5 class="card-title">Añade una nueva receta</h5>
        </div>
        <form @submit.prevent="saveReceta">
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
                            <button type="submit" class="btn btn-primary mt-4 mb-4">Actualizar receta</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <!-- Raciones receta -->
                            <div class="mb-3">
                                <label for="receta_raciones" class="form-label">Raciones</label>
                                <input v-model="receta.raciones" id="receta_raciones" type="number" min="1"
                                    class="form-control">
                            </div>
                            <!-- Tiempo receta -->
                            <div class="mb-3">
                                <label for="receta_tiempo_preparacion" class="form-label">Tiempo de preparación</label>
                                <input v-model="receta.tiempo_preparacion" id="receta_tiempo_preparacion" type="number"
                                    min="1" class="form-control">
                            </div>
                            <!-- Categoria receta -->
                            <div class="mb-3">
                                <label for="receta_categoria_id" class="form-label">Selecciona la categoría</label>
                                <Dropdown v-model="receta.categoria_id" id="receta_categoria_id" :options="categorias"
                                    optionValue="id" optionLabel="nombre" placeholder="Selecciona la categoria"
                                    checkmark class="w-100" />
                            </div>
                            <!-- Imagen receta -->
                            <div class="mb-3">
                                <label for="imagen" class="form-label">Imagen</label>
                                <DropZone v-model="receta.thumbnail" id="imagen" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref, onMounted, reactive, inject } from "vue";
import { useForm, useField } from "vee-validate";
import { useRoute } from "vue-router";
import { useRouter } from 'vue-router';
import * as yup from 'yup';
import { es } from 'yup-locales';
import { setLocale } from 'yup';
import DropZone from "@/components/DropZone.vue";
import TextEditorComponent from "@/components/TextEditorComponent.vue";

const schema = yup.object({
    nombre: yup.string().required().label('Nombre'),
})

const router = useRouter()
const { validate, errors } = useForm({ validationSchema: schema })
const route = useRoute()
const swal = inject('$swal');
const categorias = ref();

setLocale(es);

const { value: nombre } = useField('nombre', null, { initialValue: '' });
const { value: descripcion } = useField('descripcion', null, { initialValue: '' });
const { value: raciones } = useField('raciones', null, { initialValue: '' });
const { value: tiempo_preparacion } = useField('tiempo_preparacion', null, { initialValue: '' });
const { value: user_id } = useField('user_id', null, { initialValue: '' });
const { value: categoria_id } = useField('categoria_id', null, { initialValue: '' });

const receta = reactive({
    nombre,
    descripcion,
    raciones,
    tiempo_preparacion,
    user_id,
    categoria_id
})

// Carga de las categorias en el desplegable
onMounted(() => {
    axios.get('/api/categorias')
        .then(response => {
            categorias.value = response.data;
        });
});

// Mostrar los datos actuales de la receta
onMounted(() => {
    axios.get('/api/recetas/' + route.params.id)
        .then(response => {
            receta.nombre = response.data.nombre;
            receta.descripcion = response.data.descripcion;
            receta.raciones = response.data.raciones;
            receta.tiempo_preparacion = response.data.tiempo_preparacion;
            receta.user_id = response.data.user_id;
            receta.categoria_id = response.data.categoria_id;
            receta.thumbnail = response.data.media[0].original_url;
        })
        .catch(function (error) {
            console.log(error);
        });
})


function saveReceta() {

    validate().then(form => {
        console.log('validate');
        if (form.valid) {
            console.log(receta)

            let serialized = new FormData()
            for (let item in receta) {
                if (receta.hasOwnProperty(item)) {
                    serialized.append(item, receta[item])
                }
            }

            axios.post('/api/recetas/update/' + route.params.id, serialized, {
                headers: {
                    "content-type": "multipart/form-data"
                }
            })
                .then(response => {
                    swal({
                        icon: 'success',
                        title: 'Receta actualizada correctamente'
                    })
                        .then(() => {
                            router.push({ name: 'recetasAdmin.index' })
                        });
                })
                .catch(error => {
                    swal({
                        icon: 'error',
                        title: 'No se ha podido actualizar la receta'
                    });
                });


        }
    })
}
</script>