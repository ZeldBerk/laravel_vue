<template>
    <div>
      <h2>Recetas Favoritas</h2>
      <ul>
        <li v-for="receta in recetas" :key="receta.id">
          {{ favoritos.nombre }}
        </li>
      </ul>
    </div>

    <div class="row mb-3">
      <div class="col-md-6">
        <form action="#">
          <label for="filtro">Filtrar:</label>
          <input type="text" id="filtro" name="filtro" class="form-control">
        </form>

        <div class="row">
            <div class="col-md-4 mb-3" v-for="receta in recetas">
            <div class="card">
                <img :src="receta.imagen" class="card-img-top" alt="Imagen de la receta">
                <div class="card-body">
                <h5 class="card-title">{{ receta.nombre }}</h5>
                <p class="card-text">{{ receta.descripcion }}</p>
                </div>
            </div>
            </div>
        </div>
      </div>
    </div>
  </template>
  
  <script>
    import axios from "axios";
    import { ref, onMounted } from "vue";

    const userId = 

    const recetas = ref();

    onMounted(() => {
        axios.get(`api/favoritos/${userId}`)
            .then(response => {
                recetas.value = response.data;
            })
            .catch(error => {
                console.error("Error al obtener recetas favoritas:", error);
            });
    });

  </script>
  
  <style scoped>

  </style>
  