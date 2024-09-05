@extends('frontend.layout')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Conditions et Politique de Réservation</h1>

    <div class="card">
        <div class="card-header">
            <h5>Conditions Générales de Réservation</h5>
        </div>
        <div class="card-body">
            <p>
                Merci de consulter attentivement nos conditions de réservation avant de finaliser votre réservation. En effectuant une réservation, vous acceptez les conditions suivantes :
            </p>

            <h5>1. Annulation de Réservation</h5>
            <p>
                Veuillez noter que toutes les réservations sont finales. Une fois une réservation confirmée, elle ne peut en aucun cas être annulée ou remboursée, sauf en cas de force majeure.
            </p>
            <h5>2. Modifications de Réservation</h5>
            <p>
                Les demandes de modification doivent être effectuées au moins 48 heures avant la date de l'événement. Les modifications acceptées dépendent de la disponibilité et peuvent entraîner des frais supplémentaires.
            </p>

            <h5>3. Conditions Générales</h5>
            <p>
                Les conditions générales suivantes s'appliquent à toutes les réservations :
            </p>
            <ul>
                <li>Les prix des billets sont fixés au moment de la réservation et sont sujets à des variations selon les événements.</li>
                <li>Les tickets sont non transférables et non remboursables.</li>
                <li>Nous nous réservons le droit d'annuler un événement en cas de force majeure. Dans ce cas, un remboursement complet sera effectué.</li>
            </ul>

            <h5>4. Informations Supplémentaires</h5>
            <p>
                Pour toute question ou pour plus d'informations sur notre politique de réservation, veuillez nous <a href="{{ route('contact') }}">contacter</a>.
            </p>
        </div>
    </div>
</div>
@endsection
