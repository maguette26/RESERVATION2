@extends('layouts.app')

@section('title', 'Modifier le type d\'événement')

@section('content')
<div class="container">
    <h1 class="mb-4">Modifier le type d'événement</h1>
    <form action="{{ route('admin.eventTypes.update', $eventType->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="categorie" class="form-label">Nom du type d'événement</label>
            <input type="text" class="form-control" id="categorie" name="categorie" value="{{ old('categorie', $eventType->categorie) }}" required>
            @error('categorie')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
