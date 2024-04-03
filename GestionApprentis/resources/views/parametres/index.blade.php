@extends('layouts.layout')
@section('title', 'Parametres')
@section('content')
<form method="POST" action="{{ route('parametres.submit') }}" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    <label></label>
    <input type="text" name="decisionresponsable">
    <label></label>
    <input type="date" name="datedecisionresponsable">
    <label></label>
    <input type="text" name="nomresponsable">
    <label></label>
    <input type="text" name="prenomresponsable">
    <label></label>
    <input type="text" name="civiliteresponsable">
    <label></label>
    <input type="text" name="fonctionresponsable">
    <label></label>
    <input type="text" name="typedecisiondg">
    <label></label>
    <input type="date" name="datedecisiondg">
    <label></label>
    <input type="text" name="nomprenomdg">
    <label></label>
    <input type="text" name="decisionpremierresponsable">
    <label></label>
    <input type="date" name="datedecisionpremierresponsable">
    <label></label>
    <input type="text" name="nomprenompremierresponsable">
    <label></label>
    <input type="text" name="fonctionpremierresponsable">
    <label></label>
    <select name="civilitedrh" id="">
        <option value="Monsieur">Mr</option>
        <option value="Madame">Mme</option>
        <option value="Mademoiselle">Mlle</option>
    </select>
    <label></label>
    <select name="civilitedfc" id="">
        <option value="Monsieur">Mr</option>
        <option value="Madame">Mme</option>
        <option value="Mademoiselle">Mlle</option>
    </select>
    <input type="submit" value="Enregistrer">
</form>
<table id="parametres-table">
    <tr>
        <th>Decision responsable</th>
        <th>Date decision responsable</th>
        <th>Nom responsable</th>
        <th>Prenom responsable</th>
        <th>Civilite responsable</th>
        <th>Fonction responsable</th>
    </tr>
    @foreach ($parametres as $parametre)
        <tr>
            <td>{{ $parametre->decisionresponsable }}</td>
            <td>{{ $parametre->datedecisionresponsable }}</td>
            <td>{{ $parametre->nomresponsable }}</td>
            <td>{{ $parametre->prenomresponsable }}</td>
            <td>{{ $parametre->civiliteresponsable }}</td>
            <td>{{ $parametre->fonctionresponsable }}</td>
        </tr>
    @endforeach
</table>
@endserction
