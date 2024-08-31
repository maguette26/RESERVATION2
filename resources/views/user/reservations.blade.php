@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Vos Réservations</h1>

    @if ($reservations->isEmpty())
        <p>Aucune réservation trouvée.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Événement</th>
                    <th>Date</th>
                    <th>Statut</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>{{ $reservation->event->name }}</td>
                        <td>{{ $reservation->date }}</td>
                        <td>{{ ucfirst($reservation->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
