@extends('layouts.layout')
@section('title', 'Utilisateur | Ajouter')
@section('content')
<div class="container">
    <form method="POST" action="{{ route('utilisateurs.store') }}">
        @csrf
        <label>
            Nom <input type="text" name="nom">
        </label>
        <label>
            Role <select name="role">{{ $types }}</select>
            <option></option>
        </label>
        <label>
            Email <input type="email" name="email">
        </label>
        <label>
            Mot de passe <input type="password" name="password">
        </label>

        <input type="submit">
@endsection