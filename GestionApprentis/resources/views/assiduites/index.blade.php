@extends('layouts.layout')
@section('title', 'Assiduités')
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
            @if (Auth::user()->role == 'DFP' || Auth::user()->role == 'SA')  
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card mt-4">
                            <div class="card-header">
                                <h4>Ajouter Assiduité</h4>
                            </div>
                            <div class="card-body">
                                <form id="assiduiteForm" action="{{ route('assiduites.submit') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="apprenti_id">Apprenti</label>
                                        <select class="form-control" name="apprenti_id" id="apprenti_id" required>
                                            <option value="">Sélectionner un apprenti</option>
                                            @foreach ($apprentis as $apprenti)
                                                @if ($apprenti->status == "actif" && Auth::user()->structures_id == $apprenti->structure_id)
                                                <option value="{{ $apprenti->id }}" data-nom="{{ $apprenti->nom }}" data-prenom="{{ $apprenti->prenom }}" data-specialite="{{ $apprenti->specialite->nom }}">
                                                    {{ $apprenti->nom }} {{ $apprenti->prenom }}
                                                </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="nom">Nom</label>
                                        <input type="text" class="form-control" id="nom" readonly disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="prenom">Prénom</label>
                                        <input type="text" class="form-control" id="prenom" readonly disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="specialite">Specialité</label>
                                        <input type="text" class="form-control" id="specialite" readonly disabled>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="type">Type</label>
                                        <select class="form-control" name="type" id="type" required>
                                            <option value="">-- Choisir --</option>
                                            <option value="absence">Absence</option>
                                            <option value="maladiecourte">Maladie courte</option>
                                            <option value="maladielongue">Maladie longue</option>
                                            <option value="arrettravail">Arrêt de travail</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="datedebut">Date de début</label>
                                        <input type="date" class="form-control" name="datedebut" id="datedebut" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="datefin">Date de fin</label>
                                        <input type="date" class="form-control" name="datefin" id="datefin" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="motif">Motif</label>
                                        <textarea class="form-control" name="motif" id="motif" rows="4" required></textarea>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="preuve">Preuve</label>
                                        <input type="file" class="form-control" name="preuve" id="preuve" required>
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
            @endif
                <div class="row mt-4">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Apprenti ID</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Type</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                    <th>Motif</th>
                                    <th>Preuve</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assiduites as $assiduite)
                                    <tr>
                                        <td>{{ $assiduite->id }}</td>
                                        <td>{{ $assiduite->apprenti_id }}</td>
                                        @foreach ($apprentis as $apprenti)
                                            @if ($apprenti->id == $assiduite->apprenti_id)
                                                <td>{{ $apprenti->nom }}</td>
                                                <td>{{ $apprenti->prenom }}</td>
                                            @endif
                                        @endforeach
                                        <td>{{ $assiduite->type }}</td>
                                        <td>{{ $assiduite->datedebut }}</td>
                                        <td>{{ $assiduite->datefin }}</td>
                                        <td>{{ $assiduite->motif }}</td>
                                        <td><a href="{{ url('/download', $assiduite->preuve) }}">Fiche</a></td>
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
<script>
    document.getElementById('apprenti_id').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var nom = selectedOption.getAttribute('data-nom') || '';
        var prenom = selectedOption.getAttribute('data-prenom') || '';
        var specialite = selectedOption.getAttribute('data-specialite') || '';

        document.getElementById('nom').value = nom;
        document.getElementById('prenom').value = prenom;
        document.getElementById('specialite').value = specialite;
    });

    document.getElementById('datedebut').addEventListener('change', function() {
        var datedebut = this.value;
        var datefin = document.getElementById('datefin');
        datefin.min = datedebut;
    });

    document.getElementById('assiduiteForm').addEventListener('submit', function(event) {
        var datedebut = document.getElementById('datedebut').value;
        var datefin = document.getElementById('datefin').value;

        if (datedebut && datefin && datedebut >= datefin) {
            event.preventDefault();
            alert('La date de fin doit être supérieure à la date de début.');
        }
    });
</script>
@endsection
