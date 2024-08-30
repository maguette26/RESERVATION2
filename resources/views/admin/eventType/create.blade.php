@extends('dashboard')

@section('content')
<div class="container">
    <h1>Créer un nouveau type d'événement</h1>
    <form action="{{ route('admin.eventTypes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="categorie" class="form-label">Nom du type d'événement</label>
            <input type="text" class="form-control" id="categorie" name="categorie" required>
        </div>
        <button type="submit" class="btn btn-primary">Créer</button>
    </form>
</div>
@endsection
