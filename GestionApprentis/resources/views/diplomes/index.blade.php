@extends('layouts.layout')
@section('title','Diplomes')
<script src="{{ asset('asset/js/jqery-3.7.0.js') }}"></script>
<link href="{{asset('asset/js/DataTables/datatables.min.css')}}" rel="stylesheet">
<script src="{{asset('asset/js/DataTables/datatables.min.js')}}"></script>
<link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
@section('content')
<h1 class="text-center mt-4 mb-4">AJOUTER UN DIPLOME</h1>
<div id="formemodal">
    <form name="forme" id="forme" action="{{ route('diplomes.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="nom">Nom</label>
                            <input type="text" class="form-control" id="nom" name="nom" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="duree">Durée</label>
                            <input type="text" class="form-control" id="duree" name="duree" required>
                        </div>
                        <div class="form-group mb-3">
                            <label for="description">Description</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="row justify-content-center mt-4">
                            <button type="submit" class="btn btn-primary" id="submit-btn">Ajouter</button>
                        </div>
                    </form>
    <table id="diplome-table" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Durée</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($diplomes as $diplome)
            <tr id="diplome_{{ $diplome->id }}">
                <td>{{ $diplome->id }}</td>
                <td>{{ $diplome->nom }}</td>
                <td>{{ $diplome->duree }}</td>
                <td>{{ $diplome->description }}</td>
                <td>
                    <button class="btn btn-primary btn-sm edit-btn" data-id="{{ $diplome->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal" data-action="edit">Editer</button>
                    <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $diplome->id }}">Supprimer</button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="{{asset('asset/js/dataTables.min.js')}}"></script>
    <script>
        $(document).ready(function() {
            $('#diplome-table').DataTable();
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
                url: '/diplomes/' + id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Remove the row from the table
                    button.closest('tr').remove();
                    alert('diplome deleted successfully');
                },
                error: function(xhr, textStatus, errorThrown) {
                    // Handle error
                    console.error('Error deleting diplome:', errorThrown);
                }
            });
        });


            // AJAX for editing a structure
            $('.edit-btn').click(function() {
                var id = $(this).data('id');
                var row = $(this).closest('tr');
                var nom = row.find('td:eq(1)').text();
                var duree = row.find('td:eq(2)').text(); // Update index to 2 for 'duree'
                var description = row.find('td:eq(3)').text(); // Update index to 3 for 'description'
                var editForm = `
                    <form method="POST" action="/diplomes/${id}" class="edit-form">
                        @csrf
                        @method('PUT')
                        <label for="nom">Nom</label>
                        <input type="text" name="nom" class="form-control" value="${nom}">
                        <label for="duree">Durée</label>
                        <input type="text" name="duree" class="form-control" value="${duree}">
                        <label for="description">Description</label>
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
