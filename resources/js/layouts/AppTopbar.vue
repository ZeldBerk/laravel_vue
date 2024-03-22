<template>
    <div class="layout-topbar">
        <router-link to="/" class="navbar-brand logoRoute">
            <svg xmlns="http://www.w3.org/2000/svg" width="100"
                height="100" viewBox="0 0 100 100">
                <image href="../../images/ElClubDeLaOllaSVG.svg" width="70" height="70" />
            </svg></router-link>
        <a class="navbar-toggler pageTitle" type="button" data-bs-toggle="collapse"
            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <h1 class="navbar-toggler-icon">El Club de la Olla</h1>
        </a>

        <button class="p-link layout-menu-button layout-topbar-button" @click="onMenuToggle()">
            <i class="pi pi-bars"></i>
        </button>

        <button class="p-link layout-topbar-menu-button layout-topbar-button" @click="onTopBarMenuButton()">
            <i class="pi pi-ellipsis-v"></i>
        </button>

        <div class="layout-topbar-menu">

            <li class="nav-item">
                <router-link to="/" class="nav-link iconoNav" aria-current="page"><svg class="iconoHover" fill="#000000"
                        viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M27 18.039L16 9.501 5 18.039V14.56l11-8.54 11 8.538v3.481zm-2.75-.31v8.251h-5.5v-5.5h-5.5v5.5h-5.5v-8.25L16 11.543l8.25 6.186z">
                            </path>
                        </g>
                    </svg></router-link>
            </li>
            <li class="nav-item">
                <router-link :to="{ name: 'recetas.index' }" class="nav-link iconoNav"><svg class="iconoHover"
                        fill="#000000" viewBox="-10 -10 70.00 70.00" xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                        <g id="SVGRepo_iconCarrier">
                            <path
                                d="M12,39h32V2H12C8.691,2,6,4.691,6,8v34.417C6,45.496,8.691,48,12,48h32v-2H12c-2.168,0-4-1.641-4-3.583C8,40.501,9.757,39,12,39z M36.709,31.706C36.514,31.902,36.257,32,36,32c-0.255,0-0.511-0.097-0.705-0.292l-6.523-6.494l-1.76,1.76l-1.846-1.879l3.153-3.153l8.387,8.349C37.097,30.681,37.099,31.314,36.709,31.706z M16.286,10.007l7.733,7.781l-3.044,3.044L16.23,16C14.568,14.338,14.594,11.637,16.286,10.007z M14.329,30.293l13.024-13.024c-0.034-0.085-0.083-0.163-0.107-0.252c-0.399-1.509-0.322-3.426,1.045-4.777c2.031-2.094,5.497-2.989,6.998-1.505c1.501,1.571,0.596,4.909-1.435,6.916c-1.444,1.428-3.298,1.545-4.8,1.16c-0.104-0.027-0.196-0.081-0.294-0.122L14.743,31.707C14.548,31.902,15.292,32,15.036,32s-0.512-0.098-0.707-0.293C13.938,31.316,13.938,30.684,14.329,30.293z">
                            </path>
                        </g>
                    </svg></router-link>
            </li>
            <template v-if="!user?.name">
                <li class="nav-item">
                    <router-link class="nav-link iconoNav" to="/login">
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
                    </router-link>
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
                    <li><router-link class="dropdown-item" to="/admin">Ver Perfil</router-link></li>
                    <!-- Redireccionara a la pagina de plan semanal -->
                    <li><router-link to="/admin/planSemanal" class="dropdown-item">Plan Semanal</router-link></li>
                    <!-- Redireccionara a la pagina de Favoritos del usuario -->
                    <li><router-link to="/admin/favoritos" class="dropdown-item">Favoritos</router-link></li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li><a class="dropdown-item" href="javascript:void(0)" @click="logout">Cerrar Sessión</a></li>
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
