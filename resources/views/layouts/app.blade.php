<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'SenReserv') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Custom CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Additional Custom Styles -->
    <style>
        .navbar-custom {
            background-color: #1e7fe0; /* Blue background color */
        }
        .navbar-brand-custom {
            color: #fff; /* White text color */
        }
        .navbar-custom .nav-link {
            color: #fff; /* White text color for nav links */
        }
        .navbar-custom .dropdown-menu {
            background-color: #f8f9fa; /* Light background for dropdown */
        }
    </style>
</head>
<body class="font-sans antialiased bg-light">
    @include('layouts.navigation')

    @if (session('notice'))
        <div class="alert alert-info alert-custom" role="alert">
            {{ session('notice') }}
        </div>
    @endif

    <!-- Page Heading -->
    @if (isset($header))
        <header class="bg-white shadow-sm">
            <div class="container py-4">
                {{ $header }}
            </div>
        </header>
    @endif

    <!-- Page Content -->
    <main class="container my-4">
        @yield('content')
    </main>

    <!-- Bootstrap JS (with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
