@extends('layouts.layout')
@section('title', 'Assisduité | Ajouter')
@section('content')
<form action="{{ route('assiduites.submit') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <select name="apprenti_id">
        @foreach ($apprentis as $apprenti)
            <option value="{{ $apprenti->id }}">{{ $apprenti->nom }} {{ $apprenti->prenom }}</option>
        @endforeach
    </select><br/>
    <select name="type">
        <option value="absence">absence</option>
        <option value="maladiecourte">maladie courte</option>
        <option value="maladielongue">maladie longue</option>
        <option value="arrettravail">arret de travail</option>
    </select><br/>
    <input type="date" name="datedebut"/><br/>
    <input type="date" name="datefin"/><br/>
    <textarea type="text" name="motif" rows="4" cols="50">
    </textarea><br/>
    <input type="file" name="preuve"/><br/>
    <input type="submit" value="Ajouter"/>
</form>
<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Type</th>
            <th>Date debut</th>
            <th>Date fin</th>
            <th>Motif</th>
            <th>Preuve</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($assiduites as $assiduite)
            <tr>
                <td>{{ $apprenti->nom }}</td>
                <td>{{ $apprenti->prenom }}</td>
                <td>{{ $assiduite->type }}</td>
                <td>{{ $assiduite->datedebut }}</td>
                <td>{{ $assiduite->datefin }}</td>
                <td>{{ $assiduite->motif }}</td>
                <td>{{ $assiduite->preuve }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection