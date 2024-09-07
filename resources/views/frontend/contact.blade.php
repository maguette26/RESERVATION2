@extends('frontend.layout')

@section('content')
<div class="container-fluid contact py-6 wow bounceInUp" data-wow-delay="0.1s">
    <div class="container">
        <div class="p-5 bg-light rounded contact-form">
            <div class="row g-4">
                <div class="col-12">
                    <h1 class="display-5 mb-0">Contactez-nous avec plaisir pour plus de questions!</h1>
                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if (session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                    @endif
                </div>
                <div class="col-md-6 col-lg-7">
                    <p class="mb-4">Si vous avez des questions, veuillez remplir le formulaire ci-dessous. Nous vous répondrons dès que possible.</p>
                    <form action="{{ route('contact.submit') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Nom</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Message:</label>
                            <textarea class="form-control" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Envoyer</button>
                    </form>
                </div>
                <div class="col-md-6 col-lg-5">
                    <div class="contact-info">
                        <div class="d-inline-flex w-100 border border-primary p-4 rounded mb-4">
                            <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4 class="col-12">Adresse</h4>
                                <p class="contact-text">Rue 7 Zoubir, Casablanca, Maroc</p>
                            </div>
                        </div>
                        <div class="d-inline-flex w-100 border border-primary p-4 rounded mb-4">
                            <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                            <div>
                                <h4 class="contact-text">Email</h4>
                                <p class="col-12">diopmaguette1978@example.com</p>
                            </div>
                        </div>
                        <div class="d-inline-flex w-100 border border-primary p-4 rounded">
                            <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                            <div>
                                <h4 class="col-12">Téléphone</h4>
                                <p class="contact-text">(+212) 608 623 315</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>@extends('frontend.layout')

    @section('content')
    <div class="container-fluid contact py-6 wow bounceInUp" data-wow-delay="0.1s">
        <div class="container">
            <div class="p-5 bg-light rounded contact-form">
                <div class="row g-4">
                    <div class="col-12">
                        <h1 class="display-5 mb-0">Contactez-nous avec plaisir pour plus de questions!</h1>
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                        @endif
                    </div>
                    <div class="col-md-6 col-lg-7">
                        <p class="mb-4">Si vous avez des questions, veuillez remplir le formulaire ci-dessous. Nous vous répondrons dès que possible.</p>
                        <form action="{{ route('contact.submit') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nom</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Message:</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required>{{ old('message') }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Envoyer</button>
                        </form>
                    </div>
                    <div class="col-md-6 col-lg-5">
                        <div class="contact-info">
                            <div class="d-inline-flex w-100 border border-primary p-4 rounded mb-4">
                                <i class="fas fa-map-marker-alt fa-2x text-primary me-4"></i>
                                <div>
                                    <h4 class="col-12">Adresse</h4>
                                    <p class="contact-text">Rue 7 Zoubir, Casablanca, Maroc</p>
                                </div>
                            </div>
                            <div class="d-inline-flex w-100 border border-primary p-4 rounded mb-4">
                                <i class="fas fa-envelope fa-2x text-primary me-4"></i>
                                <div>
                                    <h4 class="contact-text">Email</h4>
                                    <p class="col-12">diopmaguette1978@example.com</p>
                                </div>
                            </div>
                            <div class="d-inline-flex w-100 border border-primary p-4 rounded">
                                <i class="fa fa-phone-alt fa-2x text-primary me-4"></i>
                                <div>
                                    <h4 class="col-12">Téléphone</h4>
                                    <p class="contact-text">(+212) 608 623 315</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection

    <style>
        /* Applique la police Copperplate à l'ensemble du contenu */
        body, h1, h2, h3, h4, h5, h6, p, a, button, input, select {
            font-family: 'Copperplate', serif;
        }

        .contact-form p,
        .contact-info p {
            color: #000; /* Texte en noir */
        }

        .contact-info h4 {
            color: #000; /* Titre en noir */
        }

        .contact-info i {
            color: #126abd; /* Couleur des icônes */
        }

        .btn-primary {
            background-color: #126abd; /* Couleur du bouton envoyer */
            border-color: #126abd;
        }

        .btn-primary:hover {
            background-color: #0e5092; /* Couleur du bouton au survol */
            border-color: #0e5092;
        }
    </style>

</div>
@endsection

<style>
    body {
        font-family: 'Georgia', serif;
    }

    .contact-form p,
    .contact-info p {
        color: #000; /* Texte en noir */
    }

    .contact-info h4 {
        color: #000; /* Titre en noir */
    }

    .contact-info i {
        color: #126abd; /* Couleur des icônes */
    }
</style>
