@extends('layouts.app')

@section('title', 'Liste d\'événements')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Liste des événements</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-4">
        <a href="{{ route('admin.create') }}" class="btn btn-primary">Ajouter un événement</a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-striped">
            <thead class="table-dark">
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Date</th>
                    <th scope="col">Nombre de places</th>
                    <th scope="col">Heure</th>
                    <th scope="col">Lieu</th>
                    <th scope="col">Description</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Catégorie</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($events as $event)
                    <tr>
                        <td>
                            @if ($event->image)
                                <img src="{{ asset($event->image) }}" alt="Image" class="img-thumbnail" style="max-width: 100px;">
                            @endif
                        </td>
                        <td>{{ $event->name }}</td>
                        <td>{{ $event->date }}</td>
                        <td>{{ $event->nombre_place }}</td>
                        <td>{{ $event->heure }}</td>
                        <td>{{ $event->lieu }}</td>
                        <td>{{ $event->description }}</td>
                        <td>{{ $event->prix }}</td>
                        <td>{{ $event->eventType->categorie }}</td>
                        <td>
                            <a href="{{ route('admin.edit', $event->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('admin.destroy', $event->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
