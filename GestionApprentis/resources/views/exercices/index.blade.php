@extends('layouts.layout')
@section('title', 'Exercices')
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

            <!-- Page Content -->
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
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addExerciceModal">
                            Ajouter un Exercice
                        </button>
                    </div>
                </div>
                <!-- Modal Structure -->
                <div class="modal fade" id="addExerciceModal" tabindex="-1" aria-labelledby="addExerciceModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addExerciceModalLabel">Gestion Des Exercices</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="add-form" action="{{ route('exercices.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="annee">Année</label>
                                        <input type="text" pattern="[0-9]+" class="form-control" id="annee" name="annee" placeholder="Année" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="datedebut">Date début</label>
                                        <input type="date" class="form-control" id="datedebut" name="datedebut" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="datefin">Date fin</label>
                                        <input type="date" class="form-control" id="datefin" name="datefin" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombrebesoins">Nombre besoins</label>
                                        <input type="text" pattern="[0-9]+" class="form-control" id="nombrebesoins" name="nombrebesoins" placeholder="Nombre besoins" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="massesalariaire">Masse salariaire</label>
                                        <input type="text" pattern="[0-9]+" class="form-control" id="massesalariaire" name="massesalariaire" placeholder="Masse salariaire" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="budget">Budget</label>
                                        <input type="text" class="form-control" id="budget" name="budget" readonly>
                                    </div>
                                    <div class="text-center" style="margin-top:3%;">
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <h1 class="text-center" style="margin-top:3%;">Liste des exercices</h1>
                <!-- Responsive Table -->
                <div class="row mt-4">
                    <div class="col-lg-12">
                        <div class="table-responsive">
                            <table id="exercices-table" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">ID</th>
                                        <th scope="col">Année</th>
                                        <th scope="col">Date début</th>
                                        <th scope="col">Date fin</th>
                                        <th scope="col">Nombre besoins</th>
                                        <th scope="col">Masse salariaire</th>
                                        <th scope="col">Budget</th>
                                        <th scope="col">Statut</th>
                                        @if($user->role == 'DFP')
                                            <th scope="col">Action</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($exercices as $exercice)
                                        <tr>
                                            <td>{{ $exercice->id }}</td>
                                            <td>{{ $exercice->annee }}</td>
                                            <td>{{ $exercice->datedebut }}</td>
                                            <td>{{ $exercice->datefin }}</td>
                                            <td>{{ $exercice->nombrebesoins }}</td>
                                            <td>{{ $exercice->massesalariaire }}</td>
                                            <td>{{ $exercice->budget }}</td>
                                            <td>{{ $exercice->status }}</td>
                                            @if($user->role == 'DFP')
                                                <td>
                                                    <button class="btn btn-primary edit-btn" data-id="{{ $exercice->id }}">Modifier</button>
                                                    <form id="deleteForm{{ $exercice->id }}" action="{{ route('exercices.destroy', $exercice->id) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $exercice->id }})">Delete</button>
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

    <!-- Include jQuery and DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Your JavaScript code -->
    <script>
        function confirmDelete(id) {
            if (confirm('Voulez-vous supprimer cet exercice?')) {
                // Submit the form if confirmed
                document.getElementById('deleteForm' + id).submit();
            } 
        }
        $(document).ready(function() {
            $('#exercices-table').DataTable();

            // AJAX for adding a new exercice
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
                        console.error('Error adding exercice:', errorThrown);
                    }
                });
            });

            // AJAX for editing a structure
        $('.edit-btn').click(function() {
            var id = $(this).data('id');
            var row = $(this).closest('tr');
            var annee = row.find('td:eq(1)').text();
            var datedebut = row.find('td:eq(2)').text();
            var datefin = row.find('td:eq(3)').text();
            var nombrebesoins = row.find('td:eq(4)').text();
            var massesalariaire = row.find('td:eq(5)').text();
            var budget = row.find('td:eq(6)').text();
            var status = row.find('td:eq(7)').text();
            var editForm = `
                <form method="POST" action="/planbesoins/${id}" class="edit-form">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="annee">Anneée</label>
                        <input type="text" name="annee" pattern="[0-9]+"  class="form-control" value="${annee}">
                    </div>
                    <div class="form-group">
                        <label for="datedebut">Date debut</label>
                        <input type="date" name="datedebut" class="form-control" value="${datedebut}">
                    </div>
                    <div class="form-group">
                        <label for="datefin">Date fin</label>
                        <input type="date" name="datefin" class="form-control" value="${datefin}">
                    </div>
                    <div class="form-group">
                        <label for="nombrebesoins">Nombre besoins</label>
                        <input type="text" name="nombrebesoins" class="form-control" value="${nombrebesoins}">
                    </div>
                    <div class="form-group">
                        <label for="massesalariaire">Masse salariaire</label>
                        <input type="text" name="massesalariaire" class="form-control" value="${massesalariaire}">
                    </div>
                    <div class="form-group">
                        <label for="budget">Budget</label>
                        <input type="text" name="budget" class="form-control" id="budget" value="${budget}">
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" value="${status}">
                            <option value="actif">Actif</option>
                            <option value="inactif">inactif</option>
                    </div>
                    <input type="submit" value="Modifier" class="btn btn-primary">
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
                type: 'POST',
                data: form.serialize(), // Change this to use PUT method for update
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

            // Calculate budget based on masse salariaire
            $('#massesalariaire').on('input', function() {
                var masseSalariaire = $(this).val();
                var budget = masseSalariaire * 0.01; // Assume budget is 1% of masse salariaire
                $('#budget').val(budget.toFixed(2)); // Set budget value with 2 decimal places
            });
        });
    </script>
@endsection
