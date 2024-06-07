@extends('layouts.layout')
@section('title', 'Diplomes')
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
            @if (Auth::user()->role == 'DFP') 
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAccountModal">
                        Ajouter un Diplome
                    </button>
                </div>
            </div>

                <!-- Modal depart -->
                <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAccountModalLabel">Gestion Des Diplomes</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="add-form" action="{{ route('diplomes.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="nom">Nom</label>
                                        <input type="text" class="form-control" id="nom" name="nom" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="duree">Durée</label>
                                        <input type="text" class="form-control" id="duree" name="duree" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
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
            <table id="diplomes-table" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Durée (mois)</th>
                        <th scope="col">Description</th>
                        @if (Auth::user()->role == "DFP")
                        <th scope="col">Action</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($diplomes as $diplome)
                        <tr>
                            <td>{{ $diplome->id }}</td>
                            <td>{{ $diplome->nom }}</td>
                            <td>{{ $diplome->duree }}</td>
                            <td>{{ $diplome->description }}</td>
                            @if (Auth::user()->role == "DFP")
                            <td>
                                <button class="btn btn-primary edit-btn" data-id="{{ $diplome->id }}">Modifier</button>
                                <form action="{{ route('diplomes.destroy', $diplome->id) }}" method="POST">                  
                                    @csrf
                                    @method('DELETE')           
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
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
    $(document).ready(function() {
        $('#diplomes-table').DataTable();

        // AJAX for adding a new diplome
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
                    console.error('Error adding diplome:', errorThrown);
                }
            });
        });

        // AJAX for editing a diplome
        $(document).on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var row = $(this).closest('tr');
            var nom = row.find('td:eq(1)').text();
            var duree = row.find('td:eq(2)').text();
            var description = row.find('td:eq(3)').text();
            var editForm = `
                <form method="POST" action="/diplomes/${id}" class="edit-form">
                    @csrf
                    @method('PUT')
                    <input type="text" name="nom" class="form-control" value="${nom}">
                    <input type="text" name="duree" class="form-control" value="${duree}">
                    <input type="text" name="description" class="form-control" value="${description}">
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
