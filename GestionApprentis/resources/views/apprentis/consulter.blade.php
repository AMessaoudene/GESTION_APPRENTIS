@extends('layouts.layout')
@section('title', 'Apprentis')
<link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
<style>
    th, td{
        text-align: center;
    }
</style>
@section('content')
<div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            @include('layouts.sidenav')
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" style="background-color:white;">
                <div class="container">
                    <div class="row justify-content-center">
                        <h1 class="text-center mb-5">Liste des apprentis</h1>
                        <a href="{{ route('apprentis.index') }}" class="btn btn-primary mb-3">Ajouter un nouveau apprenti</a>
                        <table id="apprentis-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prenom</th>
                                    <th scope="col">Structure</th>
                                    <th scope="col">Specialite</th>
                                    <th scope="col">Historique des MA</th>
                                    <th scope="col">Dossier</th>
                                    <th scope="col">Assiduités</th>
                                    <th scope="col">Evaluation</th>
                                    <th scope="col">Statut</th>
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
                                    <td><a href="/apprentis/historiqueMA/{{ $apprenti->id }}">Voir</a></td>
                                    @if ($user->role == 'SA')
                                    <td><a href="/apprentis/dossiers/{{ $apprenti->id }}">Voir</a></td>
                                    @elseif($user->role == 'DFP')
                                    <td><a href="/apprentis/details/{{ $apprenti->id }}">Voir</a></td>
                                    @endif
                                    <td><a href="/apprentis/assiduites/{{ $apprenti->id }}">Voir</a></td>
                                    <td><a href="/apprentis/evaluation/{{ $apprenti->id }}">Voir</a></td>
                                    <td>{{ $apprenti->status }}</td>
                                    <td>
                                        <form id="deleteForm{{ $apprenti->id }}" action="{{ route('apprentis.destroy', $apprenti->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $apprenti->id }})">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                </div>
            </main>
        </div>
    </div>
@endsection

<script>
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this apprentice?')) {
            // Submit the form if confirmed
            document.getElementById('deleteForm' + id).submit();
        } 
        // No action needed if canceled
    }
</script>