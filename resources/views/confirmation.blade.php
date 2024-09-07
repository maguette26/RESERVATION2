@extends('frontend.layout')

@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmation de Réservation</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
            font-family: 'Copperplate', serif; /* Use Copperplate font */
        }
    </style>
</head>
@csrf
<body>
    <header class="bg-primary text-white text-center py-4">
        <h1>Confirmation de Réservation</h1>
    </header>

    <main class="container my-5">
        <div class="alert alert-success text-center" role="alert">
            <h2 class="mb-4">Merci pour votre réservation !</h2>
            <p>Votre réservation a été reçue et est en cours de traitement.</p>
            <p>Nous vous enverrons un email de confirmation avec les détails de votre réservation.</p>
        </div>
        <div class="text-center">
            <a href="{{ route('cart.index') }}" class="btn btn-primary">Retourner au Panier</a>
        </div>
    </main>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
@endsection
