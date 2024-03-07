<template>
    <div class="container">
        <h1>{{ receta.nombre }}</h1>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <img src="receta.ruta_imagen" alt="imagen de la receta">
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
                                <button type="submit" class="btn btn-primary">Comentarios</button>
                            </div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary">Añadir a plan semanal</button>
                            </div>
                        </div>
                        <h5>Ingredientes:</h5>
                        <div class="row">
                            <!-- Contenedor para ingredietes -->
                        </div>
                        <h5>Pasos pra realizar la receta</h5>
                        <p>{{ receta.descripcion }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";

const route = useRoute()
const receta = ref([]);

onMounted(() => {
    axios.get('/api/recetas/' + route.params.id)
    .then(response => {
        receta.value = response.data;
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
</script>