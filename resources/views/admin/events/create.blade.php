@extends('layouts.app')

@section('title', 'Nouveau Événement')

@section('content')
<div class="container">
    <h1 class="mb-4">Nouveau Événement</h1>
    <form class="w-50 mx-auto shadow p-3 rounded" action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $e)
                        <li>{{ $e }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="mb-3">
            <label for="name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Nom" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" placeholder="Description" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" required>
        </div>

        <div class="mb-3">
            <label for="lieu" class="form-label">Lieu</label>
            <input type="text" class="form-control" id="lieu" name="lieu" placeholder="Lieu" required>
        </div>

        <div class="mb-3">
            <label for="nombre_place" class="form-label">Nombre de places</label>
            <input type="number" class="form-control" id="nombre_place" name="nombre_place" placeholder="Nombre de places" required>
        </div>

        <div class="mb-3">
            <label for="heure" class="form-label">Heure</label>
            <input type="time" class="form-control" id="heure" name="heure" placeholder="Heure" required>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>

        <div class="mb-3">
            <label for="categorie" class="form-label">Catégorie</label>
            <select id="categorie" name="event_type_id" class="form-control @error('categorie') is-invalid @enderror" required>
                @foreach ($eventTypes as $type)
                    <option value="{{ $type->id }}">{{ $type->categorie }}</option>
                @endforeach
            </select>
            @error('categorie')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="prix" class="form-label">Prix</label>
            <input id="prix" type="text" class="form-control @error('prix') is-invalid @enderror" name="prix" value="{{ old('prix') }}" required>
            @error('prix')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Ajouter l'événement</button>
    </form>
</div>
@endsection
