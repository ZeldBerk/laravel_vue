<template>
    <div class="contenedorHOME">
        <div id="carouselExampleIndicators" class="carousel slide marginsDelCarrousel" data-bs-ride="carousel">
            
            

            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="../../../images/carrousel.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="../../../images/carrusel2.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../../../images/carrusel3.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../../../images/carruselopcional.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../../../images/carruselopcional2.png" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
            <div class="BotonCarrouselContainer">
                <RouterLink :to="{ name: 'recetas.index' }" class="BotonCarrousel d-flex justify-content-center">
                    <span class="mt-2">Recetario</span>
                </RouterLink>
            </div>

            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                    aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"
                    aria-label="Slide 5"></button>
            </div>
        </div>



        <div class="row justify-content-center marginCuadradoPulsables">
            <div class="col-md-4">
                <div class="button-wrapper">
                    <a href="#" class="button">
                        <img src="../../../images/sopa-de-pasta.jpg" alt="Botón 1">
                    </a>
                    <div class="button-text">
                        <span class="primeraLinea">¡Empieza con buen sabor!</span>
                        <span class="segundaLinea">Para abrir mesa</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="button-wrapper">
                    <a href="#" class="button">
                        <img src="../../../images/Pollo.jpg" alt="Botón 2">
                    </a>
                    <div class="button-text">
                        <span class="primeraLinea">¡Continua disfrutando!</span>
                        <span class="segundaLinea">Segundos platos</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="button-wrapper">
                    <a href="#" class="button">
                        <img src="../../../images/dolci_freddi_maggio.jpg" alt="Botón 3">
                    </a>
                    <div class="button-text">
                        <span class="primeraLinea">¡Final feliz!</span>
                        <span class="segundaLinea">Postres dulzones</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="containerLetras">
                    <span class="LetrasAzules">Sumérgete en el arte de la gastronomía en nuestro rincón
                        culinario.</span>
                    <span class="SegundoTexto mb-2">RECETAS TANTO DULCES COMO SALADAS</span>
                    <span class="TercerTexto">Platos que hemos visto siempre en casa, o los clásicos totalmente
                        renovados. Porque la cocina no deja de ser un juego. Un juego que nos hace disfrutar tanto en su
                        elaboración como después cuando nos sentamos a la mesa para compartir momentos únicos. Ya lo
                        sabemos todos, alrededor de una mesa es donde se toman las mejores decisiones. Donde nos
                        reunimos, discutimos, reímos, y nos emocionamos. Y porque a través de la comida transmitimos
                        nuestro cariño, nuestro amor… Y mucha felicidad.</span>
                </div>
            </div>
        </div>
        <div class="containerRecetasAbuela row">
            <div class="recetasAbuela col-6 col-md-3" v-for="receta in ultimasRecetas">
                <div class="imagenAbuela" @click.stop="detallesReceta(receta.id)">
                    <div class="imagenAbuelaTexto">
                        <img :src="`${receta.media[0]?.original_url}`" class="imgReceta mb-2">
                        <div class="texto mb-2">{{ receta.nombre }}</div>
                        <div class="con-like " @click.stop="anadirFavoritos(receta.id)">
                            <input class="like like-{{ receta.id }}" type="checkbox" title="like"
                                :checked="isFavorito(receta.id)">
                            <div class="checkmark">
                                <svg xmlns="http://www.w3.org/2000/svg" class="outline" viewBox="0 0 24 24">
                                    <path
                                        d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Zm-3.585,18.4a2.973,2.973,0,0,1-3.83,0C4.947,16.006,2,11.87,2,8.967a4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,11,8.967a1,1,0,0,0,2,0,4.8,4.8,0,0,1,4.5-5.05A4.8,4.8,0,0,1,22,8.967C22,11.87,19.053,16.006,13.915,20.313Z">
                                    </path>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" class="filled" viewBox="0 0 24 24">
                                    <path
                                        d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z">
                                    </path>
                                </svg>
                                <svg xmlns="http://www.w3.org/2000/svg" height="100" width="100" class="celebrate">
                                    <polygon class="poly" points="10,10 20,20"></polygon>
                                    <polygon class="poly" points="10,50 20,50"></polygon>
                                    <polygon class="poly" points="20,80 30,70"></polygon>
                                    <polygon class="poly" points="90,10 80,20"></polygon>
                                    <polygon class="poly" points="90,50 80,50"></polygon>
                                    <polygon class="poly" points="80,80 70,70"></polygon>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script setup>
import axios from 'axios';
import { ref, onMounted, inject } from "vue";
import { useRouter } from 'vue-router';

const ultimasRecetas = ref([]);
const favoritosArray = ref([]);
const swal = inject('$swal');
const router = useRouter();

onMounted(() => {
    obtenerUltimasRecetas();
    buscarFavoritos();
});

async function obtenerUltimasRecetas() {
    await axios.get('/api/ultimasRecetas')
        .then(response => {
            ultimasRecetas.value = response.data;
            console.log(ultimasRecetas);
        }).catch(error => {
            console.error("Error fetching favorites:", error);
        });
}

function anadirFavoritos(receta_id) {
    const data = localStorage.getItem("vuex");
    let userId = null;
    let responseStatus;

    if (data) {
        try {
            userId = JSON.parse(data).auth.user.id;
            console.log("ID del usuario:", userId);
        } catch (error) {
            console.error("Error al analizar los datos del localStorage:", error);
        }
    } else {
        console.log("No hay usuario autenticado en el localStorage");
    }

    if (userId) {
        axios.post('/api/favoritos/', {
            user_id: userId,
            receta_id,
        })
            .then(response => {
                console.log(response.data);
                responseStatus = response.data.success;

                if (!responseStatus) {
                    // Llamada a axios.destroy
                    axios.delete(`/api/favoritos/${receta_id}`, {
                        user_id: userId,
                    });
                }
            });
    } else {

        swal({
            title: "Es necesario iniciar session antes de realizar esta accion",
            icon: "info",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Iniciar Session"
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/login';
                return;
            };
        });
    }


}

function detallesReceta(id) {
    router.push({ name: 'recetas.detalle', params: { id } });
}


async function buscarFavoritos() {
    const data = localStorage.getItem("vuex");
    let userId = null;

    if (data) {
        try {
            userId = JSON.parse(data).auth.user.id;
            console.log("ID del usuario:", userId);
        } catch (error) {
            console.error("Error al analizar los datos del localStorage:", error);
        }
    } else {
        console.log("No hay usuario autenticado en el localStorage");
    }


    axios.get(`/api/favoritos/${userId}`)
        .then(response => {
            // Extraer todos los ID

            for (const receta of response.data) {
                favoritosArray.value.push(receta.id);
            }


        })
}

function isFavorito(recetaId) {

    return favoritosArray.value.some(fav => fav === recetaId);
}



</script>

<style scoped></style>
