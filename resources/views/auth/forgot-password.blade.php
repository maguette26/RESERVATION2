@extends('frontend.layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <div class="card shadow-lg border-light rounded-4">
                <div class="card-header bg-primary text-white text-center rounded-top">
                    <h4 class="mb-0">Réinitialisation du mot de passe</h4>
                </div>
                <div class="card-body">
                    <div class="mb-4 text-sm text-gray-600">
                        {{ __('Vous avez oublié votre mot de passe? Pas de problème. Indiquez-nous simplement votre adresse e-mail et nous vous enverrons un lien de réinitialisation de mot de passe .') }}
                    </div>

                    @if (session('status'))
                        <div class="alert alert-success mb-4">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <!-- Email Address -->
                        <div class="mb-4">
                            <label for="email" class="form-label">{{ __('Email') }}</label>
                            <input id="email" class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus />
                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="btn btn-primary w-30">
                                {{ __('Envoyer ') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
