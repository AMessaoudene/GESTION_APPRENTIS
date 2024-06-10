@extends('layouts.layout')
@section('title', 'Structures')
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
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" style="background-color:white;">
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
                            Ajouter une structure d'accueil
                        </button>
                    </div>
                </div>

                <!-- Modal Structure -->
                <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAccountModalLabel">Gestion Des Structures</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="add-form" method="POST" action="{{ route('structures.submit') }}" class="form-horizontal">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nom">Nom</label>
                                        <input type="text" name="nom" class="form-control" id="nom" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="adressecourriel">Adresse courriel</label>
                                        <input type="text" name="adressecourriel" class="form-control" id="adressecourriel" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="referencedecisionresponsable">referencedecisionresponsable</label>
                                        <input type="text" name="referencedecisionresponsable" class="form-control" id="referencedecisionresponsable">
                                    </div>
                                    <div class="form-group">
                                        <label for="decisionresponsable">decisionresponsable</label>
                                        <select name="decisionresponsable" class="form-control" id="decisionresponsable">
                                            <option value="">-- Choisir --</option>
                                            <option value="Presidentiel">Présidentiel</option>
                                            <option value="Ministerial">Ministérial</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="datedecisionresponsable">datedecisionresponsable</label>
                                        <input type="date" name="datedecisionresponsable" class="form-control" id="datedecisionresponsable">
                                    </div>
                                    <div class="form-group">
                                        <label for="nomresponsable">nomresponsable</label>
                                        <input type="text" name="nomresponsable" class="form-control" id="nomresponsable">
                                    </div>
                                    <div class="form-group">
                                        <label for="prenomresponsable">prenomresponsable</label>
                                        <input type="text" name="prenomresponsable" class="form-control" id="prenomresponsable">
                                    </div>
                                    <div class="form-group">
                                        <label for="civiliteresponsable">civilitéresponsable</label>
                                        <select name="civiliteresponsable" class="form-control" id="civiliteresponsable">
                                            <option value="">-- Choisir --</option>
                                            <option value="M">M.</option>
                                            <option value="Mme">Mme</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="fonctionresponsable">fonctionresponsable</label>
                                        <input type="text" name="fonctionresponsable" class="form-control" id="fonctionresponsable">
                                    </div>
                                    <div class="form-group text-center mt-3 mb-3">
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                @endif
                <h1 class="text-center" style="margin-top:3%;">Liste des structures</h1>
                <table id="structures-table" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Nom</th>
                            <th scope="col">Adresse Courriel</th>
                            <th scope="col">referencedecisionresponsable</th>
                            <th scope="col">decisionresponsable</th>
                            <th scope="col">datedecisionresponsable</th>
                            <th scope="col">nomresponsable</th>
                            <th scope="col">prenomresponsable</th>
                            <th scope="col">civilitéresponsable</th>
                            <th scope="col">fonctionresponsable</th>
                            @if (Auth::user()->role == 'DFP' || Auth::user()->role == 'SA')
                                <th scope="col">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($structures as $structure)
                        <tr>
                            <td>{{ $structure->id }}</td>
                            <td>{{ $structure->nom }}</td>
                            <td>{{ $structure->adressecourriel }}</td>
                            <td>{{ $structure->referencedecisionresponsable }}</td>
                            <td>{{ $structure->decisionresponsable }}</td>
                            <td>{{ $structure->datedecisionresponsable }}</td>
                            <td>{{ $structure->nomresponsable }}</td>
                            <td>{{ $structure->prenomresponsable }}</td>
                            <td>{{ $structure->civiliteresponsable }}</td>
                            <td>{{ $structure->fonctionresponsable }}</td>
                            @if (Auth::user()->role == 'DFP' || Auth::user()->role == 'SA')
                            <td>
                                <div>
                                    @if (Auth::user()->role == 'DFP' || (Auth::user()->role == 'SA' && Auth::user()->structures_id == $structure->id))
                                        <button class="btn btn-primary edit-btn mr-2" data-id="{{ $structure->id }}">Modifier</button>
                                    @endif
                                    @if (Auth::user()->role == 'DFP')
                                    <form id="deleteForm{{ $structure->id }}" action="{{ route('structures.destroy', $structure->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $structure->id }})">Supprimer</button>
                                    </form>
                                    @endif
                                </div>
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
        if (confirm('Voulez-vous supprimer cette structure?')) {
            // Submit the form if confirmed
            document.getElementById('deleteForm' + id).submit();
        }
    }
    $(document).ready(function() {
        $('#structures-table').DataTable();

        // AJAX for adding a new structure
        $('#add-form').submit(function(event) {
            event.preventDefault();
            var form = $(this);
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    // Reload the page to update the table
                    location.reload();
                },
                error: function(xhr, textStatus, errorThrown) {
                    // Handle error
                    console.error('Error adding structure:', errorThrown);
                }
            });
        });

        // AJAX for editing a structure
        $(document).on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var row = $(this).closest('tr');
            var nom = row.find('td:eq(1)').text();
            var adressecourriel = row.find('td:eq(2)').text();
            var referencedecisionresponsable = row.find('td:eq(3)').text();
            var decisionresponsable = row.find('td:eq(4)').text();
            var datedecisionresponsable = row.find('td:eq(5)').text();
            var nomresponsable = row.find('td:eq(6)').text();
            var prenomresponsable = row.find('td:eq(7)').text();
            var civiliteresponsable = row.find('td:eq(8)').text();
            var fonctionresponsable = row.find('td:eq(9)').text();
            var editForm = `
                <form method="POST" action="{{ route('structures.update', $structure->id) }}" class="edit-form">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" class="form-control" value=${nom} id="nom">
                    </div>
                    <div class="form-group">
                        <label for="adressecourriel">Adresse courriel</label>
                        <input type="text" name="adressecourriel" class="form-control" value=${adressecourriel} id="adressecourriel">
                    </div>
                    <div class="form-group">
                        <label for="referencedecisionresponsable">referencedecisionresponsable</label>
                        <input type="text" name="referencedecisionresponsable" class="form-control" value=${referencedecisionresponsable} id="referencedecisionresponsable">
                    </div>
                    <div class="form-group">
                        <label for="decisionresponsable">decisionresponsable</label>
                        <select name="decisionresponsable" class="form-control" value=${decisionresponsable} id="decisionresponsable">
                            <option value="">-- Choisir --</option>
                            <option value="Presidentiel">Présidentiel</option>
                            <option value="Ministerial">Ministérial</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="datedecisionresponsable">datedecisionresponsable</label>
                        <input type="date" name="datedecisionresponsable" class="form-control" value=${datedecisionresponsable} id="datedecisionresponsable">
                    </div>
                    <div class="form-group">
                        <label for="nomresponsable">nomresponsable</label>
                        <input type="text" name="nomresponsable" class="form-control" value=${nomresponsable} id="nomresponsable">
                    </div>
                    <div class="form-group">
                        <label for="prenomresponsable">prenomresponsable</label>
                        <input type="text" name="prenomresponsable" class="form-control" value=${prenomresponsable} id="prenomresponsable">
                    </div>
                    <div class="form-group">
                        <label for="civiliteresponsable">civilitéresponsable</label>
                        <select name="civiliteresponsable" class="form-control" value=${civiliteresponsable} id="civiliteresponsable">
                            <option value="">-- Choisir --</option>
                            <option value="M">M.</option>
                            <option value="Mme">Mme</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="fonctionresponsable">fonctionresponsable</label>
                        <input type="text" name="fonctionresponsable" class="form-control" value=${fonctionresponsable} id="fonctionresponsable">
                    </div>
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
                    console.error('Error updating structure:', errorThrown);
                }
            });
        });
    });
</script>
