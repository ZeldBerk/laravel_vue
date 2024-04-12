<template>
    <div class="lista-compra">
        <h2>Lista de la compra</h2>
        <div class="formato-selector">
            <label for="formato">Formato:</label>
            <select id="formato" v-model="formato" @change="cargarListaCompra">
                <option value="semana">Semana</option>
                <option value="dia">Día</option>
            </select>
        </div>
        <div v-if="listaCompra" class="lista">
            <template v-if="formato === 'semana'">
                <ul>
                    <li v-for="(infoIngrediente, index) in listaCompra" :key="index">
                        <template v-if="infoIngrediente.cantidad !== null">
                            {{ infoIngrediente.cantidad }} x {{ infoIngrediente.nombre }} ({{ infoIngrediente.unidad }})
                        </template>
                        <template v-else>
                            {{ infoIngrediente.nombre }}
                        </template>
                    </li>
                </ul>
            </template>
            <template v-else-if="formato === 'dia'">
                <div v-for="(ingredientesDia, dia) in listaCompra" :key="dia">
                    <h3>{{ dia }}</h3>
                    <ul>
                        <li v-for="(infoIngrediente, index) in ingredientesDia" :key="index">
                            <template v-if="infoIngrediente.cantidad !== null">
                                {{ infoIngrediente.cantidad }} x {{ infoIngrediente.nombre }} ({{ infoIngrediente.unidad
                                }})
                            </template>
                            <template v-else>
                                {{ infoIngrediente.nombre }}
                            </template>
                        </li>
                    </ul>
                </div>
            </template>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const userId = 1; // Reemplazar con el ID del usuario actual

const formato = ref('semana');
const listaCompra = ref(null);

onMounted(() => {
    cargarListaCompra();
});

function cargarListaCompra() {
    axios
        .get(`/api/listaCompra/${userId}`, {
            params: {
                formato: formato.value
            }
        })
        .then((response) => {
            listaCompra.value = response.data;
        });
}
</script>

<style scoped>
.lista-compra {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.formato-selector {
    margin-bottom: 20px;
}

.lista {
    margin-top: 20px;
}

.lista ul {
    list-style-type: none;
    padding-left: 0;
}

.lista li {
    margin-bottom: 5px;
}
</style>
