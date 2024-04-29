<template>
    <div class="container mt-4">
        <div class="row d-flex justify-content-center">
            <div class="col-12 padding">
                <div class="card comentarioCard">
                    <div class="row">
                        <div class="col-md-12 col-lg-5">
                            <div class="row">
                                <div class="col-12">
                                    <h2>{{ receta.nombre }}</h2>
                                    <h4>{{ receta.descripcion_corta }}</h4>
                                </div>
                                <div class="col-12 d-flex align-items-center">
                                    <svg class="mr-1" width="20px" height="20px" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title></title> <g id="Complete"> <g id="Clock"> <g> <polyline fill="none" points="11.9 5.9 11.9 11.9 12 12 14.1 14.1" stroke="#422329" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></polyline> <circle cx="12" cy="12" data-name="Circle" fill="none" id="Circle-2" r="10" stroke="#422329" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></circle> </g> </g> </g> </g></svg>
                                    <p>Tiempio preparación: {{ receta.tiempo_preparacion }}</p>
                                </div>
                                <div class="col-12 d-flex align-items-center">
                                    <svg version="1.1" id="_x32_" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="20px" height="20px" viewBox="0 0 512 512" xml:space="preserve" fill="#000000" stroke="#000000" class="mr-1">
  <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
  <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
  <g id="SVGRepo_iconCarrier">
    <!-- Inline style instead of <style> tag -->
    <g>
      <path style="fill:#422329;" d="M207.103,23.875v109.219c0,7-5.656,12.641-12.625,12.641h-3.375c-6.969,0-12.641-5.641-12.641-12.641V23.375 c0-18-12.109-23.375-23.719-23.375s-23.719,5.375-23.719,23.375v109.719c0,7-5.672,12.641-12.641,12.641h-3.375 c-6.969,0-12.625-5.641-12.625-12.641V23.875c0-32.219-45.938-31.125-45.938,0.359c0,37.703,0,104.297,0,104.297 c-0.219,57.906,13.625,72.953,36.469,91c18.422,14.531,34.156,22.859,34.156,58.953v232.188h55.344V278.484 c0-36.094,15.734-44.422,34.156-58.953c22.859-18.047,36.688-33.094,36.469-91c0,0,0-66.594,0-104.297 C253.04-7.25,207.103-8.344,207.103,23.875z"></path>
      <path style="fill:#422329;" d="M385.228,34.75c-11.75,32.953-45.578,110.156-47.719,178.344c-3.313,105.844,61.547,90.188,62.703,159.531 v138.688h55.078l0.266,0.688c0,0,0-0.281,0-0.688c0-9.266,0-119.625,0-232.203c0-111.359,0-224.797,0-244.359 C455.556-5.438,403.524-16.531,385.228,34.75z"></path>
    </g>
  </g>
</svg>
                                    <p>Raciones: {{ receta.raciones }}</p>
                                </div>
                                <div class="col-12 d-flex align-items-center">
                                    <svg class="mr-1" width="20px" height="20px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M2 12C2 8.22876 2 6.34315 3.17157 5.17157C4.34315 4 6.22876 4 10 4H14C17.7712 4 19.6569 4 20.8284 5.17157C22 6.34315 22 8.22876 22 12V14C22 17.7712 22 19.6569 20.8284 20.8284C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.8284C2 19.6569 2 17.7712 2 14V12Z" stroke="#422329" stroke-width="1.5"></path> <path d="M7 4V2.5" stroke="#422329" stroke-width="1.5" stroke-linecap="round"></path> <path d="M17 4V2.5" stroke="#422329" stroke-width="1.5" stroke-linecap="round"></path> <path d="M2.5 9H21.5" stroke="#422329" stroke-width="1.5" stroke-linecap="round"></path> <path d="M18 17C18 17.5523 17.5523 18 17 18C16.4477 18 16 17.5523 16 17C16 16.4477 16.4477 16 17 16C17.5523 16 18 16.4477 18 17Z" fill="#422329"></path> <path d="M18 13C18 13.5523 17.5523 14 17 14C16.4477 14 16 13.5523 16 13C16 12.4477 16.4477 12 17 12C17.5523 12 18 12.4477 18 13Z" fill="#422329"></path> <path d="M13 17C13 17.5523 12.5523 18 12 18C11.4477 18 11 17.5523 11 17C11 16.4477 11.4477 16 12 16C12.5523 16 13 16.4477 13 17Z" fill="#422329"></path> <path d="M13 13C13 13.5523 12.5523 14 12 14C11.4477 14 11 13.5523 11 13C11 12.4477 11.4477 12 12 12C12.5523 12 13 12.4477 13 13Z" fill="#422329"></path> <path d="M8 17C8 17.5523 7.55228 18 7 18C6.44772 18 6 17.5523 6 17C6 16.4477 6.44772 16 7 16C7.55228 16 8 16.4477 8 17Z" fill="#422329"></path> <path d="M8 13C8 13.5523 7.55228 14 7 14C6.44772 14 6 13.5523 6 13C6 12.4477 6.44772 12 7 12C7.55228 12 8 12.4477 8 13Z" fill="#422329"></path> </g></svg>
                                    <p>Creada: {{ formatedate(receta.created_at) }}</p>
                                </div>
                                <div class="col-md-6 col-lg-12 col-xl-6 d-flex align-items-center mb-2">
                                    <button type="submit" class="btn colorBoton"
                                        @click.stop="anadirPlanSemanal(receta.id)">Añadir a plan semanal</button>
                                </div>
                                <div class="col-md-6 col-lg-12 col-xl-6 d-flex align-items-center mb-2">
                                    <router-link :to="{ name: 'comentarios.index', params: { id: receta.id } }"
                                        class="btn colorBoton">Comentarios</router-link>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-7 d-flex justify-content-center">
                            <img :src="receta?.media[0]?.original_url" alt="" style="max-width: 100%; height: auto;" />
                        </div>
                    </div>
                    <div class="row">
                    </div>
                    <h4>Ingredientes:</h4>
                    <div class="row">
                        <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3" v-for="ingrediente in ingredientes">
                            <div v-if="ingrediente.cantidad">
                                <p>- {{ formatCantidad(ingrediente.cantidad) }} {{ ingrediente.unidad }} de {{
                                    ingrediente.nombre }}</p>
                            </div>
                            <div v-else>
                                <p>- {{ ingrediente.nombre }}</p>
                            </div>
                        </div>
                    </div>
                    <h4>Pasos de la receta:</h4>
                    <TextEditorComponent :readOnly="true" v-model="receta.descripcion" class="border-less" />
                </div>
            </div>
        </div>
        <!-- <h2>{{ receta.nombre }}</h2>
        <h4>{{ receta.descripcion_corta }}</h4>
        <div class="row">
            <div class="col-12">
                <div class="card comentarioCard">
                    <img :src="receta?.media[0]?.original_url" alt="" />
                    <div class="card-body">
                        <div class="row">
                            <div class="col-2">
                                <p>Tiempio preparación: {{ receta.tiempo_preparacion }}</p>
                            </div>
                            <div class="col-1">
                                <p>Raciones: {{ receta.raciones }}</p>
                            </div>
                            <div class="col-4">
                                <p>Creada: {{ formatedate(receta.created_at) }}</p>
                            </div>
                            <div class="col-2">
                                <router-link :to="{ name: 'comentarios.index', params: { id: receta.id } }"
                                    class="btn btn-primary">Comentarios</router-link>
                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary">Añadir a plan semanal</button>
                            </div>
                        </div>
                        <h5>Ingredientes:</h5>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3" v-for="ingrediente in ingredientes">
                                <div v-if="ingrediente.cantidad">
                                    <p>- {{ formatCantidad(ingrediente.cantidad) }} {{ ingrediente.unidad }} de {{ ingrediente.nombre }}</p>
                                </div>
                                <div v-else>
                                    <p>- {{ ingrediente.nombre }}</p>
                                </div>
                            </div>
                        </div>
                        <h5>Pasos de la receta:</h5>
                        <TextEditorComponent :readOnly="true" v-model="receta.descripcion" class="border-less" />
                    </div>
                </div>
            </div>
        </div>-->
    </div>
</template>

<script setup>
import axios from "axios";
import { ref, onBeforeMount, inject } from "vue";
import { useRoute } from "vue-router";
import TextEditorComponent from "@/components/TextEditorComponent.vue";

const route = useRoute()
const receta = ref({});
const ingredientes = ref({});
const swal = inject('$swal');

onBeforeMount(() => {
    axios.get('/api/recetas/' + route.params.id)
        .then(response => {
            console.log(response.data)
            receta.value = response.data;
        })
    axios.get('/api/ingredientes/receta/' + route.params.id)
        .then(response => {
            console.log(response.data);
            ingredientes.value = response.data;
        })
});


// Funcion para formatera la fecha
function formatedate(fechaISO) {
    // Convertir la fecha a un objeto Date
    const fecha = new Date(fechaISO);

    // Obtener el día, mes y año
    const dia = fecha.getDate().toString().padStart(2, "0");
    const mes = (fecha.getMonth() + 1).toString().padStart(2, "0");
    const año = fecha.getFullYear();

    // Devolver la fecha en formato dd-mm-aaaa
    return `${dia}-${mes}-${año}`;
}


// Filtro para formatear la cantidad
function formatCantidad(cantidad) {
    const entero = Math.floor(cantidad);
    const decimal = cantidad - entero;

    // Si no hay parte decimal, solo mostrar el número entero
    if (decimal === 0) {
        return entero;
    } else {
        // Si hay parte decimal, formatear con coma en lugar de punto
        return cantidad.toLocaleString('es', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).replace('.', ',');
    }
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
/* Estilos boton añadi a plan semanal */
.icon-link {
    display: inline-block;
    padding: 5px;
    transition: background-color 0.3s, color 0.3s;
}

.icon-link:hover {
    cursor: pointer;
}

.circle {
    stroke: #422329;
    stroke-width: 1.5;
}

.cross {
    stroke: #422329;
    stroke-width: 1.5;
    stroke-linecap: round;
}


.icon-link:hover .circle {
    stroke: #F59E0B;
}

.icon-link:hover .cross {
    stroke: #F59E0B;
}
</style>