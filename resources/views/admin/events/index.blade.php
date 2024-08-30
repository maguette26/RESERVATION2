@extends('dashboard')

@section('titre')
Liste des événements
@endsection

@section('notice')
    {{ session('notice') }}
@endsection

@section('main')
<div class="d-flex justify-content-between align-items-center mb-3">

    <a href="{{ route('admin.create') }}" class="btn btn-primary">Ajouter un événement</a>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>Image</th>
            <th>Nom</th>
            <th>Date</th>
            <th>Nombre de places</th>
            <th>Heure</th>
            <th>Lieu</th>
            <th>Description</th>
            <th>Prix</th>
            <th>Catégorie</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($events as $event)
            <tr>
                <td><img src="{{ asset('storage/'.$event->image) }}" alt="" width="200"></td>
                <td>{{ $event->name }}</td>
                <td>{{ $event->date }}</td>
                <td>{{ $event->nombre_place }}</td>
                <td>{{ \Carbon\Carbon::parse($event->heure)->format('H:i') }}</td>
                <td>{{ $event->lieu }}</td>
                <td>{{ $event->description }}</td>
                <td>{{ $event->prix }}</td>
                <td>{{ $event->eventType->categorie }}</td>
                <td>
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <a class="btn btn-warning btn-sm" href="{{ route('admin.edit', $event->id) }}">Modifier</a>
                        <form action="{{ route('admin.destroy', $event) }}" method="post" style="display:inline-block;" onsubmit="return confirmDelete(event)">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

<script>
    function confirmDelete(event) {
        return confirm("Êtes-vous sûr de vouloir supprimer cet événement ?");
    }
</script>
@endsection
