@extends('layouts.layout')
@section('title', 'Reports')
@section('content')
<div class="container-fluid">
    <div class="row">
        @if (Auth::user()->role == 'DFP')
            @include('layouts.dfpsidenav')
        @elseif(Auth::user()->role == 'SA')
            @include('layouts.sasidenav')
        @elseif(Auth::user()->role == 'DRH')
            @include('layouts.drhsidenav')
        @elseif(Auth::user()->role == 'EvaluateurGradé')
            @include('layouts.egsidenav')
        @endif
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAccountModal">
                        Ajouter un report
                    </button>
                </div>
            </div>

                <!-- Modal depart -->
            <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addAccountModalLabel">Gestion Des reports</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('reports.store') }}" class="row g-3">
                                @csrf
                                <div class="col-md-6">
                                    <label for="user_id" class="form-label">Utilisateur</label>
                                    <select class="form-control" id="user_id" name="user_id">
                                        <option value="">Sélectionnez un utilisateur</option>
                                        @foreach ($users as $user)
                                            @if ($user->id == Auth::user()->id)
                                                <option value="{{ $user->id }}">{{ $user->nom }} - {{ $user->prenom }} - {{ $user->role }} - 
                                                    @foreach ($structures as $structure)
                                                        @if ($user->structures_id == $structure->id)
                                                            {{ $structure->nom }}
                                                        @endif
                                                    @endforeach
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="titre" class="form-label">titre</label>
                                    <input type="text" class="form-control" id="titre" name="titre">
                                </div>
                                <div class="col-md-6">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea type="text" class="form-control" id="description" name="description"></textarea>
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <table id="reports-table" class="table table-striped mt-4" style="width:100%">
                    <thead>
                        <tr>
                            @if (Auth::user()->role == 'DFP')
                                <th scope="col">ID</th>
                            @endif
                            <th scope="col">Nom</th>
                            <th scope="col">Role</th>
                            <th scope="col">Structure</th>
                            <th scope="col">Sujet</th>
                            <th scope="col">Description</th>
                            <th scope="col">Date de creation</th>
                            @if (Auth::user()->role == 'DFP')
                                <th scope="col">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reports as $report)
                            @if (Auth::user()->role == 'DFP' || Auth::user()->role == 'DRH')           
                            <tr>
                                @if (Auth::user()->role == 'DFP')
                                    <td>{{ $report->id }}</td>
                                @endif
                                @foreach ($users as $user)
                                    @if ($user->id == $report->user_id)
                                        <td>{{ $user->nom }}</td>
                                        <td>{{ $user->role }}</td>
                                        @foreach($structures as $structure)
                                            @if ($user->structures_id == $structure->id)
                                                <td>{{ $structure->nom }}</td>
                                            @endif
                                        @endforeach
                                    @endif
                                @endforeach
                                <td>{{ $report->titre }}</td>
                                <td>{{ $report->description }}</td>
                                <td>{{ $report->created_at }}</td>
                                @if (Auth::user()->role == 'DFP')
                                    <td>
                                        <form action="{{ route('reports.destroy', $report->id) }}" method="POST">                  
                                            @csrf
                                            @method('DELETE')           
                                            <button type="submit" class="btn btn-danger" onclick="confirmDelete({{ $report->id }})">Supprimer</button>
                                        </form>
                                    </td>
                                @endif
                            </tr>
                            @else
                                @if (Auth::user()->structures_id == $report->user_id)
                                <tr>
                                    @foreach ($users as $user)
                                        @if ($user->id == $report->user_id)
                                            <td>{{ $user->nom }}</td>
                                            <td>{{ $user->role }}</td>
                                            @foreach($structures as $structure)
                                                @if ($user->structures_id == $structure->id)
                                                    <td>{{ $structure->nom }}</td>
                                                @endif
                                            @endforeach
                                        @endif
                                    @endforeach
                                    <td>{{ $report->titre }}</td>
                                    <td>{{ $report->description }}</td>
                                    <td>{{ $report->created_at }}</td>
                                </tr>
                                @endif
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </main>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
<script>
    function confirmDelete(id) {
        if (confirm('Voulez-vous supprimer ce report?')) {
            // Submit the form if confirmed
            document.getElementById('deleteForm' + id).submit();
        }
    }
    $(document).ready(function() {
        $('#reports-table').DataTable();
    });
</script>