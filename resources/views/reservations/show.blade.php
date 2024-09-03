@extends('frontend.layout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Détails de la Réservation</h1>

    <div class="card">
        <div class="card-header">
            <h5>Réservation #{{ $reservation->id }}</h5>
        </div>
        <div class="card-body">
            <h5 class="card-title">Événement(s) Réservé(s):</h5>
            <ul class="list-group mb-3">
                @foreach ($reservation->events as $event)
                    <li class="list-group-item">
                        <strong>{{ $event->name }}</strong>
                        <br>
                        <em>Date:</em> {{ $event->date }} | <em>Heure:</em> {{ $event->heure }} | <em>Lieu:</em> {{ $event->lieu }}
                    </li>
                @endforeach
            </ul>

            <p class="card-text"><strong>Date de Réservation:</strong> {{ $reservation->date_reservation }}</p>

            <p class="card-text">
                <strong>Statut:</strong>
                @if ($reservation->status == 'confirmed')
                    <span class="text-success">Confirmé</span>
                @elseif ($reservation->status == 'pending')
                    <span class="text-warning">En attente</span>
                @else
                    <span class="text-secondary">{{ ucfirst($reservation->status) }}</span>
                @endif
            </p>

            <p class="card-text"><strong>Nombre de place:</strong>
                @php
                    $totalParticipants = $reservation->events->sum('pivot.quantite');
                @endphp
                {{ $totalParticipants }}
            </p>

            <p class="card-text"><strong>Total de la Réservation:</strong>
                @php
                    $totalPrice = $reservation->events->sum(function($event) {
                        return $event->pivot->quantite * $event->pivot->prix;
                    });
                @endphp
                <span class="text-success">{{ number_format($totalPrice, 0, ',', ' ') }} Dh</span>
            </p>

            @if ($reservation->status == 'pending')
                <form action="{{ route('reservations.update', $reservation->id) }}" method="POST" class="mt-4">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="status" value="confirmed">
                    <button type="submit" class="btn btn-success">Confirmer</button>
                </form>
            @endif
        </div>
    </div>
</div>
@endsection
