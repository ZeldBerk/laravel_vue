<template>
    <div class="card comentarioCard">
        <div class="card-header bg-transparent">
            <h5 class="float-start">Perfil</h5>
        </div>
        <div class="card-body">
            <form @submit.prevent="submitForm">
                <div class="mb-3">
                    <label for="name" class="form-label">Nombre</label>
                    <input type="text" v-model="profile.name" class="form-control" id="name">
                    <div class="text-danger mt-1">
                        {{ errors.name }}
                    </div>
                    <div class="text-danger mt-1">
                        <div v-for="message in validationErrors?.name">
                            {{ message }}
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" v-model="profile.email" class="form-control" id="email">
                    <div class="text-danger mt-1">
                        {{ errors.email }}
                    </div>
                    <div class="text-danger mt-1">
                        <div v-for="message in validationErrors?.email">
                            {{ message }}
                        </div>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Contraseña</label>
                    <input type="password" v-model="profile.password" class="form-control" id="password" placeholder="Rellena esta campo para actualizar tu contraseña">
                    <div class="text-danger mt-1">
                        <div v-for="message in validationErrors?.password">
                            {{ message }}
                        </div>
                    </div>
                </div>
                <div class="mb-3 mt-4">
                    <button :disabled="isLoading" class="btn colorBoton">
                        <div v-show="isLoading" class=""></div>
                        <span v-if="isLoading">Procesando...</span>
                        <span v-else>Actualizar</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script setup>
import { onMounted, reactive, watchEffect } from "vue";
import { useForm, useField, defineRule } from "vee-validate";
import { required, min } from "@/validation/rules";
import useProfile from "@/composables/profile";
import axios from "axios";

defineRule('required', required);
defineRule('min', min);

const schema = {
    name: 'required|min:3',
    email: 'required',
    password: 'required|min:6', 
};

// Crea un contexto de formulario con el esquema de validación
const { validate, errors } = useForm({ validationSchema: schema });

// Define los campos reales para la validación
const { value: name } = useField('name', null, { initialValue: '' });
const { value: email } = useField('email', null, { initialValue: '' });
const { value: password } = useField('password', null, { initialValue: '' }); 

const { profile: profileData, getProfile, updateProfile, validationErrors, isLoading } = useProfile();

const profile = reactive({
    name,
    email,
    password, // Añade la contraseña al objeto reactiva
});


function submitForm() {
    validate().then(form => { if (form.valid) updateProfile(profile) });
}

onMounted(() => {
    getProfile();
});


watchEffect(() => {
    profile.name = profileData.value.name;
    profile.email = profileData.value.email;
    profile.password = profileData.value.password;
});
</script>
