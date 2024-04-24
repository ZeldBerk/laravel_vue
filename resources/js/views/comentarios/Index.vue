<template>
    <div id="recetas" class="container">
        <h1>Comentarios</h1>
        <div class="row mb-3">
            <div class="col-md-6">
                <p>Filtro de los comentarios</p>
                <div class="col-md-6">
    <p>Filtro de los comentarios</p>
    <select v-model="filtroPuntuacion" class="form-select">
        <option value="">Todos</option>
        <option v-for="estrella in estrellas" :value="estrella">{{ estrella }} estrellas</option>
    </select>
</div>
            </div>
            <div class="col-md-6 text-right">
                <router-link :to="{ name: 'comentarios.create', params: {id: receta_id}}" class="btn btn-success">Dejar Comentario</router-link>
            </div>
        </div>
        <!-- <Rating v-model="comentario.value.puntuacion" :cancel="false" :stars="5" /> -->
        <div class="row">
    <div class="col-md-4 mb-3" v-for="comentario in comentariosFiltrados" :key="comentario.id">
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
import { ref, onMounted, computed } from "vue";
import { useRoute } from "vue-router";
import Rating from 'primevue/rating'; // Importa el componente Rating de PrimeVue

const comentarioSH = ref([]);
const route = useRoute();

// Obtener id de la receta
const receta_id = route.params.id;

// Filtro de estrellas
const filtroPuntuacion = ref('');

// Array de estrellas para el filtro
const estrellas = [1, 2, 3, 4, 5];

// Obtener todo los comentarios de la receta
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