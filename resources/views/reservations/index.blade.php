@extends('frontend.layout')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-4">Vos Réservations</h1>

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
        <div class="alert alert-warning text-center">
            <p>Aucune réservation trouvée.</p>
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-hover table-striped table-bordered align-middle">
                <thead class="bg-primary text-white">
                    <tr class="text-center">
                        <th class="p-3">ID</th>
                        <th class="p-3">Événements</th>
                        <th class="p-3">Date</th>
                        <th class="p-3">Statut</th>
                        <th class="p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td class="text-center">{{ $reservation->id }}</td>
                            <td>
                                <ul class="list-unstyled mb-0">
                                    @foreach ($reservation->events as $event)
                                        <li><i class="bi bi-calendar-event me-2 text-primary"></i> {{ $event->name }}</li>
                                    @endforeach
                                </ul>
                            </td>
                            <td class="text-center"><i class="bi bi-clock me-2 text-primary"></i> {{ $reservation->date_reservation }}</td>
                            <td class="text-center">
                                @if ($reservation->status == 'confirmed')
                                    <span class="text-success">Confirmé</span>
                                @elseif ($reservation->status == 'pending')
                                    <span class="text-warning">En attente</span>
                                @elseif ($reservation->status == 'cancelled')
                                    <span class="text-danger">Annulé</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-info btn-sm">
                                    <i class="bi bi-eye me-1"></i> Voir</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection
