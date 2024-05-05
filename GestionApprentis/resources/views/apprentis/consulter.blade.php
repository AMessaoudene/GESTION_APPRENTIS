@extends('layouts.layout')
@section('title', 'Apprentis')
<link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
@section('content')
<table id="apprentis-table" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nom</th>
            <th scope="col">Prenom</th>
            <th scope="col">Structure</th>
            <th scope="col">Specialite</th>
            <th scope="col">Dossier</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($apprentis as $apprenti)
        <tr>
            <td>{{ $apprenti->id }}</td>
            <td>{{ $apprenti->nom }}</td>
            <td>{{ $apprenti->prenom }}</td>
            <td>{{ $apprenti->structure_id }}</td>
            <td>{{ $apprenti->specialite_id }}</td>
            <td><a href="/apprentis/details/{{ $apprenti->id }}">Voir</a></td>
            <td>{{ $apprenti->status }}</td>
            <td>
                <button class="btn btn-primary edit-btn" data-id="{{ $diplome->id }}">Modifier</button>
                <form action="{{ route('apprentis.destroy', $diplome->id) }}" method="POST">                  
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
    $('#apprentis-table').DataTable();

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
        var prenom = row.find('td:eq(2)').text();
        var structure_id = row.find('td:eq(3)').text();
        var specialite_id = row.find('td:eq(4)').text();
        var status = row.find('td:eq(5)').text();
        var editForm = `
            <form method="POST" action="/apprentis/${id}" class="edit-form">
                @csrf
                @method('PUT')
                <input type="text" name="nom" class="form-control" value="${nom}">
                <input type="text" name="prenom" class="form-control" value="${prenom}">
                <select name="structure_id" class="form-control" value="${structure_id}">
                    <option value="">-- Choisir --</option>
                    @foreach($structures as $structure)
                    <option value="{{ $structure->id }}">{{ $structure->nom }}</option>
                    @endforeach
                </select>
                <select name="specialite_id" class="form-control" value="${specialite_id}">
                    <option value="">-- Choisir --</option>
                    @foreach($specialites as $specialite)
                    <option value="{{ $specialite->id }}">{{ $specialite->nom }}</option>
                    @endforeach
                </select>
                <select name="status" class="form-control" value="${status}">
                    <option value="">-- Choisir --</option>
                    <option value="Actif">Actif</option>
                    <option value="Inactif">Inactif</option>
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
                console.error('Error updating structure:', errorThrown);
            }
        });
    });
});
</script>