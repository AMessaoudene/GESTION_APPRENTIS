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
            <!-- Trigger button -->
            <div class="container mt-5">
                <h1 class="text-center">Assiduités</h1>
                <div class="row justify-content-center">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAssiduitesModal">
                        Ajouter une assiduité
                    </button>
                </div>
            </div>

                <!-- Modal Structure -->
                <div class="modal fade" id="addAssiduitesModal" tabindex="-1" aria-labelledby="addAssiduitesModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAssiduitesModalLabel">Gestion Des Assiduités</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="assiduiteForm" action="{{ route('assiduites.submit') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="apprenti_id">Apprenti</label>
                                        <select class="form-control" name="apprenti_id" id="apprenti_id" required>
                                            <option value="">Sélectionner un apprenti</option>
                                            @foreach ($apprentis as $apprenti)
                                                @if ($apprenti->status == "actif" && (Auth::user()->role == 'DFP' || (Auth::user()->role == 'SA' && Auth::user()->structures_id == $apprenti->structure_id)))
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
            @endif
            <div class="row mt-4">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Type</th>
                                    <th>Date de début</th>
                                    <th>Date de fin</th>
                                    <th>Motif</th>
                                    <th>Preuve</th>
                                    @if (Auth::user()->role == 'DFP' || Auth::user()->role == 'SA')
                                        <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($assiduites as $assiduite)
                                    <tr>
                                        <td>{{ $assiduite->id }}</td>
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
                                        @if (Auth::user()->role == 'DFP' || (Auth::user()->role == 'SA' && $assiduite->apprenti_id == $apprenti->id && $apprenti->structure_id == Auth::user()->structures_id))
                                            <td>
                                                <form action="{{ route('assiduites.destroy', $assiduite->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="confirmDelete({{ $assiduite->id }})">Supprimer</button>
                                                </form>
                                            </td>
                                        @endif
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
    function confirmDelete(id) {
        if (confirm('Voulez-vous supprimer ce bareme?')) {
            // Submit the form if confirmed
            document.getElementById('deleteForm' + id).submit();
        }
    }
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

    document.getElementById('datefin').addEventListener('change', function() {
        var datedebut = document.getElementById('datedebut').value;
        var datefin = this.value;

        if (datedebut && datefin && new Date(datedebut) >= new Date(datefin)) {
            alert('La date de fin doit être supérieure à la date de début.');
            this.value = '';
        }
    });

    document.getElementById('assiduiteForm').addEventListener('submit', function(event) {
        var datedebut = document.getElementById('datedebut').value;
        var datefin = document.getElementById('datefin').value;

        if (datedebut && datefin && new Date(datedebut) >= new Date(datefin)) {
            event.preventDefault();
            alert('La date de fin doit être supérieure à la date de début.');
        }
    });
</script>
@endsection
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
