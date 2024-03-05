<template>
  <div class="receta-card">
    <div class="receta-imagen">
      <img :src="receta.ruta_imagen" alt="Imagen de la receta">
    </div>
    <div class="receta-info">
      <h2>{{ receta.nombre }}</h2>
      <p class="meta">
        <span>{{ receta.raciones }} personas</span> - <span>{{ receta.tiempo_preparacion }} min</span>
      </p>
      <p class="descripcion">{{ receta.descripcion_corta }}</p>
      <button class="boton-favorito" @click="toggleFavorito">
        <i class="fas fa-heart" :class="{ 'activo': receta.favorito }"></i>
      </button>
    </div>
  </div>
</template>


<script>
import axios from "axios";
import { ref, onMounted } from "vue";

export default {
  setup() {
    const data = localStorage.getItem("vuex");
    let userId = null; 

    if (data) {
      try {
        userId = JSON.parse(data).auth.user.id;
        console.log("ID del usuario:", userId);
      } catch (error) {
        console.error("Error parsing localStorage data:", error);
        
      }
    } else {
      console.log("No hay usuario autenticado en el localStorage");
    }

    const favoritos = ref([]);

    onMounted(async () => {
      if (userId) {
        await axios.get(`/api/favoritos/${userId}`)
        .then(response =>{
          favoritos.value = response.data;  
        });
        
        console.log(favoritos.value);
      }
    });

    return { favoritos };
  },
};
</script>




