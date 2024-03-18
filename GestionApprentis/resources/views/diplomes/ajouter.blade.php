@extends('layouts.layout')
@section('title','Diplome | Ajouter')
@section('content')
<h1>Ajouter un diplome</h1>
<form action="{{ route('diplomes.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nom">Nom :</label>
        <input type="text" class="form-control" id="nom" name="nom" required>
    </div>
    <div class="form-group">
        <label for="duree">Duree :</label>
        <input type="text" class="form-control" id="duree" name="duree" required>
    </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
@endsection