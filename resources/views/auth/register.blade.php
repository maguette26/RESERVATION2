@extends('frontend.layout')

@section('content')
<style>
    .bg-image {
        background-image: url('storage/images/hero.jpg'); /* Remplacez par votre image de fond */
        background-size: cover;
        background-position: center;
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .close-btn {
        position: absolute;
        top: 10px;
        right: 15px;
        color: #ffffff; /* Couleur blanche pour le bouton de fermeture */
        font-size: 1.2rem;
        cursor: pointer;
    }
    .close-btn:hover {
        color: #ffcccc; /* Couleur rose clair au survol */
    }
    .card {
        background-color: rgba(255, 255, 255, 0.85); /* Couleur de la carte légèrement transparente */
        border: none;
    }

    .card-header {
        background-color: rgba(0, 0, 0, 0.7); /* Fond sombre semi-transparent */
        color: #ffffff; /* Texte blanc pour le contraste */
    }

    .form-control {
        background-color: rgba(255, 255, 255, 0.9); /* Fond de champ de formulaire légèrement transparent */
        border: 1px solid #ccc; /* Bordure claire */
    }

    .form-check-label, .text-gray-600 {
        color: #333333; /* Couleur gris foncé pour une meilleure lisibilité */
    }

    .btn-primary {
        background-color: #007bff; /* Couleur bleue primaire */
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Couleur bleue plus foncée au survol */
        border-color: #0056b3;
    }

    .policy-link {
        color: #007bff;
    }

    .policy-link:hover {
        color: #0056b3;
    }

</style>

<div class="bg-image">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg rounded-4">
                    <div class="card-header text-center rounded-top">
                        <h4 class="mb-0">Inscription</h4>
                        <!-- Bouton de fermeture -->
                        <a href="{{ url('/') }}" class="close-btn">&times;</a>
                    </div>
                        @if($errors->any())
                            <div class="alert alert-danger">
                                @foreach($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="mb-4">
                                <label for="name" class="form-label">Nom</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control @error('prenom') is-invalid @enderror" id="prenom" name="prenom" value="{{ old('prenom') }}">
                                @error('prenom')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="phone" class="form-label">Téléphone</label>
                                <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" name="phone" value="{{ old('phone') }}" required>
                                @error('phone')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="email" class="form-label">Adresse e-mail</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
                                @error('email')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="password" class="form-label">Mot de passe</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                                @error('password')
                                    <div class="invalid-feedback">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                            <div class="form-check mb-4">
                                <input type="checkbox" class="form-check-input" id="terms" required>
                                <label class="form-check-label" for="terms">
                                    J'accepte les <a href="#" class="policy-link">termes et conditions</a> de la politique de confidentialité
                                </label>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <button type="submit" class="btn btn-primary">
                                    Créer un compte
                                </button>
                                <a class="text-sm text-gray-600" href="{{ route('login') }}">
                                    {{ __('Déjà inscrit?') }}
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
