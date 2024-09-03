<nav class="navbar navbar-expand-lg navbar-custom">
    <a class="navbar-brand navbar-brand-custom" href="{{ route('dashboard') }}">Admin Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('categorie') }}">Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.index') }}">Événements</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.reservations') }}">Réservations</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.utilisateurs') }}">Utilisateurs</a>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ Auth::user()->name }}
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
                    {{-- <li>
                        <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                    </li> --}}
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">Déconnexion</button>
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
