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
            @if (Auth::user()->role == 'DFP')         
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">Ajouter une structure</div>
                                <div class="card-body">
                                <form method="POST" action="{{ route('parametres.store') }}" class="row g-3">
                                    @csrf
                                    <div class="col-md-6">
                                        <label for="reference" class="form-label">Reference</label>
                                        <input type="text" class="form-control" id="reference" name="reference">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="decisionresponsable" class="form-label">Decision responsable</label>
                                        <input type="text" class="form-control" id="decisionresponsable" name="decisionresponsable">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="datedecisionresponsable" class="form-label">Date decision responsable</label>
                                        <input type="date" class="form-control" id="datedecisionresponsable" name="datedecisionresponsable">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nomresponsable" class="form-label">Nom responsable</label>
                                        <input type="text" class="form-control" id="nomresponsable" name="nomresponsable">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="prenomresponsable" class="form-label">Prenom responsable</label>
                                        <input type="text" class="form-control" id="prenomresponsable" name="prenomresponsable">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="civiliteresponsable" class="form-label">Civilite responsable</label>
                                        <select class="form-select" id="civiliteresponsable" name="civiliteresponsable">
                                            <option value="">-- Choisir --</option>
                                            <option value="Monsieur">Mr</option>
                                            <option value="Madame">Mme</option>
                                            <option value="Mademoiselle">Mlle</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="fonctionresponsable" class="form-label">Fonction responsable</label>
                                        <input type="text" class="form-control" id="fonctionresponsable" name="fonctionresponsable">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="typedecisiondg" class="form-label">Type Decision DG</label>
                                        <input type="text" class="form-control" id="typedecisiondg" name="typedecisiondg">
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
                                        <label for="decisionpremierresponsable" class="form-label">Decision premier responsable</label>
                                        <input type="text" class="form-control" id="decisionpremierresponsable" name="decisionpremierresponsable">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="datedecisionpremierresponsable" class="form-label">Date decision premier responsable</label>
                                        <input type="date" class="form-control" id="datedecisionpremierresponsable" name="datedecisionpremierresponsable">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nomprenompremierresponsable" class="form-label">Nom et Prenom premier responsable</label>
                                        <input type="text" class="form-control" id="nomprenompremierresponsable" name="nomprenompremierresponsable">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="fonctionpremierresponsable" class="form-label">Fonction premier responsable</label>
                                        <input type="text" class="form-control" id="fonctionpremierresponsable" name="fonctionpremierresponsable">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="civilitedrh" class="form-label">Civilite DRH</label>
                                        <select class="form-select" id="civilitedrh" name="civilitedrh">
                                            <option value="">-- Choisir --</option>
                                            <option value="Monsieur">Mr</option>
                                            <option value="Madame">Mme</option>
                                            <option value="Mademoiselle">Mlle</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="civilitedfc" class="form-label">Civilite DFC</label>
                                        <select class="form-select" id="civilitedfc" name="civilitedfc">
                                            <option value="">-- Choisir --</option>
                                            <option value="Monsieur">Mr</option>
                                            <option value="Madame">Mme</option>
                                            <option value="Mademoiselle">Mlle</option>
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
            </div>
            @endif
            <div class="table-responsive">
                <table id="parametres-table" class="table">
                    <thead>
                        <tr>
                            <th>Reference</th>
                            <th>Decision responsable</th>
                            <th>Date decision responsable</th>
                            <th>Nom responsable</th>
                            <th>Prenom responsable</th>
                            <th>Civilite responsable</th>
                            <th>Fonction responsable</th>
                            <th>Decision DG</th>
                            <th>Date decision DG</th>
                            <th>Nom et prenom DG</th>
                            <th>Decision premier responsable</th>
                            <th>Date decision premier responsable</th>
                            <th>Nom et prenom premier responsable</th>
                            <th>Fonction premier responsable</th>
                            <th>Civilite RH</th>
                            <th>Civilite Fc</th>
                            @if($user->role == 'DFP')
                                <th>Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($parametres as $parametre)
                            <tr>
                                <td>{{ $parametre->reference }}</td>
                                <td>{{ $parametre->decisionresponsable }}</td>
                                <td>{{ $parametre->datedecisionresponsable }}</td>
                                <td>{{ $parametre->nomresponsable }}</td>
                                <td>{{ $parametre->prenomresponsable }}</td>
                                <td>{{ $parametre->civiliteresponsable }}</td>
                                <td>{{ $parametre->fonctionresponsable }}</td>
                                <td>{{ $parametre->typedecisiondg }}</td>
                                <td>{{ $parametre->datedecisiondg }}</td>
                                <td>{{ $parametre->nomprenomdg }}</td>
                                <td>{{ $parametre->decisionpremierresponsable }}</td>
                                <td>{{ $parametre->datedecisionpremierresponsable }}</td>
                                <td>{{ $parametre->nomprenompremierresponsable }}</td>
                                <td>{{ $parametre->fonctionpremierresponsable }}</td>
                                <td>{{ $parametre->civilitedrh }}</td>
                                <td>{{ $parametre->civilitedfc }}</td>
                                @if($user->role == 'DFP')
                                    <td>
                                        <button class="btn btn-primary edit-btn" data-id="{{ $parametre->id }}">Modifier</button>
                                        <form action="{{ route('parametres.destroy', $parametre->id) }}" method="POST">                  
                                            @csrf
                                            @method('DELETE')           
                                            <button type="submit" class="btn btn-danger">Supprimer</button>
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

@push('scripts')
<script>
    $(document).ready(function() {
        $('#parametres-table').DataTable();
    });
    // AJAX for editing a diplome
    $(document).on('click', '.edit-btn', function() {
        var id = $(this).data('id');
        var row = $(this).closest('tr');
        var nomresponsable = row.find('td:eq(1)').text();
        var prenomresponsable = row.find('td:eq(2)').text();
        var civiliteresponsable = row.find('td:eq(3)').text();
        var fonctionresponsable = row.find('td:eq(4)').text();
        var typedecisiondg = row.find('td:eq(5)').text();
        var datedecisiondg = row.find('td:eq(6)').text();
        var nomprenomdg = row.find('td:eq(7)').text();
        var decisionpremierresponsable = row.find('td:eq(8)').text();
        var datedecisionpremierresponsable = row.find('td:eq(9)').text();
        var nomprenompremierresponsable = row.find('td:eq(10)').text();
        var fonctionpremierresponsable = row.find('td:eq(11)').text();
        var civilitedrh = row.find('td:eq(12)').text();
        var civilitedfc = row.find('td:eq(13)').text();

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
                    <option value="Mademoiselle">Mlle</option>
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
                    <option value="Mademoiselle">Mlle</option>
                </select>
                <select name="civilitedfc" value="${civilitedfc}">
                    <option value="">-- Choisir --</option>
                    <option value="Monsieur">Mr</option>
                    <option value="Madame">Mme</option>
                    <option value="Mademoiselle">Mlle</option>
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
@endpush
