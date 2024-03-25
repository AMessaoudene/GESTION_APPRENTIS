@extends('layouts.layout')
@section('title', 'Structure | Ajouter')
@section('content')
<form method="POST" action="{{ route('structures.submit') }}" class="form-horizontal">
    @csrf
    <label>Nom</label>
    <input type="text" name="nom" class="form-control">
    <br>
    <label>Adresse courriel</label>
    <input type="text" name="adressecourriel" class="form-control">
    <br>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
@endsection