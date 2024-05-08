<template>
    <div id="favoritos" class="container">
        <h1>Mis recetas Favoritas</h1>
        <div class="row">
            <div v-if="favoritos && favoritos.length > 0">
                <div class="col-md-12 col-lg-4 mb-3" v-for="favorito in favoritos" :key="favorito.id">
                    <div class="cursor_pointer cardBorderIMG" @click.stop="detallesReceta(favorito.id)">
                        <div class="contenidoCard cursor_pointer">
                            <div class="cardImageDIV -relative">
                                <div class="position-absolute top-0 end-0 pr-2 pt-2 mr-2">
                                    <div class="mi-con-like" @click.stop="eliminarFavoritos(favorito.id)">
                                        <input class="mi-like" checked type="checkbox" title="like">
                                        <div class="mi-checkmark">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mi-outline"
                                                viewBox="0 0 24 24">
                                                <path
                                                    d="M17.5,1.917a6.4,6.4,0,0,0-5.5,3.3,6.4,6.4,0,0,0-5.5-3.3A6.8,6.8,0,0,0,0,8.967c0,4.547,4.786,9.513,8.8,12.88a4.974,4.974,0,0,0,6.4,0C19.214,18.48,24,13.514,24,8.967A6.8,6.8,0,0,0,17.5,1.917Z">
                                                </path>
                                            </svg>
                                            <svg xmlns="http://www.w3.org/2000/svg" class="mi-filled"
                                                viewBox="0 0 24 24">
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
                                    <div class="col-2 mb-4" @click.stop="anadirPlanSemanal(favorito.id)">
                                        <a class="icon-link">
                                            <svg width="35px" height="35px" viewBox="-2.4 -2.4 28.80 28.80" fill="none"
                                                xmlns="http://www.w3.org/2000/svg" stroke="#F59E0B">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round">
                                                </g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <circle cx="12" cy="12" r="10" class="circle"></circle>
                                                    <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15"
                                                        class="cross">
                                                    </path>
                                                </g>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                                <p class="texto ml-2">{{ favorito.descripcion }}</p>
                            </div>
                        </div>
                        <div class="oval"></div>
                    </div>
                </div>
            </div>
            <div v-else>
                <div class="noComentarios d-flex align-items-center justify-content-center flex-column">
                    <h5>No tienes ningun favorito</h5>
                    <p>Añade las recetas que mas te gusten</p>
                    <router-link :to="{ name: 'recetas.index' }" class="btn colorBoton">Recetario</router-link>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { ref, onBeforeMount, inject } from "vue";
import { useRouter } from "vue-router";

const router = useRouter();
const swal = inject('$swal');

// Obtener id de usuario
const data = localStorage.getItem("vuex");
let userId = JSON.parse(data).auth.user.id;

const favoritos = ref({});

// Obtener los favoritos del usuario
onBeforeMount(() => {

    axios.get('/api/favoritos/' + userId)
        .then(response => {
            console.log(response.data)
            favoritos.value = response.data;
        })
});

// Elimina el favorito al deseleccionar el corazon
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

// Redireccion a la pagina de detalles de la receta
function detallesReceta(id) {
    router.push({ name: 'recetas.detalle', params: { id } });
}

// Pregunta el dia de la semana y el momento del dia para añadir la receta al plan semanal
function anadirPlanSemanal(receta_id) {
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

    if (userId) {
        swal({
            title: "Añadir receta al plan semanal",
            html: `
            <label for="dia_semana">Día de la semana:</label>
            <select id="dia_semana" class="swal2-select" required>
                <option value="">Seleccionar día</option>
                <option value="Lunes">Lunes</option>
                <option value="Martes">Martes</option>
                <option value="Miércoles">Miércoles</option>
                <option value="Jueves">Jueves</option>
                <option value="Viernes">Viernes</option>
                <option value="Sábado">Sábado</option>
                <option value="Domingo">Domingo</option>
            </select>
            <label for="momento_dia">Momento del día:</label>
            <select id="momento_dia" class="swal2-select" required>
                <option value="">Seleccionar momento</option>
                <option value="Almuerzo">Almuerzo</option>
                <option value="Cena">Cena</option>
            </select>
        `,
            focusConfirm: false,
            preConfirm: () => {
                const dia_semana = swal.getPopup().querySelector('#dia_semana').value;
                const momento_dia = swal.getPopup().querySelector('#momento_dia').value;


                if (!dia_semana || !momento_dia) {
                    swal.showValidationMessage(`Por favor, seleccione el día de la semana y el momento del día.`);
                } else {
                    // Realizar la llamada al endpoint con los datos
                    axios.post('/api/planSemanal/', {
                        user_id: userId,
                        receta_id,
                        dia_semana,
                        momento_dia
                    })
                        .then(response => {
                            if (response.data.success) {
                                swal.fire({
                                    title: 'Receta añadida al plan semanal',
                                    icon: 'success'
                                });
                            } else {
                                swal.fire({
                                    title: 'Error al añadir receta',
                                    text: response.data.message, // Puedes mostrar el mensaje de error proporcionado por el servidor
                                    icon: 'warning'
                                });
                            }
                        })
                        .catch(error => {
                            console.error("Error al añadir receta al plan semanal:", error);
                            swal.fire({
                                title: 'Error',
                                text: 'Ocurrió un error al añadir la receta al plan semanal',
                                icon: 'error'
                            });
                        });
                }
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
</script>
<style scoped>
/* Estilo personalizado para el botón de añadir al plan semanal */
.position-absolute {
    position: absolute;
}

.top-0 {
    top: 0;
}

.end-0 {
    right: 0;
}

/* Estilo para el efecto de zoom */
.cardBorderIMG:hover .contenidoCard {
    transform: scale(1.1);
    transition: transform 0.3s ease;
}
</style>