@extends('layouts.layout')
@section('title', 'Apprentis | Dossiers')
@section('content')
<form method="POST" action="{{ route('dossiers.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="contratapprenti">Contrat</label>
        <input type="file" class="form-control" id="contratapprenti" name="contratapprenti" required>
        <label for="decisionapprenti">Decision d'apprenti</label>
        <input type="file" class="form-control" id="decisionapprenti" name="decisionapprenti" required>
        <label for="decisionmaitreapprenti">Decision Maitre d'apprentis</label>
        <input type="file" class="form-control" id="decisionmaitreapprenti" name="decisionmaitreapprenti" required>
        <label for="pvinstallation">PV d'Installation</label>
        <input type="file" class="form-control" id="pvinstallation" name="pvinstallation" required>
        <label for="copiecheque">copie cheque</label>
        <input type="file" class="form-control" id="copiecheque" name="copiecheque" required>
        <label for="extraitnaissance">:extrait de naissance</label>
        <input type="file" class="form-control" id="extraitnaissance" name="extraitnaissance" required>
        <label for="autorisationparentele">autorisationparentele</label>
        <input type="file" class="form-control" id="autorisationparentele" name="autorisationparentele">
        <label for="photo">photo</label>
        <input type="file" class="form-control" id="photo" name="photo">
    </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
@endsection