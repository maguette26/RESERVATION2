@extends('layouts.app')

@section('title', 'Nouveau type d\'événement')

@section('content')
<div class="container">
    <h1 class="mb-4">Nouveau type d'événement</h1>
    <form class="w-50 mx-auto shadow p-3 rounded" action="{{ route('admin.eventTypes.store') }}" method="POST" enctype="multipart/form-data">
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
            <label for="categorie" class="form-label">Catégorie</label>
            <input type="text" class="form-control" id="categorie" name="categorie" placeholder="Catégorie" required>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter le type</button>
    </form>
</div>
@endsection
