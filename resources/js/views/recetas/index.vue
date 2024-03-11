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
              <div class="con-like" @click.stop="anadirFavoritos(receta.id)">
                <input
                  class="like like-{{ receta.id }}"
                  type="checkbox"
                  title="like"
                  :checked="favoritos.some(fav => fav.receta_id === receta.id)"
                >
                <div class="checkmark">
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </template>
  

  <script setup>
  import axios from "axios";
  import { ref, onMounted, computed } from "vue";
  import { useRouter } from "vue-router";
  
  const recetas = ref([]);
  const favoritos = ref([]); // Array of favorite objects (including receta_id)
  const router = useRouter();
  
  onMounted(async () => {
    try {
      const recetasResponse = await axios.get('api/recetas');
      recetas.value = recetasResponse.data;
  
      const favoritosResponse = await axios.get('api/favoritos'); // Assuming API endpoint for fetching favorites
      favoritos.value = favoritosResponse.data; // Update favorites data on mount
    } catch (error) {
      console.error("Error:", error);
    }
  });
  
  function detallesReceta(id) {
    router.push({ name: 'recetas.detalle', params: { id } });
  }
  
  function anadirFavoritos(recetaId) {
    const data = localStorage.getItem("vuex"); // Consider using a state management solution like Vuex for user data
    let userId = null;
  
    if (data) {
      try {
        userId = JSON.parse(data).auth.user.id;
      } catch (error) {
        console.error("Error al analizar los datos del localStorage:", error);
      }
    } else {
      console.log("No hay usuario autenticado en el localStorage");
    }
  
    if (userId) {
      // Handle adding/removing favorite using API calls and updating UI
      axios.post('api/favoritos/', {
        user_id: userId,
        receta_id: recetaId
      })
      .then(response => {
        console.log(response.data);
  
        // Update favorites data in the state based on API response
        const isFavorite = favoritos.value.some(fav => fav.receta_id === recetaId);
        if (isFavorite) {
          // Remove from favorites
          favoritos.value = favoritos.value.filter(fav => fav.receta_id !== recetaId);
        } else {
          // Add to favorites
          favoritos.value.push({ receta_id, user_id }); // Assuming response includes user_id
        }
      });
    } else {
      console.log("Usuario no autenticado. No se puede añadir a favoritos.");
    }
  



<style scoped>
/* Añade estilo al cursor al pasar por encima de la carta */
.cursor_pointer {
  cursor: pointer;
}
</style>