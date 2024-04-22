<template>
    <div id="recetas" class="container">
        <h1>Comentarios</h1>
        <div class="row mb-3">
            <div class="col-md-6">
                <p>Filtro de los comentarios</p>
            </div>
            <div class="col-md-6 text-right">
                <router-link :to="{ name: 'comentarios.create', params: {id: receta_id}}" class="btn btn-success">Dejar Comentario</router-link>
            </div>
        </div>
        <!-- <Rating v-model="comentario.value.puntuacion" :cancel="false" :stars="5" /> -->
        <div class="row">
            <div class="col-md-4 mb-3" v-for="comentario in comentarioSH">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">{{ comentario.name }}</h5>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <Rating v-model="comentario.puntuacion" readonly :cancel="false" />
                            </div>
                        </div>
                        <p class="card-text">{{ comentario.contenido }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import Rating from 'primevue/rating'; // Importa el componente Rating de PrimeVue

const comentarioSH = ref([]);
const route = useRoute();

// Obtener id de la receta
const receta_id = route.params.id;

// Obtener todo los comentraios de la receta
onMounted(() => {
    axios.get('/api/comentarios/' + receta_id)
        .then(response => {
            comentarioSH.value = response.data;
        });
});

</script>