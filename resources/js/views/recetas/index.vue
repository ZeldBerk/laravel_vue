<template>
    <div id="recetas" class="container">
        <h1>Recetas</h1>

        <div class="row mb-3">
            <div class="col-md-6">
                <form action="#">
                    <label for="filtro">Filtrar:</label>
                    <input type="text" id="filtro" name="filtro" class="form-control">
                </form>
            </div>
            <div class="col-md-6 text-right">
                <router-link :to="{ name: 'recetas.create' }" class="btn btn-primary">Añadir receta</router-link>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3" v-for="receta in recetas" :key="receta.id">
                <div class="card cursor_pointer" @click="detallesReceta(receta.id)"> 
                    <img :src="receta.imagen" class="card-img-top" alt="Imagen de la receta">
                    <div class="card-body">
                        <h5 class="card-title">{{ receta.nombre }}</h5>
                        <p class="card-text">{{ receta.descripcion }}</p>
                        <button class="btn btn-sm btn-outline-primary" @click="anadirFavoritos(receta)">Añadir a favoritos</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { ref, onMounted } from "vue";
import { useRouter } from "vue-router"; // Import the router

const recetas = ref([]); // Array to hold recipes
const router = useRouter(); // Instantiate the router object

onMounted(() => {
    axios.get('api/recetas')
        .then(response => {
            recetas.value = response.data;
        })
        .catch(error => {
            // Handle errors gracefully, e.g., display an error message
            console.error("Error fetching recipes:", error);
        });
});

function detallesReceta(id) {
    router.push({ name: 'recetas.detalle', params: {id:id} });
}
</script>

<style scoped>
/* Añade estilo al cursor al pasar por encima de la carta */
.cursor_pointer {
  cursor: pointer;
}
</style>