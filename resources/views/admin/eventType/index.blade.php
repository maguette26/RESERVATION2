@extends('layouts.app')

@section('title', 'Liste des types d\'événements')

@section('content')
<div class="container">
    <h1 class="mb-4">Liste des types d'événements</h1>
    <a href="{{ route('admin.eventTypes.create') }}" class="btn btn-primary mb-3">Ajouter un type d'événement</a>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <table class="table">
        <thead>
            <tr>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($eventTypes as $eventType)
                <tr>
                    <td>{{ $eventType->categorie }}</td>
                    <td>
                        <a href="{{ route('admin.eventTypes.edit', $eventType->id) }}" class="btn btn-warning">Modifier</a>
                        <form action="{{ route('admin.eventTypes.destroy', $eventType->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce type d\'événement ?')">Supprimer</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
