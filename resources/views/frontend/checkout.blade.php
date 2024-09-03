@extends('frontend.layout')

@section('content')
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://js.stripe.com/v3/"></script>
    @csrf
</head>
<body>
    <header>
        <!-- Votre en-tête -->
    </header>
    <main class="container my-5">
        <h2 class="mb-4">Informations de Facturation</h2>
        <form id="payment-form" action="{{ route('confirmation') }}" method="POST" class="bg-light p-4 rounded shadow">
            @csrf
            <div class="form-group">
                <label for="name">Nom</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ Auth::user()->name }}" readonly>
            </div>
            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" class="form-control" value="{{ Auth::user()->prenom }}" readonly>
            </div>
            <div class="form-group">
                <label for="email">Adresse email</label>
                <input type="text" id="email" name="email" class="form-control" value="{{ Auth::user()->email }}" readonly>
            </div>
            <div class="form-group">
                <label for="card-element">Informations de carte de crédit :</label>
                <div id="card-element" class="form-control">
                    <!-- Un élément de carte sera inséré ici. -->
                </div>
                <div id="card-errors" class="text-danger mt-2" role="alert"></div>
            </div>
            <input type="hidden" name="amount" value="{{ $total * 100 }}">
            <button id="submit-button" class="btn btn-primary">Confirmer la Réservation</button>
        </form>

        <script>
        var stripe = Stripe('pk_test_51PudQ3RtB7irkMOgoYxfHkoTMsyUdpuBtFGr4GsjBEBiscLL2UjeOpAS1fM0fy7czWdAdtyjn7ejToNq1HSCht0X00yAQm5WdV');
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');

        document.getElementById('submit-button').addEventListener('click', function(event) {
            event.preventDefault();
            var form = document.getElementById('payment-form');

            stripe.createToken(cardElement).then(function(result) {
                if (result.error) {
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    var hiddenInput = document.createElement('input');
                    hiddenInput.setAttribute('type', 'hidden');
                    hiddenInput.setAttribute('name', 'stripeToken');
                    hiddenInput.setAttribute('value', result.token.id);
                    form.appendChild(hiddenInput);
                    form.submit();
                }
            });
        });
        </script>
</body>
</html>
@endsection
