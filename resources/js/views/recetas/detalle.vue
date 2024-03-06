<template>
    <
    {{ receta }}
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
</script>