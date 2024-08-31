@extends('frontend.layout')

@section('content')
<style>
    /* Animation pour l'apparition des éléments */
    .fade-in-up {
        opacity: 0;
        transform: translateY(20px);
        animation: fadeInUp 0.8s forwards;
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .event-container {
        display: flex;
        align-items: flex-start;
        gap: 20px;
        /* Animation pour l'apparition de l'image et des informations */
        animation: fadeInUp 0.8s forwards;
    }

    .event-img {
        width: 50%;
        height: auto;
        object-fit: cover;
        border-radius: 8px;
        border: 1px solid #ddd;
        transition: transform 0.3s;
    }

    .event-img:hover {
        transform: scale(1.05);
    }

    .event-info {
        flex: 1;
        padding: 15px;
        background-color: #f9f9f9;
        border-radius: 8px;
        border: 1px solid #ddd;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s;
    }

    .event-info:hover {
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
    }

    .event-title {
        font-size: 2rem;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
        animation: fadeInUp 0.8s forwards;
    }

    .event-details p {
        font-size: 1.2rem;
        margin-bottom: 10px;
        color: #555;
    }

    .event-details strong {
        color: #007bff;
    }

    .calendar-sync {
        margin-top: 20px;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 8px;
        border: 1px solid #ddd;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        text-align: center;
        animation: fadeInUp 0.8s forwards;
    }

    .calendar-sync h3 {
        font-size: 1.5rem;
        margin-bottom: 10px;
        color: #333;
    }

    .calendar-sync a {
        display: inline-flex;
        align-items: center;
        padding: 10px 20px;
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        border-radius: 5px;
        font-weight: bold;
        transition: background-color 0.3s, transform 0.3s;
    }

    .calendar-sync a:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }

    .calendar-sync i {
        margin-right: 8px;
    }

    .event-description {
        margin-top: 20px;
        font-size: 1.2rem;
        color: #555;
        line-height: 1.6;
        animation: fadeInUp 0.8s forwards;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
        border-radius: 50px;
        padding: 10px 20px;
        text-transform: uppercase;
        font-weight: bold;
        text-decoration: none;
        transition: background-color 0.3s, transform 0.3s;
    }

    .btn-primary:hover {
        background-color: #0056b3;
        transform: scale(1.05);
    }
</style>

<section class="container my-5">
    <div class="event-title fade-in-up">{{ $event->name }}</div>
    <div class="event-container">
        <!-- Image de l'événement à gauche -->
        <img src="{{ asset('storage/' . $event->image) }}" class="event-img img-fluid" alt="{{ $event->name }}">

        <!-- Informations de l'événement à droite -->
        <div class="event-info fade-in-up">
            <div class="event-details">
                <p><strong>Date:</strong> {{ $event->date }}</p>
                <p><strong>Lieu:</strong> {{ $event->lieu }}</p>
                <p><strong>Ouverture des portes:</strong> 17h00</p>
                <p><strong>Heure du spectacle:</strong> {{ $event->heure }} h</p>
                <p><strong>Prix:</strong> {{ $event->prix }} DH</p>
            </div>

            <!-- Bloc d'ajout au calendrier en bas des informations -->
            <div class="calendar-sync fade-in-up">
                <h3>Ajouter au calendrier pour ne pas oublier</h3>
                <a href="https://www.google.com/calendar/render?action=TEMPLATE&text={{ urlencode($event->name) }}&dates={{ date('Ymd\THis\Z', strtotime($event->start_time)) }}/{{ date('Ymd\THis\Z', strtotime($event->end_time)) }}&details={{ urlencode($event->description) }}&location={{ urlencode($event->lieu) }}&trp=false" target="_blank">
                    <i class="fas fa-calendar-alt"></i> Google Calendar
                </a>
            </div>
        </div>
    </div>
    <div class="event-description fade-in-up">
        <p>{{ $event->description }}</p>
    </div>
    <!-- Bouton de retour -->

    <a href="{{ url('/') }}" class="btn btn-primary mt-4">Retour à la liste des événements</a>
</section>
@endsection
