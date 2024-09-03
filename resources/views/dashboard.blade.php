@extends('layouts.app')

@section('content')

    <div class="container mt-5 d-flex justify-content-center align-items-center" style="min-height: 80vh;">
        <div class="alert alert-info text-center" style="border-radius: 10px; background-color: #e7f3fe; color: #31708f; padding: 20px;">
            <p>You are logged in!</p>
            <h2><i class="fas fa-tachometer-alt"></i> Bienvenue dans le dashboard de l'administrateur</h2>
            <p class="mt-4">
                <strong>L'administrateur supervise</strong> l'ensemble des opérations de la plateforme, garantissant une gestion efficace des réservations, des événements et des utilisateurs. Grâce à une <strong>surveillance attentive</strong> et une <strong>prise de décision rapide</strong>, l'administrateur s'assure que chaque aspect de l'expérience utilisateur est optimisé, de l'organisation des événements à la gestion des demandes de réservation. En collaboration avec l'équipe, il veille à maintenir une plateforme <strong>fonctionnelle et agréable</strong> pour tous.
            </p>
        </div>
    </div>

@endsection
