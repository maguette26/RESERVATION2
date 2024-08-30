@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Vos Réservations</h1>
    <div class="card">
        <div class="card-header">
            <h2 class="mb-0">Liste des réservations</h2>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Événement</th>
                            <th scope="col">Date</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservations as $reservation)
                            <tr>
                                <td>
                                    @foreach ($reservation->evenements as $evenement)
                                        {{ $evenement->nom }}
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($reservation->evenements as $evenement)
                                        {{ $evenement->date->format('d/m/Y') }}
                                    @endforeach
                                </td>
                                <td>
                                    <form action="{{ route('reservations.cancel', $reservation) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Annuler</button>
                                    </form>
                                    <a href="{{ route('reservations.show', $reservation) }}" class="btn btn-info btn-sm">Voir</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</div>
@endsection

