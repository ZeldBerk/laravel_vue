<template>
    <div class="contenedorAdmins">
        <div class="grid">
            <div class="col-12">
                <div class="card comentarioCard">
                    <div class="card-body">
                        <div class="d-flex justify-content-between pb-2 mb-2">
                            <h5 class="card-title">Todos los comentarios</h5>
                            <div class="filtro-comentarios d-flex ">
                                <p class="mr-2">Filtro:</p>
                                <div v-for="estrella in estrellas" :key="estrella" class="mx-1">
                                    <span class="mr-1 ml-2">{{ estrella }}</span>
                                    <label :for="'estrella-' + estrella" class="estrella-label">
                                        <input type="checkbox" :id="'estrella-' + estrella" :value="estrella"
                                            :checked="filtroPuntuacion[estrella]" @change="toggleEstrella(estrella)"
                                            class="estrella-checkbox" hidden>
                                        <svg v-if="!filtroPuntuacion[estrella]" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                                            data-pc-section="officon">
                                            <path
                                                d="M10.9741 13.6721C10.8806 13.6719 10.7886 13.6483 10.7066 13.6033L7.00002 11.6545L3.29345 13.6033C3.19926 13.6539 3.09281 13.6771 2.98612 13.6703C2.87943 13.6636 2.77676 13.6271 2.6897 13.5651C2.60277 13.5014 2.53529 13.4147 2.4948 13.3148C2.45431 13.215 2.44241 13.1058 2.46042 12.9995L3.17881 8.87264L0.167699 5.95324C0.0922333 5.8777 0.039368 5.78258 0.0150625 5.67861C-0.00924303 5.57463 -0.00402231 5.46594 0.030136 5.36477C0.0621323 5.26323 0.122141 5.17278 0.203259 5.10383C0.284377 5.03488 0.383311 4.99023 0.488681 4.97501L4.63087 4.37126L6.48797 0.618832C6.54083 0.530159 6.61581 0.456732 6.70556 0.405741C6.79532 0.35475 6.89678 0.327942 7.00002 0.327942C7.10325 0.327942 7.20471 0.35475 7.29447 0.405741C7.38422 0.456732 7.4592 0.530159 7.51206 0.618832L9.36916 4.37126L13.5114 4.97501C13.6167 4.99023 13.7157 5.03488 13.7968 5.10383C13.8779 5.17278 13.9379 5.26323 13.9699 5.36477C14.0041 5.46594 14.0093 5.57463 13.985 5.67861C13.9607 5.78258 13.9078 5.8777 13.8323 5.95324L10.8212 8.87264L11.532 12.9995C11.55 13.1058 11.5381 13.215 11.4976 13.3148C11.4571 13.4147 11.3896 13.5014 11.3027 13.5651C11.2059 13.632 11.0917 13.6692 10.9741 13.6721ZM7.00002 10.4393C7.09251 10.4404 7.18371 10.4613 7.2675 10.5005L10.2098 12.029L9.65193 8.75036C9.6368 8.6584 9.64343 8.56418 9.6713 8.47526C9.69918 8.38633 9.74751 8.30518 9.81242 8.23832L12.1969 5.94559L8.90298 5.45648C8.81188 5.44198 8.72555 5.406 8.65113 5.35152C8.57671 5.29703 8.51633 5.2256 8.475 5.14314L7.00002 2.1626L5.52503 5.15078C5.4837 5.23324 5.42332 5.30467 5.3489 5.35916C5.27448 5.41365 5.18815 5.44963 5.09705 5.46412L1.80318 5.94559L4.18761 8.23832C4.25252 8.30518 4.30085 8.38633 4.32873 8.47526C4.3566 8.56418 4.36323 8.6584 4.3481 8.75036L3.7902 12.0519L6.73253 10.5234C6.81451 10.4762 6.9058 10.4475 7.00002 10.4393Z"
                                                fill="currentColor"></path>
                                        </svg>
                                        <svg v-else viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg"
                                            aria-hidden="true" data-pc-section="onicon">
                                            <path
                                                d="M13.9718 5.36453C13.9398 5.26298 13.8798 5.17252 13.7986 5.10356C13.7175 5.0346 13.6186 4.98994 13.5132 4.97472L9.37043 4.37088L7.51307 0.617955C7.46021 0.529271 7.38522 0.455834 7.29545 0.404836C7.20568 0.353838 7.1042 0.327026 7.00096 0.327026C6.89771 0.327026 6.79624 0.353838 6.70647 0.404836C6.6167 0.455834 6.54171 0.529271 6.48885 0.617955L4.63149 4.37088L0.488746 4.97472C0.383363 4.98994 0.284416 5.0346 0.203286 5.10356C0.122157 5.17252 0.0621407 5.26298 0.03014 5.36453C-0.00402286 5.46571 -0.00924428 5.57442 0.0150645 5.67841C0.0393733 5.7824 0.0922457 5.87753 0.167722 5.95308L3.17924 8.87287L2.4684 13.0003C2.45038 13.1066 2.46229 13.2158 2.50278 13.3157C2.54328 13.4156 2.61077 13.5022 2.6977 13.5659C2.78477 13.628 2.88746 13.6644 2.99416 13.6712C3.10087 13.678 3.20733 13.6547 3.30153 13.6042L7.00096 11.6551L10.708 13.6042C10.79 13.6491 10.882 13.6728 10.9755 13.673C11.0958 13.6716 11.2129 13.6343 11.3119 13.5659C11.3988 13.5022 11.4663 13.4156 11.5068 13.3157C11.5473 13.2158 11.5592 13.1066 11.5412 13.0003L10.8227 8.87287L13.8266 5.95308C13.9033 5.87835 13.9577 5.7836 13.9833 5.67957C14.009 5.57554 14.005 5.4664 13.9718 5.36453Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive">

                            <table class="table table-hover table-sm">
                                <thead class="bg-dark text-light">
                                    <tr>
                                        <th width="50" class="text-center">#</th>
                                        <th>Usuario</th>
                                        <th>Receta</th>
                                        <th>Comentario</th>
                                        <th>Valoración</th>
                                        <th class="text-center" width="200">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="(comentario, index) in comentariosFiltrados">
                                        <td class="text-center">{{ comentario.id }}</td>
                                        <td>{{ comentario.name }}</td>
                                        <td>{{ comentario.nombre }}</td>
                                        <td>{{ comentario.contenido }}</td>
                                        <td>{{ comentario.puntuacion }}</td>
                                        <td class="text-center">
                                            <router-link
                                                :to="{ name: 'comentAdmin.update', params: { id: comentario.id } }"
                                                class="btn btn-warning mr-1">Editar</router-link>
                                            <button class="btn btn-danger"
                                                @click="deleteComent(comentario.id, index)">Eliminar</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, inject, computed } from "vue";

const swal = inject('$swal');
const comentList = ref([]);

// Obtener id de usuario
const data = localStorage.getItem("vuex");
const user_id = JSON.parse(data).auth.user.id;

// Filtro de puntuación
const filtroPuntuacion = ref({
    1: false,
    2: false,
    3: false,
    4: false,
    5: false
});

// Array de estrellas para el filtro
const estrellas = [1, 2, 3, 4, 5];

// Obtener todo los comentraios de la receta
onMounted(() => {
    axios.get('/api/comentario/admin/' + user_id)
        .then(response => {
            comentList.value = response.data;
        });
});

// Computed property para filtrar los comentarios basados en el filtro de estrellas
const comentariosFiltrados = computed(() => {
    const puntuacionesSeleccionadas = Object.keys(filtroPuntuacion.value).filter(key => filtroPuntuacion.value[key]);

    if (puntuacionesSeleccionadas.length === 0) {
        return comentList.value;
    }

    return comentList.value.filter(comentario => puntuacionesSeleccionadas.includes(comentario.puntuacion.toString()));
});

// Funcion para cambiar el estado de una estrella
const toggleEstrella = (estrella) => {
    filtroPuntuacion.value[estrella] = !filtroPuntuacion.value[estrella];
};

// Funcion de flecha para eliminar un comentario
const deleteComent = (id, index) => {

    swal({
        title: 'Quieres eliminar el comentario?',
        text: 'Esta acción no es reversible!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, eliminar',
        confirmButtonColor: '#ef4444',
        timer: 20000,
        timerProgressBar: true,
        reverseButtons: true
    })
        .then(result => {
            if (result.isConfirmed) {
                axios.delete('/api/comentarios/' + id)
                    .then(response => {
                        comentList.value.splice(index, 1);
                        swal({
                            icon: 'success',
                            title: 'Comentario eliminado correctamente'
                        });
                    })
                    .catch(error => {
                        swal({
                            icon: 'error',
                            title: 'No se ha podido eliminar el comentario'
                        });
                    });
            }
        })
}
</script>

<style>
.filtro-comentarios p {
    display: inline;
    /* o inline-block */
    margin-right: 10px;
    /* Ajusta el margen si es necesario */
}
</style>