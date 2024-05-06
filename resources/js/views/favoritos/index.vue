<template>
    <div id="favoritos" class="container">
        <h1>Mis recetas Favoritas</h1>

        <div class="row">
            <div class="col-md-12 col-lg-4 mb-3" v-for="favorito in favoritos" :key="favorito.id">
                <div class="cursor_pointer cardBorderIMG" @click.stop="detallesReceta(favorito.id)">
                    <div class="contenidoCard cursor_pointer">
                        <div class="cardImageDIV -relative">
                            <div class="position-absolute top-0 end-0 pr-2 pt-2 mr-2">
                                <div class="mi-con-like" @click.stop="eliminarFavoritos(favorito.id)">
                                    <input class="mi-like" checked type="checkbox" title="like">
                                    <div class="mi-checkmark">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mi-outline" viewBox="0 0 24 24">
                                            <path
                                                d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z">
                                            </path>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" class="mi-filled" viewBox="0 0 24 24">
                                            <path
                                                d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z">
                                            </path>
                                        </svg>
                                        <svg xmlns="http://www.w3.org/2000/svg" height="100" width="100"
                                            class="mi-celebrate">
                                            <polygon class="mi-poly" points="10,10 20,20"></polygon>
                                            <polygon class="mi-poly" points="10,50 20,50"></polygon>
                                            <polygon class="mi-poly" points="20,80 30,70"></polygon>
                                            <polygon class="mi-poly" points="90,10 80,20"></polygon>
                                            <polygon class="mi-poly" points="90,50 80,50"></polygon>
                                            <polygon class="mi-poly" points="80,80 70,70"></polygon>
                                        </svg>
                                    </div>
                                </div>
                            </div>
                            <div class="cardImage"
                                :style="{ 'background-image': `url(${favorito.media[0]?.original_url})` }">
                            </div>
                        </div>
                        <div class="cuerpoCarta">
                            <div class="row ml-2 align-items-center">
                                <h5 class="col-10 tituloCard">{{ favorito.nombre }}</h5>
                            </div>
                            <p class="texto ml-2">{{ favorito.descripcion }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>

</template>

<script setup>
import axios from "axios";
import { ref, onBeforeMount } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();

// Obtener id de usuario
const data = localStorage.getItem("vuex");
let userId = JSON.parse(data).auth.user.id;


const favoritos = ref({});

onBeforeMount(() => {

    axios.get('/api/favoritos/' + userId)
        .then(response => {
            console.log(response.data)
            favoritos.value = response.data;
        })
});

function eliminarFavoritos(receta_id) {
    if (!userId) {
        console.error("No user ID found for removing favorites");
        return;
    }

    axios.delete(`/api/favoritos/${receta_id}`, {
        user_id: userId,
    })
        .then(response => {
            console.log(response.data);
            window.location.reload()
        })
        .catch(error => {
            console.error("Error deleting favorite:", error);
        });
}

function detallesReceta(id) {
    router.push({ name: 'recetas.detalle', params: { id } });
}
</script>
