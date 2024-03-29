<!-- Assuming this is diplomes.index.blade.php -->

@extends('layouts.layout')
@section('title','Diplome | Ajouter')
@section('content')
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.0.3/css/dataTables.bootstrap5.css">
<script type="text/javascript" src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/2.0.3/js/jquery.dataTables.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.bootstrap5.js"></script>
<h1 class="text-center mt-4 mb-4">AJOUTER UN DIPLOME</h1>
<div id="formemodal">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-action="add">
        Ajouter Diplome
    </button>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Ajouter un Diplome</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                </div>
            </div>
        </div>
    </div>
    <table id="example" class="table table-striped" style="width:100%">
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
    <a href="{{ route('diplomes.print') }}" class="btn btn-primary" target="_blank">Imprimer</a>
</div>
<script>
    <script>
    let isEdit = false
    $(document).ready(function() {
    // Edit diploma modal
    $('.edit-btn').click(function() {
        var id = $(this).data('id');
        $.ajax({
            url: "{{ url('diplomes') }}" + '/' + id + '/edit',
            type: 'GET',
            success: function(data) {
                $('#nom').val(data.diplome.nom);
                $('#duree').val(data.diplome.duree);
                $('#description').val(data.diplome.description);
                $('#diplome_id').val(id); // Populate diploma ID
                // Set the form action dynamically
                $('#forme').attr('action', "{{ url('diplomes') }}/" + id); 
                $('#exampleModal').modal('show');
                isEdit = true;
            }
        });
    });
     // Submit update form via AJAX
     $('#forme').submit(function(e) {
            e.preventDefault(); // Prevent default form submission
            var formData = $(this).serialize();
            var url = $(this).attr('action');
            $.ajax({
                url: url,
                type: isEdit? 'PUT' : 'POST', // You can use POST method for the same route and view
                data: formData,
                success: function(data) {
                    // Handle success response
                    // For example, if you want to reload the page after successful update:
                    location.reload();
                },
                error: function(xhr, status, error) {
                    // Handle error response
                    // For example, if you want to show an alert message:
                    alert('An error occurred while updating the diploma.');
                    console.error(error); // Log the error for debugging
                }
            });
        });

        // Delete diploma
        $('.delete-btn').click(function() {
            var id = $(this).data('id');
            if (confirm('Are you sure you want to delete this diploma?')) {
                $.ajax({
                    url: "{{ url('diplomes') }}" + '/' + id,
                    type: 'DELETE',
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    success: function(data) {
                        $('#diplome_' + id).remove();
                    }
                });
            }
        });
    });
</script>
@endsection
