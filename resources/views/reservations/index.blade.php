@extends('frontend.layout')

@section('content')
<div class="container">
    <h1>Vos Réservations</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if ($reservations->isEmpty())
        <p>Aucune réservation trouvée.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Événements</th>
                    <th>Date</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($reservations as $reservation)
                    <tr>
                        <td>{{ $reservation->id }}</td>
                        <td>
                            @foreach ($reservation->events as $event)
                                {{ $event->name }}
                            @endforeach
                        </td>
                        <td>{{ $reservation->date_reservation }}</td>
                        <td>{{ ucfirst($reservation->status) }}</td>
                        <td>
                            <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-info">Voir</a>
                            @if ($reservation->status != 'cancelled')
                            <form action="{{ route('reservations.cancel', $reservation->id) }}" method="GET" style="display:inline;">
                                @csrf
                                <button type="submit" class="btn btn-danger">Annuler</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
