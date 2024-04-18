<template>
    <div id="actualizar-comentario" class="container">
        <div class="d-flex justify-content-between pb-2 mb-2">
            <h5 class="card-title">Actualizar Comentario</h5>
        </div>
        <form @submit.prevent="saveComent">
            <div class="row my-5">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <!-- Valoración -->
                            <div class="mb-3">
                                <label for="comentario_valoracion" class="form-label">Valoración</label>
                                <Rating v-model="comentario.puntuacion" :cancel="false" />
                            </div>
                            <!-- Texto del Comentario -->
                            <div class="mb-3">
                                <label for="comentario_texto" class="form-label">Texto del Comentario</label>
                                <TextEditorComponent v-model="comentario.contenido" id="comentario_texto"
                                    class="form-control" rows="4"></TextEditorComponent>
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 mb-4">Actualizar Comentario</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>


<script setup>
import { ref, onMounted, inject, reactive } from "vue";
import { useForm, useField } from "vee-validate";
import { useRoute } from "vue-router";
import { useRouter } from 'vue-router';
import * as yup from 'yup';
import Rating from 'primevue/rating'; // Importa el componente Rating de PrimeVue
import TextEditorComponent from "@/components/TextEditorComponent.vue";
import axios from "axios";

const schema = yup.object({
    contenido: yup.string().required().label('Contenido'),
    puntuacion: yup.number().required().label('Puntuación'),
});

const { validate, errors } = useForm({ validationSchema: schema })
const swal = inject('$swal');
const route = useRoute();
const router = useRouter()

const { value: user_id } = useField('user_id', null, { initialValue: '' });
const { value: receta_id } = useField('receta_id', null, { initialValue: '' });
const { value: contenido } = useField('contenido', null, { initialValue: '' });
const { value: puntuacion } = useField('puntuacion', null, { initialValue: 0 });

const comentario = reactive({
    user_id,
    receta_id,
    contenido,
    puntuacion
})

// Obtener todo los comentraios de la receta
onMounted(() => {
    axios.get('/api/comentario/' + route.params.id)
        .then(response => {
            comentario.user_id = response.data.user_id;
            comentario.receta_id = response.data.receta_id;
            comentario.contenido = response.data.contenido;
            comentario.puntuacion = response.data.puntuacion;
        });
});

// Guarda los cambios del comentario
function saveComent() {
    // swal({
    //     title: 'Procesando...',
    //     text: 'Por favor, espera un momento.',
    //     allowOutsideClick: false,
    //     allowEscapeKey: false,
    //     showConfirmButton: false,
    //     showCancelButton: false,
    //     showCloseButton: false,
    //     onBeforeOpen: () => {
    //         swal.showLoading();
    //     }
    // });
    validate().then(form => {
        console.log("depuesde de validate y antes del if valid")
        if (form.valid) {
            console.log("despues del if valid y antes del axios")
            axios.put('/api/comentario/update/' + route.params.id, comentario)
                .then(response => {
                    // Cerrar la alerta de carga
                    // swal.close();

                    // Mostrar la alerta de éxito
                    swal({
                        icon: 'success',
                        title: 'Comentario actualizado correctamente'
                    })
                        .then(() => {
                            // Redireccionar a la página después de cerrar la alerta
                            router.push({ name: 'comentAdmin.index' });
                        });
                })
                .catch(error => {
                    // Cerrar la alerta de carga
                    // swal.close();

                    // Mostrar la alerta de error
                    swal({
                        icon: 'error',
                        title: 'No se ha podido actualizar el Comentario'
                    });
                })
        }
    });
}
</script>