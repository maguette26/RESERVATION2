@extends('frontend.layout')

@section('content')
<style>
    .bg-image {
        background-image: url('storage/images/hero.jpg'); /* Chemin vers l'image de fond */
        background-size: cover;
        background-position: center;
        min-height: 100vh; /* Assurez-vous que l'arrière-plan couvre toute la hauteur de la page */
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        background-color: rgba(255, 255, 255, 0.85); /* Couleur blanche légèrement transparente */
        border: none; /* Retirer la bordure par défaut */
    }

    .card-header {
        background-color: rgba(0, 0, 0, 0.7); /* Fond sombre semi-transparent */
        color: #ffffff; /* Texte en blanc */
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

    .form-control {
        background-color: rgba(255, 255, 255, 0.9); /* Fond de champ de formulaire légèrement transparent */
        border: 1px solid #ccc; /* Bordure claire */
    }

    .form-check-label, .text-gray-600 {
        color: #333333; /* Couleur gris foncé pour une bonne lisibilité */
    }

    .btn-primary {
        background-color: #007bff; /* Couleur bleue primaire */
        border-color: #007bff;
    }

    .btn-primary:hover {
        background-color: #0056b3; /* Couleur bleue plus foncée au survol */
        border-color: #0056b3;
    }

</style>

<div class="bg-image">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg rounded-4">
                    <div class="card-header text-center rounded-top">
                        <h4 class="mb-0">Connexion</h4>
                        <!-- Bouton de fermeture -->
                        <a href="{{ url('/') }}" class="close-btn">&times;</a>
                    </div>
                    <div class="card-body">
                        <!-- Session Status -->
                        <x-auth-session-status class="mb-4" :status="session('status')" />

                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <!-- Email Address -->
                            <div class="mb-4">
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>

                            <!-- Password -->
                            <div class="mb-4">
                                <x-input-label for="password" :value="__('Mot de passe')" />
                                <x-text-input id="password" class="form-control @error('password') is-invalid @enderror" type="password" name="password" required autocomplete="current-password" />
                                <x-input-error :messages="$errors->get('password')" class="mt-2" />
                            </div>

                            <!-- Remember Me -->
                            <div class="form-check mb-4">
                                <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                                <label class="form-check-label" for="remember_me">{{ __('Se souvenir de moi') }}</label>
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                @if (Route::has('password.request'))
                                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                                        {{ __('Mot de passe oublié?') }}
                                    </a>
                                @endif

                                <button type="submit" class="btn btn-primary w-30">
                                    {{ __('Se connecter') }}
                                </button>
                            </div>

                            <!-- Link to Registration Page -->
                            <div class="mt-4 text-center">
                                <span class="text-sm text-gray-600">{{ __("Vous n'avez pas de compte?") }}</span>
                                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                                    {{ __('Inscrivez-vous ici') }}
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
