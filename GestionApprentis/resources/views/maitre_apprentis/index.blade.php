@extends('layouts.layout')
@section('title', 'Maitre des Apprentis')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @if (Auth::user()->role == 'DFP')
        @include('layouts.dfpsidenav')
        @elseif(Auth::user()->role == 'SA')
        @include('layouts.sasidenav')
        @elseif(Auth::user()->role == 'DRH')
        @include('layouts.drhsidenav')
        @elseif(Auth::user()->role == 'EvaluateurGradé')
        @include('layouts.egsidenav')
        @endif

        <!-- Page Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            @if (Auth::user()->role == 'DFP') 
            <div class="container mt-5 mb-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-center">Ajouter un maitre d'apprentis</h5>
                    </div>
                    <div class="card-body">
                    <form action="{{ route("maitreapprentis.submit") }}" method="POST">
                        @csrf
                        <div class="mb-3 row">
                            <label for="matricule" class="col-sm-2 col-form-label">Matricule</label>
                            <div class="col-sm-10">
                            <input type="text" name="matricule" id="matricule" class="form-control">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                            <div class="col-md-6">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="civilite" class="form-label">Civilité</label>
                                <select class="form-select" id="civilite" name="civilite" required>
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="adresse" class="form-label">Adresse</label>
                                <input type="text" class="form-control" id="adresse" name="adresse" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                            </div>
                            <div class="col-md-6">
                                <label for="telephonepro" class="form-label">Téléphone</label>
                                <input type="text" class="form-control" id="telephonepro" name="telephonepro" required pattern="[0-9]{10}">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="statut" class="form-label">Statut</label>
                                <select class="form-select" id="statut" name="statut" required>
                                    <option value="formé">Formé</option>
                                    <option value="non formé">Non formé</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="fonction" class="form-label">Fonction</label>
                                <input type="text" class="form-control" id="fonction" name="fonction" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="affectation" class="form-label">Affectation</label>
                                <input type="text" name="affectation" id="affectation" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="daterecrutement" class="form-label">Date de recrutement</label>
                                <input type="date" class="form-control" id="daterecrutement" name="daterecrutement" required>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif
@endsection
