@extends('layouts.layout')
@section('title', 'Apprenti | Ajouter')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h1 class="card-title text-center mb-4">Ajouter un apprenti</h1>
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
                        <div class="mb-3">
                            <label for="numcontrat" class="form-label">Numéro du contrat</label>
                            <input type="text" name="numcontrat" class="form-control" id="numcontrat" required>
                        </div>
                        <div class="mb-3">
                            <label for="datecontrat" class="form-label">Date du contrat</label>
                            <input type="date" class="form-control" id="datecontrat" name="datecontrat" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Diplome</label>
                            <select name="diplome1_id" class="form-select" required>
                                <option value="">Choisir</option>
                                @foreach($diplomes as $diplome)
                                    <option value="{{ $diplome->id }}">{{ $diplome->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label>Date debut et fin d'apprentissage</label>
                            <div class="input-group">
                                <input type="date" name="datedebut" class="form-control" required>
                                <span class="input-group-text">Au</span>
                                <input type="date" name="datefin" class="form-control" required>
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
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="civilite" class="form-label">Civilité</label>
                                <select class="form-select" id="civilite" name="civilite" required>
                                    <option value="">Choisir</option>
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="nationalite" class="form-label">Nationalité</label>
                                <select class="form-select" id="nationalite" name="nationalite" required>
                                    <option value="">Choisir</option>
                                    <option value="algerienne">Algerienne</option>
                                    <option value="etrangere">Etrangere</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="datenaissance" class="form-label">Date de naissance</label>
                            <input type="date" id="datenaissance" name="datenaissance" class="form-control" required>
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
                        <div class="mb-3">
                            <label class="form-label">Niveau scolaire</label>
                            <select name="niveauscolaire" class="form-select" required>
                                <option value="">-- Choisir --</option>
                                <option value="primaire">Primaire</option>
                                <option value="moyen">Moyen</option>
                                <option value="secondaire">Secondaire</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Specialite</label>
                            <select name="specialite_id" class="form-select" required>
                                <option value="">-- Choisir une specialite --</option>
                                @foreach($specialites as $specialite)
                                    <option value="{{$specialite->id}}">{{ $specialite->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Structure</label>
                            <select name="structure_id" class="form-select" required>
                                <option value="">-- Choisir une structure --</option>
                                @foreach($structures as $structure)
                                    <option value="{{$structure->id}}">{{ $structure->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <!--<div class="mb-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="">-- Choisir un statut --</option>
                                <option value="actif" selected>Actif</option>
                                <option value="inactif">Inactif</option>
                            </select>
                        </div>-->
                        <div class="mb-3">
                            <label class="form-label">Maître d'apprentissage</label>
                            <select name="maitre_apprentis" class="form-select" required>
                                <option value="">-- Choisir un maitre d'apprentissage --</option>
                                @foreach($maitre_apprentis as $maitre_apprenti)
                                    @if(is_null($maitre_apprenti->apprenti1_id) || is_null($maitre_apprenti->apprenti2_id)){
                                        <option value="{{ $maitre_apprenti->id }}">{{ $maitre_apprenti->nom }} {{ $maitre_apprenti->prenom }}</option>
                                    }
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="text-center">
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

