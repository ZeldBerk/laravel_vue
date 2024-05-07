<template>
    <div id="recetas" class="container">
        <div class="d-flex justify-content-between pb-2 mb-2">
            <h5 class="card-title">Añade una nueva receta</h5>
        </div>
        <form @submit.prevent="addReceta">
            <div class="row my-5">
                <div class="col-md-8">
                    <div class="card comentarioCard shadow-sm">
                        <div class="card-body">
                            <!-- Nombre receta -->
                            <div class="mb-3">
                                <label for="receta_nombre" class="form-label">Nombre de la receta</label>
                                <input v-model="receta.nombre" id="receta_nombre" type="text" class="form-control">
                            </div>
                            <!-- Descripcion corta -->
                            <div class="mb-3">
                                <label class="form-label">Descripcion corta (máximo 80 caracteres)</label>
                                <input v-model.trim="receta.descripcion_corta" type="text" class="form-control"
                                    @input="limitarLongitud">
                            </div>
                            <!-- Ingredientes -->
                            <div class="mb-3">
                                <label class="form-label">Ingredientes</label>
                                <!-- Configuracion de ingredientes -->
                                <div class="row ingredientes">

                                </div>
                                <!-- Selector de ingredeientes -->
                                <Dropdown v-model="ingredientes_receta.ingrediente_id" :options="ingredientes"
                                    optionValue="id" optionLabel="nombre" placeholder="Selecciona los ingredientes"
                                    checkmark filter class="w-100"
                                    @change="ingrediente_selection(ingredientes_receta.ingrediente_id)" />
                            </div>
                            <!-- Contenido receta -->
                            <div class="mb-3">
                                <label class="form-label">Pasos de la receta</label>
                                <TextEditorComponent v-model="receta.descripcion" />
                            </div>
                            <button type="submit" class="btn colorBoton mt-4 mb-4">Añadir receta</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card comentarioCard shadow-sm">
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
let receta_id = 0;

// Definir un objeto para almacenar las propiedades de cada ingrediente seleccionado
const ingredientesSeleccionados = ref([]);

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
                confirmButton.classList.add('btn', 'colorBoton2');
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
        // Crear un objeto para almacenar las propiedades del ingrediente seleccionado
        const nuevoIngrediente = { id: id_selection, cantidad: '', unidad: '' };

        // Verificar si el ingrediente ya ha sido seleccionado previamente
        const ingredienteExistenteIndex = ingredientesSeleccionados.value.findIndex(ingrediente => ingrediente.id === id_selection);

        if (ingredienteExistenteIndex === -1) {
            // Si el ingrediente no ha sido seleccionado previamente, agregarlo a la lista
            ingredientesSeleccionados.value.push(nuevoIngrediente);
        } else {
            // Si el ingrediente ya ha sido seleccionado, mostrar una alerta
            swal({
                icon: 'warning',
                title: 'Ingrediente ya seleccionado',
                text: 'Este ingrediente ya ha sido añadido a la receta.'
            });
            return;
        }

        // Insertar el nuevo ingrediente en la lista de ingredientes seleccionados
        const ingredientContainer = document.querySelector('.ingredientes');

        // Encontrar el ingrediente seleccionado en la lista de ingredientes
        const selectedIngredient = ingredientes.value.find(ingrediente => ingrediente.id === id_selection);

        // Crear un contenedor flex para el nombre y los inputs de cantidad y unidad de medida
        const flexContainer = document.createElement('div');
        flexContainer.setAttribute('class', 'col-6 d-flex align-items-center'); // Alinea los elementos verticalmente

        // Insertar el nombre del ingrediente en el contenedor flex
        const nombreElement = document.createElement('p');
        nombreElement.textContent = selectedIngredient.nombre;
        flexContainer.appendChild(nombreElement);
        nombreElement.setAttribute('class', 'nombreIng');

        // Crear inputs para la cantidad y la unidad de medida
        const cantidadInput = document.createElement('input');
        cantidadInput.setAttribute('type', 'number');
        cantidadInput.setAttribute('min', '1');
        cantidadInput.setAttribute('class', 'form-control ml-2'); // Margen izquierdo para separar del nombre
        cantidadInput.setAttribute('placeholder', 'Cantidad');
        cantidadInput.addEventListener('input', event => {
            nuevoIngrediente.cantidad = event.target.value;
        });

        const unidadSelect = document.createElement('select');
        unidadSelect.setAttribute('class', 'form-select ml-2'); // Margen izquierdo para separar del input de cantidad
        // Opción predeterminada para simular un placeholder
        const defaultOption = document.createElement('option');
        defaultOption.text = 'Unidad medida';
        defaultOption.disabled = true;
        defaultOption.selected = true;

        // Opciones de unidades
        const options = [
            { value: 'g', text: 'Gramos' },
            { value: 'kg', text: 'Kilos' },
            { value: 'ml', text: 'Mililitros' },
            { value: 'L', text: 'Litros' },
            { value: 'unidades', text: 'Unidades' }
        ];

        // Agregar la opción predeterminada seguida de las opciones de unidades
        unidadSelect.appendChild(defaultOption);
        options.forEach(option => {
            const optionElement = document.createElement('option');
            optionElement.value = option.value;
            optionElement.text = option.text;
            unidadSelect.appendChild(optionElement);
        });

        unidadSelect.addEventListener('change', event => {
            nuevoIngrediente.unidad = event.target.value;
        });

        // Crear el elemento span
        const spanElement = document.createElement('span');
        spanElement.setAttribute('class', 'delete-icon');
        spanElement.addEventListener('click', event => {
            deleteIngredienteRecetas_nuevos(nuevoIngrediente.id);
            // Eliminar visualmente el contenedor del ingrediente
            flexContainer.remove();
        });

        // Crear el elemento SVG dentro del span
        const svgElement = document.createElementNS("http://www.w3.org/2000/svg", "svg");
        svgElement.setAttribute("width", "25px");
        svgElement.setAttribute("height", "25px");
        svgElement.setAttribute("viewBox", "0 0 24 24");
        svgElement.setAttribute("fill", "none");
        svgElement.setAttribute("xmlns", "http://www.w3.org/2000/svg");
        svgElement.innerHTML = `
            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
            <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
            <g id="SVGRepo_iconCarrier">
                <path
                    d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6"
                    stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                </path>
            </g>`;

        // Agregar el elemento SVG al span
        spanElement.appendChild(svgElement);

        // Insertar los inputs en el contenedor flex
        flexContainer.appendChild(cantidadInput);
        flexContainer.appendChild(unidadSelect);
        flexContainer.appendChild(spanElement);

        // Insertar el contenedor flex en el contenedor principal
        ingredientContainer.appendChild(flexContainer);
    }
}

// Definir la función para eliminar un ingrediente del array
function deleteIngredienteRecetas_nuevos(id) {
    // Encontrar el índice del ingrediente en el array
    const index = ingredientesSeleccionados.value.findIndex(ingrediente => ingrediente.id === id);

    // Si se encuentra el ingrediente en el array, eliminarlo
    if (index !== -1) {
        ingredientesSeleccionados.value.splice(index, 1); // Elimina el elemento en el índice "index"
        // Aquí puedes agregar cualquier otra lógica que necesites después de eliminar el ingrediente
    }
}

// Añade la receta y muestra una alerta en función de la respuesta de la API
function addReceta() {

    swal({
        title: 'Procesando...',
        text: 'Por favor, espera un momento.',
        allowOutsideClick: false,
        allowEscapeKey: false,
        showConfirmButton: false,
        showCancelButton: false,
        showCloseButton: false,
        onBeforeOpen: () => {
            swal.showLoading();
        }
    });

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
            // Acceder al ID de la receta recién creada
            const receta_id = response.data.id;
            let ingredientPromises = [];

            ingredientesSeleccionados.value.forEach(ingrediente => {
                const ingrediente_receta = ref({});

                ingrediente_receta.value.receta_id = receta_id;
                ingrediente_receta.value.ingrediente_id = ingrediente.id;
                ingrediente_receta.value.cantidad = ingrediente.cantidad;
                ingrediente_receta.value.unidad = ingrediente.unidad;

                console.log(ingrediente_receta);
                ingredientPromises.push(
                    axios.post('/api/ingredientes/receta/', ingrediente_receta.value)
                );
            });

            // Esperar a que todas las promesas se resuelvan
            return Promise.all(ingredientPromises);
        })
        .then(() => {
            // Cerrar la alerta de carga
            swal.close();

            // Mostrar la alerta de éxito
            swal({
                icon: 'success',
                title: 'Receta añadida correctamente'
            })
                .then(() => {
                    // Redireccionar a la página después de cerrar la alerta
                    router.push({ name: 'recetasAdmin.index' });
                });
        })
        .catch(error => {
            // Cerrar la alerta de carga
            swal.close();

            swal({
                icon: 'error',
                title: 'No se ha añadido la receta'
            });
        });
}

// Método para limitar la longitud del texto
function limitarLongitud() {
    const maxLength = 80; // Longitud máxima permitida
    const spacesCount = (receta.value.descripcion_corta.match(/ /g) || []).length; // Contar espacios en blanco
    const currentLength = receta.value.descripcion_corta.length + spacesCount; // Longitud actual del texto incluyendo los espacios

    // Verificar si la longitud actual supera la máxima permitida
    if (currentLength > maxLength) {
        // Recortar el texto para que no exceda la longitud máxima
        receta.value.descripcion_corta = receta.value.descripcion_corta.slice(0, maxLength - spacesCount);
    }
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

.nombreIng {
    margin-bottom: 0px;
}
</style>