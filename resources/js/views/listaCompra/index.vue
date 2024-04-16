<template>
    <h2>Lista de la compra</h2>
    <div class="formato-selector" >
        <label for="formato">Formato:</label>
        <select id="formato" v-model="formato" @change="cargarListaCompra">
            <option value="semana">Semana</option>
            <option value="dia">Día</option>
        </select>
    </div>
    <div class="lista-compra">

        <div v-if="listaCompra" class="lista">
            <template v-if="formato === 'semana'">
                <div v-for="(ingredientes, dia) in listaCompra" :key="dia" class="lista-dia-semana">
                    <ul>
                        <li v-for="ingrediente in ingredientes" :key="ingrediente.nombre">
                            <div v-if="ingrediente.cantidad !== null && ingrediente.unidad !== null" class="ingrediente">
                                <span>- {{ ingrediente.cantidad }} {{ ingrediente.unidad }} de {{ ingrediente.nombre
                                    }}</span>
                            </div>
                            <div v-else class="ingrediente">
                                <span>- {{ ingrediente.nombre }}</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </template>
            <template v-else-if="formato === 'dia'"> 
                <div class="columnas">
                <div v-for="(ingredientes, dia) in listaCompra" :key="dia" class="lista-dia">
                    <h3>{{ dia }}</h3>
                   
                        <ul>
                            <li v-for="ingrediente in ingredientes" :key="ingrediente.nombre">
                                <div v-if="ingrediente.cantidad !== null && ingrediente.unidad !== null" class="ingrediente">
                                    <span>- {{ ingrediente.cantidad }} {{ ingrediente.unidad }} de {{ ingrediente.nombre
                                        }}</span>
                                </div>
                                <div v-else class="ingrediente">
                                    <span>- {{ ingrediente.nombre }}</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </template>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const data = localStorage.getItem("vuex");
let userId = null;
userId = JSON.parse(data).auth.user.id;


const formato = ref('semana');
const listaCompra = ref(null);

onMounted(() => {
    cargarListaCompra();
});

function cargarListaCompra() {
    axios
        .get(`/api/listaCompra/${userId}/${formato.value}`)
        .then((response) => {
            console.log(response)
            listaCompra.value = response.data;
        });
}
</script>

<style scoped>
.lista-compra {
  max-width: 1440px;
  margin: 0 auto;
  padding: 20px;
}

.lista {
  margin-top: 20px;
}

.lista-dia-semana {
  margin-bottom: 20px;
}

.lista h3 {
  margin-bottom: 10px;
}

.lista ul {
  list-style-type: none;
  padding-left: 0;
}

.lista li {
  margin-bottom: 5px;
}

.ingrediente {
  padding: 10px;
  border-radius: 5px;
}

.ingrediente span {
  font-size: 16px;
}

.columnas {
  display: flex;
  flex-wrap: wrap;
}

.columnas .lista-dia {
  flex: 1;
  margin-right: 20px;
}
</style>