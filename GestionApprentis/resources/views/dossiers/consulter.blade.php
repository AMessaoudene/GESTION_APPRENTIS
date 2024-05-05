@extends('layouts.layout')
@section('title','Dossiers')
@section('content')
<h1>Liste des dossiers</h1>
<table id="dossiers-table" class="table table-striped mt-4">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Structure</th>
            <th>PV</th>
            <th>Extrait de naissance</th>
            <th>Contrat</th>
            <th>Decision Apprenti</th>
            <th>Decision MA</th>
            <th>Cheque barré</th>
            <th>Photo</th>
            <th>Autorisation parentale</th>
            <th>Piece d'identité</th>
            <th>Statut</th>
            <th>Motif</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($apprentis as $apprenti)
            <tr>
                <td>{{$apprenti->id}}</td>
                <td>{{$apprenti->nom}}</td>
                <td>{{$apprenti->prenom}}</td>
                @foreach($structures as $structure)
                    @if($structure->id == $apprenti->structure_id)
                        <td>{{$structure->nom}}</td>
                    @endif
                @endforeach
                @foreach($dossiers as $dossier)
                    @if($dossier->id == $apprenti->dossier_id)
                    <td><a href="{{ url('/apprentis/fichiers/download', $dossier->pvinstallation) }}">voir</a></td>
                    <td><a href="{{ url('/apprentis/fichiers/download', $dossier->contratapprenti) }}">voir</a></td>
                    <td><a href="{{ url('/apprentis/fichiers/download', $dossier->extraitnaissance) }}">voir</a></td>
                    <td><a href="{{ url('/apprentis/fichiers/download', $dossier->decisionapprenti) }}">voir</a></td>
                    <td><a href="{{ url('/apprentis/fichiers/download', $dossier->decisionmaitreapprenti) }}">voir</a></td>
                    <td><a href="{{ url('/apprentis/fichiers/download', $dossier->copiecheque) }}">voir</a></td>
                    @if($dossier->photo)
                        <td><a href="{{ url('/apprentis/fichiers/download', $dossier->photo) }}">voir</a></td>
                    @else
                        <td>Aucun</td>
                    @endif
                    @if($dossier->autorisationparentale)
                        <td><a href="{{ url('/apprentis/fichiers/download', $dossier->autorisationparentale) }}">voir</a></td>
                    @else
                        <td>Aucun</td>
                    @endif
                    @if($dossier->pieceidentite)
                        <td><a href="{{ url('/apprentis/fichiers/download', $dossier->pieceidentite) }}">voir</a></td>
                    @else
                        <td>Aucun</td>
                    @endif
                        @if(auth::user()->role === 'SA')
                            <td>{{$dossier->status}}</td>
                            <td>{{$dossier->motif}}</td>
                        @elseif(auth::user()->role === 'DFP')
                            <td>
                                <select name="status" id="">
                                    <option value="" disabled>-- Choisir --</option>
                                    <option value="en cours">en cours</option>
                                    <option value="valide">valide</option>
                                    <option value="refuse">refuse</option>
                                </select>
                            </td>
                            <td><textarea name="motif" id="" cols="30" rows="10"></textarea></td>
                            <td><button type="submit">Valider</button></td>
                        @endif
                        <td><button>Supprimer</button></td>
                    @endif
                @endforeach
            </tr>
        @endforeach
    </tbody>
</table>
@endsection