<template>
    <div id="recetas" class="container">
        <h1>Comentarios</h1>
        <div class="row mb-3">
            <div class="col-md-6">
                <p>Filtro de los comentarios</p>
            </div>
            <div class="col-md-6 text-right">
                <button class="btn btn-success" @click="createComentario()">Dejar comentario</button>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 mb-3" v-for="receta in recetas" :key="receta.id">
                <div class="card cursor_pointer" @click="detallesReceta(receta.id)">
                    <div class="card-body">
                        <h5 class="card-title">{{ Comentario.puntuacion }}</h5>
                        <p class="card-text">{{ comentario.contenido }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, inject } from "vue";
import { useRoute } from "vue-router";

const swal = inject('$swal');
const comentario = ref([]);
const route = useRoute()

// Obtener id de usuario
const data = localStorage.getItem("vuex");
const user_id = JSON.parse(data).auth.user.id;

// Obtener id de la receta
const receta_id = route.params.id;

comentario.value.user_id = user_id;
comentario.value.receta_id = receta_id;

function createComentario() {
    swal.fire({
        title: 'Deja tu comentario',
        html: `
                <div class="form-group">
                    <label for="puntuacion">Valoración:</label>
                    <input v_model="comentario.puntuacion" type="number" id="puntuacion" class="form-control" min="1" max="5" required>
                </div>
                <div class="form-group">
                    <label for="contenido">Comentario:</label>
                    <textarea v-model="comentario.contenido" id="contenido" class="form-control" rows="3" required></textarea>
                </div>
            `,
        showCancelButton: true,
        confirmButtonText: 'Enviar',
        customClass: {
            confirmButton: 'btn btn-success',
            cancelButton: 'btn btn-default'
        }
    }).then((result) => {
        if (result.isConfirmed) {
            axios.post('/api/comentarios', comentario.value)
                .then(response => {
                    swal({
                        icon: 'success',
                        title: 'Receta añadida correctamente'
                    })
                        .then(() => {
                            router.push({ name: 'comentarios.index' })
                        });
                })
                .catch(error => {
                    swal({
                        icon: 'error',
                        title: 'No se ha podido añadir el comentario'
                    });
                });
        }
    });
}
</script>