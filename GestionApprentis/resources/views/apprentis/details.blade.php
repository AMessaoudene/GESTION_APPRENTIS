@extends('layouts.layout')
@section('title','Apprenti | details')
@section('content')
<div class="container">
    <h1>{{ $apprenti->nom }} {{ $apprenti->prenom }}</h1>
    <div class="row">
        <div class="col-md-6">
            <h2>Informations personnelles</h2>
            <p>ID : {{ $apprenti->id }}</p>
            <p>Adresse : {{ $apprenti->adresse }}</p>
            <p>Téléphone : {{ $apprenti->telephone }}</p>
            <p>Email : {{ $apprenti->email }}</p>
            <p>Civilité : {{ $apprenti->civilite }}</p>
            <p>Numéro du contrat : {{ $apprenti->numcontrat }}</p>
            <p>Date du contrat : {{ $apprenti->datecontrat }}</p>
            <p>Date de début du contrat : {{ $apprenti->datedebut }}</p>
            <p>Date de fin du contrat : {{ $apprenti->datefin }}</p>
            <p>Date du transfert : {{ $apprenti->datetransfert }}</p>
            <p>Niveau Scolaire : {{ $apprenti->niveauscolaire }}</p>
            <p>Spécialité : {{ $specialite->nom }}</p>
            <p>Diplôme : {{ $diplome->nom }}</p>
            <p>Structure : {{ $structure->nom }}</p>
        </div>
        <div class="col-md-6">
            <h2>PV</h2>
            <p>Référence : {{ $pv->reference }}</p>
            <p>Date du PV : {{ $pv->datepv }}</p>
            <p>Maitre Apprenti : {{ $pv->maitreapprenti_id }}</p>
            <p>Date installation : {{ $pv->dateinstallationchiffre }}</p>
            <p>annee d'installation (lettre) : {{ $pv->anneeinstallationlettre }}</p>
            <p>mois d'installation (lettre) : {{ $pv->moisinstallationlettre }}</p>
            <p>jour d'installation (lettre) : {{ $pv->jourinstallationlettre }}</p>
            <p>direction d'affectation : {{ $pv->directionaffectation }}</p>
            <p>service d'affectation : {{ $pv->serviceaffectation }}</p>
            <p>Dotations : {{ $pv->dotations }}</p>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h2>Decision Apprenti</h2>
            @foreach($decisionapprentis as $decisionapprenti)
                @if($decisionapprenti->pv_id == $pv->id)
                    <p>ID : {{ $decisionapprenti->id }}</p>
                    <p>Plan Besoin ID : {{ $decisionapprenti->planbesoins_id }}</p>
                    <p>Reference : {{ $decisionapprenti->referenceda }}</p>
                    <p>Date Decision : {{ $decisionapprenti->dateda }}</p>
                    <p>Parametre ID : {{ $decisionapprenti->parametre_id }}</p>
                    <p>Bareme ID : {{ $decisionapprenti->bareme_id }}</p>
                    @if($decisionapprenti->datetransfert)
                        <p>Date Transfert : {{ $decisionapprenti->datetransfert }}</p>
                    @endif
                @endif
            @endforeach
        </div>
        <div class="col-md-6">
            <h2>Decision Maitre Apprenti</h2>
            @foreach($decisionmaitreapprentis as $decisionmaitreapprenti)
                @if($decisionmaitreapprenti->pv_id == $pv->id)
                    <p>ID : {{ $decisionmaitreapprenti->id }}</p>
                    <p>Reference : {{ $decisionmaitreapprenti->referencedma }}</p>
                    <p>Date Decision : {{ $decisionmaitreapprenti->datedma }}</p>
                    <p>Parametre ID : {{ $decisionmaitreapprenti->parametre_id }}</p>
                    <p>Bareme ID : {{ $decisionmaitreapprenti->bareme_id }}</p>
                @endif
            @endforeach
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <h2>Documents</h2>
            @foreach($dossiers as $dossier)
                @if($dossier->apprentis_id == $apprenti->id)
                    <p><a href="{{ url('/apprentis/fichiers/download', $dossier->contratapprenti) }}">Contrat</a></p>
                    <p><a href="{{ url('/apprentis/fichiers/download', $dossier->pvinstallation) }}">PV</a></p>
                    <p><a href="{{ url('/apprentis/fichiers/download', $dossier->extraitnaissance) }}">Extrait de naissance</a></p>
                    <p><a href="{{ url('/apprentis/fichiers/download', $dossier->decisionapprenti) }}">Decision Apprenti</a></p>
                    <p><a href="{{ url('/apprentis/fichiers/download', $dossier->decisionmaitreapprenti) }}">Decision Maitre d'apprentis</a></p>
                    <p><a href="{{ url('/apprentis/fichiers/download', $dossier->copiecheque) }}">Copie cheque</a></p>
                    @if($dossier->photo)
                        <p><a href="{{ url('/apprentis/fichiers/download', $dossier->photo) }}">Photo</a></p>
                    @endif
                    @if($dossier->autorisationparentale)
                        <p><a href="{{ url('/apprentis/fichiers/download', $dossier->autorisationparentale) }}">Autorisation parentale</a></p>
                    @endif
                    @if($dossier->pieceidentite)
                        <p><a href="{{ url('/apprentis/fichiers/download', $dossier->pieceidentite) }}">Piece d'identité</a></p>
                    @endif
                    <p>Statut du dossier : {{ $dossier->status }}</p>
                @endif
            @endforeach
        </div>
        <div class="col-md-6">
            <h2>Maitre d'apprenti</h2>
            @foreach($maitreapprentis as $maitreapprenti)
                @if($maitreapprenti->apprenti1_id == $apprenti->id || $maitreapprenti->apprenti2_id == $apprenti->id)
                    <p>Nom : {{ $maitreapprenti->nom }}</p>
                    <p>Prenom : {{ $maitreapprenti->prenom }}</p>
                    <p>Civilite : {{ $maitreapprenti->civilite }}</p>
                    <p>Telephone : {{ $maitreapprenti->telephonepro }}</p>
                    <p>Adresse : {{ $maitreapprenti->adresse }}</p>
                    <p>Email : {{ $maitreapprenti->email }}</p>
                    <p>Statut : {{ $maitreapprenti->statut }}</p>
                @endif
            @endforeach
        </div>
        <p>Statut de l'apprenti : {{ $apprenti->status }}</p>
    </div>
</div>
@endsection