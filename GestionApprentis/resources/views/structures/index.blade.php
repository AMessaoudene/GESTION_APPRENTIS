@extends('layouts.layout')
@section('title', 'Structures')
<link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
@section('content')
<div class="container mt-5 mb-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ajouter une structure</div>
                <div class="card-body">
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
                        <div class="form-group text-center mt-3 mb-3">
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<table id="structures-table" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nom</th>
            <th scope="col">Adresse Courriel</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($structures as $structure)
        <tr>
            <td>{{ $structure->id }}</td>
            <td>{{ $structure->nom }}</td>
            <td>{{ $structure->adressecourriel }}</td>
            <td>
                <div class="d-flex justify-content-center align-items-center">
                    <button class="btn btn-primary edit-btn mr-2" data-id="{{ $structure->id }}">Modifier</button>
                    <form action="{{ route('structures.destroy', $structure->id) }}" method="POST" class="delete-form d-inline mr-2 mt-2 mb-2 p-2 text-center w-100 h-100 d-flex justify-content-center align-items-center flex-column p-2">                  
                        @csrf
                        @method('DELETE')           
                        <button type="submit" class="btn btn-danger delete-btn">Supprimer</button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
<script>
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
        var editForm = `
            <form method="POST" action="/structures/${id}" class="edit-form">
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
                console.error('Error updating structure:', errorThrown);
            }
        });
    });
});
</script>
