@extends('layouts.layout')
@section('title','Apprenti | details')
@section('content')
<div class="container">
    <h1 style="text-align:center;">Dossier de l'apprenti</h1>
    <div class="row">
        <div class="col-lg-6">
            <h2>Informations personnelles</h2>
            <ul class="list-group">
                <li class="list-group-item">ID : {{ $apprenti->id }}</li>
                <li class="list-group-item">Nom : {{ $apprenti->nom }}</li>
                <li class="list-group-item">Prénom : {{ $apprenti->prenom }}</li>
                <li class="list-group-item">Adresse : {{ $apprenti->adresse }}</li>
                <li class="list-group-item">Téléphone : {{ $apprenti->telephone }}</li>
                <li class="list-group-item">Email : {{ $apprenti->email }}</li>
                <li class="list-group-item">Civilité : {{ $apprenti->civilite }}</li>
                <li class="list-group-item">Numéro du contrat : {{ $apprenti->numcontrat }}</li>
                <li class="list-group-item">Date du contrat : {{ $apprenti->datecontrat }}</li>
                <li class="list-group-item">Date de début du contrat : {{ $apprenti->datedebut }}</li>
                <li class="list-group-item">Date de fin du contrat : {{ $apprenti->datefin }}</li>
                <li class="list-group-item">Date du transfert : {{ $apprenti->datetransfert }}</li>
                <li class="list-group-item">Niveau Scolaire : {{ $apprenti->niveauscolaire }}</li>
                <li class="list-group-item">Spécialité : {{ $specialite->nom }}</li>
                <li class="list-group-item">Diplôme : {{ $diplome->nom }}</li>
                <li class="list-group-item">Structure : {{ $structure->nom }}</li>
            </ul>
        </div>
        <div class="col-lg-6">
            <h2>PV</h2>
            <ul class="list-group">
                <li class="list-group-item">Référence : {{ $pv->reference }}</li>
                <li class="list-group-item">Date du PV : {{ $pv->datepv }}</li>
                <li class="list-group-item">Maitre Apprenti : {{ $pv->maitreapprenti_id }}</li>
                <li class="list-group-item">Date installation : {{ $pv->dateinstallationchiffre }}</li>
                <li class="list-group-item">Année d'installation (lettre) : {{ $pv->anneeinstallationlettre }}</li>
                <li class="list-group-item">Mois d'installation (lettre) : {{ $pv->moisinstallationlettre }}</li>
                <li class="list-group-item">Jour d'installation (lettre) : {{ $pv->jourinstallationlettre }}</li>
                <li class="list-group-item">Direction d'affectation : {{ $pv->directionaffectation }}</li>
                <li class="list-group-item">Service d'affectation : {{ $pv->serviceaffectation }}</li>
                <li class="list-group-item">Dotations : {{ $pv->dotations }}</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h2>Decision Apprenti</h2>
            <ul class="list-group">
                @foreach($decisionapprentis as $decisionapprenti)
                    @if($decisionapprenti->pv_id == $pv->id)
                        <li class="list-group-item">ID : {{ $decisionapprenti->id }}</li>
                        <li class="list-group-item">Plan Besoin ID : {{ $decisionapprenti->planbesoins_id }}</li>
                        <li class="list-group-item">Référence : {{ $decisionapprenti->referenceda }}</li>
                        <li class="list-group-item">Date Decision : {{ $decisionapprenti->dateda }}</li>
                        <li class="list-group-item">Parametre ID : {{ $decisionapprenti->parametre_id }}</li>
                        <li class="list-group-item">Bareme ID : {{ $decisionapprenti->bareme_id }}</li>
                        @if($decisionapprenti->datetransfert)
                            <li class="list-group-item">Date Transfert : {{ $decisionapprenti->datetransfert }}</li>
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
                        <li class="list-group-item">ID : {{ $decisionmaitreapprenti->id }}</li>
                        <li class="list-group-item">Référence : {{ $decisionmaitreapprenti->referencedma }}</li>
                        <li class="list-group-item">Date Decision : {{ $decisionmaitreapprenti->datedma }}</li>
                        <li class="list-group-item">Parametre ID : {{ $decisionmaitreapprenti->parametre_id }}</li>
                        <li class="list-group-item">Bareme ID : {{ $decisionmaitreapprenti->bareme_id }}</li>
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
                        <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->contratapprenti) }}">Contrat</a></li>
                        <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->pvinstallation) }}">PV</a></li>
                        <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->extraitnaissance) }}">Extrait de naissance</a></li>
                        <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->decisionapprenti) }}">Decision Apprenti</a></li>
                        <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->decisionmaitreapprenti) }}">Decision Maitre d'apprentis</a></li>
                        <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->copiecheque) }}">Copie cheque</a></li>
                        @if($dossier->photo)
                            <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->photo) }}">Photo</a></li>
                        @endif
                        @if($dossier->autorisationparentale)
                            <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->autorisationparentale) }}">Autorisation parentale</a></li>
                        @endif
                        @if($dossier->pieceidentite)
                            <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->pieceidentite) }}">Piece d'identité</a></li>
                        @endif
                        @if ($dossier->status == 'en cours')
                        <form action="{{ route('apprentis.updatedossier',$dossier->id) }}" method="POST">
                            @csrf
                            <label for="">Status du dossier</label>
                            <select name="status" value="{{ $dossier->status }}" required>
                                <option value="#">Choisir</option>
                                <option value="valide">Valide</option>
                                <option value="refuse">Refuse</option>
                            </select>
                            <label for="">Motif</label>
                            <input type="text" name="motif" id="">
                            <button type="submit">Valider</button>
                        </form>
                        @else
                        <input type="text" name="status" id="" value="{{ $dossier->status }}" disabled readonly>
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
        @if ($apprenti->status == "actif")
        <p style="text-align:center;">Statut de l'apprenti : <span style="color:green;">{{ $apprenti->status }}</span></p>
        @elseif($apprenti->status == "inactif")
        <p style="text-align:center;">Statut de l'apprenti : <span style="color:red;">{{ $apprenti->status }}</span></p>
        @endif
    </div>
</div>
@endsection
