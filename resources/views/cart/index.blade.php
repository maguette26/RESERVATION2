@extends('frontend.layout')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h4>Votre Panier</h4>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if ($panier->isEmpty())
                <div class="alert alert-warning">Votre panier est vide.</div>
            @else
                <style>
                    .item-image {
                        width: 100px; /* Ajustez cette valeur selon vos besoins */
                        height: 100px; /* Assurez-vous que la hauteur est proportionnelle à la largeur */
                        object-fit: cover; /* Assure que l'image couvre le conteneur sans déformation */
                        margin-right: 15px; /* Espace entre l'image et le texte */
                        border-radius: 5px; /* Pour des coins légèrement arrondis si souhaité */
                    }

                    .update-form {
                        margin-bottom: 1rem;
                    }

                    .quantity-input {
                        width: 80px; /* Ajustez la largeur selon vos besoins */
                    }
                </style>

                <ul class="list-group mb-4" id="cart-items">
                    @foreach ($panier as $item)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div class="row w-100">
                                <div class="col-md-2 d-flex justify-content-center align-items-center">
                                    <img src="{{ asset($item->attributes->image) }}" alt="Image de l'événement" class="item-image">
                                </div>
                                <div class="col-md-8">
                                    <h5 class="mb-1">{{ $item->name }}</h5>
                                    <small>{{ $item->quantity }} x {{ $item->price }} DH</small>
                                </div>
                                <div class="col-md-2 d-flex flex-column align-items-end">
                                    <form action="{{ route('cart.update', $item->id) }}" method="POST" class="update-form">
                                        @csrf
                                        @method('PATCH')
                                        <div class="input-group input-group-sm mb-2">
                                            <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" class="form-control quantity-input" aria-label="Quantité" data-item-id="{{ $item->id }}" data-price="{{ $item->price }}">
                                            <div class="input-group-append">
                                                <span class="input-group-text">Ajouter le nombre de tickets souhaité</span>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-outline-primary btn-sm">Mettre à jour</button>
                                    </form>
                                    <form action="{{ route('cart.destroy', $item->id) }}" method="POST" class="mt-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-outline-danger btn-sm" onclick="return confirmDelete()">Supprimer</button>
                                    </form>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>

                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4>Total :</h4>
                    <h4 id="total">{{ $total }} DH</h4>
                </div>

                <a href="{{ route('checkout.index', ['id' => $panier->first()->id]) }}" class="btn btn-success">Passer à la caisse</a>
            @endif
        </div>
    </div>
</div>
@endsection

.
