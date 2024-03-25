<template>
    <div class="contenedorHOME">
        <div id="carouselExampleIndicators" class="carousel slide marginsDelCarrousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                    aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                    aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3"
                    aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4"
                    aria-label="Slide 5"></button>
            </div>
            <button class="BotonCarrousel">Recetario</button>
            <div class="carousel-inner">
                <div class="carousel-item active" data-bs-interval="10000">
                    <img src="../../../images/carrousel.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item" data-bs-interval="2000">
                    <img src="../../../images/carrusel2.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../../../images/carrusel3.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../../../images/carruselopcional.png" class="d-block w-100" alt="...">
                </div>
                <div class="carousel-item">
                    <img src="../../../images/carruselopcional2.png" class="d-block w-100" alt="...">
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
                data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


        <div class="button-container">
            <div class="button-wrapper">
                <a href="#" class="button">
                    <img src="../../../images/sopa-de-pasta.jpg" alt="Botón 1">
                </a>
                <div class="button-text">
                    <span>¡Empieza con buen sabor!</span>
                    <span>Para abrir mesa</span>
                </div>
            </div>
            <div class="button-wrapper">
                <a href="#" class="button">
                    <img src="../../../images/Pollo.png" alt="Botón 2">
                </a>
                <div class="button-text">
                    <span>¡Continua disfrutando!</span>
                    <span>Segundos platos</span>
                </div>
            </div>
            <div class="button-wrapper">
                <a href="#" class="button">
                    <img src="../../../images/dolci_freddi_maggio.jpg" alt="Botón 3">
                </a>
                <div class="button-text">
                    <span>¡Final feliz!</span>
                    <span>Postres dulzones</span>
                </div>
            </div>
        </div>


    </div>
</template>

<script setup>
</script>

<style scoped></style>
