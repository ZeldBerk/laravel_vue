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
            <div class="col-md-4 mb-3" v-for="comentario in comentarioSH">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ comentario.puntuacion }}</h5>
                        <p class="card-text">{{ comentario.contenido }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import axios from "axios";
import { ref, onMounted, inject } from "vue";
import { useRoute } from "vue-router";

const swal = inject('$swal');
const comentarioSH = ref([]);
const comentario = ref({});
const route = useRoute();

// Obtener id de usuario
const data = localStorage.getItem("vuex");
const user_id = JSON.parse(data).auth.user.id;

// Obtener id de la receta
const receta_id = route.params.id;

// Obtener todo los comentraios de la receta
onMounted(() => {
    axios.get('/api/comentarios/' + receta_id)
    .then(response => {
        comentarioSH.value = response.data;
    })
});

// Guardar receta_id y user_id en comentario para hacer el insert
comentario.value.user_id = user_id;
comentario.value.receta_id = receta_id;
console.log(comentario)

function createComentario() {
    swal.fire({
        title: 'Deja tu comentario',
        html: `
                <div class="form-group">
                    <label for="puntuacion">Valoración:</label>
                    <input type="number" id="puntuacion" class="form-control" min="1" max="5" required>
                </div>
                <div class="form-group">
                    <label for="contenido">Comentario:</label>
                    <textarea id="contenido" class="form-control" rows="3" required></textarea>
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
            // Recojer valores del formulario de la alerta
            const puntuacion = document.getElementById('puntuacion').value;
            const contenido = document.getElementById('contenido').value;

            // Guardar valores en comentario
            comentario.value.puntuacion = puntuacion;
            comentario.value.contenido = contenido;

            // Insert del comentario 
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