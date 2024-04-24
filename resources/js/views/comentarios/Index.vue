<template>
    <div id="recetas" class="container mt-4">
        <h1>Comentarios</h1>
        <div class="row mb-4">
            <div class="col-md-6">
                <p>Filtro de los comentarios</p>
                <div class="col-md-6">
                    <div v-for="estrella in estrellas" :key="estrella">
                        <Rating :value="estrella" :cancel="false" v-model="filtroPuntuacion"></Rating>
                    </div>
                </div>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-end">
                <router-link :to="{ name: 'comentarios.create', params: { id: receta_id } }" class="btn colorBoton">Dejar Comentario</router-link>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 mb-3" v-for="comentario in comentariosFiltrados" :key="comentario.id">
                <div class="card comentarioCard">
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
import { ref, onMounted, computed } from "vue";
import { useRoute } from "vue-router";
import Rating from 'primevue/rating'; // Importa el componente Rating de PrimeVue

const comentarioSH = ref([]);
const route = useRoute();

// Obtener id de la receta
const receta_id = route.params.id;

// Filtro de puntuación
const filtroPuntuacion = ref(null);

// Array de estrellas para el filtro
const estrellas = [1, 2, 3, 4, 5];

// Obtener todos los comentarios de la receta
onMounted(() => {
    axios.get('/api/comentarios/' + receta_id)
        .then(response => {
            comentarioSH.value = response.data;
        });
});

// Computed property para filtrar los comentarios basados en el filtro de estrellas
const comentariosFiltrados = computed(() => {
    if (!filtroPuntuacion.value) {
        return comentarioSH.value;
    }

    return comentarioSH.value.filter(comentario => comentario.puntuacion === filtroPuntuacion.value);
});
</script>
