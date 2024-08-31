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
        <form id="payment-form" action="{{ route('checkout.process') }}" method="POST" class="bg-light p-4 rounded shadow">
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
            <input type="hidden" name="amount" value="{{ $event->price * 100 }}"> <!-- Montant en cents -->
            <button id="submit-button" class="btn btn-primary">Confirmer la Réservation</button>
        </form>
    </main>
    <script>
        var stripe = Stripe('pk_test_51PkWnlFOpWZwj0g46ST0bA6rDvQQycqLfmQ28yduwIoNRMRNvPK24vPhDocwcaaaRMGUJ8KDf4gq76jhNzUlHbf600Mz1CdNvF'); // Remplacez par votre clé publique Stripe
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
            // Ajoute le token Stripe au formulaire et soumet le formulaire
            var hiddenInput = document.createElement('input');
            hiddenInput.setAttribute('type', 'hidden');
            hiddenInput.setAttribute('name', 'stripeToken');
            hiddenInput.setAttribute('value', result.token.id);
            form.appendChild(hiddenInput);

            // Soumettre le formulaire
            form.submit();

            // Redirige l'utilisateur vers la page de confirmation après la soumission du formulaire
            window.location.href = "{{ route('confirmation') }}";
        }
    });
});

    </script>
</body>
</html>
@endsection
