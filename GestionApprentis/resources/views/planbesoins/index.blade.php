@extends('layouts.layout')
@section('title','Plan de Besoins')
<link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
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
            @if (Auth::user()->role == 'DFP' || Auth::user()->role == 'SA')         
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card mt-4">
                            <div class="card-header bg-primary text-white">Ajouter un plan de besoins</div>
                            <div class="card-body">
                            <form action="{{ route('planbesoins.store') }}" method="POST" enctype="multipart/form-data" class="p-4 shadow-sm rounded bg-light">
                                @csrf
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="exercice_id" class="form-label">Exercice</label>
                                            <select name="exercice_id" id="exercice_id" class="form-select" required>
                                                <option value="" disabled selected>-- Choisir --</option>
                                                @foreach($exercices as $exercice)
                                                    @if($exercice->status == 'actif')
                                                        <option value="{{ $exercice->id }}">{{ $exercice->annee }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="structure_id" class="form-label">Structure</label>
                                            <select name="structure_id" id="structure_id" class="form-select" required>
                                                <option value="" disabled selected>-- Choisir --</option>
                                                @foreach($structures as $structure)
                                                    @if($user->structures_id == $structure->id)
                                                        <option value="{{ $structure->id }}">{{ $structure->nom }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="reference" class="form-label">Référence</label>
                                            <input type="text" name="reference" id="reference" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="date" class="form-label">Date</label>
                                            <input type="date" name="date" id="date" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="nombereffectif" class="form-label">Nombre d'effectif</label>
                                            <input type="text" pattern="[0-9]+" name="nombereffectif" id="nombereffectif" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                @foreach($specialites as $specialite)
                                    <input type="hidden" name="specialites_id[]" value="{{ $specialite->id }}">
                                    <div class="row mb-3 border-top pt-3">
                                        <div class="col-md-3">
                                            <label class="form-label">Spécialité</label>
                                            <p class="form-control-plaintext">{{ $specialite->nom }}</p>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="nombreapprentis{{ $specialite->id }}" class="form-label">Nombre d'apprentis</label>
                                                <input type="text" pattern="[0-9]+" name="nombreapprentis[]" id="nombreapprentis{{ $specialite->id }}" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="description{{ $specialite->id }}" class="form-label">Description</label>
                                                <textarea rows="2" name="description[]" id="description{{ $specialite->id }}" class="form-control"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <div class="text-center mt-4">
                                    <button type="submit" id="submit-btn" class="btn btn-primary btn-lg">Ajouter</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
            @endif

            <table id="planbesoins-table" class="table table-striped mt-4" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Exercice</th>
                        <th>Structure ID</th>
                        <th>Référence</th>
                        <th>Spécialité</th>
                        <th>Date</th>
                        <th>Nombre d'apprentis</th>
                        <th>Nombre d'effectif</th>
                        <th>Nombre d'apprentis max</th>
                        <th>Description</th>
                        <th>Status</th>
                        @if (Auth::user()->role == "DFP" || Auth::user()->role == "SA")
                        <th>Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @if (Auth::user()->role == "DFP" || Auth::user()->role == "DRH")
                    @foreach($planbesoins as $planbesoin)
                    <tr id="planbesoin_{{ $planbesoin->id }}">
                        <td>{{ $planbesoin->id }}</td>
                        <td>{{ $planbesoin->exercice_id }}</td>
                        <td>{{ $planbesoin->structure_id }}</td>
                        <td>{{ $planbesoin->reference }}</td>
                        <td>{{ $planbesoin->specialites_id }}</td>
                        <td>{{ $planbesoin->date }}</td>
                        <td>{{ $planbesoin->nombreapprentis }}</td>
                        <td>{{ $planbesoin->nombereffectif }}</td>
                        <td>{{ $planbesoin->nombreapprentismax }}</td>
                        <td>{{ Str::limit($planbesoin->description, 50) }}</td>
                        <td>{{ $planbesoin->status }}</td>
                        @if (Auth::user()->role == "DFP")
                        <td>
                            <button class="btn btn-primary btn-sm edit-btn" data-id="{{ $planbesoin->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal" data-action="edit">Editer</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $planbesoin->id }}">Supprimer</button>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                    @elseif(Auth::user()->role == "SA")
                    @foreach($planbesoins as $planbesoin)
                    @if ($planbesoin->structure_id == Auth::user()->structures_id)
                    <tr id="planbesoin_{{ $planbesoin->id }}">
                        <td>{{ $planbesoin->id }}</td>
                        <td>{{ $planbesoin->exercice_id }}</td>
                        <td>{{ $planbesoin->structure_id }}</td>
                        <td>{{ $planbesoin->reference }}</td>
                        <td>{{ $planbesoin->specialites_id }}</td>
                        <td>{{ $planbesoin->date }}</td>
                        <td>{{ $planbesoin->nombreapprentis }}</td>
                        <td>{{ $planbesoin->nombereffectif }}</td>
                        <td>{{ $planbesoin->nombreapprentismax }}</td>
                        <td>{{ Str::limit($planbesoin->description, 50) }}</td>
                        <td>{{ $planbesoin->status }}</td>
                        <td>
                            <button class="btn btn-primary btn-sm edit-btn" data-id="{{ $planbesoin->id }}" data-bs-toggle="modal" data-bs-target="#exampleModal" data-action="edit">Editer</button>
                            <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $planbesoin->id }}">Supprimer</button>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                    @endif
                </tbody>
            </table>
        </main>
    </div>
</div>
@endSection
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#planbesoins-table').DataTable();
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
                url: '/planbesoins/' + id,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    // Remove the row from the table
                    button.closest('tr').remove();
                    alert('Plan besoins deleted successfully');
                },
                error: function(xhr, textStatus, errorThrown) {
                    // Handle error
                    console.error('Error deleting plan besoins:', errorThrown);
                }
            });
        });

        // AJAX for editing a structure
        $('.edit-btn').click(function() {
            var id = $(this).data('id');
            var row = $(this).closest('tr');
            var exercice_id = row.find('td:eq(1)').text();
            var structure_id = row.find('td:eq(2)').text();
            var reference = row.find('td:eq(3)').text();
            var specialites_id = row.find('td:eq(4)').text();
            var date = row.find('td:eq(5)').text();
            var nombreapprentis = row.find('td:eq(6)').text();
            var nombereffectif = row.find('td:eq(7)').text();
            var nombreapprentismax = row.find('td:eq(8)').text();
            var description = row.find('td:eq(9)').text();
            var status = row.find('td:eq(10)').text();
            var editForm = `
                <form method="POST" action="/planbesoins/${id}" class="edit-form">
                    @csrf
                    @method('PUT')
                    <select name="exercice_id" class="form-control mb-2">
                        @foreach($exercices as $exercice)
                            <option value="{{ $exercice->id }}" ${exercice_id == '{{ $exercice->id }}' ? 'selected' : ''}>{{ $exercice->annee }}</option>
                        @endforeach
                    </select>
                    <select name="structure_id" class="form-control mb-2">
                        @foreach($structures as $structure)
                            <option value="{{ $structure->id }}" ${structure_id == '{{ $structure->id }}' ? 'selected' : ''}>{{ $structure->nom }}</option>
                        @endforeach
                    </select>
                    <input type="text" name="reference" class="form-control mb-2" value="${reference}">
                    <select name="specialites_id" class="form-control mb-2" required>
                        @foreach($specialites as $specialite)
                            <option value="{{$specialite->id}}" ${specialites_id == '{{ $specialite->id }}' ? 'selected' : ''}>{{$specialite->nom}}</option>
                        @endforeach
                    </select>
                    <input type="date" name="date" class="form-control mb-2" value="${date}">
                    <input type="text" pattern="[0-9]+" name="nombreapprentis" class="form-control mb-2" value="${nombreapprentis}">
                    <input type="text" pattern="[0-9]+" name="nombereffectif" class="form-control mb-2" value="${nombereffectif}">
                    <input type="text" pattern="[0-9]+" name="nombreapprentismax" class="form-control mb-2" readonly disabled value="${nombreapprentismax}">
                    <textarea rows="4" cols="50" name="description" class="form-control mb-2">${description}</textarea>
                    @if($user->role == 'DFP')
                        <select name="status" class="form-control mb-2">
                            <option value="en cours" ${status == 'en cours' ? 'selected' : ''}>En cours</option>
                            <option value="accepté" ${status == 'accepté' ? 'selected' : ''}>Accepté</option>
                            <option value="refusé" ${status == 'refusé' ? 'selected' : ''}>Refusé</option>
                        </select>
                    @else
                        <input type="hidden" name="status" value="${status}">
                    @endif
                    <input type="submit" value="Modifier" class="btn btn-primary">
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