@extends('layouts.app')

@section('title', 'Nouveau Événement')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4">Créer un Nouveau Événement</h1>
    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-body">
            <form action="{{ route('admin.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3">
                    <label for="name" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Nom de l'événement" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" placeholder="Description de l'événement" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>

                <div class="mb-3">
                    <label for="lieu" class="form-label">Lieu</label>
                    <input type="text" class="form-control" id="lieu" name="lieu" placeholder="Lieu de l'événement" required>
                </div>

                <div class="mb-3">
                    <label for="nombre_place" class="form-label">Nombre de places</label>
                    <input type="number" class="form-control" id="nombre_place" name="nombre_place" placeholder="Nombre de places disponibles" required>
                </div>

                <div class="mb-3">
                    <label for="heure" class="form-label">Heure</label>
                    <input type="time" class="form-control" id="heure" name="heure" placeholder="Heure de l'événement" required>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Image</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>

                <div class="mb-3">
                    <label for="categorie" class="form-label">Catégorie</label>
                    <select id="categorie" name="event_type_id" class="form-select" required>
                        @foreach ($eventTypes as $type)
                            <option value="{{ $type->id }}">{{ $type->categorie }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="prix" class="form-label">Prix</label>
                    <input id="prix" type="text" class="form-control" name="prix" placeholder="Prix de l'événement" required>
                </div>

                <button type="submit" class="btn btn-primary w-100">Ajouter l'événement</button>
            </form>
        </div>
    </div>
</div>
@endsection
