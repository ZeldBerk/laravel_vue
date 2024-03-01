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
            <router-link :to="{name: 'recetas.create'}" class="btn btn-primary">Añadir receta</router-link>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3" v-for="receta in recetas">
            <div class="card">
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
    import {ref, onMounted} from "vue";

    const recetas = ref();

    onMounted(()=>{
        axios.get('api/recetas')
        .then(response =>{
            recetas.value = response.data; 
        })
    });
    
</script>