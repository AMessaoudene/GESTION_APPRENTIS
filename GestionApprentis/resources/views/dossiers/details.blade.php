@extends('layouts.layout')
@section('title','Apprenti | details')
@section('content')
<div class="container">
    <h1 style="text-align:center;">Dossier de l'apprenti</h1>
    <div class="row">
        <div class="col-lg-6">
            <h2>Informations personnelles</h2>
            <ul class="list-group">
                <li class="list-group-item">ID : <input type="text" value="{{ $apprenti->id }}" readonly disabled></li>
                <li class="list-group-item">Nom : <input type="text" name="nom" value="{{ $apprenti->nom }}"></li>
                <li class="list-group-item">Prenom : <input type="text" name="prenom" value="{{ $apprenti->prenom }}"> </li>
                <li class="list-group-item">Adresse : <input type="text" name="adresse" value="{{ $apprenti->adresse }}"> </li>
                <li class="list-group-item">Téléphone : <input type="text" pattern="" name="telephone" value="{{ $apprenti->telephone }}"></li>
                <li class="list-group-item">Email : <input type="email" name="email" value="{{ $apprenti->email }}"> </li>
                <li class="list-group-item">Civilité : 
                    <select name="civilite" value="{{ $apprenti->civilite }}">
                        <option value="">-- Choisir --</option>
                        <option value="M">M.</option>
                        <option value="Mme">Mme</option>
                        <option value="Mlle">Mlle</option>
                    </select>
                </li>
                <li class="list-group-item">Numéro du contrat : <input type="text" name="numcontrat" value="{{ $apprenti->numcontrat }}"></li>
                <li class="list-group-item">Date du contrat : <input type="date" name="datecontrat" value="{{ $apprenti->datecontrat }}"></li>
                <li class="list-group-item">Date de début du contrat : <input type="date" name="datedebut" value="{{ $apprenti->datedebut }}"></li>
                <li class="list-group-item">Date de fin du contrat : <input type="date" name="datefin" value="{{ $apprenti->datefin }}"></li>
                <li class="list-group-item">Date du transfert : <input type="date" name="datetransfert" value="{{ $apprenti->datetransfert }}"> </li>
                <li class="list-group-item">Niveau Scolaire : 
                    <select name="niveauscolaire" value="{{ $apprenti->niveauscolaire }}">
                        <option value="">-- Choisir --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                </li>
                <li class="list-group-item">Spécialité : 
                    <select name="specialite_id" value="{{ $specialite->id }}">
                    <option value="">-- Choisir --</option>
                        @foreach($specialites as $specialite)
                            <option value="{{ $specialite->id }}">{{ $specialite->nom }}</option>
                        @endforeach
                    </select>
                 </li>
                <li class="list-group-item">Diplôme : 
                    <select name="diplome_id" value="{{ $ }}">
                    <option value="">-- Choisir --</option>
                        @foreach($diplomes as $diplome)
                            <option value="{{ $diplome->id }}">{{ $diplome->nom }}</option>
                        @endforeach
                    </select>
                </li>
                <li class="list-group-item">Structure : 
                    <select name="" value="{{ $s }}">
                </li>
            </ul>
        </div>
        <div class="col-lg-6">
            <h2>PV</h2>
            <ul class="list-group">
                <li class="list-group-item">Référence : <input type="text" name="" value="{{ $ }}"></li>
                <li class="list-group-item">Date du PV : <input type="date" name="" value="{{ $ }}"></li>
                <li class="list-group-item">Maitre Apprenti : <input type="text" name="" value="{{ $ }}"></li>
                <li class="list-group-item">Date installation : <input type="date" name="" value="{{ $ }}"> </li>
                <li class="list-group-item">Année d'installation (lettre) : <input type="text" name="" value="{{ $ }}"> </li>
                <li class="list-group-item">Mois d'installation (lettre) : <input type="text" name="" value="{{ $ }}"> </li>
                <li class="list-group-item">Jour d'installation (lettre) : <input type="text" name="" value="{{ $ }}"> </li>
                <li class="list-group-item">Direction d'affectation : <input type="text" name="" value="{{ $ }}"> </li>
                <li class="list-group-item">Service d'affectation : <input type="text" name="" value="{{ $ }}"> </li>
                <li class="list-group-item">Dotations : <input type="text" name="" value="{{ $ }}"> </li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h2>Decision Apprenti</h2>
            <ul class="list-group">
                @foreach($decisionapprentis as $decisionapprenti)
                    @if($decisionapprenti->pv_id == $pv->id)
                        <li class="list-group-item">ID : <input type="text" name="" value="{{ $ }}"></li>
                        <li class="list-group-item">Plan Besoin ID : <input type="text" name="" value="{{ $ }}"></li>
                        <li class="list-group-item">Référence : <input type="text" name="" value="{{ $ }}"> </li>
                        <li class="list-group-item">Date Decision : <input type="text" name="" value="{{ $ }}"></li>
                        <li class="list-group-item">Parametre ID : <input type="text" name="" value="{{ $ }}"></li>
                        <li class="list-group-item">Bareme ID : <input type="text" name="" value="{{ $ }}"></li>
                        @if($decisionapprenti->datetransfert)
                            <li class="list-group-item">Date Transfert : <input type="text" name="" value="{{ $ }}"></li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="col-lg-6">
            <h2>Decision Maitre Apprenti</h2>
            <ul class="list-group">
                @foreach($decisionmaitreapprentis as $decisionmaitreapprenti)
                    @if($decisionmaitreapprenti->pv_id == $pv->id)
                        <li class="list-group-item">ID : <input type="text" name="" value="{{ $ }}"> </li>
                        <li class="list-group-item">Référence : <input type="text" name="" value="{{ $ }}"> </li>
                        <li class="list-group-item">Date Decision : <input type="text" name="" value="{{ $ }}"> </li>
                        <li class="list-group-item">Parametre ID : <input type="text" name="" value="{{ $ }}"></li>
                        <li class="list-group-item">Bareme ID : <input type="text" name="" value="{{ $ }}"> </li>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h2>Documents</h2>
            <ul class="list-group">
                @foreach($dossiers as $dossier)
                    @if($dossier->apprentis_id == $apprenti->id)
                        <li class="list-group-item">
                            <a href="{{ url('/apprentis/fichiers/download', $dossier->contratapprenti) }}">Contrat</a>
                            <form action="{{ route('dossiers.deletefichier', ['id' => $dossier->id, 'fichier' => 'contratapprenti']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </li>
                        <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->pvinstallation) }}">PV</a></li>
                        <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->extraitnaissance) }}">Extrait de naissance</a></li>
                        <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->decisionapprenti) }}">Decision Apprenti</a></li>
                        <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->decisionmaitreapprenti) }}">Decision Maitre d'apprentis</a></li>
                        <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->copiecheque) }}">Copie cheque</a></li>
                        @if($dossier->photo)
                            <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->photo) }}">Photo</a></li>
                        @endif
                        @if($dossier->autorisationparentele)
                            <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->autorisationparentele) }}">Autorisation parentale</a></li>
                        @endif
                        @if($dossier->pieceidentite)
                            <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->pieceidentite) }}">Piece d'identité</a></li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="col-lg-6">
            <h2>Maitre d'apprenti</h2>
            <ul class="list-group">
                @foreach($maitreapprentis as $maitreapprenti)
                    @if($maitreapprenti->apprenti1_id == $apprenti->id || $maitreapprenti->apprenti2_id == $apprenti->id)
                        <li class="list-group-item">Nom : {{ $maitreapprenti->nom }}</li>
                        <li class="list-group-item">Prenom : {{ $maitreapprenti->prenom }}</li>
                        <li class="list-group-item">Civilite : {{ $maitreapprenti->civilite }}</li>
                        <li class="list-group-item">Telephone : {{ $maitreapprenti->telephonepro }}</li>
                        <li class="list-group-item">Adresse : {{ $maitreapprenti->adresse }}</li>
                        <li class="list-group-item">Email : {{ $maitreapprenti->email }}</li>
                        <li class="list-group-item">Statut : {{ $maitreapprenti->statut }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
        <form action="{{ route('apprentis.updatedossier',$dossier->id) }}" method="POST">
            @csrf
            <select name="status" value="{{ $dossier->status }}" required>
                <option value="#">Choisir</option>
                <option value="valide">Valide</option>
                <option value="refuse">Refuse</option>
            </select>
            <input type="text" name="motif" id="">
            <button type="submit">Valider</button>
        </form>
        @if ($apprenti->status == "actif")
        <p style="text-align:center;">Statut de l'apprenti : <span style="color:green;">{{ $apprenti->status }}</span></p>
        @elseif($apprenti->status == "inactif")
        <p style="text-align:center;">Statut de l'apprenti : <span style="color:red;">{{ $apprenti->status }}</span></p>
        @endif
    </div>
</div>
@endsection
