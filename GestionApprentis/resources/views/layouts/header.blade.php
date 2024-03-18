<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('asset/images/AlgeriePoste.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-white">
            <div class="container">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('asset/images/AlgeriePoste.svg') }}" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('dashboard') }}">Dashboard</a> <!-- Added text-dark class -->
                        </li>
                        @auth
                        <li class="nav-item">
                            <span class="nav-link text-dark">Bienvenue, {{ Auth::user()->name }}</span> <!-- Added text-dark class -->
                        </li>
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link text-dark">Logout</button> <!-- Added text-dark class -->
                            </form>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('login') }}">Login</a> <!-- Added text-dark class -->
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" href="{{ route('register') }}">Register</a> <!-- Added text-dark class -->
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>