<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('asset/images/AlgeriePoste.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('asset/images/AlgeriePoste.svg') }}" alt="Logo" width="50" height="50" class="d-inline-block align-text-top">
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="{{ route('planbesoins.index') }}" class="nav-link">Plan Des Besoins</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('structures.index') }}">Structures</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('apprentis.index') }}">Apprentis</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('maitreapprentis.index') }}">Maitre Apprentis</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('diplomes.index') }}">Diplomes</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('specialites.index') }}">Specialites</a>
                        </li>
                        @auth
                        <li class="nav-item">
                            <span class="nav-link">Bienvenue, {{ Auth::user()->name }}</span>
                        </li>
                        <li class="nav-item">
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">Logout</button>
                            </form>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-HXE74I+8CiOmGjZDQ0P3+gaTEjm9vLC+4z8/9ltdUgY+ntMx7ZD1jd4AR30yZa0mytBipRwu2QgWJitQ53ZYvA==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+zEK5+2mL7P8JMF6srY6U5cXInFJwJ8ERdknLPM" crossorigin="anonymous"></script>