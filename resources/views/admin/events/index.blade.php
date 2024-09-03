@extends('layouts.app')

@section('title', 'Liste d\'événements')

@section('content')
<style>
    .custom-table {
        width: 130%; /* Adjust this value as needed */
        max-width: 1200px;
         margin: 0%;
    }
</style>

<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">Liste des événements</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="mb-4">
        <a href="{{ route('admin.create') }}" class="btn btn-primary">Ajouter un événement</a>
    </div>

    <table class="table table-striped table-bordered custom-table">
        <thead class="bg-primary text-white">
            <tr class="text-center">
                <th scope="col">Image</th>
                <th scope="col">Nom</th>
                <th scope="col">Date</th>
                <th scope="col">Nombre_place</th>
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
                    <td class="text-center">
                        @if ($event->image)
                            <img src="{{ asset($event->image) }}" alt="Image" class="img-thumbnail" style="max-width: 100px;">
                        @endif
                    </td>
                    <td class="text-center">{{ $event->name }}</td>
                    <td class="text-center">{{ $event->date }}</td>
                    <td class="text-center">{{ $event->nombre_place }}</td>
                    <td class="text-center">{{ $event->heure }}</td>
                    <td class="text-center">{{ $event->lieu }}</td>
                    <td class="text-center">{{ $event->description }}</td>
                    <td class="text-center">{{ $event->prix }}</td>
                    <td class="text-center">{{ $event->eventType->categorie }}</td>
                    <td class="text-center">
                        <div class="btn-group" role="group">
                            <a href="{{ route('admin.edit', $event->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                            <form action="{{ route('admin.destroy', $event->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirmDelete(event);">Supprimer</button>
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
</div>

@endsection
