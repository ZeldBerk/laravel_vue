<template>
  <div class="container">
    <h1>Recetas Favoritas</h1>
    <ul v-if="favoritos.length">
      <li v-for="favorito in favoritos" :key="receta.id">
        <a :href="`/recetas/${receta.id}`">{{ receta.nombre }}</a>
      </li>
    </ul>
    <p v-else>No tienes recetas favoritas guardadas.</p>
  </div>
</template>

<script>
import axios from "axios";
import { ref, onMounted } from "vue";

const data = localStorage.getItem("vuex");

if (data) {
  const userId = JSON.parse(data).auth.user.id;
  console.log("ID del usuario:", userId);
} else {
  console.log("No hay usuario autenticado en el localStorage");
}

const favoritos = ref();

onMounted(()=>{
  axios.get('api/favoritos/',{userId})
  .then(response =>{
    favoritos.value = response.data;
  })
})

</script>

<style scoped>
  /* Opcional: agrega estilos personalizados para la lista de recetas favoritas */
</style>

