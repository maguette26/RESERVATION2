@extends('frontend.layout')
@section('content')

<!-- Section des événements -->
<section class="container my-5">
    <h2 class="text-center mb-4">Tous les Événements de Conférence</h2>
    <div class="row">
        @foreach ($events as $event)
            <div class="col-lg-6 col-md-6 mb-4 animate__animated animate__fadeInUp">
                <div class="card shadow-sm border-0 h-100" style="border-radius: 12px; overflow: hidden;">
                    <div class="position-relative">
                        <img src="{{ asset('storage/'.$event->image) }}" class="card-img-top" alt="{{ $event->name }}" style="height: 200px; object-fit: cover;">
                        <div class="badge bg-primary position-absolute top-0 start-0 m-2 px-3 py-2" style="font-size: 0.8rem;">{{ $event->eventType->categorie }}</div>
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-primary">{{ $event->name }}</h5>
                        <ul class="list-unstyled mb-4">
                            <li><i class="fas fa-calendar-alt text-primary"></i> <strong>Date:</strong> {{ $event->date }}</li>
                            <li><i class="fas fa-map-marker-alt text-primary"></i> <strong>Lieu:</strong> {{ $event->lieu }}</li>
                            <li><i class="fas fa-dollar-sign text-primary"></i> <strong>Prix:</strong> {{ $event->prix }} DH</li>
                            <li><i class="fas fa-clock text-primary"></i> <strong>Heure:</strong> {{ \Carbon\Carbon::parse($event->heure)->format('H:i') }}</li>
                        </ul>
                        <div class="d-flex justify-content-between mt-auto">
                            <!-- Formulaire pour réserver -->
                            <form action="{{ route('cart.store') }}" method="post">
                                @csrf
                                <input type="hidden" name="event_id" value="{{ $event->id }}">
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
</section>

@endsection
