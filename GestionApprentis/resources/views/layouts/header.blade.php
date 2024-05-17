<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" href="{{ asset('asset/images/AlgeriePoste.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            flex-direction: column;
            min-height: 100vh; /* Set body minimum height to 100% of viewport height */
            margin: 0; /* Remove default margin */
        }
        .navbar-brand img {
            margin-right: 10px;
        }
        .navbar-toggler {
            border-color: transparent;
        }
        .navbar-nav .nav-item {
            margin-right: 10px;

        }
        .nav-link {
            color: darkblue !important;
        }
        main {
            padding-top: 20px;
            flex-grow: 1; /* Grow to fill remaining vertical space */
        }
        .navbar-nav .nav-item .nav-link {
            display: flex;
            align-items: center;
        }
        .nav-item .logout-button {
            padding: 0;
        }
        footer {
            background-color: #f8f9fa;
            text-align: center;
            padding: 0 0;
            margin: 0;
        }
    </style>
</head>
<body>
    <header>
        <nav style="max-height: 100px;"class="navbar navbar-expand-lg bg-body-tertiary  " >
            <div class="container">
                <a class="navbar-brand" href="/">
                    <img src="{{ asset('asset/images/AlgeriePoste.svg') }}" alt="Logo" width="70" height="70" class="d-inline-block align-text-top">
                </a>
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <div class="navbar-nav ">
                        @auth
                        <li class="nav-item">
                            <span class="nav-link">
                                Bienvenue, 
                                <a href="{{ url('/profile') }}" class="nav-link">{{ Auth::user()->nom }}</a>
                            </span>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">Register</a>
                        </li>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-HXE74I+8CiOmGjZDQ0P3+gaTEjm9vLC+4z8/9ltdUgY+ntMx7ZD1jd4AR30yZa0mytBipRwu2QgWJitQ53ZYvA==" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-KyZXEAg3QhqLMpG8r+Knujsl5+zEK5+2mL7P8JMF6srY6U5cXInFJwJ8ERdknLPM" crossorigin="anonymous"></script>