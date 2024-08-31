@extends('frontend.layout')

@section('content')
<div class="container">
    <h1>Détails de la Réservation</h1>

    <div class="card">
        <div class="card-header">
            Réservation {{ $reservation->id }}
        </div>
        <div class="card-body">
            <h5 class="card-title">
                Événement:
                @foreach ($reservation->events as $event)
                    {{ $event->name }}
                @endforeach
            </h5>
            <p class="card-text"><strong>Date de Réservation:</strong> {{ $reservation->date_reservation }}</p>
            <p class="card-text"><strong>Statut:</strong> {{ ucfirst($reservation->status) }}</p>

            <p class="card-text"><strong>Quantité:</strong>
                @foreach ($reservation->events as $event)
                    {{ $event->pivot->quantite }}
                @endforeach
            </p>
            <p class="card-text"><strong>Prix:</strong>
                @foreach ($reservation->events as $event)
                    {{ $event->pivot->prix }}
                @endforeach
            </p>

            @if ($reservation->status == 'pending')
                <form action="{{ route('reservations.update', $reservation->id) }}" method="POST">
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
