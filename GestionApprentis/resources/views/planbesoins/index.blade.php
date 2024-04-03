@extends('layouts.layout')
@section('title','Plan de Besoins')
<link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
@section('content')
<form action="{{ route('planbesoins.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <select name="exercice_id">Année
        @foreach($exercices as $exercice)
            <option value="{{ $exercice->id }}">{{ $exercice->annee }}</option>
        @endforeach
    </select>
    <select name="structure_id" required>
        @foreach($structures as $structure)
            <option value="{{ $structure->id }}">{{ $structure->nom }}</option>
        @endforeach
    </select>
    <input type="text" name="reference" required>
    <input type="date" name="date" required>
    <input type="text" pattern="[0-9]+" name="nombreapprentis" required>
    <input type="text" pattern="[0-9]+" name="nombereffectif" required>
    <input type="text" pattern="[0-9]+" name="nombreapprentismax" readonly disabled>
    <textarea type="text" rows="4" cols="50" name="description" required>
    </textarea>
    <input type="submit" value="Ajouter">
</form>
<table id="planbesoins-table" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Exercice</th>
                <th>structure ID</th>
                <th>reference</th>
                <th>date</th>
                <th>nombreapprentis</th>
                <th>nombereffectif</th>
                <th>nombreapprentismax</th>
                <th>description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($planbesoins as $planbesoin)
            <tr id="planbesoin_{{ $planbesoin->id }}">
                <td>{{ $planbesoin->id }}</td>
                <td>{{ $planbesoin->exercice_id }}</td>
                <td>{{ $planbesoin->structure_id }}</td>
                <td>{{ $planbesoin->reference }}</td>
                <td>{{ $planbesoin->date }}</td>
                <td>{{ $planbesoin->nombreapprentis }}</td>
                <td>{{ $planbesoin->nombereffectif }}</td>
                <td>{{ $planbesoin->nombreapprentismax }}</td>
                <td>{{ Str::limit($planbesoin->description, 50) }}</td>
                <td>{{ $planbesoin->status }}</td>
                <td>
                    <button class="btn btn-primary btn-sm edit-btn" data-id="{{ $planbesoin->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal" data-action="edit">Editer</button>
                    <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $planbesoin->id }}">Supprimer</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endSection
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#planbesoins-table').DataTable();
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
                        console.error('Error adding diplome:', errorThrown);
                    }
                });
            });

            // AJAX for deleting a structure
        $('.delete-btn').click(function() {
            var id = $(this).data('id');
            var button = $(this); // Store reference to 'this'
            $.ajax({
                url: '/planbesoins/' + id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Remove the row from the table
                    button.closest('tr').remove();
                    alert('plan besoins deleted successfully');
                },
                error: function(xhr, textStatus, errorThrown) {
                    // Handle error
                    console.error('Error deleting plan besoins:', errorThrown);
                }
            });
        });


            // AJAX for editing a structure
            $('.edit-btn').click(function() {
    var id = $(this).data('id');
    var row = $(this).closest('tr');
    var exercice_id = row.find('td:eq(1)').text();
    var structure_id = row.find('td:eq(2)').text();
    var reference = row.find('td:eq(3)').text();
    var date = row.find('td:eq(4)').text();
    var nombreapprentis = row.find('td:eq(5)').text();
    var nombereffectif = row.find('td:eq(6)').text();
    var nombreapprentismax = row.find('td:eq(7)').text();
    var description = row.find('td:eq(8)').text();
    var status = row.find('td:eq(9)').text();
    var editForm = `
        <form method="POST" action="/planbesoins/${id}" class="edit-form">
            @csrf
            @method('PUT')
            <select name="exercice_id">Année
                @foreach($exercices as $exercice)
                    <option value="{{ $exercice->id }}">{{ $exercice->annee }}</option>
                @endforeach
            </select>
            <select name="structure_id">
                @foreach($structures as $structure)
                    <option value="{{ $structure->id }}">{{ $structure->nom }}</option>
                @endforeach
            </select>
            <input type="text" name="reference" value="${reference}">
            <input type="date" name="date" value="${date}">
            <input type="text" pattern="[0-9]+" name="nombreapprentis" value="${nombreapprentis}">
            <input type="text" pattern="[0-9]+" name="nombereffectif" value="${nombereffectif}">
            <input type="text" pattern="[0-9]+" name="nombreapprentismax" readonly disabled value="${nombreapprentismax}">
            <textarea type="text" rows="4" cols="50" name="description">${description}</textarea>
            <select name="status">
                <option value="en cours" ${status == 'en cours' ? 'selected' : ''}>En cours</option>
                <option value="accepté" ${status == 'accepté' ? 'selected' : ''}>Accepté</option>
                <option value="refusé" ${status == 'refusé' ? 'selected' : ''}>Refusé</option>
            </select>
            <input type="submit" value="Modifier">
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
        });
    
    </script>