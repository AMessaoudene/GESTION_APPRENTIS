@extends('layouts.layout')
@section('title', 'Supervisions')
<link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
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
            @if (Auth::user()->role == 'DFP' || Auth::user()->role == 'SA')
            <!-- Trigger button -->
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAccountModal">
                        Ajouter une supervision
                    </button>
                </div>
            </div>

            <!-- Modal super$supervision -->
            <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addAccountModalLabel">Gestion Des supervisions</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form id="add-form" method="POST" action="{{ route('supervisions.submit') }}" class="form-horizontal">
                                @csrf
                                <div class="form-group">
                                    <label for="apprenti_id">Apprenti</label>
                                    <select name="apprenti_id" class="form-control" id="apprenti_id" required>
                                        <option value="">Sélectionnez un apprenti</option>
                                        @foreach($apprentis as $apprenti)
                                        <option value="{{ $apprenti->id }}" data-diplome1-id="{{ $apprenti->diplome1_id }}" data-diplome2-id="{{ $apprenti->diplome2_id }}" data-specialite="{{ $apprenti->specialite_id }}" data-structure="{{ $apprenti->structure_id }}">{{ $apprenti->nom }} {{ $apprenti->prenom }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="maitreapprenti_id">Maitre d'apprenti</label>
                                    <select name="maitreapprenti_id" class="form-select" required id="maitre_apprentis">
                                        <option value="">-- Choisir un maitre d'apprentissage --</option>
                                        @foreach($maitres as $maitre)
                                        @if (is_null($maitre->apprenti1_id) || is_null($maitre->apprenti2_id))
                                        <option value="{{ $maitre->id }}"
                                                data-specialite="{{ $maitre->fonction }}"
                                                data-structure="{{ $maitre->affectation }}"
                                                data-diplome="{{ $maitre->diplome_id }}"
                                                data-duree="{{ $maitre->diplome->duree }}">
                                            {{ $maitre->nom }} {{ $maitre->prenom }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="datedebut">Date début</label>
                                    <input type="date" name="datedebut" class="form-control" id="datedebut" required>
                                </div>
                                <div class="form-group">
                                    <label for="datefin">Date fin</label>
                                    <input type="date" name="datefin" class="form-control" id="datefin" required>
                                </div>
                                <script>
                                    const datedebutInput = document.getElementById('datedebut');
                                    const datefinInput = document.getElementById('datefin');

                                    function updateDateFinMin() {
                                        const datedebut = new Date(datedebutInput.value);
                                        if (datedebut) {
                                            // Set the minimum date for datefin to be one day after datedebut
                                            const minDateFin = new Date(datedebut);
                                            minDateFin.setDate(minDateFin.getDate() + 1);
                                            datefinInput.min = minDateFin.toISOString().split('T')[0];
                                        }
                                    }

                                    datedebutInput.addEventListener('change', updateDateFinMin);
                                </script>
                                <div class="form-group text-center mt-3 mb-3">
                                    <button type="submit" class="btn btn-primary">Ajouter</button>
                                </div> 
                            </form>
                            <script>
                                document.addEventListener('DOMContentLoaded', function () {
                                    const specialiteSelect = document.getElementById('apprenti_id');
                                    const structureSelect = document.getElementById('apprenti_id');
                                    const diplomeSelect = document.getElementById('apprenti_id');
                                    const maitreApprentisSelect = document.getElementById('maitre_apprentis');

                                    function filterMaitreApprentis() {
                                        const selectedSpecialite = specialiteSelect.options[specialiteSelect.selectedIndex].getAttribute('data-specialite');
                                        const selectedStructure = structureSelect.options[structureSelect.selectedIndex].getAttribute('data-structure');
                                        const selectedDiplome1 = diplomeSelect.options[diplomeSelect.selectedIndex].getAttribute('data-diplome1-id');
                                        const selectedDiplome2 = diplomeSelect.options[diplomeSelect.selectedIndex].getAttribute('data-diplome2-id');

                                        Array.from(maitreApprentisSelect.options).forEach(option => {
                                            const specialite = option.getAttribute('data-specialite');
                                            const structure = option.getAttribute('data-structure');
                                            const maitreDiplome = option.getAttribute('data-diplome');

                                            if ((specialite === selectedSpecialite) && (structure === selectedStructure) && (maitreDiplome === selectedDiplome1 || maitreDiplome === selectedDiplome2)) {
                                                option.style.display = '';
                                            } else {
                                                option.style.display = 'none';
                                            }
                                        });

                                        // Clear the selection of maitre_apprentis
                                        maitreApprentisSelect.value = '';
                                    }

                                    specialiteSelect.addEventListener('change', filterMaitreApprentis);
                                    structureSelect.addEventListener('change', filterMaitreApprentis);
                                    diplomeSelect.addEventListener('change', filterMaitreApprentis);

                                    // Call the filter function initially to set the correct state
                                    filterMaitreApprentis();
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            @endif
            <h1 class="text-center" style="margin-top:3%;">Liste des supervisions</h1>
            <table id="supervisions-table" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Apprenti</th>
                        <th scope="col">Maitre Apprenti</th>
                        <th scope="col">Date Debut</th>
                        <th scope="col">Date Fin</th>
                        <th scope="col">Status</th>
                        @if (Auth::user()->role == 'DFP' || Auth::user()->role == 'SA')
                        <th scope="col">Actions</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($supervisions as $supervision)
                    <tr>
                        <td>{{ $supervision->id }}</td>
                        <td>
                            @foreach ($apprentis as $apprenti)
                            @if ($apprenti->id == $supervision->apprenti_id)
                            {{ $apprenti->nom }} {{ $apprenti->prenom }}
                            @endif
                            @endforeach
                        <td>
                            @foreach ($maitres as $maitre)
                            @if ($maitre->id == $supervision->maitreapprenti_id)
                            {{ $maitre->nom }} {{ $maitre->prenom }}
                            @endif
                            @endforeach
                        <td>{{ $supervision->datedebut }}</td>
                        <td>{{ $supervision->datefin }}</td>
                        <td>{{ $supervision->status }}</td>
                        @if (Auth::user()->role == 'DFP' || Auth::user()->role == 'SA')
                        <td>
                            <div>
                                @if (Auth::user()->role == 'DFP' || (Auth::user()->role == 'SA' && $supervision->apprenti_id == $apprenti->id && Auth::user()->structures_id == $apprenti->structure_id))
                                <button class="btn btn-primary edit-btn mr-2" data-id="{{ $supervision->id }}">Modifier</button>
                                @endif
                                @if (Auth::user()->role == 'DFP')
                                <form id="deleteForm{{ $supervision->id }}" action="{{ route('supervisions.destroy', $supervision->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" onclick="                                    confirmDelete({{ $supervision->id }})">Supprimer</button>
                                </form>
                                @endif
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </main>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
<script>
    function confirmDelete(id) {
        if (confirm('Voulez-vous supprimer cette supervision?')) {
            // Submit the form if confirmed
            document.getElementById('deleteForm' + id).submit();
        }
    }

    $(document).ready(function() {
        $('#supervisions-table').DataTable();

        // AJAX for adding a new supervision
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
                    console.error('Error adding supervision:', errorThrown);
                }
            });
        });

        // AJAX for editing a supervision
        $(document).on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var row = $(this).closest('tr');
            var apprenti = row.find('td:eq(1)').text().trim();
            var maitre = row.find('td:eq(2)').text().trim();
            var datedebut = row.find('td:eq(3)').text().trim();
            var datefin = row.find('td:eq(4)').text().trim();
            var status = row.find('td:eq(5)').text().trim();
            
            var editForm = `
                <form method="POST" action="{{ url('supervisions/update/${id}') }}" class="edit-form">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="apprenti_id">Apprenti</label>
                        <select name="apprenti_id" class="form-control" required>
                            <option value="">Sélectionnez un apprenti</option>
                            @foreach($apprentis as $apprenti)
                                <option value="{{ $apprenti->id }}" ${apprenti.id == id ? 'selected' : ''}>{{ $apprenti->nom }} {{ $apprenti->prenom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="maitreapprenti_id">Maitre d'apprenti</label>
                        <select name="maitreapprenti_id" class="form-control" required>
                            <option value="">Sélectionnez un maitre d'apprenti</option>
                            @foreach($maitres as $maitre)
                                <option value="{{ $maitre->id }}" ${maitre.id == id ? 'selected' : ''}>{{ $maitre->nom }} {{ $maitre->prenom }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="datedebut">Date début</label>
                        <input type="date" name="datedebut" class="form-control" value="${datedebut}" required>
                    </div>
                    <div class="form-group">
                        <label for="datefin">Date fin</label>
                        <input type="date" name="datefin" class="form-control" value="${datefin}" required>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" required>
                            <option value="actif" ${status == 'actif' ? 'selected' : ''}>Actif</option>
                            <option value="inactif" ${status == 'inactif' ? 'selected' : ''}>Inactif</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
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
                type: 'PUT',
                data: form.serialize(),
                success: function(response) {
                    // Reload the page to update the table
                    location.reload();
                },
                error: function(xhr, textStatus, errorThrown) {
                    // Handle error
                    console.error('Error updating supervision:', errorThrown);
                }
            });
        });
    });
</script>
