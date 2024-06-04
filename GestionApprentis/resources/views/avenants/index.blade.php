@extends('layouts.layout')
@section('title', 'avenants')
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
                @if (Auth::user()->role == 'DFP' || Auth::user()->role == 'SA')    
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card mt-4">
                                <div class="card-header">
                                    <h4>Ajouter un Avenant</h4>
                                </div>
                                <div class="card-body">
                                    <form id="avenantForm" action="{{ route('avenants.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group mb-3">
                                            <label for="decisionapprenti_id">Sélectionner une decision d'un apprenti</label>
                                            <select name="decisionapprenti_id" id="decisionapprenti_id">
                                                <option value="">-- Choisir --</option>
                                                @foreach ($apprentis as $apprenti)
                                                    @if (Auth::user()->structures_id == $apprenti->structure_id)
                                                        @foreach ($pvs as $pv)
                                                            @if ($pv->apprenti_id == $apprenti->id)
                                                                @foreach ($decisions as $decision)
                                                                    @if ($decision->pv_id == $pv->id)
                                                                        <option value="{{ $decision->id }}">{{ $decision->referenceda }} - {{ $apprenti->nom }} - {{ $apprenti->prenom }} - 
                                                                        @foreach ($specialites as $specialite)
                                                                            @if ($specialite->id == $apprenti->specialite_id) {{ $specialite->nom }} @endif
                                                                        @endforeach
                                                                    </option>
                                                                    @endif
                                                                @endforeach
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="date">Date</label>
                                            <input type="date" class="form-control" name="date" id="date" required>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="type">Type</label>
                                            <select class="form-control" name="type" id="type" required>
                                                <option value="">-- Choisir --</option>
                                                <option value="rattrapage">Rattrapage</option>
                                                <option value="passerelle">Passerelle</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="diplome">Diplome</label>
                                            <select class="form-control" name="diplome_id" id="diplome">
                                                <option value="">-- Choisir --</option>
                                                @foreach ($diplomes as $diplome)
                                                    <option value="{{ $diplome->id }}">{{ $diplome->nom }}</option>
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
                @endif
                <div class="row mt-4">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Decision Apprenti ID</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($avenants as $avenant)
                                    <tr>
                                        <td>{{ $avenant->decisionapprenti_id }}</td>
                                        <td>{{ $avenant->date }}</td>
                                        <td>{{ $avenant->type }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection