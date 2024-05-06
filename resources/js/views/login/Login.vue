<template>
    <diV class="colorFondo">
        <div class="container">
            <div class="row justify-content-center py-4">
                <div class="col-md-6">
                    <div class="card comentarioCard shadow-sm">
                        <div class="card-body">
                            <form @submit.prevent="submitLogin">
                                <div class="">
                                    <!-- Email -->
                                    <div class="mb-3">
                                        <label for="email" class="form-label">{{ $t('Email') }}</label>
                                        <input v-model="loginForm.email" id="email" type="email" class="form-control"
                                            required autofocus autocomplete="username">
                                        <!-- Validation Errors -->
                                        <div class="text-danger mt-1">
                                            <div v-for="message in validationErrors?.email">
                                                {{ message }}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Password -->
                                    <div class="mb-4">
                                        <label for="password" class="form-label">
                                            {{ $t('Password') }}
                                        </label>
                                        <input v-model="loginForm.password" id="password" type="password"
                                            class="form-control" required autocomplete="current-password">
                                        <!-- Validation Errors -->
                                        <div class="text-danger-600 mt-1">
                                            <div v-for="message in validationErrors?.password">
                                                {{ message }}
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Remember me -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember"
                                            v-model="loginForm.remember" id="flexCheckIndeterminate">
                                        <label class="form-check-label" for="flexCheckIndeterminate">
                                            <span>Recuerdame</span>
                                        </label>
                                    </div>

                                    <!-- Buttons -->
                                    <div class="flex items-center justify-end mt-4 mb-4">
                                        <button class="btn colorBoton" :class="{ 'opacity-25': processing }"
                                            :disabled="processing">
                                            <span>Iniciar Session</span>
                                        </button>
                                    </div>
                                </div>
                                <router-link :to="{ name: 'auth.forgot-password' }"><span class="colorMarron">Has olvidado tu contraseña?</span></router-link>
                                <router-link class="nav-link" to="/register">
                                    <p>¿No tienes cuenta? <span class="colorMarron">Crea una nueva ahora</span></p>
                                </router-link>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </diV>

</template>

<script setup>

import useAuth from '@/composables/auth'

const { loginForm, validationErrors, processing, submitLogin } = useAuth();

</script>
