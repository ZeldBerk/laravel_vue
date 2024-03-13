<template>
    <h1>Plan Semanal</h1>
    <div class="container card">
      <table>
        <tr>
            <th class="separador espacio"></th>
            <th class="separador espacio">Almuerzo</th>
            <th>Cena</th>
        </tr>
        <tr v-for="dia in diasSemana" :key="dia">
            <th class="separador espacio">{{ dia }}</th>
            <td class="separador">fsdfsf</td>
            <td></td>
        </tr>
      </table>
    </div>
  </template>
  
  <script>
  import { ref } from "vue";
  
  export default {
    setup() {
      const diasSemana = ref([
        'Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado', 'Domingo'
      ]);
  
      return { diasSemana };
    },
  };
  </script>
  