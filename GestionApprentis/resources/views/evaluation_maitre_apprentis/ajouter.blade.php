@extends('layouts.layout')
@section('title, Evaluation MA')
@section('content')
<form method="POST" action="{{ route('evaluation_maitre_apprentis.submit') }}">
    @csrf
    <label>reference
        <input type="text" name="reference">
    </label><br/>
    <select name="maitreapprentis_id">
        @foreach ($maitre_apprentis as $maitre_apprenti)
            <option value="{{ $maitre_apprenti->id }}">{{ $maitre_apprenti->nom }} {{ $maitre_apprenti->prenom }}</option>
        @endforeach
    </select><br/>
    <label>structure attache
        <input type="text" name="structureattache" readonly>
     </label><br/>
    <input type="submit" value="Ajouter">
</form>
@endsection