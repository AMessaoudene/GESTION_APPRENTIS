@extends('layouts.layout')

@section('content')
<form method="post" action="{{ route('utilisateurs.completion') }}">
    @csrf
    <select class="form-control" id="id" name="id" required>
        @foreach ($utilisateurs as $utilisateur)
            <option value="{{$utilisateur->id}}">{{ $utilisateur->nom }} {{ $utilisateur->prenom }}</option>  
        @endforeach 
    </select>
    <div class="form-group">
        <label for="nomresponsable">Nom</label>
        <input type="text" class="form-control" id="nomresponsable" name="nomresponsable" value="{{ old('nomresponsable') }}" required>
    </div>
    <div class="form-group">
        <label for="prenomresponsable">Prénom</label>
        <input type="text" class="form-control" id="prenomresponsable" name="prenomresponsable" value="{{ old('prenomresponsable') }}" required>
    </div>
    <div class="form-group">
        <label for="civiliteresponsable">Civilité</label>
        <select class="form-control" id="civiliteresponsable" name="civiliteresponsable" required>
            <option value="M">Monsieur</option>
            <option value="Mme">Madame</option>
        </select>
    </div>
    <div class="form-group">
        <label for="numerofixe">numerofixe</label>
        <input type="phone" class="form-control" id="numerofixe" name="numerofixe" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Enregistrer</button>
</form>
@endsection