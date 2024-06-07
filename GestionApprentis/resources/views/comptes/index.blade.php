@extends('layouts.layout')
@section('title', 'Gestion des comptes')
<link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
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

                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                @if (Auth::user()->role == 'DFP')      
                <!-- Trigger button -->
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAccountModal">
                            Ajouter un Compte
                        </button>
                    </div>
                </div>

                <!-- Modal Structure -->
                <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAccountModalLabel">Gestion Des Comptes</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="add-form" action="{{ route('comptes.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nom">Nom</label>
                                        <input type="text" class="form-control" id="nom" name="nom" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="prenom">Prenom</label>
                                        <input type="text" class="form-control" id="prenom" name="prenom" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="civilite">Civilité</label>
                                        <select class="form-control" id="civilite" name="civilite" required>
                                            <option value="">-- Choisir une civilite --</option>
                                            <option value="Homme">Homme</option>
                                            <option value="Femme">Femme</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="role">Role</label>
                                        <select class="form-control" id="role" name="role" required>
                                            <option value="">-- Choisir un role --</option>
                                            <option value="DFP">DFP</option>
                                            <option value="DRH">DRH</option>
                                            <option value="SA">SA</option>
                                            <option value="EvaluateurGradé">Evaluateur Gradé</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="structures_id">Structure</label>
                                        <select class="form-control" id="structures_id" name="structures_id" required>
                                            <option value="">-- Choisir une structure --</option>
                                            @foreach ($structures as $structure)
                                                <option value="{{ $structure->id }}">{{ $structure->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="password">Mot de passe</label>
                                        <input type="password" class="form-control" id="password" name="password" required>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                @endif
                <h1 class="text-center mt-3">Liste des Comptes</h1>
                <table id="comptes-table" class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                            <th scope="col">Civilité</th>
                            <th scope="col">Role</th>
                            <th scope="col">Structure</th>
                            <th scope="col">Email</th>
                            <th scope="col">Statut</th>
                            @if (Auth::user()->role == 'DFP')
                            <th scope="col">Action</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comptes as $compte)
                            <tr>
                                <td>{{ $compte->id }}</td>
                                <td>{{ $compte->nom }}</td>
                                <td>{{ $compte->prenom }}</td>
                                <td>{{ $compte->civilite }}</td>
                                <td>{{ $compte->role }}</td>
                                @foreach($structures as $structure)
                                    @if($structure->id == $compte->structures_id)
                                        <td>{{ $structure->nom }}</td>
                                    @endif
                                @endforeach
                                <td>{{ $compte->email }}</td>
                                <td>{{ $compte->status }}</td>
                                @if (Auth::user()->role == 'DFP')
                                <td>
                                    <button class="btn btn-primary edit-btn" data-id="{{ $compte->id }}">Modifier</button>
                                    <form id="deleteForm{{ $compte->id }}" action="{{ route('comptes.destroy', $compte->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $compte->id }})">Delete</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
<script>
    function confirmDelete(id) {
        if (confirm('Voulez-vous supprimer cet compte?')) {
            // Submit the form if confirmed
            document.getElementById('deleteForm' + id).submit();
        }
    }
        $(document).ready(function() {
            $('#comptes-table').DataTable();

            $(document).ready(function() {
        $('#comptes-table').DataTable();

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
                <form method="POST" action="/comptes/${id}" class="edit-form">
                    @csrf
                    @method('PUT')
                    <input type="text" name="nom" class="form-control" value="${nom}">
                    <input type="text" name="prenom" class="form-control" value="${prenom}">
                    <select name="civilite" class="form-control">
                        <option value="">-- Choisir une civilite --</option>
                        <option value="Homme" ${civilite === 'Homme' ? 'selected' : ''}>Homme</option>
                        <option value="Femme" ${civilite === 'Femme' ? 'selected' : ''}>Femme</option>
                    </select>
                    <select name="structures_id" class="form-control">
                        <option value="">-- Choisir une structure --</option>
                        @foreach ($structures as $structure)
                            <option value="{{ $structure->id }}" ${structure === '{{ $structure->nom }}' ? 'selected' : ''}>{{ $structure->nom }}</option>
                        @endforeach
                    </select>
                    <select name="role" class="form-control">
                        <option value="">-- Choisir un role --</option>
                        <option value="DFP" ${role === 'DFP' ? 'selected' : ''}>DFP</option>
                        <option value="DRH" ${role === 'DRH' ? 'selected' : ''}>DRH</option>
                        <option value="SA" ${role === 'SA' ? 'selected' : ''}>SA</option>
                        <option value="EvaluateurGrade" ${role === 'EvaluateurGrade' ? 'selected' : ''}>Evaluateur Gradé</option>
                    </select>
                    <input type="email" name="email" class="form-control" value="${email}">
                    <select name="status" class="form-control">
                        <option value="">-- Choisir un statut --</option>
                        <option value="actif" ${status === 'actif' ? 'selected' : ''}>actif</option>
                        <option value="inactif" ${status === 'inactif' ? 'selected' : ''}>inactif</option>
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
            var row = form.closest('tr');
            $.ajax({
                url: form.attr('action'),
                type: 'PUT',
                data: form.serialize(),
                success: function(response) {
                    // Extract the new values from the form
                    var nom = form.find('input[name="nom"]').val();
                    var prenom = form.find('input[name="prenom"]').val();
                    var civilite = form.find('select[name="civilite"]').val();
                    var structure = form.find('select[name="structures_id"] option:selected').text();
                    var role = form.find('select[name="role"] option:selected').val();
                    var email = form.find('input[name="email"]').val();
                    var status = form.find('select[name="status"] option:selected').val();

                    // Update the table row with the new values
                    row.find('td:eq(1)').text(nom);
                    row.find('td:eq(2)').text(prenom);
                    row.find('td:eq(3)').text(civilite);
                    row.find('td:eq(4)').text(structure);
                    row.find('td:eq(5)').text(role);
                    row.find('td:eq(6)').text(email);
                    row.find('td:eq(7)').text(status);

                    // Remove the form
                    form.remove();
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error('Error updating compte:', errorThrown);
                }
            });
        });
    });
});
</script>
