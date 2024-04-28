@extends('layouts.layout')
@section('title', 'Apprentis | Dossiers')
<link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
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
        <label for="extraitnaissance">extrait de naissance</label>
        <input type="file" class="form-control" id="extraitnaissance" name="extraitnaissance" required>
        <label for="autorisationparentele">autorisationparentele</label>
        <input type="file" class="form-control" id="autorisationparentele" name="autorisationparentele">
        <label for="photo">photo</label>
        <input type="file" class="form-control" id="photo" name="photo">
    </div>
    <button type="submit" class="btn btn-primary">Ajouter</button>
    <table id="dossiers-table">
        <thead>
            <tr>
                <th>Apprenti ID</th>
                <th>PV d'installation</th>
                <th>Decision d'apprenti</th>
                <th>Decision Maitre d'apprentis</th>
                <th>Contrat Apprenti</th>
                <th>copie cheque</th>
                <th>extrait de naissance</th>
                <th>autorisationparentele</th>
                <th>photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($dossiers as $dossier)
    <tr>
        <td>{{ $dossier->apprentis_id }}</td>
        <td><a href="{{ url('/apprentis/fichiers/download', $dossier->pvinstallation) }}">PV d'installation</a></td>
        <td><a href="{{ url('/apprentis/fichiers/download', $dossier->decisionapprenti) }}">Decision Apprenti</a></td>
        <td><a href="{{ url('/apprentis/fichiers/download', $dossier->decisionmaitreapprenti) }}">Decision Maitre d'apprentis</a></td>
        <td><a href="{{ url('/apprentis/fichiers/download', $dossier->contratapprenti) }}">Contrat Apprenti</a></td>
        <td><a href="{{ url('/apprentis/fichiers/download', $dossier->copiecheque) }}">copie cheque</a></td>
        <td><a href="{{ url('/apprentis/fichiers/download', $dossier->extraitnaissance) }}">extrait de naissance</a></td>

        @if($dossier->autorisationparentele)
            <td><a href="{{ url('/apprentis/fichiers/download', $dossier->autorisationparentele) }}">autorisation parentale</a></td>
        @else
            <td>Aucun</td>
        @endif

        @if($dossier->photo)
            <td><a href="{{ url('/apprentis/fichiers/download', $dossier->photo) }}">Photo</a></td>
        @else
            <td>Aucun</td>
        @endif
    </tr>
@endforeach
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dossiers-table').DataTable();
        });
    </script>
</form>
@endsection