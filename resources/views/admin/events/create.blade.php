@extends('layouts.app')

@section('title', 'Nouveau Événement')

@section('content')
<div class="container mt-5">
    <h1 class="text-center mb-4 text-primary">Créer un Nouveau Événement</h1>
    <div class="card mx-auto" style=" width: 130%; max-width: 1200px; margin: 0%;">
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

                <!-- Form Fields for Creating Event -->
                @include('admin.partials.event-form')

                <button type="submit" class="text-center btn btn-primary w-10">Ajouter l'événement</button>
            </form>
        </div>
    </div>
</div>
@endsection
