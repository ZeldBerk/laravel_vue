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
        <div v-if="listaCompra.length != 0">
            <div v-if="listaCompra && formato === 'semana'">
                <div class="lista-semana">
                    <div v-for="(ingredientes, dia) in listaCompra" :key="dia"
                        class="tarjeta-dia col-lg-3 col-md-6 col-sm-12">
                        <h3>Semanal</h3>
                        <div class="lista-ingredientes row">
                            <div class="col-lg-3 col-md-2" v-for="ingrediente in ingredientes"
                                :key="ingrediente.nombre">
                                <ul class="ingrediente">
                                    <li v-if="ingrediente.cantidad !== null && ingrediente.unidad !== null"
                                        class="nombre">
                                        {{ ingrediente.cantidad }} {{ ingrediente.unidad }} de {{ ingrediente.nombre }}
                                    </li>
                                    <li v-else class="nombre">
                                        {{ ingrediente.nombre }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lista">
                <div v-if="listaCompra && formato === 'dia'">
                    <div class="row">
                        <div v-for="(ingredientes, dia) in listaCompra" :key="dia"
                            class="tarjeta-dia col-md-12 col-lg-6 margin2">
                            <div class="lista-dia-columna">
                                <h3>{{ dia }}</h3>
                                <div class="lista-ingredientes">
                                    <div v-for="ingrediente in ingredientes" :key="ingrediente.nombre">
                                        <ul class="ingrediente">
                                            <li v-if="ingrediente.cantidad !== null && ingrediente.unidad !== null"
                                                class="nombre">
                                                {{ ingrediente.cantidad }} {{ ingrediente.unidad }} de {{
                                                ingrediente.nombre }}
                                            </li>
                                            <li v-else class="nombre">
                                                {{ ingrediente.nombre }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div v-else class="col-12">
            <div class="noComentarios d-flex align-items-center justify-content-center flex-column">
                <h5>No hay nada en la lista de la compra</h5>
                <p>Añade recetas al plan semanal para tener lista de la compra</p>
                <router-link :to="{ name: 'recetas.index' }"
                    class="btn colorBoton">Añadir recetas</router-link>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import axios from 'axios';

const data = localStorage.getItem("vuex");
const userId = JSON.parse(data).auth.user.id;

const formato = ref('semana');
const listaCompra = ref({});

onMounted(() => {
    cargarListaCompra();
});

function cargarListaCompra() {
    axios.get(`/api/listaCompra/${userId}/${formato.value}`)
        .then((response) => {
            listaCompra.value = response.data;
            console.log(listaCompra.value)
        });
}
</script>

<style scoped>
.lista-compra {
    margin: 0 auto;
    padding: 20px;
    background-color: #f8f8f8;
}

.formato-selector {
    margin-bottom: 20px;
    text-align: center;
}

.lista {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
}

.row {
    display: flex;
    flex-wrap: wrap;
}

.col-md-12 {
    flex: 1;
    margin-bottom: 20px;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.col-lg-6 {
    flex: 1;
    margin-bottom: 20px;
    padding: 20px;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.lista-semana {
    display: flex;
    flex-wrap: wrap;
}

.tarjeta-dia {
    flex: 1;
    margin-bottom: 20px;
    padding: 20px;
    background-color: #fff;
    border-radius: 0px;
    border: 3px solid #422329c9;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.margin2 {
    margin: 2px;
}

.lista-dia h3 {
    margin-bottom: 15px;
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    color: #333;
}

.lista-ingredientes {
    list-style: none;
    padding: 0;
}

.lista-ingredientes li {
    margin-bottom: 10px;
}

.ingrediente {
    display: flex;
    align-items: center;
    padding: 10px;
}

.nombre {
    margin-right: 1
}

/* Media queries para diseño responsive */
@media (max-width: 992px) {
    .tarjeta-dia {
        max-width: calc(50% - 20px);
        /* 50% para 2 columnas en pantallas medianas */
    }
}

@media (max-width: 576px) {
    .tarjeta-dia {
        max-width: 100%;
        /* Mostrar en una sola columna en pantallas pequeñas */
    }
}
</style>
