@extends('layouts.layout')
@section('title', 'Evaluation MA')
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
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card mt-4">
                            <div class="card-header">
                                <h1 class="card-title text-center">Evaluation Maitre d'Apprenti</h1>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('evaluationMA.submit') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="maitreapprenti_id">Maitre Apprenti</label>
                                        <select name="maitreapprenti_id" id="maitreapprenti_id" class="form-control" required>
                                            <option value="">-- Choisir --</option>
                                            @foreach($maitreapprentis as $maitre)
                                            <option value="{{ $maitre->id }}">{{ $maitre->nom }} {{ $maitre->prenom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="datedebut">Date de debut</label>
                                        <input type="date" name="datedebut" id="datedebut" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="datefin">Date de fin</label>
                                        <input type="date" name="datefin" id="datefin" class="form-control" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="sensresponsabilite">Sens de responsabilite</label>
                                        <select name="sensresponsabilite" id="sensresponsabilite" class="form-control" required>
                                            <option value="">-- Choisir --</option>
                                            <option value="Très bon">Très bon</option>
                                            <option value="Bon">Bon</option>
                                            <option value="Moyen">Moyen</option>
                                            <option value="Mauvais">Mauvais</option>
                                        </select>
                                        <input type="text" name="observationsr" id="observationsr" class="form-control" placeholder="Observation">
                                    </div>
                                    <div class="form-group">
                                        <label for="disponibiliteorientationapprenti">Disponibilite et orientation apprenti</label>
                                        <select name="disponibiliteorientationapprenti" id="disponibiliteorientationapprenti" class="form-control" required>
                                            <option value="">-- Choisir --</option>
                                            <option value="Très bon">Très bon</option>
                                            <option value="Bon">Bon</option>
                                            <option value="Moyen">Moyen</option>
                                            <option value="Mauvais">Mauvais</option>
                                        </select>
                                        <input type="text" name="observationdoa" id="observationdoa" class="form-control" placeholder="Observation">
                                    </div>
                                    <div class="form-group">
                                        <label for="respectmissionencadrement">Respect mission encadrement</label>
                                        <select name="respectmissionencadrement" id="respectmissionencadrement" class="form-control" required>
                                            <option value="">-- Choisir --</option>
                                            <option value="Très bon">Très bon</option>
                                            <option value="Bon">Bon</option>
                                            <option value="Moyen">Moyen</option>
                                            <option value="Mauvais">Mauvais</option>
                                        </select>
                                        <input type="text" name="observationrme" id="observationrme" class="form-control" placeholder="Observation">
                                    </div>
                                    <div class="form-group">
                                        <label for="effetpoursuiviapprenti">Effet pour suivi apprenti</label>
                                        <select name="effetpoursuiviapprenti" id="effetpoursuiviapprenti" class="form-control" required>
                                            <option value="">-- Choisir --</option>
                                            <option value="Très bon">Très bon</option>
                                            <option value="Bon">Bon</option>
                                            <option value="Moyen">Moyen</option>
                                            <option value="Mauvais">Mauvais</option>
                                        </select>
                                        <input type="text" name="observationepsa" id="observationepsa" class="form-control" placeholder="Observation">
                                    </div>
                                    <div class="form-group">
                                        <label for="qualiteencadrementapprenti">Qualite encadrement apprenti</label>
                                        <select name="qualiteencadrementapprenti" id="qualiteencadrementapprenti" class="form-control" required>
                                            <option value="">-- Choisir --</option>
                                            <option value="Très bon">Très bon</option>
                                            <option value="Bon">Bon</option>
                                            <option value="Moyen">Moyen</option>
                                            <option value="Mauvais">Mauvais</option>
                                        </select>
                                        <input type="text" name="observationqea" id="observationqea" class="form-control" placeholder="Observation">
                                    </div>
                                    <div class="form-group">
                                        <label for="avisapprenti">Avis de l'apprenti</label>
                                        <textarea name="avisapprenti" id="avisapprenti" class="form-control" rows="5" required></textarea>
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
        </main>
    </div>
</div>
@endsection
