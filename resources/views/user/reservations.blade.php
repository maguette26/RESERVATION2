@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1>Vos Réservations</h1>

    @if ($reservations->isEmpty())
        <p>Aucune réservation trouvée.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Événement</th>
                    <th>Date de Réservation</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->event->name }}</td>
                        <td>{{ $reservation->date_reservation->format('d/m/Y') }}</td> <!-- Assurez-vous que date_reservation est un objet Carbon -->
                        <td>{{ $reservation->quantite }}</td>
                        <td>{{ $reservation->prix }} {{ config('app.currency') }}</td> <!-- Ajouter la devise selon votre configuration -->
                        <td>{{ ucfirst($reservation->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
