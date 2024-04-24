<template>
  <div>
    <h1 class=" mx-4">Plan Semanal</h1>
    <div class="contenedorGeneral m-0">
      <table class="table table-bordered">
        <thead class="text-white">
          <tr>
            <th scope="col">Día</th>
            <th scope="col">Almuerzo</th>
            <th scope="col">Cena</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(dia, index) in diasSemana" :key="index">
            <td class="text-center align-middle">{{ dia }}</td>
            <td>
              <div v-if="filtrarRecetas(dia, 'Almuerzo').length > 0">
                <div v-for="receta in filtrarRecetas(dia, 'Almuerzo')" :key="receta.id">
                  <div class="row receta">
                    <p class="col-lg-8 col-md-12">{{ receta.receta.nombre }}</p>
                    <div class="col-lg-2 col-md-6">
                      <span class="icon-eye" @click.stop="detallesReceta(receta.receta_id)">
                        <svg width="35px" height="35px" viewBox="-2.4 -2.4 28.80 28.80" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                          <g id="SVGRepo_iconCarrier">
                            <path
                              d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z"
                              stroke="#DDCAD0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path
                              d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z"
                              stroke="#DDCAD0" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </svg>
                      </span>
                    </div>
                    <div class="col-lg-2 col-md-6">
                      <span class="icon-container" @click.stop="deleteRecetadelPlan(receta.id)">
                        <svg width="30px" height="30px" fill="#DDCAD0" viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg" stroke="#DDCAD0">
                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                          <g id="SVGRepo_iconCarrier">
                            <path
                              d="M5.755,20.283,4,8H20L18.245,20.283A2,2,0,0,1,16.265,22H7.735A2,2,0,0,1,5.755,20.283ZM21,4H16V3a1,1,0,0,0-1-1H9A1,1,0,0,0,8,3V4H3A1,1,0,0,0,3,6H21a1,1,0,0,0,0-2Z">
                            </path>
                          </g>
                        </svg>
                      </span>
                    </div>

                  </div>
                </div>
              </div>
              <div v-else>
                <p class="text-muted text-center align-middle">Ninguna receta para el almuerzo</p>
              </div>
            </td>
            <td class="text-center align-middle">
              <div v-if="filtrarRecetas(dia, 'Cena').length > 0">
                <div v-for="receta in filtrarRecetas(dia, 'Cena')" :key="receta.id">
                  <div class="row receta">
                    <p class="col-lg-8 col-md-12">{{ receta.receta.nombre }}</p>
                    <div class="col-lg-2 col-md-6">
                      <span class="icon-eye" @click.stop="detallesReceta(receta.receta_id)">
                        <svg width="35px" height="35px" viewBox="-2.4 -2.4 28.80 28.80" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                          <g id="SVGRepo_iconCarrier">
                            <path
                              d="M15.0007 12C15.0007 13.6569 13.6576 15 12.0007 15C10.3439 15 9.00073 13.6569 9.00073 12C9.00073 10.3431 10.3439 9 12.0007 9C13.6576 9 15.0007 10.3431 15.0007 12Z"
                              stroke="#F59E0B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path
                              d="M12.0012 5C7.52354 5 3.73326 7.94288 2.45898 12C3.73324 16.0571 7.52354 19 12.0012 19C16.4788 19 20.2691 16.0571 21.5434 12C20.2691 7.94291 16.4788 5 12.0012 5Z"
                              stroke="#F59E0B" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </svg>
                      </span>
                    </div>
                    <div class="col-lg-2 col-md-6">
                      <span class="icon-container" @click.stop="deleteRecetadelPlan(receta.id)">
                        <svg width="30px" height="30px" fill="#F59E0B" viewBox="0 0 24 24"
                          xmlns="http://www.w3.org/2000/svg" stroke="#F59E0B">
                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                          <g id="SVGRepo_iconCarrier">
                            <path
                              d="M5.755,20.283,4,8H20L18.245,20.283A2,2,0,0,1,16.265,22H7.735A2,2,0,0,1,5.755,20.283ZM21,4H16V3a1,1,0,0,0-1-1H9A1,1,0,0,0,8,3V4H3A1,1,0,0,0,3,6H21a1,1,0,0,0,0-2Z">
                            </path>
                          </g>
                        </svg>
                      </span>
                    </div>

                  </div>
                </div>
              </div>
              <div v-else>
                <p class="text-muted">Ninguna receta para la cena</p>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
      <div class="text-center mt-3">
        <RouterLink class="btn colorBoton" :to="{ name: 'recetas.index' }">Ver más recetas</RouterLink>
      </div>
    </div>
  </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import axios from "axios";
import { RouterLink, useRouter } from "vue-router";

const diasSemana = ref([
  "Lunes",
  "Martes",
  "Miércoles",
  "Jueves",
  "Viernes",
  "Sábado",
  "Domingo",
]);

const planSemanal = ref([]);

onMounted(async () => {
  obtenerPlanSemanal();
});

const router = useRouter();

function obtenerPlanSemanal() {
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
    axios.get(`/api/planSemanal/${userId}`)
      .then((response) => {
        planSemanal.value = response.data;
      })
      .catch((error) => {
        console.error("Error: ", error);
      });
  }
}

function filtrarRecetas(dia, momentoDia) {
  return planSemanal.value.filter((item) => item.dia_semana === dia && item.momento_dia === momentoDia);
}

function detallesReceta(receta_id) {
  router.push({ name: 'recetas.detalle', params: { id: receta_id } });
}

function deleteRecetadelPlan(id) {
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

  if (!userId) {
    console.error("No user ID found for removing favorites");
    return;
  }

  console.log(id);

  axios.delete(`/api/planSemanal/${id}`, {
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
</script>

<style>
.receta {
  padding: 10px;
  margin-bottom: 5px;
}


</style>
