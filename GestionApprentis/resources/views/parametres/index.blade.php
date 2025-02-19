@extends('layouts.layout')
@section('title', 'Parametres')
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
            @if (Auth::user()->role == 'DFP' || Auth::user()->role == 'DRH')         
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAccountModal">
                        Ajouter un parametres
                    </button>
                </div>
            </div>

                <!-- Modal depart -->
                <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAccountModalLabel">Gestion Des parametres</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST" action="{{ route('parametres.store') }}" class="row g-3">
                                    @csrf
                                    <div class="col-md-6">
                                        <label for="reference" class="form-label">Reference</label>
                                        <input type="text" class="form-control" id="reference" name="reference">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="typedecisiondg" class="form-label">Type Decision DG</label>
                                        <select class="form-control" id="typedecisiondg" name="typedecisiondg">
                                            <option value="">-- Choisir --</option>
                                            <option value="Presidentiel">Présidentiel</option>
                                            <option value="Ministerial">Ministérial</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="datedecisiondg" class="form-label">Date Decision DG</label>
                                        <input type="date" class="form-control" id="datedecisiondg" name="datedecisiondg">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nomprenomdg" class="form-label">Nom et Prenom DG</label>
                                        <input type="text" class="form-control" id="nomprenomdg" name="nomprenomdg">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="civilitedg" class="form-label">Civilité DG</label>
                                        <select class="form-select" id="civilitedg" name="civilitedg">
                                            <option value="">-- Choisir --</option>
                                            <option value="Monsieur">Mr</option>
                                            <option value="Madame">Mme</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="civilitedrh" class="form-label">Civilite DRH</label>
                                        <select class="form-select" id="civilitedrh" name="civilitedrh">
                                            <option value="">-- Choisir --</option>
                                            <option value="Monsieur">Mr</option>
                                            <option value="Madame">Mme</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="civilitedfc" class="form-label">Civilite DFC</label>
                                        <select class="form-select" id="civilitedfc" name="civilitedfc">
                                            <option value="">-- Choisir --</option>
                                            <option value="Monsieur">Mr</option>
                                            <option value="Madame">Mme</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="table-responsive">
                    <table id="parametres-table" class="table table-striped mt-4" style="width:100%">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Reference</th>
                                <th scope="col">Decision DG</th>
                                <th scope="col">Date decision DG</th>
                                <th scope="col">Nom et prenom DG</th>
                                <th scope="col">Civilite DG</th>
                                <th scope="col">Civilite RH</th>
                                <th scope="col">Civilite Fc</th>
                                <th scope="col">Status</th>
                                @if($user->role == 'DFP')
                                    <th scope="col">Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($parametres as $parametre)
                                <tr>
                                    <td>{{ $parametre->id }}</td>
                                    <td>{{ $parametre->reference }}</td>
                                    <td>{{ $parametre->typedecisiondg }}</td>
                                    <td>{{ $parametre->datedecisiondg }}</td>
                                    <td>{{ $parametre->nomprenomdg }}</td>
                                    <td>{{ $parametre->civilitedg }}</td>
                                    <td>{{ $parametre->civilitedrh }}</td>
                                    <td>{{ $parametre->civilitedfc }}</td>
                                    <td>{{ $parametre->status }}</td>
                                    @if($user->role == 'DFP')
                                        <td>
                                            <button class="btn btn-primary edit-btn" data-id="{{ $parametre->id }}">Modifier</button>
                                            <form action="{{ route('parametres.destroy', $parametre->id) }}" method="POST">                  
                                                @csrf
                                                @method('DELETE')           
                                                <button type="submit" class="btn btn-danger" onclick="confirmDelete({{ $parametre->id }})">Supprimer</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
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
        if (confirm('Voulez-vous supprimer ce parametre?')) {
            // Submit the form if confirmed
            document.getElementById('deleteForm' + id).submit();
        }
    }
    $(document).ready(function() {
        $('#parametres-table').DataTable();
    });
    // AJAX for editing a diplome
    $(document).on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        var row = $(this).closest('tr');
        var typedecisiondg = row.find('td:eq(5)').text();
        var datedecisiondg = row.find('td:eq(6)').text();
        var nomprenomdg = row.find('td:eq(7)').text();
        var decisionpremierresponsable = row.find('td:eq(8)').text();
        var datedecisionpremierresponsable = row.find('td:eq(9)').text();
        var nomprenompremierresponsable = row.find('td:eq(10)').text();
        var fonctionpremierresponsable = row.find('td:eq(11)').text();
        var civilitedrh = row.find('td:eq(12)').text();
        var civilitedfc = row.find('td:eq(13)').text();
        var status = row.find('td:eq(14)').text();
        // Replace html of the row with the edit form
        row.find('td:eq(1)').html(`
            <form method="POST" action="/parametres/${id}" class="edit-form">
                @csrf
                @method('PUT')
                <input type="text" name="nomresponsable" value="${nomresponsable}">
                <input type="text" name="prenomresponsable" value="${prenomresponsable}">
                <select name="civiliteresponsable" value="${civiliteresponsable}">
                    <option value="">-- Choisir --</option>
                    <option value="Monsieur">Mr</option>
                    <option value="Madame">Mme</option>
                </select>
                <input type="text" name="fonctionresponsable" value="${fonctionresponsable}">
                <input type="text" name="typedecisiondg" value="${typedecisiondg}">
                <input type="date" name="datedecisiondg" value="${datedecisiondg}">
                <input type="text" name="nomprenomdg" value="${nomprenomdg}">
                <input type="text" name="decisionpremierresponsable" value="${decisionpremierresponsable}">
                <input type="date" name="datedecisionpremierresponsable" value="${datedecisionpremierresponsable}">
                <input type="text" name="nomprenompremierresponsable" value="${nomprenompremierresponsable}">
                <input type="text" name="fonctionpremierresponsable" value="${fonctionpremierresponsable}">
                <select name="civilitedrh" value="${civilitedrh}">
                    <option value="">-- Choisir --</option>
                    <option value="Monsieur">Mr</option>
                    <option value="Madame">Mme</option>
                </select>
                <select name="civilitedfc" value="${civilitedfc}">
                    <option value="">-- Choisir --</option>
                    <option value="Monsieur">Mr</option>
                    <option value="Madame">Mme</option>
                </select>
                <select name="status" value="${status}">
                    <option value="">-- Choisir --</option>
                    <option value="Actif">Actif</option>
                    <option value="Inactif">Inactif</option>
                </select>
                <input type="submit" value="Enregistrer">
                <button type="button" class="cancel-edit">Annuler</button>
            </form>
        `);
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
</script>
