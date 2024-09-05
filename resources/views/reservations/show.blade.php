@extends('frontend.layout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Détails de la Réservation</h1>

    <div class="card">
        <div class="card-header">
            <h5>Réservation #{{ $reservation->id }}</h5>
        </div>
        <div class="card-body">
            <!-- Informations sur le Client -->
            <h5 class="text-center card-title">Vos informations</h5>
            <p><strong>Nom:</strong> {{ $reservation->user->name }}</p>
            <p><strong>Prenom:</strong> {{ $reservation->user->prenom}}</p>
            <p><strong>Adresse e-mail:</strong> {{ $reservation->user->email }}</p>

            <!-- Liste des Événements Réservés -->
            <h5 class="card-title mt-4">Événement(s) Réservé(s):</h5>
            <ul class="list-group mb-3">
                @foreach ($reservation->events as $event)
                    <li class="list-group-item">
                        <strong>{{ $event->name }}</strong>
                        <br>
                        <em>Date:</em> {{ $event->date }} | <em>Heure:</em> {{ $event->heure }} | <em>Lieu:</em> {{ $event->lieu }}
                        <br>
                        <em>Nombre de place:</em> {{ $event->pivot->quantite }}
                        <br>
                        <em>Prix Unitaire:</em> {{ number_format($event->pivot->prix, 0, ',', ' ') }} Dh
                        <br>
                        <em>Prix Total:</em> {{ number_format($event->pivot->quantite * $event->pivot->prix, 0, ',', ' ') }} Dh
                    </li>
                @endforeach
            </ul>

            {{-- <!-- Résumé de la Réservation -->
            <div class="mt-4">
                <p class="card-text"><strong>Nombre Total de Places Réservées:</strong>
                    @php
                        $totalParticipants = $reservation->events->sum('pivot.quantite');
                    @endphp
                    {{ $totalParticipants }}
                </p>
                <p class="card-text"><strong>Prix Total de la Réservation:</strong>
                    @php
                        $totalPrice = $reservation->events->sum(function($event) {
                            return $event->pivot->quantite * $event->pivot->prix;
                        });
                    @endphp
                    <span class="text-success">{{ number_format($totalPrice, 0, ',', ' ') }} Dh</span>
                </p>
            </div> --}}

            <!-- Statut de la Réservation -->
            <p class="card-text"><strong>Statut:</strong>
                @if ($reservation->status == 'confirmed')
                    <span class="text-success">Confirmé</span>
                @elseif ($reservation->status == 'pending')
                    <span class="text-warning">En attente</span>
                @else
                    <span class="text-secondary">{{ ucfirst($reservation->status) }}</span>
                @endif
            </p>

            <!-- Section Ticket -->
            <hr class="my-4">
            <h5>Votre Ticket de Réservation</h5>

            <form action="{{ route('reservations.download', $reservation->id) }}" method="GET">
                <button type="submit" class="btn btn-primary">Télécharger le Ticket en PDF</button>
            </form>

             <!-- Conditions et Politique de Réservation -->
         <div class="mt-4">
                <h5>Conditions et Politique de Réservation</h5>
                <p>Veuillez consulter <a href="{{ route('conditions') }}">les conditions concernant les reservations</a></p>
            </div>

            <!-- Informations Supplémentaires -->
            <div class="mt-4">
                <h5>Informations Supplémentaires</h5>
                <p>Pour toute question spécifique sur les événements, veuillez nous <a href="{{ route('contact') }}">contacter</a>.</p>
                <p>Assurez-vous de conserver ce ticket pour votre entrée aux événements.</p>
            </div>
        </div>
    </div>
</div>
@endsection
