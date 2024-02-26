<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between pb-2 mb-2">
                <h5 class="card-title">Añade una tarea nueva</h5>
            </div>
            <div v-if="stringSuccess" class="alert alert-success alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ stringSuccess }}</strong>
            </div>
            <div v-if="stringError" class="alert alert-danger alert-dismissible fade show" role="alert">
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                <strong>{{ stringError }}</strong>
            </div>
                   {{ task }}
            <form @submit.prevent="addTask">
                <div class="form-group mb-2">
                    <label>Nombre</label><span class="text-danger"> *</span>
                    <input v-model="task.name" type="text" class="form-control" placeholder="Nombre tarea">
                </div>
                <div class="form-group mb-2">
                    <label>Descripción</label><span class="text-danger"> *</span>
                    <textarea v-model="task.description" class="form-control" rows="3" placeholder="Descripción"></textarea>
                </div>
                <div class="form-gorup mb-2">
                    <label>Fecha inicio</label><span class="text-danger">*</span>
                    <input v-model="task.date_open" class="form-control" type="datetime-local" name="date_open"/>
                </div>
                <div class="form-gorup mb-2">
                    <label>Fecha fin</label><span class="text-danger">*</span>
                    <input v-model="task.date_close" class="form-control" type="datetime-local" name="date_close"/>
                </div>
                <button type="submit" class="btn btn-primary mt-4 mb-4">Añadir Tarea</button>
            </form>
        </div>
    </div>
</template>


<script setup>
    import { ref } from "vue";
    const task = ref({});

    const stringError = ref();
    const stringSuccess = ref();

    function addTask(){

        axios.post('/api/tasks', task.value)
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


<style>
</style>
