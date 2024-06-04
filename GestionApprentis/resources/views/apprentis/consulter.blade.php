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
            @if (Auth::user()->role == 'DFP')
            @include('layouts.dfpsidenav')
            @elseif(Auth::user()->role == 'SA')
            @include('layouts.sasidenav')
            @elseif(Auth::user()->role == 'DRH')
            @include('layouts.drhsidenav')
            @elseif(Auth::user()->role == 'EvaluateurGradé')
            @include('layouts.egsidenav')
            @endif
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" style="background-color:white;">
                <div class="container">
                    <div class="row justify-content-center">
                        <h1 class="text-center mb-5">Liste des apprentis</h1>
                        @if (Auth::user()->role == 'DFP' || Auth::user()->role == 'SA')
                        <a href="{{ route('apprentis.index') }}" class="btn btn-primary mb-3">Ajouter un nouveau apprenti</a>
                        @endif
                        <table id="apprentis-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th scope="col">Nom</th>
                                    <th scope="col">Prenom</th>
                                    <th scope="col">Structure</th>
                                    <th scope="col">Specialite</th>
                                    <th scope="col">Historique des MA</th>
                                    <th scope="col">Dossier</th>
                                    <th scope="col">Assiduités</th>
                                    <th scope="col">Evaluations</th>
                                    <th scope="col">Statut</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if (Auth::user()->role == 'DFP')
                                @foreach($apprentis as $apprenti)
                                <tr>
                                    <td>{{ $apprenti->nom }}</td>
                                    <td>{{ $apprenti->prenom }}</td>
                                    @foreach ($structures as $structure)
                                        @if ($structure->id == $apprenti->structure_id)
                                            <td>{{ $structure->nom }}</td>
                                        @endif
                                    @endforeach
                                    @foreach ($specialites as $specialite)
                                        @if ($specialite->id == $apprenti->specialite_id)
                                            <td>{{ $specialite->nom }}</td>
                                        @endif
                                    @endforeach
                                    <td><a href="/apprentis/{{ $apprenti->id }}/HistoriqueMA">Voir</a></td>
                                    @if ($user->role == 'SA')
                                    <td><a href="/apprentis/details/update/{{ $apprenti->id }}">Voir</a></td>
                                    @elseif($user->role == 'DFP')
                                    <td><a href="/apprentis/details/{{ $apprenti->id }}">Voir</a></td>
                                    @endif
                                    <td><a href="/apprentis/{{ $apprenti->id }}/HistoriqueAssiduites">Voir</a></td>
                                    <td><a href="/apprentis/{{ $apprenti->id }}/Historiqueevaluations">Voir</a></td>
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
                                @else
                                @foreach($apprentis as $apprenti)
                                @if ($apprenti->structure_id == Auth::user()->structures_id)
                                <tr>
                                    <td>{{ $apprenti->nom }}</td>
                                    <td>{{ $apprenti->prenom }}</td>
                                    <td>{{ $apprenti->structure_id }}</td>
                                    <td>{{ $apprenti->specialite_id }}</td>
                                    <td><a href="/apprentis/historiqueMA/{{ $apprenti->id }}">Voir</a></td>
                                    @if ($user->role == 'SA' && $apprenti->status == 'inactif')
                                    <td><a href="/apprentis/details/update/{{ $apprenti->id }}">Voir</a></td>
                                    @elseif($user->role == 'DFP' || ($user->role == 'SA' && $apprenti->status == 'actif'))
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
                                @endif
                                @endforeach
                                @endif
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