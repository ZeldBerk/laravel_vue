<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="contenedorHEADER">
            <router-link to="/" class="navbar-brand logoRoute">
                <svg xmlns="http://www.w3.org/2000/svg" width="90" height="90" viewBox="0 0 100 100">
                    <image href="../../images/ElClubDeLaOllaSVG.svg" width="70" height="70" />
                </svg>
            </router-link>
            <div class="pageTitle">
                <span class="title">El Club de la Olla</span>
            </div>
            <a class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </a>
            <div class="collapse navbar-collapse desplegableIdiomas" id="navbarSupportedContent">
                <ul class="navbar-nav mt-2 mt-lg-0 me-auto mb-2 mb-lg-0">
                    <LocaleSwitcher />
                </ul>

                <ul class="navbar-nav mt-2 mt-lg-0 ms-auto">
                    <li class="nav-item d-flex align-items-center">
                        <router-link :to="{ name: 'recetas.index' }" class="nav-link textoHeader"><span>Recetario</span></router-link>
                    </li>
                    <template v-if="!user?.name">
                        <li class="nav-item">
                            <router-link class="nav-link iconoNav" to="/login"><svg class="iconoHover" fill="#000000"
                                    viewBox="-3.2 -3.2 22.40 22.40" xmlns="http://www.w3.org/2000/svg">
                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                    <g id="SVGRepo_iconCarrier">
                                        <path
                                            d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z"
                                            fill="#030708"></path>
                                        <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z"
                                            fill="#030708"></path>
                                    </g>
                                </svg></router-link>
                        </li>
                    </template>
                    <li v-if="user?.name" class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle iconoNav" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <svg class="iconoHover" fill="#000000" viewBox="-3.2 -3.2 22.40 22.40"
                                xmlns="http://www.w3.org/2000/svg">
                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                <g id="SVGRepo_iconCarrier">
                                    <path
                                        d="M8 7C9.65685 7 11 5.65685 11 4C11 2.34315 9.65685 1 8 1C6.34315 1 5 2.34315 5 4C5 5.65685 6.34315 7 8 7Z"
                                        fill="#030708"></path>
                                    <path d="M14 12C14 10.3431 12.6569 9 11 9H5C3.34315 9 2 10.3431 2 12V15H14V12Z"
                                        fill="#030708"></path>
                                </g>
                            </svg>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <!-- Redireccionara a la pagina para que el usuario vea sus datos personales -->
                            <li><router-link class="dropdown-item" to="/user">Ver Perfil</router-link></li>
                            <!-- Redireccionara a la pagina de plan semanal -->
                            <li><router-link to="/user/planSemanal" class="dropdown-item">Plan Semanal</router-link>
                            </li>
                            <!-- Redireccionara a la pagina de Favoritos del usuario -->
                            <li><router-link to="/user/favoritos" class="dropdown-item">Favoritos</router-link></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="javascript:void(0)" @click="logout">Cerrar Sessión</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script setup>
import { useStore } from "vuex";
import useAuth from "@/composables/auth";
import { computed } from "vue";
import LocaleSwitcher from "../components/LocaleSwitcher.vue";

const store = useStore();
const user = computed(() => store.getters["auth/user"])
const { processing, logout } = useAuth();
</script>
