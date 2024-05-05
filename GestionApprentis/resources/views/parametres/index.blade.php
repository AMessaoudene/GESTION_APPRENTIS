@extends('layouts.layout')
@section('title', 'Parametres')
@section('content')
<h1>Parametres</h1><br/>
<form method="POST" action="{{ route('parametres.store') }}" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    <label for="">Reference
        <input type="text" name="reference" id="">
    </label>
    <label>
        Decision responsable
    </label>
    <input type="text" name="decisionresponsable">
    <label>
        Date decision responsable
    </label>
    <input type="date" name="datedecisionresponsable">
    <label>
        Nom responsable
    </label>
    <input type="text" name="nomresponsable">
    <label>
        Prenom responsable
    </label>
    <input type="text" name="prenomresponsable">
    <label>
        Civilite responsable
    </label>
    <input type="text" name="civiliteresponsable">
    <label>
        Fonction responsable
    </label>
    <input type="text" name="fonctionresponsable">
    <label>
        Type Decision DG
    </label>
    <input type="text" name="typedecisiondg">
    <label>
        Date Decision DG
    </label>
    <input type="date" name="datedecisiondg">
    <label>
        Nom et Prenom DG
    </label>
    <input type="text" name="nomprenomdg">
    <label>
        Decision premier responsable
    </label>
    <input type="text" name="decisionpremierresponsable">
    <label>
        Date decision premier responsable
    </label>
    <input type="date" name="datedecisionpremierresponsable">
    <label>
        Nom et Prenom premier responsable
    </label>
    <input type="text" name="nomprenompremierresponsable">
    <label>
        Fonction premier responsable
    </label>
    <input type="text" name="fonctionpremierresponsable">
    <label>
        Civilite DRH
    </label>
    <select name="civilitedrh" id="">
        <option value="">-- Choisir --</option>
        <option value="Monsieur">Mr</option>
        <option value="Madame">Mme</option>
        <option value="Mademoiselle">Mlle</option>
    </select>
    <label>
        Civilite DFC
    </label>
    <select name="civilitedfc" id="">
        <option value="">-- Choisir --</option>
        <option value="Monsieur">Mr</option>
        <option value="Madame">Mme</option>
        <option value="Mademoiselle">Mlle</option>
    </select>
    <input type="submit" value="Enregistrer">
</form>
<table id="parametres-table">
    <tr>
        <th>Reference</th>
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
            <td>{{ $parametre->reference }}</td>
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
@endsection
