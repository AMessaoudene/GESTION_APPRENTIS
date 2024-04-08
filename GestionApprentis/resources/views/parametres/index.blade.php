@extends('layouts.layout')
@section('title', 'Parametres')
@section('content')
<h1>Parametres</h1><br/>
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
        <th>Decision DG</th>
        <th>Date decision DG</th>
        <th>Nom et prenom DG</th>
        <th>Decision premier responsable</th>
        <th>Date decision premier responsable</th>
        <th>Nom et prenom premier responsable</th>
        <th>Fonction premier responsable</th>
        <th>Civilite RH</th>
        <th>Civilite Fc</th>
    </tr>
    @foreach ($parametres as $parametre)
        <tr>
            <td>{{ $parametre->decisionresponsable }}</td>
            <td>{{ $parametre->datedecisionresponsable }}</td>
            <td>{{ $parametre->nomresponsable }}</td>
            <td>{{ $parametre->prenomresponsable }}</td>
            <td>{{ $parametre->civiliteresponsable }}</td>
            <td>{{ $parametre->fonctionresponsable }}</td>
            <td>{{ $parametre->typedecisiondg }}</td>
            <td>{{ $parametre->datedecisiondg }}</td>
            <td>{{ $parametre->nomprenomdg }}</td>
            <td>{{ $parametre->decisionpremierresponsable }}</td>
            <td>{{ $parametre->datedecisionpremierresponsable }}</td>
            <td>{{ $parametre->nomprenompremierresponsable }}</td>
            <td>{{ $parametre->fonctionpremierresponsable }}</td>
            <td>{{ $parametre->civilitedrh }}</td>
            <td>{{ $parametre->civilitedfc }}</td>
        </tr>
    @endforeach
</table>
@endserction
