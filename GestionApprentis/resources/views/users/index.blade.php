@extends('layouts.layout')
<link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
@section('title', 'Gestion des utilisateurs')
@section('content')
<form id="add-form" method="POST" action="{{ route('users.submit') }}" class="form-horizontal">
    @csrf
    <label>Nom</label>
    <input type="text" name="nom" class="form-control">
    <br>
    <label>Prenom</label>
    <input type="text" name="prenom" class="form-control">
    <br>
    <label>Adresse courriel</label>
    <input type="text" name="adressecourriel" class="form-control">
    <br>
    <label for="telephone">Telephone</label>
    <input type="text" name="telephone" id="telephone" pattern="[0-9]+" class="form-control">
    <br>
    <label for="SA">Structure d'accueil</label>
    <select name="Structures_id" id="SA">
        <option value="">-- Choisir --</option>
        @foreach($structures as $structure)
        <option value="{{ $structure->id }}">{{ $structure->nom }}</option>
        @endforeach
    </select>
    <br>
    <label>Role</label>
    <select name="role" id="role">
        <option value="">-- Choisir --</option>
        <option value="DFP">DFP</option>
        <option value="DRH">DRH</option>
        <option value="SA">SA</option>
        <option value="EvaluateurGrade">Evaluateur Gradé</option>
    </select>
    <br>
    <label>Mot de passe</label>
    <input type="password" name="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" class="form-control">
    <br>
    <button type="submit" class="btn btn-primary">Ajouter</button>
</form>
<table id="users-table" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nom</th>
            <th scope="col">Prenom</th>
            <th scope="col">Structure d’accueil</th>
            <th scope="col">Role</th>
            <th scope="col">Telephone</th>
            <th scope="col">Adresse courriel</th>
            <th scope="col">Email</th>
            <th scope="col">Statut</th>
            <th scope="col">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
        <tr>
            <td>{{ $user->id }}</td>
            <td>{{ $user->nom }}</td>
            <td>{{ $user->prenom }}</td>
            @foreach($structures as $structure)
            @if($user->Structures_id == $structure->id)
            <td>{{ $structure->nom }}</td>
            @else
            <td></td>
            @endif
            @endforeach
            <td>{{ $user->role }}</td>
            <td>{{ $user->telephone }}</td>
            <td>{{ $user->adressecourriel }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->statut }}</td>
            <td>
                <button class="btn btn-primary edit-btn" data-id="{{ $user->id }}">Modifier</button>
                <form action="{{ route('users.destroy', $user->id) }}" method="POST">                  
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
    $('#users-table').DataTable();

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
        var structure = row.find('td:eq(3)').text();
        var role = row.find('td:eq(4)').text();
        var telephone = row.find('td:eq(5)').text();
        var adressecourriel = row.find('td:eq(6)').text();
        var email = row.find('td:eq(7)').text();
        var statut = row.find('td:eq(8)').text();
        var editForm = `
            <form method="POST" action="/users/${id}" class="edit-form">
                @csrf
                @method('PUT')
                <input type="text" name="nom" class="form-control" value="${nom}">
                <input type="text" name="prenom" class="form-control" value="${prenom}">
                <select name="Structures_id" id="SA">
                    <option value="${Structures_id}">-- Choisir --</option>
                    @foreach($structures as $structure)
                    <option value="{{ $structure->id }}">{{ $structure->nom }}</option>
                    @endforeach
                </select>
                <select name="role" class="form-control" value="${role}">
                    <option value="">-- Choisir --</option>
                    <option value="DFP">DFP</option>
                    <option value="DRH">DRH</option>
                    <option value="SA">SA</option>
                    <option value="EvaluateurGrade">Evaluateur Gradé</option>
                </select>
                <input type="text" name="telephone" class="form-control" value="${telephone}">
                <input type="text" name="adressecourriel" class="form-control" value="${adressecourriel}">
                <input type="text" name="email" class="form-control" value="${email}">
                <select name="statut" class="form-control" value="${statut}">
                    <option value="">-- Choisir --</option>
                    <option value="active">Actif</option>
                    <option value="inactive">Inactif</option>
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
