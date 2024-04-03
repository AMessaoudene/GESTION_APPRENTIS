@extends('layouts.layout')
@section('title', 'Exercices')
@section('content')
<form action="{{ route('exercices.store') }}" method="POST">
    @csrf
    <label for="annee">Année</label>
    <input type="text" pattern="[0-9]+" name="annee">
    <label for="datedebut">Date debut</label>
    <input type="date" name="datedebut">
    <label for="datefin">Date fin</label>
    <input type="date" name="datefin">
    <label for="nombrebesoins">Nombre besoins</label>
    <input type="text" pattern="[0-9]+" name="nombrebesoins">
    <label for="massesalariaire">Masse salariaire</label>
    <input type="text" id="massesalariaire" pattern="[0-9]+" name="massesalariaire">
    <label for="budget">Budget</label>
    <input type="text" id="budget" name="budget" readonly disabled>
    <button type="submit">Submit</button>
</form>
@endSection
<script>
    // calculate budget=massesalariaire*0.01
    document.getElementById('budget').value = document.getElementById('massesalariaire').value * 0.01;
    document.getElementById("massesalariaire").addEventListener("input", function() {
        document.getElementById('budget').value = document.getElementById('massesalariaire').value * 0.01;
    });
</script>