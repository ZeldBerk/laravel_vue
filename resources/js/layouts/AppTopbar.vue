<template>
    <div class="layout-topbar">
        <router-link to="/" class="navbar-brand logoRoute m-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100">
                <image href="../../images/ElClubDeLaOllaSVG.svg" width="70" height="70" />
            </svg>
        </router-link>
        <a class="navbar-toggler pageTitle" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
        </a>

        <button class="p-link layout-menu-button layout-topbar-button" @click="onMenuToggle()">
            <i class="pi pi-bars"></i>
        </button>

        <button class="p-link layout-topbar-menu-button layout-topbar-button" @click="onTopBarMenuButton()">
            <i class="pi pi-ellipsis-v"></i>
        </button>

        <div class="layout-topbar-menu">

            <li class="nav-item d-flex align-items-center">
                <router-link :to="{ name: 'recetas.index' }"
                    class="nav-link textoHeader"><span>Recetario</span></router-link>
            </li>
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
                    <li><router-link class="dropdown-item" to="/admin">Ver Perfil</router-link></li>
                    <!-- Redireccionara a la pagina de plan semanal -->
                    <li><router-link to="/admin/planSemanal" class="dropdown-item">Plan Semanal</router-link>
                    </li>
                    <!-- Redireccionara a la pagina de Favoritos del usuario -->
                    <li><router-link to="/admin/favoritos" class="dropdown-item">Favoritos</router-link></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="javascript:void(0)" @click="logout">Cerrar Sessión</a>
                    </li>
                </ul>
            </li>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted, onBeforeUnmount } from 'vue';
import { useLayout } from '../composables/layout';
import { useStore } from 'vuex';
import useAuth from "@/composables/auth";

const { onMenuToggle } = useLayout();
const store = useStore();
const user = computed(() => store.state.auth.user)
const { processing, logout } = useAuth();

const topbarMenuActive = ref(false);

const onTopBarMenuButton = () => {
    topbarMenuActive.value = !topbarMenuActive.value;
};

const topbarMenuClasses = computed(() => {
    return {
        'layout-topbar-menu-mobile-active': topbarMenuActive.value
    };
});




</script>

<style lang="scss" scoped>
.layout-topbar-button-c,
.layout-topbar-button-c:hover {
    width: auto;
    background-color: rgb(255, 255, 255, 0);
    border: 0;
    border-radius: 0%;
    padding: 1em;
}
</style>
