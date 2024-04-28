@extends('layouts.layout')
@section('title','Diplomes')
<link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
@section('content')
<h1 class="text-center mt-4 mb-4">AJOUTER UN DIPLOME</h1>
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
                    <table id="structures-table" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nom</th>
            <th scope="col">Durée (mois)</th>
            <th scope="col">Description</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($diplomes as $diplome)
        <tr>
            <td>{{ $diplome->id }}</td>
            <td>{{ $diplome->nom }}</td>
            <td>{{ $diplome->duree }}</td>
            <td>{{ $diplome->description }}</td>
            <td>
                <button class="btn btn-primary edit-btn" data-id="{{ $diplome->id }}">Modifier</button>
                <form action="{{ route('diplomes.destroy', $diplome->id) }}" method="POST">                  
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
