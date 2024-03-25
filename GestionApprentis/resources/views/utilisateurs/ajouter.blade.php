@extends('layouts.layout')
@section('title', 'Utilisateur | Ajouter')
@section('content')
<div class="container">
    <form method="post" action="{{ route('utilisateurs.submit') }}">
        @csrf
        <label>Structure</label>
        <select name="structure_id">
            @foreach ($structures as $structure)
                <option value="{{$structure->id}}">{{ $structure->nom }}</option>
            @endforeach
        </select><br/>
        <label>Role</label>
        <select name="role">
            <option value="DFP">DFP</option>
            <option value="DRH">DRH</option>
            <option value="SA">Structure accueil</option>
            <option value="EvaluateurN+1">Evaluateur N+1</option>
        </select><br/>
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        <label>Mot de passe</label>
        <input type="password" name="password" required>
        <button type="submit">Ajouter</button>
    </form>
</div>
@endsection