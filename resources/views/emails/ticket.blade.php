<!DOCTYPE html>
<html>
<head>
    <title>Votre Ticket de Réservation</title>
</head>
<body>
    <h1>Merci pour votre réservation!</h1>
    <p>Voici votre ticket pour l'événement :</p>
    <p>Réservation ID: {{ $reservation->id }}</p>
    <p>Événement: {{ $reservation->event->name }}</p>
    <p>Nombre de Places: {{ $reservation->quantite }}</p>
    <p>Prix Total: {{ $reservation->prix }}Dh</p>
    <p>Veuillez trouver ci-joint votre ticket au format PDF.</p>
</body>
</html>
