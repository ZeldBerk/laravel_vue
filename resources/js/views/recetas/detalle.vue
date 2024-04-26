<template>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card comentarioCard">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h2>{{ receta.nombre }}</h2>
                            <h3>{{ receta.descripcion_corta }}</h3>
                        </div>
                        <div class="col-12 d-flex justify-content-center mb-4">
                            <img :src="receta?.media[0]?.original_url" alt="" style="max-width: 100%; height: auto;" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2 d-flex align-items-center">
                            <p>Tiempio preparación: {{ receta.tiempo_preparacion }}</p>
                        </div>
                        <div class="col-1 d-flex align-items-center">
                            <p>Raciones: {{ receta.raciones }}</p>
                        </div>
                        <div class="col-2 d-flex align-items-center">
                            <p>Creada: {{ formatedate(receta.created_at) }}</p>
                        </div>
                        <div class="col-5 d-flex align-items-center justify-content-end" @click.stop="anadirPlanSemanal(receta.id)">
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
                        <div class="col-2 d-flex align-items-center justify-content-end">
                            <router-link :to="{ name: 'comentarios.index', params: { id: receta.id } }"
                                class="btn colorBoton">Comentarios</router-link>
                        </div>
                    </div>
                    <h4>Ingredientes:</h4>
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
.icon-link:hover{
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