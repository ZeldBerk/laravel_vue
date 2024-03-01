<template>
    <div id="recetas" class="container">
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Añade una nueva receta</h5>
            </div>
            <div v-if="stringSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ stringSuccess }}</strong>
            </div>
            <div v-if="stringError" class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ stringError }}</strong>
            </div>
            <form @submit.prevent="addReceta">
                <div class="row my-5">
                    <div class="col-md-8">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <!-- Nombre receta -->
                                <div class="mb-3">
                                    <label for="receta_nombre" class="form-label">Nombre de la receta</label>
                                    <input v-model="receta.nombre" id="receta_nombre" type="text" class="form-control">
                                </div>
                                <!-- Contenido receta -->
                                <div class="mb-3">
                                    <label for="receta_descripcion" class="form-label">Contenido de la receta</label>
                                    <TextEditorComponent v-model="receta.descripcion"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-body">
                                <div class="mb-3">
                                    <label for="receta_raciones" class="form-label">Raciones de la receta</label>
                                    <input v-model="receta.raciones" id="receta_raciones" type="number" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</template>


<script setup>
    import { ref } from "vue";
    import TextEditorComponent from "@/components/TextEditorComponent.vue";

    const receta = ref({});

    const stringError = ref();
    const stringSuccess = ref();

    function addTask(){

        axios.post('/api/recetas', receta.value)
        .then(response =>{
            console.log(response);
            stringSuccess.value = response.data.success;
            stringError.value = "";
        })
        .catch(error => {
            console.log(error);
            stringSuccess.value = "";
            stringError.value = error.response.data.message;
        });
    }
    
</script>