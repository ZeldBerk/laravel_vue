<template>
    <div id="actualizar-comentario" class="container">
        <div class="d-flex justify-content-between pb-2 mb-2">
            <h5 class="card-title">Nuevo Comentario</h5>
        </div>
        <div class="row">
            
            <div class="col-8">
                <form @submit.prevent="saveComent">
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
                                <textarea v-model="comentario.contenido" id="comentario_texto" class="form-control"
                                    rows="4"></textarea>
                            </div>
                            <!-- <button type="submit" class="btn btn-primary mt-4 mb-4">Guardar Comentario</button> -->
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-4 mb-3">
                <div class="cardBorderIMG">
                    <div class="contenidoCard">
                        <div class="cardImageDIV position-relative">
                            <div class="cardImage"
                                :style="{ 'background-image': `url(${receta.media[0]?.original_url})` }">
                            </div>
                        </div>
                        <div class="cuerpoCarta">
                            <div class="row ml-2 align-items-center">
                                <h5 class="col-10 tituloCard">{{ receta.nombre }}</h5>
                            </div>
                            <p class="texto ml-2">{{ receta.descripcion_corta }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onBeforeMount, inject } from "vue";
import { useRoute } from "vue-router";
import { useRouter } from 'vue-router';
import Rating from 'primevue/rating'; // Importa el componente Rating de PrimeVue

const comentario = ref({});
const receta = ref({});
const swal = inject('$swal');
const route = useRoute();
const router = useRouter();

console.log(route.params.id)
onBeforeMount(() => {
    axios.get('/api/recetas/' + route.params.id)
        .then(response => {
            console.log(response.data)
            receta.value = response.data;
        })
});

</script>
