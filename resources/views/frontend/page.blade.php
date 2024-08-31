@extends('frontend.layout')

@section('content')
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
                                    <img src="{{ asset('storage/images'.$event->image) }}" class="card-img-top" alt="{{ $event->name }}" style="height: 200px; object-fit: cover;">
                                    <div class="badge bg-primary position-absolute top-0 start-0 m-2 px-3 py-2" style="font-size: 0.8rem;">{{ $event->eventType->categorie }}</div>
                                </div>
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title text-primary">{{ $event->name }}</h5>
                                    <ul class="list-unstyled mb-4">
                                        <li><i class="fas fa-calendar-alt text-primary"></i> <strong>Date:</strong> {{ $event->date }}</li>
                                        <li><i class="fas fa-map-marker-alt text-primary"></i> <strong>Lieu:</strong> {{ $event->lieu }}</li>
                                        <li><i class="fas fa-clock text-primary"></i> <strong>Heure:</strong> {{ $event->heure }}</li>
                                        <li><i class="fas fa-dollar-sign text-primary"></i> <strong>Prix:</strong> {{ $event->prix }} DH</li>
                                    </ul>
                                    <div class="d-flex justify-content-between mt-auto">

                                        <form action="{{ route('cart.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="event_id" value="{{ $event->id }}">
                                            <div class="mb-3">
                                                <label for="number_of_places" class="form-label">Nombre de places</label>
                                                <input type="number" class="form-control" id="number_of_places" name="number_of_places" min="1" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Réserver</button>
                                        </form>
                                        <!-- Bouton Voir Détail -->
                                        <a href="{{ route('event.show', $event->id) }}" class="btn btn-secondary">Voir Détail</a>

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

    .detail-box {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        height: 100%;
        padding: 2rem;
    }
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function(){
        // Initialisation du carousel Bootstrap
        var myCarousel = document.querySelector('#carouselExampleIndicators');
        var carousel = new bootstrap.Carousel(myCarousel, {
            interval: 5000,
            wrap: true
        });
    });
</script>
@endsection
