<template>
    <p>Toma geroma</p>
    
</template>

<script setup>
import { ref, onMounted } from "vue";
import { useRoute } from "vue-router";

const route = useRoute()
// const receta = ref([]);
id = route.params.id;
console.log(id)
onMounted(() => {
    axios.get('/api/recetas/' + id)
    .then(response => {
        receta.value = response.data;
    })
});
</script>