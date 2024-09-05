@extends('frontend.layout')

@section('content')
<!-- Affichage du message flash -->
@if (session('success'))
<div class="flash-message alert alert-success" role="alert">
    {{ session('success') }}
</div>
@endif

<!-- header -->
<section class="slider_section position-relative">
    <div class="container">
        <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
            <ol class="carousel-indicators">
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"></li>
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"></li>
                <li data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="{{ asset('storage/images/hero.jpg') }}" class="d-block w-100" alt="Concert">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="text-center text-light">
                            <h2>Bienvenue à</h2>
                            <h1>Votre Événement</h1>
                            <p>Découvrez nos offres pour une expérience inoubliable.</p>
                            <a href="#" class="btn btn-primary">Voir les événements</a>
                        </div>
                    </div>
                </div>
                <!-- Slide 2 -->
                <div class="carousel-item">
                    <img src="{{ asset('storage/images/hero.jpg') }}" class="d-block w-100" alt="Conférence">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="text-center text-light">
                            <h2>Explorez</h2>
                            <h1>Nos Services</h1>
                            <p>Nous proposons une gamme variée d'événements pour tous les goûts.</p>
                            <a href="#" class="btn btn-primary">Voir les événements</a>
                        </div>
                    </div>
                </div>
                <!-- Slide 3 -->
                <div class="carousel-item">
                    <img src="{{ asset('storage/images/hero.jpg') }}" class="d-block w-100" alt="Exposition d'art">
                    <div class="carousel-caption d-flex align-items-center justify-content-center">
                        <div class="text-center text-light">
                            <h2>Événements</h2>
                            <h1>À ne pas manquer</h1>
                            <p>Ne ratez pas nos événements exclusifs et offres spéciales.</p>
                            <a href="#" class="btn btn-primary">Voir les événements</a>
                        </div>
                    </div>
                </div>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Précédent</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Suivant</span>
            </a>
        </div>
    </div>
</section>
<!-- End header -->

<!-- Section des événements -->
<section class="container my-5">
    <h2 class="text-center mb-4">Tous les Événements</h2>
    <div class="row">
        @foreach ($events->chunk(2) as $chunk)
            <div class="col-12 mb-4">
                <div class="row">
                    @foreach ($chunk as $event)
                        <div class="col-lg-6 mb-4 animate__animated animate__fadeInUp">
                            <div class="card shadow-sm border-0 h-100" style="border-radius: 12px; overflow: hidden;">
                                <div class="position-relative">
                                    <img src="{{ asset($event->image) }}" class="card-img-top" alt="{{ $event->name }}" style="height: 200px; object-fit: cover;">

                                    <!-- Badge de catégorie -->
                                    <div class="badge bg-primary position-absolute top-0 start-0 m-2 px-3 py-2" style="font-size: 0.8rem;">{{ $event->eventType->categorie }}</div>

                                    <!-- Badge "Rupture de stock" -->
                                    @if($event->isSoldOut())
                                    <div style="position: absolute;
                                    top: 50%;
                                    left: 50%;
                                    transform: translate(-50%, -50%) rotate(-10deg);
                                    padding: 30px 60px;

                                    color: #b12020;
                                    font-size: 64px;
                                    font-weight: bold;
                                    text-transform: uppercase;

                                    border-radius: 6px;

                                    letter-spacing: 5px;
                                    z-index: 20;
                                    display: flex;
                                    align-items: center;
                                    justify-content: center;
                                    text-shadow: 3px 3px 5px rgba(10, 10, 10, 0.6);
                                    opacity: 0.95;
                                    width: 70%;
                                    height: 70%;">
                            SOLD OUT
                        </div>
                                    @endif
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-primary">{{ $event->name }}</h5>
                                    <ul class="list-unstyled mb-4">
                                        <li><i class="fas fa-calendar-alt text-primary"></i> <strong>Date:</strong> {{ $event->date }}</li>
                                        <li><i class="fas fa-map-marker-alt text-primary"></i> <strong>Lieu:</strong> {{ $event->lieu }}</li>
                                        <li><i class="fas fa-clock text-primary"></i> <strong>Heure:</strong> {{ $event->heure }}</li>
                                        <li><i class="fas fa-dollar-sign text-primary"></i> <strong>Prix:</strong> {{ $event->prix }} DH</li>
                                        <li><i class="fas fa-ticket-alt text-primary"></i>
                                            <strong>Tickets disponibles:</strong>
                                            @if($event->isSoldOut())
                                              <span class="text-danger">Rupture de stock</span>
                                            @else
                                               <span class="text-success">{{ $event->nombre_place }} disponibles</span>
                                            @endif
                                        </li>
                                    </ul>

                                    <div class="d-flex justify-content-between align-items-center mt-auto">
                                        @if(!$event->isSoldOut())
                                            <form action="{{ route('cart.store') }}" method="POST" class="d-inline me-2">
                                                @csrf
                                                <input type="hidden" name="event_id" value="{{ $event->id }}">
                                                <div class="mb-3">
                                                    <label for="number_of_places" class="form-label">Nombre de places souhaités</label>
                                                    <input type="number" class="form-control" id="number_of_places" name="number_of_places" min="1" max="{{ $event->nombre_place }}" required>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mt-auto">
                                                    <button type="submit" class="btn btn-primary">Réserver</button>
                                                    <a href="{{ route('event.show', $event->id) }}" class="btn btn-primary ms-4">Voir Détail</a>
                                                </div>
                                            </form>
                                        {{-- @else
                                            <button class="btn btn-secondary me-2" disabled>Événement indisponible</button> --}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</section>
@endsection

@section('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap');

    body {
        font-family: 'Georgia', sans-serif;
    }

    .slider_section {
        padding: 0;
    }

    .carousel-inner {
        height: 100vh;
    }

    .carousel-item {
        height: 100%;
        background: #333;
        color: #fff;
    }

    .carousel-item h1 {
        font-size: 3rem;
    }

    .carousel-item p {
        font-size: 1.25rem;
    }

    .carousel-item .btn {
        margin-top: 1rem;
    }

    .flash-message {
        opacity: 1;
        transition: opacity 0.5s ease-in-out;
        font-size: 0.9rem;
        padding: 0.5rem 1rem;
        border-radius: 0.25rem;
        margin-bottom: 1rem;
        max-width: 600px;
        margin-left: auto;
        margin-right: auto;
    }

    .alert-success {
        background-color: #d4edda;
        border-color: #c3e6cb;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .badge-sold-out {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(-20deg); /* Centre le badge et applique une rotation */
    padding: 20px 30px; /* Augmente l'espace à l'intérieur du badge */
    background-color: #d9534f; /* Rouge intense pour le fond */
    color: #fff;
    font-size: 3rem; /* Augmente considérablement la taille du texte */
    font-weight: bold;
    text-transform: uppercase;
    border: 4px solid #fff; /* Bordure blanche épaisse */
    border-radius: 8px; /* Coins légèrement arrondis */
    box-shadow: 3px 3px 10px rgba(0, 0, 0, 0.5); /* Ajoute une ombre prononcée */
    letter-spacing: 4px; /* Augmente l'espacement entre les lettres */
    z-index: 10;
    display: flex;
    align-items: center;
    justify-content: center;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5); /* Ajoute une ombre au texte pour plus de relief */
    opacity: 0.95;
}

</style>
@endsection
