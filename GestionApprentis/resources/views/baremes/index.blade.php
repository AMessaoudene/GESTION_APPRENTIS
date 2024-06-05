@extends('layouts.layout')
@section('title', 'Baremes')
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
            <div class="container">
                @if (Auth::user()->role == 'DFP' || Auth::user()->role == 'DRH')
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card">
                                <div class="card-header">Ajouter un bareme</div>
                                <div class="card-body">
                                    <form action="{{ route('baremes.store') }}" method="POST" id="baremesForm">
                                        @csrf
                                        <div class="form-group">
                                            <label for="refsalariaires_id">Référence Salariale :</label>
                                            <select class="form-control" name="refsalariaires_id" id="refsalariaires_id">
                                                <option value="">Sélectionner une version</option>
                                                @foreach ($refsalaries as $refsalarie)
                                                <option value="{{ $refsalarie->id }}" data-snmg="{{ $refsalarie->snmg }}" data-salairereference="{{ $refsalarie->salairereference }}">{{ $refsalarie->version }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="diplome_id">Diplôme :</label>
                                            <select class="form-control" name="diplome_id">
                                                <option value="">Sélectionner un diplôme</option>
                                                @foreach ($diplomes as $diplome)
                                                <option id="{{ $diplome->id }}" value="{{ $diplome->id }}">{{$diplome->id}} - {{ $diplome->nom }} -  {{ $diplome->duree }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label for="">snmg
                                                <input type="text" name="snmg" id="snmg" disabled readonly>
                                            </label>
                                            <label for="">salaire reference
                                                <input type="text" name="salairereference" id="salairereference" disabled readonly>
                                            </label>
                                        </div>

                                        <script>
                                            document.getElementById('refsalariaires_id').addEventListener('change', function() {
                                                var selectedIndex = this.selectedIndex;
                                                var selectedOption = this.options[selectedIndex];
                                                var snmg = selectedOption.getAttribute('data-snmg');
                                                var salairereference = selectedOption.getAttribute('data-salairereference');
                                                
                                                document.getElementById('snmg').value = snmg;
                                                document.getElementById('salairereference').value = salairereference;

                                                // Update the montant chiffres for all taux input fields
                                                updateMontantChiffres('apprentis', snmg);
                                                updateMontantChiffres('maitreapprentis', salairereference);
                                            });

                                            function updateMontantChiffres(role, referenceValue) {
                                                for (let i = 1; i <= 5; i++) {
                                                    let tauxInput = document.querySelector(`input[name="tauxs${i}_${role}"]`);
                                                    let montantChiffresInput = document.querySelector(`input[name="montantchiffres${i}_${role}"]`);

                                                    if (tauxInput && montantChiffresInput) {
                                                        tauxInput.addEventListener('input', function() {
                                                            let taux = parseFloat(tauxInput.value);
                                                            let montantChiffres = (referenceValue * taux)/100;
                                                            montantChiffresInput.value = isNaN(montantChiffres) ? '' : montantChiffres.toFixed(2);
                                                        });
                                                    }
                                                }
                                            }
                                        </script>

                                        <!-- Apprentice and Master Apprentice sections -->
                                        <div id="apprentisSection">
                                            <!-- Apprentis -->
                                            <div id="apprentis" class="form-group">
                                                <label>Apprentis</label>
                                                <!-- Repeat the following bareme for each section -->
                                                <div id="AS1" class="form-row">S1
                                                    <div class="col">
                                                        <input type="text" class="form-control" pattern="[0-9]+" name="tauxs1_apprentis" placeholder="S1 Taux" required>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="montantchiffres1_apprentis" placeholder="S1 Montant (Chiffres)" readonly disabled>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="montantlettres1_apprentis" placeholder="S1 Montant (Lettres)" required>
                                                    </div>
                                                </div>
                                                <!-- S2 -->
                                                <div id="AS2" class="form-row">S2
                                                    <div class="col">
                                                        <input type="text" class="form-control" pattern="[0-9]+" name="tauxs2_apprentis" placeholder="S2 Taux" required>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="montantchiffres2_apprentis" placeholder="S2 Montant (Chiffres)" readonly disabled>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="montantlettres2_apprentis" placeholder="S2 Montant (Lettres)" required>
                                                    </div>
                                                </div>
                                                <!-- S3 -->
                                                <div id="AS3" class="form-row">S3
                                                    <div class="col">
                                                        <input type="text" class="form-control" pattern="[0-9]+" name="tauxs3_apprentis" placeholder="S3 Taux">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="montantchiffres3_apprentis" placeholder="S3 Montant (Chiffres)" readonly disabled>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="montantlettres3_apprentis" placeholder="S3 Montant (Lettres)">
                                                    </div>
                                                </div>
                                                <!-- S4 -->
                                                <div id="AS4" class="form-row">S4
                                                    <div class="col">
                                                        <input type="text" class="form-control" pattern="[0-9]+" name="tauxs4_apprentis" placeholder="S4 Taux">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="montantchiffres4_apprentis" placeholder="S4 Montant (Chiffres)" readonly disabled>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="montantlettres4_apprentis" placeholder="S4 Montant (Lettres)">
                                                    </div>
                                                </div>
                                                <!-- S5 -->
                                                <div id="AS5" class="form-row">S5
                                                    <div class="col">
                                                        <input type="text" class="form-control" pattern="[0-9]+" name="tauxs5_apprentis" placeholder="S5 Taux">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="montantchiffres5_apprentis" placeholder="S5 Montant (Chiffres)" readonly disabled>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="montantlettres5_apprentis" placeholder="S5 Montant (Lettres)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="maitreapprentisSection">
                                            <!-- Maitre Apprentis -->
                                            <div id="maitreapprentis" class="form-group">
                                                <label>Maitre Apprentis</label>
                                                <!-- Repeat the following bareme for each section -->
                                                <div id="MS1" class="form-row">S1
                                                    <div class="col">
                                                        <input type="text" class="form-control" pattern="[0-9]+" name="tauxs1_maitreapprentis" placeholder="S1 Taux" required>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="montantchiffres1_maitreapprentis" placeholder="S1 Montant (Chiffres)" readonly disabled>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="montantlettres1_maitreapprentis" placeholder="S1 Montant (Lettres)" required>
                                                    </div>
                                                </div>
                                                <!-- S2 -->
                                                <div id="MS2" class="form-row">S2
                                                    <div class="col">
                                                        <input type="text" class="form-control" pattern="[0-9]+" name="tauxs2_maitreapprentis" placeholder="S2 Taux" required>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" pattern="[0-9]+" name="montantchiffres2_maitreapprentis" placeholder="S2 Montant (Chiffres)" readonly disabled>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name                                                        ="montantlettres2_maitreapprentis" placeholder="S2 Montant (Lettres)" required>
                                                    </div>
                                                </div>
                                                <!-- S3 -->
                                                <div id="MS3" class="form-row">S3
                                                    <div class="col">
                                                        <input type="text" class="form-control" pattern="[0-9]+" name="tauxs3_maitreapprentis" placeholder="S3 Taux">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" pattern="[0-9]+" name="montantchiffres3_maitreapprentis" placeholder="S3 Montant (Chiffres)" readonly disabled>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="montantlettres3_maitreapprentis" placeholder="S3 Montant (Lettres)">
                                                    </div>
                                                </div>
                                                <!-- S4 -->
                                                <div id="MS4" class="form-row">S4
                                                    <div class="col">
                                                        <input type="text" class="form-control" pattern="[0-9]+" name="tauxs4_maitreapprentis" placeholder="S4 Taux">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" pattern="[0-9]+" name="montantchiffres4_maitreapprentis" placeholder="S4 Montant (Chiffres)" readonly disabled>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="montantlettres4_maitreapprentis" placeholder="S4 Montant (Lettres)">
                                                    </div>
                                                </div>
                                                <!-- S5 -->
                                                <div id="MS5" class="form-row">S5
                                                    <div class="col">
                                                        <input type="text" class="form-control" pattern="[0-9]+" name="tauxs5_maitreapprentis" placeholder="S5 Taux">
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" pattern="[0-9]+" name="montantchiffres5_maitreapprentis" placeholder="S5 Montant (Chiffres)" readonly disabled>
                                                    </div>
                                                    <div class="col">
                                                        <input type="text" class="form-control" name="montantlettres5_maitreapprentis" placeholder="S5 Montant (Lettres)">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group text-center mt-3 mb-3">
                                            <button type="submit" class="btn btn-primary">Ajouter</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                 @endif
                 <h1 class="text-center" style="margin-top:3%;">Liste des baremes</h1>
                <table id="baremes-table" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Version</th>
                            <th scope="col">SNMG</th>
                            <th scope="col">Salaire Reference</th>
                            <th scope="col">Diplome</th>
                            <th scope="col">Taux S1 Apprentis</th>
                            <th scope="col">Taux S2 Apprentis</th>
                            <th scope="col">Taux S3 Apprentis</th>
                            <th scope="col">Taux S4 Apprentis</th>
                            <th scope="col">Taux S5 Apprentis</th>
                            <th scope="col">Taux S1 Maitre Apprentis</th>
                            <th scope="col">Taux S2 Maitre Apprentis</th>
                            <th scope="col">Taux S3 Maitre Apprentis</th>
                            <th scope="col">Taux S4 Maitre Apprentis</th>
                            <th scope="col">Taux S5 Maitre Apprentis</th>
                            <th scope="col">Status</th>
                            @if (Auth::user()->role == 'DFP')
                                <th scope="col">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($baremes as $bareme)
                        <tr>
                            <td>{{ $bareme->id }}</td>
                            <td>
                            @foreach ($refsalaries as $ref)
                                @if ($bareme->refsalariaires_id == $ref->id)
                                    {{ $ref->version }}
                                @endif
                            @endforeach
                            </td>
                            <td>
                            @foreach ($refsalaries as $ref)
                                @if ($bareme->refsalariaires_id == $ref->id)
                                    {{ $ref->snmg }} DZD
                                @endif
                            @endforeach
                            </td>
                            <td>
                            @foreach ($refsalaries as $ref)
                                @if ($bareme->refsalariaires_id == $ref->id)
                                    {{ $ref->salairereference }} DZD
                                @endif
                            @endforeach
                            </td>
                            <td>
                            @foreach ($diplomes as $diplome)
                                @if ($bareme->diplome_id == $diplome->id)
                                    {{ $diplome->nom }}
                                @endif
                            @endforeach
                            </td>
                            <td>{{ $bareme->tauxs1_apprentis }} %</td>
                            <td>{{ $bareme->tauxs2_apprentis }} %</td>
                            <td>
                            @if ($bareme->tauxs3_apprentis)
                            {{ $bareme->tauxs3_apprentis }} %
                            @else
                            /
                            @endif
                            </td>
                            <td>
                            @if ($bareme->tauxs4_apprentis)
                            {{ $bareme->tauxs4_apprentis }} %
                            @else
                            /
                            @endif
                            </td>
                            <td>
                            @if ($bareme->tauxs5_apprentis)
                            {{ $bareme->tauxs5_apprentis }} %
                            @else
                            /
                            @endif
                            </td>
                            <td>{{ $bareme->tauxs1_maitreapprentis }} %</td>
                            <td>{{ $bareme->tauxs2_maitreapprentis }} %</td>
                            <td>
                            @if ($bareme->tauxs3_maitreapprentis)
                            {{ $bareme->tauxs3_maitreapprentis }} %
                            @else
                            /
                            @endif
                            </td>
                            <td>
                            @if ($bareme->tauxs4_maitreapprentis)
                            {{ $bareme->tauxs4_maitreapprentis }} %
                            @else
                            /
                            @endif
                            </td>
                            <td>
                            @if ($bareme->tauxs5_maitreapprentis)
                            {{ $bareme->tauxs5_maitreapprentis }} %
                            @else
                            /
                            @endif
                            </td>
                            <td>{{ $bareme->statut }}</td>
                            @if (Auth::user()->role == 'DFP')
                            <td>
                                <div>
                                    <button class="btn btn-primary edit-btn mr-2" data-id="{{ $bareme->id }}">Modifier</button>
                                    <form id="deleteForm{{ $bareme->id }}" action="{{ route('baremes.destroy', $bareme->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $bareme->id }})">Supprimer</button>
                                    </form>
                                </div>
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
<script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#baremes-table').DataTable();

        // AJAX for adding a new bareme
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
                    console.error('Error adding bareme:', errorThrown);
                }
            });
        });

        // AJAX for editing a bareme
        $(document).on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var row = $(this).closest('tr');
            var nom = row.find('td:eq(1)').text();
            var adressecourriel = row.find('td:eq(2)').text();
            var editForm = `
                <form method="POST" action="/baremes/${id}" class="edit-form">
                    @csrf
                    @method('PUT')
                    <input type="text" name="nom" class="form-control" value="${nom}">
                    <input type="text" name="adressecourriel" class="form-control" value="${adressecourriel}">
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
                    console.error('Error updating bareme:', errorThrown);
                }
            });
        });
    });
    function confirmDelete(id) {
        if (confirm('Voulez-vous supprimer ce bareme?')) {
            // Submit the form if confirmed
            document.getElementById('deleteForm' + id).submit();
        }
    }
    document.addEventListener('DOMContentLoaded', function() {
        // Function to calculate and display amounts for apprentices
        function calculateApprentisAmounts() {
            const snmg = parseFloat(document.getElementById('snmg').value) || 0;
            ['s1', 's2', 's3', 's4', 's5'].forEach(semester => {
                const tauxInput = document.querySelector(`input[name="taux${semester}_apprentis"]`);
                const montantChiffresInput = document.querySelector(`input[name="montantchiffres${semester}_apprentis"]`);
                if (tauxInput && montantChiffresInput) {
                    tauxInput.addEventListener('input', function() {
                        const taux = parseFloat(tauxInput.value) || 0;
                        const montantChiffres = snmg * taux;
                        montantChiffresInput.value = montantChiffres.toFixed(2);
                    });
                }
            });
        }

        // Function to calculate and display amounts for master apprentices
        function calculateMaitreApprentisAmounts() {
            const salaireReference = parseFloat(document.getElementById('salairereference').value) || 0;
            ['s1', 's2', 's3', 's4', 's5'].forEach(semester => {
                const tauxInput = document.querySelector(`input[name="taux${semester}_maitreapprentis"]`);
                const montantChiffresInput = document.querySelector(`input[name="montantchiffres${semester}_maitreapprentis"]`);
                if (tauxInput && montantChiffresInput) {
                    tauxInput.addEventListener('input', function() {
                        const taux = parseFloat(tauxInput.value) || 0;
                        const montantChiffres = salaireReference * taux;
                        montantChiffresInput.value = montantChiffres.toFixed(2);
                    });
                }
            });
        }

        // Function to handle change in salary reference selection
        function handleSalaryReferenceChange() {
            var selectedIndex = this.selectedIndex;
            var selectedOption = this.options[selectedIndex];
            var snmg = selectedOption.getAttribute('data-snmg');
            var salairereference = selectedOption.getAttribute('data-salairereference');

            document.getElementById('snmg').value = snmg;
            document.getElementById('salairereference').value = salairereference;

            calculateApprentisAmounts();
            calculateMaitreApprentisAmounts();
        }

        // Event listener for salary reference selection change
        document.getElementById('refsalariaires_id').addEventListener('change', handleSalaryReferenceChange);

        // Initial calculation setup
        calculateApprentisAmounts();
        calculateMaitreApprentisAmounts();

        // Diploma selection handling
        var diplomeSelect = document.querySelector('select[name="diplome_id"]');
        var sectionsMap = {
            1: ['AS1', 'AS2', 'MS1', 'MS2'],
            2: ['AS1', 'AS2', 'MS1', 'MS2'],
            3: ['AS1', 'AS2', 'AS3', 'MS1', 'MS2', 'MS3'],
            4: ['AS1', 'AS2', 'AS3', 'AS4', 'MS1', 'MS2', 'MS3', 'MS4'],
            5: ['AS1', 'AS2', 'AS3', 'AS4', 'MS1', 'MS2', 'MS3', 'MS4', 'AS5', 'MS5']
        };

        function showSections(sections) {
            document.querySelectorAll('.form-row').forEach(function(section) {
                section.style.display = 'none';
            });

            sections.forEach(function(sectionId) {
                var section = document.getElementById(sectionId);
                if (section) {
                    section.style.display = 'flex'; // Assuming you're using flexbox for layout
                }
            });
        }

        function handleDiplomeChange() {
            var selectedDiplome = parseInt(diplomeSelect.value);
            if (sectionsMap[selectedDiplome]) {
                showSections(sectionsMap[selectedDiplome]);
            }
        }

        handleDiplomeChange();
        diplomeSelect.addEventListener('change', handleDiplomeChange);
    });
</script>
