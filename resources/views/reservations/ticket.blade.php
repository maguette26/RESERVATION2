<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ticket de Réservation</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
        }
        .ticket-container {
            margin: 20px auto;
            max-width: 600px;
            border: 1px solid #ccc;
            padding: 20px;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .card-header {
            background-color: #007bff;
            color: white;
            text-align: center;
            padding: 10px;
            border-radius: 8px 8px 0 0;
        }
        .card-title {
            font-size: 22px;
            font-weight: bold;
        }
        .event-photo {
            width: 100%;
            height: auto;
            border-radius: 5px;
            margin-bottom: 15px;
        }
        .event-details h2 {
            color: #007bff;
            font-size: 18px;
            margin-bottom: 10px;
            font-weight: bold;
        }
        .total-price {
            font-size: 16px;
            font-weight: bold;
            color: #28a745;
            text-align: right;
            margin-top: 15px;
        }
        .contact-info, .stripe-info {
            font-size: 12px;
            margin-top: 10px;
        }
        .qr-code img, .barcode {
            display: block;
            margin: 10px auto;
            max-width: 150px;
        }
        .small-text {
            font-size: 10px;
        }
    </style>
</head>
<body>

    @foreach ($reservation->events as $event)
    <div class="container ticket-container">
        <div class="card-header">
            <h1 class="card-title">Ticket de Réservation</h1>
            <p><strong>Référence :</strong> {{ $reservation->id }}</p>
        </div>
        <div class="card-body">

            <!-- Détails du Client -->
            <div class="mb-3">
                <p><strong>Nom :</strong> {{ Auth::user()->prenom }} {{ Auth::user()->name }}</p>
                <p><strong>Date de Réservation :</strong> {{ $reservation->date_reservation }}</p>
                <p><strong>Statut :</strong>
                    @if ($reservation->status == 'confirmed')
                        <span class="text-success">Confirmée</span>
                    @elseif ($reservation->status == 'pending')
                        <span class="text-warning">En attente</span>
                    @else
                        <span class="text-secondary">{{ ucfirst($reservation->status) }}</span>
                    @endif
                </p>
            </div>
            <!-- Détails de l'événement -->
            <div class="event-details">
                <h2>{{ $event->name }}</h2>
                <p><strong>Date :</strong> {{ $event->date }}</p>
                <p><strong>Heure :</strong> {{ $event->heure }}</p>
                <p><strong>Lieu :</strong> {{ $event->lieu }}</p>
                <p><strong>Quantité :</strong> {{ $event->pivot->quantite }}</p>
                <p><strong>Prix Unitaire :</strong> {{ number_format($event->pivot->prix, 0, ',', ' ') }} Dh</p>
            </div>

            <!-- Montant Total -->
            <div class="total-price">
                <p>Total: {{ number_format($event->pivot->quantite * $event->pivot->prix, 0, ',', ' ') }} Dh</p>
            </div>


            <!-- Contact Information -->
            <div class="contact-info">
                <p><strong>Support :</strong> <a href="mailto:fatoumatabintoudiop90@gmail.com">fatoumatabintoudiop90@gmail.com</a></p>
            </div>

            <!-- Information Stripe -->
            <div class="stripe-info small-text">
                <p>Ce ticket a été payé via Stripe. Conservez-le pour l'entrée à l'événement.</p>
            </div>

    </div>
    @endforeach

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>
