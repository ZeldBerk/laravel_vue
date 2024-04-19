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
                                <textarea  v-model="comentario.contenido" id="comentario_texto"
                                    class="form-control" rows="4"></textarea>
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
import { ref, inject } from "vue";
import { useRouter } from 'vue-router';
import Rating from 'primevue/rating'; // Importa el componente Rating de PrimeVue

const comentario = ref({})
const swal = inject('$swal');
const router = useRouter()
</script>
