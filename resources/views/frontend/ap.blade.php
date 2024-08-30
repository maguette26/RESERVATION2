@extends('frontend.layout')

@section('content')

<div class="container-fluid about-section" data-aos="fade-up">
    <div class="container py-5">
        <h2 class="about-title text-center mb-5">À propos de nous</h2>
        <div class="row align-items-center">
            <div class="col-lg-6 mb-4 mb-lg-0">
                <img src="img/ordi.png" class="img-fluid rounded about-image animate__animated animate__fadeInLeft" alt="Événement en ligne">
            </div>
            <div class="col-lg-6">
                <p class="about-text">
                    Bienvenue sur SenReserv Events, notre plateforme de réservation en ligne, où nous facilitons la gestion et la réservation d'événements pour nos utilisateurs. Nous offrons une solution complète pour planifier des événements tels que des concerts, des conférences, et des expositions d'art. Nous sommes dédiés à rendre votre expérience aussi fluide et agréable que possible.
                </p>
                <p class="about-text">
                    Notre mission est de simplifier l'expérience de réservation d'événements en offrant un système convivial et efficace. Avec des fonctionnalités adaptées à chaque type d'événement, nous nous efforçons de rendre la gestion des réservations aussi fluide que possible. Chaque détail est pris en compte pour vous offrir un service de qualité supérieure.
                </p>
            </div>
        </div>
        <div class="row align-items-center mt-5">
            <div class="col-lg-6 order-lg-2 mb-4 mb-lg-0">
                <img src="img/ordi.jpeg" class="img-fluid rounded about-image animate__animated animate__fadeInRight" alt="Système convivial">
            </div>
            <div class="col-lg-6 order-lg-1">
                <p class="about-text">
                    Notre équipe est composée de professionnels passionnés par l'événementiel et la technologie. Nous travaillons sans relâche pour améliorer notre plateforme et offrir la meilleure expérience possible à nos utilisateurs. Notre objectif est de vous offrir un service exceptionnel pour chaque réservation, qu'il s'agisse d'un grand concert, d'une conférence importante ou d'une exposition d'art captivante.
                </p>
                <p class="about-text">
                    Nous croyons en l'innovation et en l'amélioration continue. En utilisant les dernières technologies et en restant à l'écoute de vos besoins, nous nous engageons à vous fournir des solutions qui répondent parfaitement à vos attentes. Merci de faire confiance à SenReserv Events pour la gestion de vos événements.
                </p>
            </div>
        </div>
    </div>
</div>

@endsection

<style>
    .about-text {
        margin-bottom: 20px;
        font-size: 1.2rem;
        line-height: 1.8;
        color: #000; /* Texte en noir */
    }

    .about-image {
        display: block;
        margin: 0 auto;
        max-height: 550px; /* Ajuste la hauteur maximale des images */
        width: 70%; /* Ajuste la largeur tout en conservant le ratio d'aspect */
        border-radius: 10px; /* Bordure arrondie */
        object-fit: cover; /* Assure que les images couvrent le conteneur sans déformer le ratio */
    }

    .about-title {
        font-size: 4rem; /* Taille plus grande pour le titre */
        font-weight: bold;
        color: #010a13;
        margin-bottom: 40px;
    }

    /* Animation pour les images */
    .animate__animated {
        animation-duration: 1.5s;
        animation-fill-mode: both;
    }
</style>
