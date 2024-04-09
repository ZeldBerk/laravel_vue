<template>
    <div class="container">
        <h2>{{ receta.nombre }}</h2>
        <h4>{{ receta.descripcion_corta }}</h4>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <img :src="receta?.media[0]?.original_url" alt=""/>
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
                                <router-link :to="{ name: 'comentarios.index', params: {id:receta.id} }" class="btn btn-primary">Comentarios</router-link>
                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary">Añadir a plan semanal</button>
                            </div>
                        </div>
                        <h5>Ingredientes:</h5>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 col-lg-4 col-xl-3" v-for="ingrediente in ingredientes">
                                <p>- {{ formatCantidad(ingrediente.cantidad) }} {{ ingrediente.unidad }} de {{ ingrediente.nombre }}</p>
                            </div>
                        </div>
                        <h5>Pasos de la receta:</h5>
                        <TextEditorComponent :readOnly="true" v-model="receta.descripcion" class="border-less" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { ref, onBeforeMount } from "vue";
import { useRoute } from "vue-router";
import TextEditorComponent from "@/components/TextEditorComponent.vue";

const route = useRoute()
const receta = ref({});
const ingredientes = ref({});

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
function formatedate(fechaISO){
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
</script>

<style>

.ck {
    border: 0 !important;
}

</style>