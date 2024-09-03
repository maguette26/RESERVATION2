<!DOCTYPE html>
<html>
<head>
    <title>Votre Ticket</title>
</head>
<body>
    <h1>Votre Ticket de Réservation</h1>
    <p>Réservation ID: {{ $reservation->id }}</p>
    <p>Événement: {{ $reservation->event->name }}</p>
    <p>Nombre de Places: {{ $reservation->quantite }}</p>
    <p>Prix Total: {{ $reservation->prix }} Dh</p>
    <img src="{{ asset('qrcodes/' . $reservation->id . '.png') }}" alt="QR Code">
</body>
</html>
