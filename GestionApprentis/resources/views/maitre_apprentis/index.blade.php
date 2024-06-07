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
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAccountModal">
                        Ajouter un maitre des apprentis
                    </button>
                </div>
            </div>

                <!-- Modal depart -->
                <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAccountModalLabel">Gestion Des maitre d'apprentis</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
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
                                                <option value="">Sélectionner une civilite</option>
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
                                            <select name="affectation" id="affectation" class="form-control" required>
                                                <option value="">Sélectionner une affectation</option>
                                                @foreach ($structures as $structure)
                                                    <option value="{{ $structure->id }}">{{ $structure->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="fonction" class="form-label">Fonction</label>
                                            <select class="form-control" id="fonction" name="fonction" required>
                                                <option value="">Sélectionner une fonction</option>
                                                @foreach ($specialites as $specialite)
                                                    <option value="{{ $specialite->id }}">{{ $specialite->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-md-6">
                                            <label for="diplome_id" class="form-label">Diplome</label>
                                            <select class="form-select" id="diplome_id" name="diplome_id" required>
                                                <option value="">Sélectionner un diplome</option>
                                                @foreach ($diplomes as $diplome)
                                                    <option value="{{ $diplome->id }}">{{ $diplome->nom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="daterecrutement" class="form-label">Date de recrutement</label>
                                            <input type="date" class="form-control" id="daterecrutement" name="daterecrutement" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="statut" class="form-label">Statut</label>
                                            <select class="form-select" id="statut" name="statut" required>
                                                <option value="">Sélectionner un statut</option>
                                                <option value="formé">Formé</option>
                                                <option value="non formé">Non formé</option>
                                            </select>
                                        </div>
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
        <table id="maitres-table" class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th scope="col">Matricule</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Civilité</th>
                            <th scope="col">Structure</th>
                            <th scope="col">Spécialité</th>
                            <th scope="col">Email</th>
                            <th scope="col">Date Recrutement</th>
                            <th scope="col">Statut</th>
                            @if (Auth::user()->role == 'DFP' )
                                <th scope="col">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($maitre_apprentis as $maitre)
                            <tr>
                                <td>{{ $maitre->matricule }}</td>
                                <td>{{ $maitre->nom }}</td>
                                <td>{{ $maitre->prenom }}</td>
                                <td>{{ $maitre->civilite }}</td>
                                <td>
                                    @foreach ($structures as $structure)
                                        @if ($structure->id == $maitre->affectation)
                                            {{ $structure->nom }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach ($specialites as $specialite)
                                        @if ($specialite->id == $maitre->fonction)
                                            {{ $specialite->nom }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $maitre->email }}</td>
                                <td>{{ $maitre->daterecrutement }}</td>
                                <td>{{ $maitre->statut }}</td>
                                @if (Auth::user()->role == 'DFP')
                                    <td>
                                        <button type="button" class="btn btn-primary edit-btn" data-id="{{ $maitre->id }}">Modifier</button>
                                        <form method="POST" action="/maitreapprentis/{{ $maitre->id }}" class="delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger" onclick="confirmDelete({{ $maitre->id }})">Supprimer</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </main>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
<script>
    function confirmDelete(id) {
        if (confirm('Voulez-vous supprimer ce parametre?')) {
            // Submit the form if confirmed
            document.getElementById('deleteForm' + id).submit();
        }
    }
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
