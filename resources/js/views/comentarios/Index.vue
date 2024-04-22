<template>
    <div id="recetas" class="container">
        <h1>Comentarios</h1>
        <div class="row mb-3">
            <div class="col-md-6">
                <p>Filtro de los comentarios</p>
            </div>
            <div class="col-md-6 text-right">
                <router-link :to="{ name: 'comentarios.create', params: {id: receta_id}}" class="btn btn-success">Dejar Comentario</router-link>
            </div>
        </div>
        <!-- <Rating v-model="comentario.value.puntuacion" :cancel="false" :stars="5" /> -->
        <div class="row">
            <div class="col-md-4 mb-3" v-for="comentario in comentarioSH">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h5 class="card-title">{{ comentario.name }}</h5>
                            </div>
                            <div class="col-6 d-flex justify-content-end">
                                <span v-for="star in 5">
                                    <span v-if="star <= comentario.puntuacion">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            xmlns:serif="http://www.serif.com/" width="20px" height="20px"
                                            viewBox="0 0 800 800" version="1.1" xml:space="preserve"
                                            style="fill-rule:evenodd;clip-rule:evenodd;">
                                            <path
                                                d="M305.105,180.279C347.327,104.538 368.437,66.667 400,66.667C431.563,66.667 452.673,104.537 494.893,180.279L505.817,199.874C517.817,221.398 523.813,232.16 533.17,239.26C542.523,246.361 554.17,248.997 577.47,254.268L598.683,259.068C680.67,277.619 721.667,286.894 731.42,318.258C741.173,349.62 713.227,382.303 657.33,447.663L642.87,464.573C626.987,483.147 619.043,492.433 615.47,503.923C611.9,515.413 613.1,527.803 615.5,552.587L617.687,575.147C626.137,662.353 630.363,705.957 604.83,725.34C579.293,744.723 540.91,727.05 464.143,691.707L444.283,682.56C422.47,672.517 411.563,667.493 400,667.493C388.437,667.493 377.53,672.517 355.717,682.56L335.857,691.707C259.089,727.05 220.706,744.723 195.172,725.34C169.637,705.957 173.863,662.353 182.313,575.147L184.499,552.587C186.901,527.803 188.102,515.413 184.529,503.923C180.956,492.433 173.014,483.147 157.131,464.573L142.67,447.663C86.775,382.303 58.827,349.62 68.581,318.258C78.334,286.894 119.329,277.619 201.318,259.068L222.53,254.268C245.828,248.997 257.478,246.361 266.831,239.26C276.185,232.16 282.184,221.398 294.182,199.874L305.105,180.279Z"
                                                style="fill:rgb(245,158,11);stroke:rgb(245,158,11);stroke-width:50px;" />
                                        </svg>
                                    </span>
                                    <span v-else>
                                        <svg width="20px" height="20px" viewBox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" stroke="#F59E0B">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round"></g>
                                            <g id="SVGRepo_iconCarrier">
                                                <path
                                                    d="M9.15316 5.40838C10.4198 3.13613 11.0531 2 12 2C12.9469 2 13.5802 3.13612 14.8468 5.40837L15.1745 5.99623C15.5345 6.64193 15.7144 6.96479 15.9951 7.17781C16.2757 7.39083 16.6251 7.4699 17.3241 7.62805L17.9605 7.77203C20.4201 8.32856 21.65 8.60682 21.9426 9.54773C22.2352 10.4886 21.3968 11.4691 19.7199 13.4299L19.2861 13.9372C18.8096 14.4944 18.5713 14.773 18.4641 15.1177C18.357 15.4624 18.393 15.8341 18.465 16.5776L18.5306 17.2544C18.7841 19.8706 18.9109 21.1787 18.1449 21.7602C17.3788 22.3417 16.2273 21.8115 13.9243 20.7512L13.3285 20.4768C12.6741 20.1755 12.3469 20.0248 12 20.0248C11.6531 20.0248 11.3259 20.1755 10.6715 20.4768L10.0757 20.7512C7.77268 21.8115 6.62118 22.3417 5.85515 21.7602C5.08912 21.1787 5.21588 19.8706 5.4694 17.2544L5.53498 16.5776C5.60703 15.8341 5.64305 15.4624 5.53586 15.1177C5.42868 14.773 5.19043 14.4944 4.71392 13.9372L4.2801 13.4299C2.60325 11.4691 1.76482 10.4886 2.05742 9.54773C2.35002 8.60682 3.57986 8.32856 6.03954 7.77203L6.67589 7.62805C7.37485 7.4699 7.72433 7.39083 8.00494 7.17781C8.28555 6.96479 8.46553 6.64194 8.82547 5.99623L9.15316 5.40838Z"
                                                    stroke="#F59E0B" stroke-width="1.6799999999999997"></path>
                                            </g>
                                        </svg>
                                    </span>
                                </span>
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
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";
import Rating from 'primevue/rating'; // Importa el componente Rating de PrimeVue

const comentarioSH = ref([]);
const route = useRoute();

// Obtener id de la receta
const receta_id = route.params.id;

// Obtener todo los comentraios de la receta
onMounted(() => {
    axios.get('/api/comentarios/' + receta_id)
        .then(response => {
            comentarioSH.value = response.data;
        });
});

</script>