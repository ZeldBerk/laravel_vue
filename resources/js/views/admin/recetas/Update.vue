<template>
    <div id="recetas" class="container">
        <div class="d-flex justify-content-between pb-2 mb-2">
            <h5 class="card-title">Actualizar receta</h5>
        </div>
        <form @submit.prevent="saveReceta">
            <div class="row my-5">
                <div class="col-md-8">
                    <div class="card comentarioCard shadow-sm">
                        <div class="card-body">
                            <!-- Nombre receta -->
                            <div class="mb-3">
                                <label for="receta_nombre" class="form-label">Nombre de la receta:</label>
                                <input v-model="receta.nombre" id="receta_nombre" type="text" class="form-control">
                            </div>
                            <!-- Descripcion corta -->
                            <div class="mb-3">
                                <label class="form-label">Descripcion corta (máximo 80 caracteres)</label>
                                <input id="descripcion_corta" v-model.trim="receta.descripcion_corta" type="text"
                                    class="form-control" @input="limitarLongitud">
                            </div>
                            <!-- Ingredientes -->
                            <div class="mb-3">
                                <label class="form-label">Ingredientes</label>
                                <div class="row ingredientes">
                                    <!-- Iterar sobre los ingredientes de la receta -->
                                    <div v-for="(ingrediente, index) in ingredientes_receta" :key="index"
                                        class="col-6 d-flex align-items-center">
                                        <!-- Mostrar nombre del ingrediente -->
                                        <p class="nombreIng">{{ ingrediente.nombre }}</p>
                                        <!-- Campo de entrada para cantidad -->
                                        <input v-model="ingrediente.cantidad" type="number" min="1"
                                            class="form-control ml-2" placeholder="Cantidad">
                                        <!-- Campo de selección para unidad de medida -->
                                        <select v-model="ingrediente.unidad" class="form-select ml-2">
                                            <option value="g">Gramos</option>
                                            <option value="kg">Kilos</option>
                                            <option value="ml">Mililitros</option>
                                            <option value="L">Litros</option>
                                            <option value="unidades">Unidades</option>
                                        </select>
                                        <span class="delete-icon"
                                            @click.stop="deleteIngredienteRecetas(ingrediente.id)">
                                            <svg width="25px" height="25px" viewBox="0 0 24 24" fill="none"
                                                xmlns="http://www.w3.org/2000/svg" stroke="#000000">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path
                                                        d="M18 6L17.1991 18.0129C17.129 19.065 17.0939 19.5911 16.8667 19.99C16.6666 20.3412 16.3648 20.6235 16.0011 20.7998C15.588 21 15.0607 21 14.0062 21H9.99377C8.93927 21 8.41202 21 7.99889 20.7998C7.63517 20.6235 7.33339 20.3412 7.13332 19.99C6.90607 19.5911 6.871 19.065 6.80086 18.0129L6 6M4 6H20M16 6L15.7294 5.18807C15.4671 4.40125 15.3359 4.00784 15.0927 3.71698C14.8779 3.46013 14.6021 3.26132 14.2905 3.13878C13.9376 3 13.523 3 12.6936 3H11.3064C10.477 3 10.0624 3 9.70951 3.13878C9.39792 3.26132 9.12208 3.46013 8.90729 3.71698C8.66405 4.00784 8.53292 4.40125 8.27064 5.18807L8 6"
                                                        stroke="#000000" stroke-width="2" stroke-linecap="round"
                                                        stroke-linejoin="round"></path>
                                                </g>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                                <!-- Selector de ingredeientes -->
                                <Dropdown v-model="ingredeientes_nuevos.ingrediente_id" :options="ingredientes"
                                    optionValue="id" optionLabel="nombre" placeholder="Selecciona los ingredientes"
                                    checkmark filter class="w-100"
                                    @change="ingrediente_selection(ingredeientes_nuevos.ingrediente_id)" />
                            </div>
                            <!-- Contenido receta -->
                            <div class="mb-3">
                                <label for="receta_descripcion" class="form-label">Pasos de la receta</label>
                                <TextEditorComponent v-model="receta.descripcion" />
                            </div>
                            <button type="submit" class="btn colorBoton mt-4 mb-4">Actualizar receta</button>
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
                                <Dropdown v-model="receta.categoria_id" id="receta_categoria_id" :options="categorias"
                                    optionValue="id" optionLabel="nombre" placeholder="Selecciona la categoria"
                                    checkmark class="w-100" />
                            </div>
                            <!-- Imagen receta -->
                            <div class="mb-3">
                                <label for="imagen" class="form-label">Imagen</label>
                                <DropZone v-model="receta.thumbnail" id="imagen" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import { ref, onMounted, reactive, inject } from "vue";
import { useForm, useField } from "vee-validate";
import { useRoute } from "vue-router";
import { useRouter } from 'vue-router';
import * as yup from 'yup';
import DropZone from "@/components/DropZone.vue";
import TextEditorComponent from "@/components/TextEditorComponent.vue";
import axios from "axios";

// Crear esquema de validacion de la receta
const schema = yup.object({
    nombre: yup.string().required().label('Nombre'),
})

const router = useRouter()
const { validate, errors } = useForm({ validationSchema: schema })
const route = useRoute()
const swal = inject('$swal');
const categorias = ref();
const ingredientes_receta = ref();
const ingredeientes_nuevos = ref({}); // Ingrediente para pasar a la funcion ingrediente_selection
const ingredientes = ref(); // Ingredeintes del desplegable 
const ingredientesSeleccionados = ref([]); // Objeto para almacenar las propiedades de cada ingrediente seleccionado

// Campos del formulario de receta
const { value: nombre } = useField('nombre', null, { initialValue: '' });
const { value: descripcion_corta } = useField('descripcion_corta', null, { initialValue: '' });
const { value: descripcion } = useField('descripcion', null, { initialValue: '' });
const { value: raciones } = useField('raciones', null, { initialValue: '' });
const { value: tiempo_preparacion } = useField('tiempo_preparacion', null, { initialValue: '' });
const { value: user_id } = useField('user_id', null, { initialValue: '' });
const { value: categoria_id } = useField('categoria_id', null, { initialValue: '' });

// Objeto reactivo para almacenar los datos de la receta
const receta = reactive({
    nombre,
    descripcion_corta,
    descripcion,
    raciones,
    tiempo_preparacion,
    user_id,
    categoria_id
})

// Carga de las categorias en el desplegable
onMounted(() => {
    axios.get('/api/categorias')
        .then(response => {
            categorias.value = response.data;
        });
});

// Mostrar los datos actuales de la receta
onMounted(() => {
    axios.get('/api/recetas/' + route.params.id)
        .then(response => {
            receta.nombre = response.data.nombre;
            receta.descripcion_corta = response.data.descripcion_corta;
            receta.descripcion = response.data.descripcion;
            receta.raciones = response.data.raciones;
            receta.tiempo_preparacion = response.data.tiempo_preparacion;
            receta.user_id = response.data.user_id;
            receta.categoria_id = response.data.categoria_id;
            receta.thumbnail = response.data.media[0].original_url;
        })
        .catch(function (error) {
            console.log(error);
        });
})

// Carga de los ingredientes asociados a la receta
onMounted(() => {
    axios.get('/api/ingredientes/receta/' + route.params.id)
        .then(response => {
            ingredientes_receta.value = response.data;
            console.log(ingredientes_receta);
        })
});

// Cargar todos los ingredientes
onMounted(() => {
    axios.get('/api/ingredientes')
        .then(response => {
            ingredientes.value = response.data;
        });
});

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
        // Crear un objeto para almacenar las propiedades del ingrediente seleccionado
        const nuevoIngrediente = { id: id_selection, cantidad: '', unidad: '' };

        // Verificar si el ingrediente ya ha sido seleccionado previamente
        const ingredienteExistenteIndex = ingredientesSeleccionados.value.findIndex(ingrediente => ingrediente.id === id_selection);

        if (ingredienteExistenteIndex === -1) {
            // Si el ingrediente no ha sido seleccionado previamente, agregarlo a la lista
            ingredientesSeleccionados.value.push(nuevoIngrediente);
        } else {
            // Si el ingrediente ya ha sido seleccionado, no hacer nada
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

        // Crear un contenedor flex 
        const flexContainer = document.createElement('div');
        flexContainer.setAttribute('class', 'col-6 d-flex align-items-center');

        // Insertar el nombre del ingrediente en el contenedor flex
        const nombreElement = document.createElement('p');
        nombreElement.textContent = selectedIngredient.nombre;
        flexContainer.appendChild(nombreElement);
        nombreElement.setAttribute('class', 'nombreIng');

        // Crear inputs para la cantidad y la unidad de medida
        const cantidadInput = document.createElement('input');
        cantidadInput.setAttribute('type', 'number');
        cantidadInput.setAttribute('min', '1');
        cantidadInput.setAttribute('class', 'form-control ml-2');
        cantidadInput.setAttribute('placeholder', 'Cantidad');
        cantidadInput.addEventListener('input', event => {
            nuevoIngrediente.cantidad = event.target.value;
        });

        const unidadSelect = document.createElement('select');
        unidadSelect.setAttribute('class', 'form-select ml-2');
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

// Funcion para eliminar un ingrediente de la receta
function deleteIngredienteRecetas(ingredienteId) {
    // Realizar la petición para eliminar el ingrediente
    axios.delete('/api/ingredientes/receta/delete/' + ingredienteId)
        .then(response => {
            // Eliminar el ingrediente de la lista ingredientes_receta
            ingredientes_receta.value = ingredientes_receta.value.filter(ingrediente => ingrediente.id !== ingredienteId);

            // Mostrar una alerta de éxito
            swal({
                icon: 'success',
                title: 'Ingrediente eliminado correctamente'
            });
        })
        .catch(error => {
            // Mostrar una alerta de error si la petición falla
            swal({
                icon: 'error',
                title: 'No se pudo eliminar el ingrediente'
            });
        });
}

// Función para eliminar un ingrediente del array
function deleteIngredienteRecetas_nuevos(id) {
    // Encontrar el índice del ingrediente en el array
    const index = ingredientesSeleccionados.value.findIndex(ingrediente => ingrediente.id === id);

    // Si se encuentra el ingrediente en el array, eliminarlo
    if (index !== -1) {
        ingredientesSeleccionados.value.splice(index, 1); // Elimina el elemento del array
    }
}

// Funcio para guardar los cambios en la receta y los ingredientes modificados
function saveReceta() {
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

    validate().then(form => {
        if (form.valid) {
            let serialized = new FormData();
            for (let item in receta) {
                if (receta.hasOwnProperty(item)) {
                    serialized.append(item, receta[item]);
                }
            }

            // Actualizar la receta
            axios.post('/api/recetas/update/' + route.params.id, serialized, {
                headers: {
                    "content-type": "multipart/form-data"
                }
            })
                .then(response => {
                    // Crear un array de promesas para actualizar los ingredientes
                    let ingredientPromises = [];

                    ingredientes_receta.value.forEach(ingrediente => {
                        ingredientPromises.push(
                            axios.put('/api/ingredientes/receta/update/' + ingrediente.id, ingrediente)
                        );
                        console.log(ingrediente.id);
                    });

                    // Comprobar si hay ingredientes nuevos añadidos y guardarlos
                    if (ingredientesSeleccionados) {
                        ingredientesSeleccionados.value.forEach(ingrediente => {
                            const ingrediente_receta = ref({});

                            ingrediente_receta.value.receta_id = route.params.id;
                            ingrediente_receta.value.ingrediente_id = ingrediente.id;
                            ingrediente_receta.value.cantidad = ingrediente.cantidad;
                            ingrediente_receta.value.unidad = ingrediente.unidad;

                            ingredientPromises.push(
                                axios.post('/api/ingredientes/receta/', ingrediente_receta.value)
                            );
                        });
                    }

                    // Esperar a que todas las promesas se resuelvan
                    return Promise.all(ingredientPromises);
                })
                .then(() => {
                    // Cerrar la alerta de carga
                    swal.close();

                    // Mostrar la alerta de éxito
                    swal({
                        icon: 'success',
                        title: 'Receta actualizada correctamente'
                    })
                        .then(() => {
                            // Redireccionar a la página después de cerrar la alerta
                            router.push({ name: 'recetasAdmin.index' });
                        });
                })
                .catch(error => {
                    // Cerrar la alerta de carga
                    swal.close();

                    // Mostrar la alerta de error
                    swal({
                        icon: 'error',
                        title: 'No se ha podido actualizar la receta'
                    });
                });
        }
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

// Filtro para formatear la cantidad
function formatCantidad(cantidad) {
    const entero = Math.floor(cantidad);
    const decimal = cantidad - entero;

    // Si no hay parte decimal, solo mostrar el número entero
    if (decimal === 0) {
        return entero;
    } else {
        // Si hay parte decimal, formatear con coma en lugar de punto
        return cantidad.toLocaleString('es', { minimumFractionDigits: 2, maximumFractionDigits: 2 }).replace('.', ',');
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