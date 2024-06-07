@extends('layouts.layout')
@section('title', 'Supervisions')
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
                @if (Auth::user()->role == 'DFP' || Auth::user()->role == 'SA')         
                 <!-- Trigger button -->
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAccountModal">
                            Ajouter une super$supervision d'accueil
                        </button>
                    </div>
                </div>

                <!-- Modal super$supervision -->
                <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAccountModalLabel">Gestion Des super$supervisions</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                    <form id="add-form" method="POST" action="{{ route('super$supervisions.submit') }}" class="form-horizontal">
                                        @csrf
                                        <div class="form-group">
                                            <label for="apprenti_id">Apprenti</label>
                                            <select name="apprenti_id" class="form-control" id="apprenti_id" required>
                                                <option value="">Sélectionnez un apprenti</option>
                                                @foreach($apprentis as $apprenti)
                                                    <option value="{{ $apprenti->id }}">{{ $apprenti->nom }} {{ $apprenti->prenom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="maitreapprenti_id">Maitre d'apprenti</label>
                                            <select name="maitreapprenti_id" class="form-control" id="maitreapprenti_id" required>
                                                <option value="">Sélectionnez un maitre d'apprenti</option>
                                                @foreach($maitreapprentis as $maitreapprenti)
                                                    <option value="{{ $maitreapprenti->id }}">{{ $maitreapprenti->nom }} {{ $maitreapprenti->prenom }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="datedebut">date debut</label>
                                            <input type="text" name="datedebut" class="form-control" id="datedebut" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="datefin">date fin</label>
                                            <input type="email" name="datefin" class="form-control" id="datefin" required>
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
                <h1 class="text-center" style="margin-top:3%;">Liste des super$supervisions</h1>
                <table id="super$supervisions-table" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Apprenti</th>
                            <th scope="col">Maitre Appprenti</th>
                            <th scope="col">Date Debut</th>
                            <th scope="col">Date Fin</th>
                            <th scope="col">Status</th>
                            @if (Auth::user()->role == 'DFP' || Auth::user()->role == 'SA')
                                <th scope="col">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($supervisions as $supervision)
                        <tr>
                            <td>{{ $supervision->id }}</td>
                            <td>{{ $supervision->apprenti->nom }} {{ $supervision->apprenti->prenom }}</td>
                            <td>{{ $supervision->maitreapprenti->nom }} {{ $supervision->maitreapprenti->prenom }}</td>
                            <td>{{ $supervision->datedebut }}</td>
                            <td>{{ $supervision->datefin }}</td>
                            <td>{{ $supervision->status }}</td>
                            @if (Auth::user()->role == 'DFP' || Auth::user()->role == 'SA')
                            <td>
                                <div>
                                    @if (Auth::user()->role == 'DFP' || (Auth::user()->role == 'SA' && Auth::user()->structures_id == $apprenti->structure_id))
                                        <button class="btn btn-primary edit-btn mr-2" data-id="{{ $supervision->id }}">Modifier</button>
                                    @endif
                                    @if (Auth::user()->role == 'DFP')
                                    <form id="deleteForm{{ $supervision->id }}" action="{{ route('supervisions.destroy', $supervision->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $supervision->id }})">Supprimer</button>
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
<script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
<script>
    function confirmDelete(id) {
        if (confirm('Voulez-vous supprimer cette super$supervision?')) {
            // Submit the form if confirmed
            document.getElementById('deleteForm' + id).submit();
        }
    }
    $(document).ready(function() {
        $('#super$supervisions-table').DataTable();

        // AJAX for adding a new super$supervision
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
                    console.error('Error adding super$supervision:', errorThrown);
                }
            });
        });

        // AJAX for editing a super$supervision
        $(document).on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var row = $(this).closest('tr');
            var nom = row.find('td:eq(1)').text();
            var adressecourriel = row.find('td:eq(2)').text();
            var editForm = `
                <form method="POST" action="{{ route('super$supervisions.update', $supervision->id) }}" class="edit-form">
                    @csrf
                    @method('PUT')
                    <input type="text" name="nom" class="form-control" value="${nom}">
                    <input type="text" name="adressecourriel" class="form-control" value="${adressecourriel}">
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
                    console.error('Error updating super$supervision:', errorThrown);
                }
            });
        });
    });
</script>
