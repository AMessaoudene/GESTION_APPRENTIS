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
                                <label for="affectation" class="form-label">Affectation</label>
                                <input type="text" name="affectation" id="affectation" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="fonction" class="form-label">Fonction</label>
                                <input type="text" class="form-control" id="fonction" name="fonction" required>
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
        @endif
        <table id="maitres-table" class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Civilité</th>
                            <th scope="col">Spécialité</th>
                            <th scope="col">Structure</th>
                            <th scope="col">Email</th>
                            <th scope="col">Date Recrutement</th>
                            <th scope="col">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($maitre_apprentis as $maitre)
                            <tr>
                                <td>{{ $maitre->id }}</td>
                                <td>{{ $maitre->nom }}</td>
                                <td>{{ $maitre->prenom }}</td>
                                <td>{{ $maitre->civilite }}</td>
                                <td>{{ $maitre->affectation }}</td>
                                <td>{{ $maitre->fonction }}</td>
                                <td>{{ $maitre->email }}</td>
                                <td>{{ $maitre->daterecrutement }}</td>
                                <td>{{ $maitre->statut }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </main>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#maitres-table').DataTable();

        // AJAX for editing a diplome
        $(document).on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var row = $(this).closest('tr');
            var nom = row.find('td:eq(1)').text();
            var prenom = row.find('td:eq(2)').text();
            var civilite = row.find('td:eq(3)').text();
            var structure = row.find('td:eq(4)').text();
            var role = row.find('td:eq(5)').text();
            var email = row.find('td:eq(6)').text();
            var status = row.find('td:eq(7)').text();
            var editForm = `
                <form method="POST" action="/maitres/${id}" class="edit-form">
                    @csrf
                    @method('PUT')
                    <input type="text" name="nom" class="form-control" value="${nom}">
                    <input type="text" name="prenom" class="form-control" value="${prenom}">
                    <select name="civilite" class="form-control" value="${civilite}">
                        <option value="">-- Choisir une civilite --</option>
                        <option value="Homme">Homme</option>
                        <option value="Femme">Femme</option>
                    </select>
                    <select name="structures_id" class="form-control" value="${structure}">
                        <option value="">-- Choisir une structure --</option>
                        @foreach ($structures as $structure)
                            <option value="{{ $structure->id }}">{{ $structure->nom }}</option>
                        @endforeach
                    </select>
                    <select name="role" class="form-control" value="${role}">
                        <option value="">-- Choisir un role --</option>
                        <option value="DFP">DFP</option>
                        <option value="DRH">DRH</option>
                        <option value="SA">SA</option>
                        <option value="EvaluateurGrade">Evaluateur Gradé</option>
                    </select>
                    <input type="email" name="email" emailclass="form-control" value="${email}">
                    <select name="status" class="form-control" value="${status}">
                        <option value="">-- Choisir un statut --</option>
                        <option value="actif">actif</option>
                        <option value="inactif">inactif</option>
                    </select>
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
            `;
            row.find('td:eq(1)').html(editForm);
        });

        // Submit edit form
        $(document).on('submit', '.edit-form', function(event) {
            event.preventDefault();
            var form = $(this);
            $.ajax({
                url: form.attr('action'),
                type: 'PUT', // Changed from POST to PUT for update
                data: form.serialize(),
                success: function(response) {
                    // Reload the page to update the table
                    location.reload();
                },
                error: function(xhr, textStatus, errorThrown) {
                    // Handle error
                    console.error('Error updating diplome:', errorThrown);
                }
            });
        });
    });
</script>
