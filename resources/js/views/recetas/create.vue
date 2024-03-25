<template>
    <div id="recetas" class="container">
        <div class="d-flex justify-content-between pb-2 mb-2">
            <h5 class="card-title">Añade una nueva receta</h5>
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
                            <!-- Ingredientes -->
                            <div class="mb-3">
                                <label for="">Ingredientes</label>
                                <!-- Configuracion de ingredientes -->
                                <div class="row ingredientes">
                                    
                                </div>
                                <!-- Selector de ingredeientes -->
                                <Dropdown v-model="ingredientes_receta.ingrediente_id" :options="ingredientes"
                                    optionValue="id" optionLabel="nombre" placeholder="Selecciona los ingredientes"
                                    checkmark filter class="w-100"
                                    @change="ingrediente_selection(ingredientes_receta.ingrediente_id)" />
                            </div>
                            {{ ingredientes_receta }}
                            <!-- Contenido receta -->
                            <div class="mb-3">
                                <label for="receta_descripcion" class="form-label">Pasos de la receta</label>
                                <TextEditorComponent v-model="receta.descripcion" />
                            </div>
                            <button type="submit" class="btn btn-primary mt-4 mb-4">Añadir receta</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <!-- Raciones receta -->
                            <div class="mb-3">
                                <label for="receta_raciones" class="form-label">Raciones</label>
                                <input v-model="receta.raciones" id="receta_raciones" type="number" min="1"
                                    class="form-control">
                            </div>
                            <!-- Tiempo receta -->
                            <div class="mb-3">
                                <label for="receta_tiempo_preparacion" class="form-label">Tiempo de preparación</label>
                                <input v-model="receta.tiempo_preparacion" id="receta_tiempo_preparacion" type="number"
                                    min="1" class="form-control">
                            </div>
                            <!-- Categoria receta -->
                            <div class="mb-3">
                                <label for="receta_categoria_id" class="form-label">Selecciona la categoría</label>
                                <Dropdown v-model="receta.categoria_id" :options="categorias" optionValue="id"
                                    optionLabel="nombre" placeholder="Selecciona la categoria" checkmark
                                    class="w-100" />
                            </div>
                            <!-- Imagen receta -->
                            <div class="mb-3">
                                <label for="receta_ruta_imagen" class="form-label">Imagen</label>
                                <DropZone v-model="receta.thumbnail" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>


<script setup>
import { ref, inject, onMounted } from "vue";
import { useRouter } from 'vue-router';
import TextEditorComponent from "@/components/TextEditorComponent.vue";
import DropZone from "@/components/DropZone.vue";
import axios from "axios";

const categorias = ref();
const ingredeinte = ref({}); // Añadir ingredeinte
const ingredientes = ref(); // Ingredeintes del desplegable 
const ingredientes_receta = ref({});
const receta = ref({});
const swal = inject('$swal');
const router = useRouter()

// Obtener id de usuario
const data = localStorage.getItem("vuex");
const user_id = JSON.parse(data).auth.user.id;

receta.value.user_id = user_id;

// Carga de las categorias en el desplegable
function chargeCategorias() {
    axios.get('/api/categorias')
        .then(response => {
            categorias.value = response.data;
        });
}
onMounted(() => {
    chargeCategorias();
    chargeIngredientes();
});

// Carga de los ingredientes en el desplegable
function chargeIngredientes() {
    axios.get('/api/ingredientes')
        .then(response => {
            ingredientes.value = response.data;
        });
}


// Maneja los ingredientes que se añaden a la receta
function ingrediente_selection(id_selection) {
    if (id_selection === 1) {
        swal({
            title: 'Añadir Ingrediente',
            text: 'Introduce el nombre del nuevo ingrediente:',
            html: `
            <label class="form-label">Introduce el nuevo ingrediente:</label>
            <input id="nombre_ingrediente" type="text" class="form-control placeholder="Nombre del ingrediente">
            `,
            showCancelButton: true,
            cancelButtonText: 'Cancelar',
            confirmButtonText: 'Añadir',
            didOpen: () => {
                // Aplicar clases de Bootstrap a los botones de la alerta
                const confirmButton = document.querySelector('.swal2-confirm');
                const cancelButton = document.querySelector('.swal2-cancel');
                confirmButton.classList.add('btn', 'btn-success');
                cancelButton.classList.add('btn', 'btn-danger');
                confirmButton.classList.remove('swal2-styled');
                cancelButton.classList.remove('swal2-styled');
            }
        }).then((result) => {
            if (result.isConfirmed) {
                // Recojemos el valor que el usuario quiere añadi
                const nombre_ingrediente = document.getElementById('nombre_ingrediente').value;

                // Guardamos el valor en ingredeinte
                ingredeinte.value.nombre = nombre_ingrediente;

                // Insert del ingredeiente
                axios.post('/api/ingredientes', ingredeinte.value)
                    .then(response => {
                        swal({
                            icon: 'success',
                            title: 'Ingrediente añadido correctamente'
                        })
                            .then(() => {
                                chargeIngredientes();
                            });
                    })
                    .catch(error => {
                        swal({
                            icon: 'error',
                            title: 'No se ha añadido el ingrediente'
                        });
                    });
            }
        });
    } else {
        // Aquí manejamos la selección de un ingrediente existente

        // Encontrar el ingrediente seleccionado en la lista de ingredientes
        const selectedIngredient = ingredientes.value.find(ingrediente => ingrediente.id === id_selection);

        // Insertar el nombre del ingrediente en el contenedor
        const ingredientContainer = document.querySelector('.ingredientes');
        

        // Crear un contenedor flex para el nombre y los inputs de cantidad y unidad de medida
        const flexContainer = document.createElement('div');
        flexContainer.setAttribute('class', 'col-6 d-flex align-items-center'); // Alinea los elementos verticalmente

        // Insertar el nombre del ingrediente en el contenedor flex
        const nombreElement = document.createElement('p');
        nombreElement.textContent = selectedIngredient.nombre;
        flexContainer.appendChild(nombreElement);

        // Crear inputs para la cantidad y la unidad de medida
        const cantidadInput = document.createElement('input');
        cantidadInput.setAttribute('type', 'number');
        cantidadInput.setAttribute('min', '1');
        cantidadInput.setAttribute('class', 'form-control ml-2'); // Margen izquierdo para separar del nombre
        cantidadInput.setAttribute('placeholder', 'Cantidad');
        cantidadInput.addEventListener('input', event => {
            ingredientes_receta.value.cantidad = event.target.value;
        });

        const unidadSelect = document.createElement('select');
        unidadSelect.setAttribute('class', 'form-select ml-2'); // Margen izquierdo para separar del input de cantidad
        unidadSelect.innerHTML = `
            <option value="">Selecciona la unidad</option>
            <option value="gramos">Gramos</option>
            <option value="mililitros">Mililitros</option>
            <option value="unidades">Unidades</option>
            <!-- Agrega más opciones según tus necesidades -->
        `;
        unidadSelect.addEventListener('change', event => {
            ingredientes_receta.value.unidad = event.target.value;
        });

        // Insertar los inputs en el contenedor flex
        flexContainer.appendChild(cantidadInput);
        flexContainer.appendChild(unidadSelect);

        // Insertar el contenedor flex en el contenedor principal
        ingredientContainer.appendChild(flexContainer);
    }
}

// Añade la receta y muestra una alerta en funcion de la respuesta de la api
function addReceta() {
    let r = receta.value;
    let serializedReceta = new FormData()
    for (let item in r) {
        if (r.hasOwnProperty(item)) {
            serializedReceta.append(item, r[item])
        }
    }

    axios.post('/api/recetas', serializedReceta, {
        headers: {
            "content-type": "multipart/form-data"
        }
    })
        .then(response => {
            swal({
                icon: 'success',
                title: 'Receta añadida correctamente'
            })
                .then(() => {
                    // Redireccionar a la página después de cerrar la alerta
                    router.push({ name: 'recetas.index' })
                });
        })
        .catch(error => {
            swal({
                icon: 'error',
                title: 'No se ha añadido la receta'
            });
        });
}

</script>
<style>
.btn-success {
    margin-right: 5px;
}

.d-flex {
    display: flex;
}

.align-items-center {
    align-items: center;
}
</style>