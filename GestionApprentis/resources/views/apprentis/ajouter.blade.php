@extends('layouts.layout')
@section('title', 'Apprenti | Ajouter')
@section('content')
<h1 class="text-center mb-4">Ajouter un apprenti</h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                    <form method="POST" action="{{ route('apprentis.submit') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="numcontrat" class="form-label">Numéro du contrat</label>
                                <input type="text" name="numcontrat" class="form-control" id="numcontrat" required>
                            </div>
                            <div class="col-md-6">
                                <label for="datecontrat" class="form-label">Date du contrat</label>
                                <input type="date" class="form-control" id="datecontrat" name="datecontrat" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                            <div class="col-md-6">
                                <label for="prenom" class="form-label">Prenom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" required>
                            </div>
                        </div>
                        <select name="niveauscolaire" required>
                            <option value="primaire">primaire</option>
                            <option value="moyen">moyen</option>
                            <option value="secondaire">secondaire</option>
                        </select>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="civilite" class="form-label">Civilité</label>
                                <select class="form-select" id="civilite" name="civilite" required>
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="nationalite" class="form-label">Nationalité</label>
                                <select class="form-select" id="nationalite" name="nationalite" required>
                                    <option value="algerienne">Algerienne</option>
                                    <option value="etrangere">Etrangere</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="datenaissance">Date de naissance</label>
                            <input type="date" id="datenaissance" name="datenaissance" required>
                        </div>
                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                            </div>
                            <div class="col-md-6">
                                <label for="telephone" class="form-label">Telephone</label>
                                <input type="text" class="form-control" id="telephone" name="telephone" required pattern="[0-9]{10}">
                            </div>
                        </div>
                        <div>
                            <div>
                                <label></label>
                                <select name="maitre_apprentis">
                                    @foreach($maitre_apprentis as $maitre_apprenti)
                                        <option value="{{ $maitre_apprenti->id }}">{{ $maitre_apprenti->nom }} {{ $maitre_apprenti->prenom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <label>Date debut et fin d'apprentissage <span> Du </span>
                            <input type="date" name="datedebut"> <span> Au </span>
                            <input type="date" name="datefin">
                        </label>
                        <label>Date de transfert
                        <input type="date" name="datetransfert">
                        </label>
                        <label> Num PV d'installation
                            <input type="date" name="numpv">
                            <span>Date PV d'installation</span>
                            <input type="date" name="dateov">
                        </label>
                        <label>Afféct(é) à
                            <input type="text" name="directionaffectation">
                        </label>
                        <label>spécialité
                            <select name="specialite" required>
                                <option value="secretariat">secretariat</option>
                                <option value="marketing">marketing</option>
                                <option value="grh">grh</option>
                                <option value="comptabilite">comptabilite</option>
                                <option value="exploitation informatique">exploitation</option>
                                <option value="base de données informatique">base de données</option>
                                <option value="documentation et archives">documentation et archives</option>
                                <option value="sécurité reseaux">sécurité reseaux</option>
                                <option value="operateur micro informatique">operateur micro</option>
                                <option value="agent de saisie">agent de saisie</option>
                                <option value="maintenance materiels informatique">maintenance</option>
                                <option value="gestion de stock">gestion de stock</option>
                                <option value="electromecanique">electromecanique</option>
                                <option value="electricité auto">electricite</option>
                                <option value="plomberie">plomberie</option>
                                <option value="developpeur web">developpeur web</option>
                                <option value="cuisine">cuisine</option>
                                <option value="electricité industrielle">electricite industrielle</option>
                                <option value="telecommunications">telecommunications</option>
                                <option value="assurance">assurance</option>
                                <option value="magasinier">magasinier</option>
                            </select>
                            <label>Autres</label>
                            <input type="text" name="specialite">
                        </label>
                        <label>Diplome
                            <select name="diplome">
                                @foreach($diplomes as $diplome)
                                    <option value="{{ $diplome->id }}">{{ $diplome->nom }}</option><br>
                                @endforeach
                            </select>
                        </label>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
