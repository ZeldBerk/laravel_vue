<template>
  <div>
    <h1 class="mx-4">Plan Semanal</h1>
    <div class="contenedorGeneral">
      <div class="row">
        <div v-for="(dia, index) in diasSemana" :key="index" class="col-12 mb-4">
          <div class="card">
            <div class="card-header nombreDia">{{ dia }}</div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <h5 class="text-center">Almuerzo</h5>
                  <ul v-if="filtrarRecetas(dia, 'Almuerzo').length > 0">
                    <li v-for="receta in filtrarRecetas(dia, 'Almuerzo')" :key="receta.id" class="receta">
                      {{ receta.receta.nombre }}
                      <span class="icon-eye" @click.stop="detallesReceta(receta.receta_id)">
                        <!-- Icono de ojo dentro de un círculo -->
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                          <g id="SVGRepo_iconCarrier">
                            <path
                              d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                              stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path
                              d="M12 5C7.52285 5 3.73254 7.94288 2.45898 12C3.73253 16.0571 7.52285 19 12 19C16.4771 19 20.2675 16.0571 21.541 12C20.2675 7.94291 16.4771 5 12 5Z"
                              stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </svg>
                      </span>
                      <span class="delete-icon" @click.stop="deleteRecetadelPlan(receta.id)">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                          xmlns="http://www.w3.org/2000/svg" stroke="#000000">
                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                          <g id="SVGRepo_iconCarrier">
                            <path
                              d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6"
                              stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </svg>
                      </span>
                    </li>
                  </ul>
                  <p v-else class="text-muted text-center">Ninguna receta para el almuerzo</p>
                </div>
                <div class="col-md-6">
                  <h5 class="text-center">Cena</h5>
                  <ul v-if="filtrarRecetas(dia, 'Cena').length > 0">
                    <li v-for="receta in filtrarRecetas(dia, 'Cena')" :key="receta.id" class="receta">
                      {{ receta.receta.nombre }}
                      <span class="icon-eye" @click.stop="detallesReceta(receta.receta_id)">
                        <!-- Icono de ojo dentro de un círculo -->
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                          xmlns="http://www.w3.org/2000/svg">
                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                          <g id="SVGRepo_iconCarrier">
                            <path
                              d="M15 12C15 13.6569 13.6569 15 12 15C10.3431 15 9 13.6569 9 12C9 10.3431 10.3431 9 12 9C13.6569 9 15 10.3431 15 12Z"
                              stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path
                              d="M12 5C7.52285 5 3.73254 7.94288 2.45898 12C3.73253 16.0571 7.52285 19 12 19C16.4771 19 20.2675 16.0571 21.541 12C20.2675 7.94291 16.4771 5 12 5Z"
                              stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </svg>
                      </span>
                      <span class="delete-icon" @click.stop="deleteRecetadelPlan(receta.id)">
                        <svg width="24px" height="24px" viewBox="0 0 24 24" fill="none"
                          xmlns="http://www.w3.org/2000/svg" stroke="#000000">
                          <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                          <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                          <g id="SVGRepo_iconCarrier">
                            <path
                              d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6"
                              stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                          </g>
                        </svg>
                      </span>
                    </li>
                  </ul>
                  <p v-else class="text-muted text-center">Ninguna receta para la cena</p>
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

<style></style>
