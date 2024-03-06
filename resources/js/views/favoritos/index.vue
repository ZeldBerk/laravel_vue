<template>
<div id="favoritos" class="container">
  <h1>Mis recetas Favoritas</h1>

  <div class="row">
    <div class="col-md-4 mb-3" v-for="favorito in favoritos">
      <div class="card">
        <img class="card-img-top" alt="Imagen de la receta">
        <div class="card-body">
          <h5 class="card-title">{{ favorito.nombre }}</h5>
          <p class="card-text">{{ favorito.descripcion }}</p>
          <button class="btn" @click="eliminarFavoritos(favorito.id)">Eliminar</button>
        </div>
      </div>

    </div>
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




