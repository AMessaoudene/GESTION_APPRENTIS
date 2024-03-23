@extends('layouts.layout')
@section('title, Evaluation MA')
@section('content')
<form method="POST" action="{{ route('evaluation_maitre_apprentis.store') }}">
    @csrf
    <label>reference
        <input type="text" name="reference">
    </label><br/>
    <label>structure attache
        <input type="text" name="structureattache" readonly>
     </label><br/>
    <input type="submit" value="Ajouter">
</form>
@endsection