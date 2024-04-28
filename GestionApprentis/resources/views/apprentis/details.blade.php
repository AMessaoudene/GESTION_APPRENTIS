@extends('layouts.layout')
@section('title','Apprenti | details')
@section('content')
<div>
    <h1>{{ $apprenti->nom }} {{ $apprenti->prenom }}</h1>
    <p>ID : {{ $apprenti->id }}</p>
    <p>Adresse : {{ $apprenti->adresse }}</p>
    <p>Téléphone : {{ $apprenti->telephone }}</p>
    <p>Email : {{ $apprenti->email }}</p>
    <p>Civilite : {{ $apprenti->civilite }}</p>
    <p>Numéro du contrat : {{ $apprenti->numcontrat }}</p>
    <p>Date du contrat : {{ $apprenti->datecontrat }}</p>
    <p>Date de debut du contrat : {{ $apprenti->datedebut }}</p>
    <p>Date de fin du contrat : {{ $apprenti->datefin }}</p>
    <p>Date du transfert : {{ $apprenti->datetransfert }}</p>
    <p>Niveau Scolaire : {{ $apprenti->niveauscolaire }}</p>
    <p>specialite : {{ $specialite->nom }}</p>
    <p>diplome : {{ $diplome->nom }}</p>
    <p>structure : {{ $structure->nom }}</p>
    <h2>PV</h2>
    <p>reference : {{ $pv->reference }}</p>
    <p>date du pv : {{ $pv->datepv }}</p>
    <p>Maitre Apprenti : {{ $pv->maitreapprenti_id }}</p>
    <p>Date installation : {{ $pv->dateinstallationchiffre }}</p>
    <p>{{ $pv->anneeinstallationlettre }}</p>
    <p>{{ $pv->moisinstallationlettre }}</p>
    <p>{{ $pv->jourinstallationlettre }}</p>
    <p>{{ $pv->directionaffectation }}</p>
    <p>{{ $pv->serviceaffectation }}</p>
    <p>{{ $pv->dotations }}</p>
    <h2>Documents</h2>
    <a href="{{ url('/download', $dossier->pvinstallation) }}">PV d'installation</a>
    <a href="{{ url('/download', $dossier->decisionapprenti) }}">Decision Apprenti</a>
    <a href="{{ url('/download', $dossier->decisionmaitreapprenti) }}">Decision Maitre d'apprentis</a>
    <a href="{{ url('/download', $dossier->contratapprenti) }}">Contrat Apprenti</a>
    <a href="{{ url('/download', $dossier->copiecheque) }}">copie cheque</a>
    <a href="{{ url('/download', $dossier->extraitnaissance) }}">extrait de naissance</a>
    @if($dossier->autorisationparentele)
        <a href="{{ url('/download', $dossier->autorisationparentele) }}">autorisation parentale</a>
    @else
        Aucun
    @endif
    @if($dossier->photo)
        <a href="{{ url('/download', $dossier->photo) }}">Photo</a>
    @else
        Aucun
    @endif
    <p>Statut du dossier : {{ $dossier->status }}</p>
    <p>Statut de l'apprenti : {{ $apprenti->statut }}</p>
</div>
@endsection