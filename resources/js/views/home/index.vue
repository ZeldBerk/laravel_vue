<template>
    <div class="container contenedorHOME">
        <div id="carouselExampleIndicators" class="carousel slide marginsDelCarrousel" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="4" aria-label="Slide 5"></button>
            </div>
            <div class="d-flex justify-content-center mb-3">
                <button class="BotonCarrousel">Recetario</button>
            </div>
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
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="row justify-content-center marginCuadradoPulsables">
            <div class="col-md-4">
                <div class="button-wrapper">
                    <a href="#" class="button">
                        <img src="../../../images/sopa-de-pasta.jpg" alt="Botón 1">
                    </a>
                    <div class="button-text">
                        <span class="primeraLinea">¡Empieza con buen sabor!</span>
                        <span class="segundaLinea">Para abrir mesa</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="button-wrapper">
                    <a href="#" class="button">
                        <img src="../../../images/Pollo.jpg" alt="Botón 2">
                    </a>
                    <div class="button-text">
                        <span class="primeraLinea">¡Continua disfrutando!</span>
                        <span class="segundaLinea">Segundos platos</span>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="button-wrapper">
                    <a href="#" class="button">
                        <img src="../../../images/dolci_freddi_maggio.jpg" alt="Botón 3">
                    </a>
                    <div class="button-text">
                        <span class="primeraLinea">¡Final feliz!</span>
                        <span class="segundaLinea">Postres dulzones</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="containerLetras">
                    <span class="LetrasAzules">Sumérgete en el arte de la gastronomía en nuestro rincón culinario.</span>
                    <span class="SegundoTexto mb-2">RECETAS TANTO DULCES COMO SALADAS</span>
                    <span class="TercerTexto">Platos que hemos visto siempre en casa, o los clásicos totalmente renovados. Porque la cocina no deja de ser un juego. Un juego que nos hace disfrutar tanto en su elaboración como después cuando nos sentamos a la mesa para compartir momentos únicos. Ya lo sabemos todos, alrededor de una mesa es donde se toman las mejores decisiones. Donde nos reunimos, discutimos, reímos, y nos emocionamos. Y porque a través de la comida transmitimos nuestro cariño, nuestro amor… Y mucha felicidad.</span>
                </div>
            </div>
        </div>

        <div class="containerRecetasAbuela row">
            <div class="recetasAbuela col-6 col-md-3">
                <div class="imagenAbuela">
                    <span>dfsfsd</span>
                </div>
            </div>
            <div class="recetasAbuela col-6 col-md-3">
                <div class="imagenAbuela">
                    <span>dfsfsd</span>
                </div>
            </div>
            <div class="recetasAbuela col-6 col-md-3">
                <div class="imagenAbuela">
                    <span>dfsfsd</span>
                </div>
            </div>
            <div class="recetasAbuela col-6 col-md-3">
                <div class="imagenAbuela">
                    <span>dfsfsd</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
</script>

<style scoped></style>
