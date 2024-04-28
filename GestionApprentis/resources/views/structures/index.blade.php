@extends('layouts.layout')
@section('title', 'Structures')
<link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
@section('content')
<form id="add-form" method="POST" action="{{ route('structures.submit') }}" class="form-horizontal">
    @csrf
    <label>Nom</label>
    <input type="text" name="nom" class="form-control">
    <br>
    <label>Adresse courriel</label>
    <input type="text" name="adressecourriel" class="form-control">
    <br>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
<table id="structures-table" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nom</th>
            <th scope="col">Adresse Courriel</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($structures as $structure)
        <tr>
            <td>{{ $structure->id }}</td>
            <td>{{ $structure->nom }}</td>
            <td>{{ $structure->adressecourriel }}</td>
            <td>
                <button class="btn btn-primary edit-btn" data-id="{{ $structure->id }}">Modifier</button>
                <form action="{{ route('structures.destroy', $structure->id) }}" method="POST">                  
                    @csrf
                    @method('DELETE')           
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
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
