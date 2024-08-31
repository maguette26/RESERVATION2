@extends('layouts.app')

@section('title', 'Modifier un événement')

@section('content')
{{-- Affichage des messages de session --}}
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

{{-- Affichage des erreurs de validation --}}
@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </div>
@endif

<form class="w-50 mx-auto shadow p-3 rounded" action="{{ route('admin.update', $event->id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="name" class="form-label">Nom</label>
        <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $event->name) }}" placeholder="Nom" required>
    </div>

    <div class="mb-3">
        <label for="description" class="form-label">Description</label>
        <textarea class="form-control" id="description" name="description" placeholder="Description" rows="3" required>{{ old('description', $event->description) }}</textarea>
    </div>

    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="date" class="form-control" id="date" name="date" value="{{ old('date', $event->date) }}" required>
    </div>

    <div class="mb-3">
        <label for="lieu" class="form-label">Lieu</label>
        <input type="text" class="form-control" id="lieu" name="lieu" value="{{ old('lieu', $event->lieu) }}" placeholder="Lieu" required>
    </div>

    <div class="mb-3">
        <label for="nombre_place" class="form-label">Nombre de places</label>
        <input type="number" class="form-control" id="nombre_place" name="nombre_place" value="{{ old('nombre_place', $event->nombre_place) }}" placeholder="Nombre de places" required>
    </div>

    <div class="mb-3">
        <label for="heure" class="form-label">Heure</label>
        <input type="time" class="form-control" id="heure" name="heure" value="{{ old('heure', $event->heure) }}" placeholder="heure" required>
    </div>

    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image">
        @if ($event->image)
            <img src="{{ asset('storage/'.$event->image) }}" alt="Image actuelle" class="mt-2" style="max-width: 200px;">
        @endif
    </div>

    <div class="mb-3">
        <label for="categorie">Catégorie</label>
        <select id="categorie" name="event_type_id" class="form-control @error('event_type_id') is-invalid @enderror" required>
            @foreach ($eventTypes as $type)
                <option value="{{ $type->id }}" {{ $type->id == $event->event_type_id ? 'selected' : '' }}>
                    {{ $type->categorie }}
                </option>
            @endforeach
        </select>
        @error('event_type_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <div class="mb-3">
        <label for="prix">Prix</label>
        <input id="prix" type="text" class="form-control @error('prix') is-invalid @enderror" name="prix" value="{{ old('prix', $event->prix) }}" required>
        @error('prix')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>

    <button type="submit" class="btn btn-primary">Valider</button>
</form>
@endsection
