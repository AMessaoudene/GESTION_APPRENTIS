@extends('layouts.layout')

@section('content')
<table id="apprentis-table" class="table table-striped" style="width:100%">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nom</th>
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
            <td>{{ $apprenti->structure_id }}</td>
            <td>{{ $apprenti->specialite }}</td>
            <td><a href="/apprentis/details/{{ $apprenti->id }}">Voir</a></td>
            <td>
                <button class="btn btn-primary edit-btn" data-id="{{ $apprenti->id }}">Modifier</button>
                <button class="btn btn-danger delete-btn" data-id="{{ $apprenti->id }}">Supprimer</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection