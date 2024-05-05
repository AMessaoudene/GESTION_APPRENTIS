@extends('layouts.layout')
@section('title', 'Dashboard')
<style>
    .custom-button {
        padding: 20px 40px;
        font-size: 18px;
        border-radius: 10px;
        margin: 10px;
        display: block;
        text-align: center;
        text-decoration: none;
        color: #fff;
        background-color: #007bff;
        border: 1px solid #007bff;
        transition: all 0.3s ease;
    }

    .custom-button:hover {
        background-color: #0056b3;
        border-color: #0056b3;
    }

    .custom-button:last-child {
        margin-bottom: 0;
    }

    .container {
        max-width: 800px;
        margin: 0 auto;
        padding-top: 50px;
    }

    h1 {
        text-align: center;
        margin-bottom: 50px;
        color: #333;
    }
</style>
@section('content')
<div class="container mt-5 mb-5">
    <h1 class="text-center mb-5">Bienvenue sur DFP Dashboard</h1>
    <a href="{{ route('comptes.index')}}" class="custom-button">Gestion des comptes</a>
    <a href="#" class="custom-button">Gestion des apprentis</a>
    <a href="{{ route('maitreapprentis.index')}}" class="custom-button">Gestion des maîtres apprentis</a>
    <a href="{{ route('structures.index')}}" class="custom-button">Gestion des structures</a>
    <a href="#" class="custom-button">Gestion des plans de besoins</a>
</div>
@endsection
