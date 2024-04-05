<template>
    <div class="colorFondo">
        <div id="recetas" class="container ">
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
                    <div class="bordeRecetas card cursor_pointer" @click.stop="detallesReceta(receta.id)">
                        <div class="position-relative">
                            <div class="position-absolute top-0 end-0 p-2">
                                <div @click.stop="anadirPlanSemanal(receta.id)">
                                    <a class="icon-link">
                                        <svg width="35px" height="35px" viewBox="-2.4 -2.4 28.80 28.80" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" stroke="#F59E0B">
                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                stroke-linejoin="round">
                                            </g>
                                            <g id="SVGRepo_iconCarrier">
                                                <circle cx="12" cy="12" r="10" class="circle"></circle>
                                                <path d="M15 12L12 12M12 12L9 12M12 12L12 9M12 12L12 15" class="cross">
                                                </path>
                                            </g>
                                        </svg>
                                    </a>

                                </div>
                            </div>
                            <img :src="`${receta.media[0]?.original_url}`" class="card-img-top" alt="">
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">{{ receta.nombre }}</h5>
                            <p class="texto">{{ receta.descripcion }}</p>
                            <div class="d-flex justify-content-end">
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
                                        <svg xmlns="http://www.w3.org/2000/svg" height="100" width="100"
                                            class="celebrate">
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
        </div>
    </div>

</template>

<script setup>
import axios from "axios";
import { ref, onMounted, inject } from "vue";
import { useRouter } from "vue-router";

const swal = inject('$swal');
const favoritosArray = ref([]);
const recetas = ref([]);
const router = useRouter();

onMounted(() => {
    obtenerRecetas();
    buscarFavoritos();
});

async function obtenerRecetas() {
    try {
        const response = await axios.get('api/recetas');
        recetas.value = response.data;
    } catch (error) {
        console.error("Error al obtener recetas:", error);
    }
}



function detallesReceta(id) {
    router.push({ name: 'recetas.detalle', params: { id } });
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
/* Añade estilo al cursor al pasar por encima de la carta */
.cursor_pointer {
    cursor: pointer;
}

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
</style>