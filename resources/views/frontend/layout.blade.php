<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SenReserv Evens</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- CSS de Bootstrap -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.2.3/css/bootstrap.min.css" rel="stylesheet">

<!-- JS de jQuery et Bootstrap -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Playball&display=swap" rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <link href="{{asset('lib/lightbox/css/lightbox.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/owlcarousel/owl.carousel.min.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <!-- Customized Bootstrap Stylesheet -->

    <!-- Template Stylesheet -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">

    <!-- Additional Stylesheet -->

    <!-- Custom Styles for Times New Roman -->
    <style>
        body, h1, h2, h3, h4, h5, h6, p, a, button, input, select {
            font-family: 'Times New Roman', Times, serif;



        }
    </style>
</head>
<body>

    <!-- Spinner End -->

    <!-- Header Section Start -->

<header class="container-fluid nav-bar">
    <div class="container">
        <nav class="navbar navbar-light navbar-expand-lg py-4">
            <a href="{{ url('/')}}" class="navbar-brand">
                <h1 class="text-primary fw-bold mb-0">SenReserv<span class="text-dark"> Evens</span> </h1>
            </a>
            <button class="navbar-toggler py-2 px-3" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="fa fa-bars text-primary"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav mx-auto">
                    <a href="{{ url('/')}}" class="nav-item nav-link">Accueil</a>
                    <a href="{{ url('ap')}}" class="nav-item nav-link">À propos</a>
                    <div class="dropdown">
                        <a class="btn btn-secondary dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Catégorie
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('categorie.concert') }}" class="dropdown-item">Concert</a></li>
                            <li><a href="{{ route('categorie.conference') }}" class="dropdown-item">Conférence</a></li>
                            <li><a href="{{ route('categorie.exposition') }}" class="dropdown-item">Exposition d'art</a></li>
                        </ul>
                    </div>
                    <a href="{{ url('contact')}}" class="nav-item nav-link">Contact</a>
                </div>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                   
                        @guest
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" id="authDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="authDropdown">
                                <li><a class="dropdown-item" href="{{ route('login') }}">Connexion</a></li>
                                <li><a class="dropdown-item" href="{{ route('register') }}">Inscription</a></li>
                            </ul>
                        </li>
                        @endguest

                        <!-- Panier -->
                          {{-- <li class="nav-item">
                            <a href="{{ route('cart.index') }}" class="nav-link">
                                <i class="fa fa-shopping-bag" aria-hidden="true"></i> Panier ({{ $count }})
                            </a>
                        </li>  --}}
                        <li class="nav-item">
                            <button type="button" class="btn btn-outline-secondary d-flex align-items-center" data-bs-toggle="modal" data-bs-target="#searchModal" style="padding: 0.5rem 1rem; box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);">
                                <i class="fa fa-search fa-lg"></i> <span class="ms-2">Rechercher</span>
                            </button>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>


    <!-- Header Section End -->

    <!-- Search Modal Start -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="searchModalLabel">Rechercher un Événement</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <form action="{{ route('recherche') }}" method="GET">
                        <div class="input-group">
                            <input type="search" name="query" class="form-control form-control-lg" placeholder="Recherchez un événement" required>
                            <button class="btn btn-primary btn-lg" type="submit">Rechercher</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Events Section Start -->
    @yield('content')
    <!-- Events Section End -->

    <footer class="container-fluid bg-primary text-white py-5">
        <div class="container text-center">
            <div class="footer-text mt-4">
                <p>&copy; 2024 SenReserv Events. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <!-- Custom JavaScript -->
    <script src="{{ asset('js/custom.js') }}"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>
