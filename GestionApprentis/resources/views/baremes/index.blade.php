@extends('layouts.layout')
@section('title', 'Baremes')
@section('content')
<div class="container">
    <h2>Ajouter un élément</h2>
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
    <option value="">Selectoinner in diplome:</option>
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
    });
</script>

        <!-- Apprentice and Master Apprentice sections -->
        <div id="apprentisSection">
            <!-- Apprentis -->
            <div id="apprentis" class="form-group">
                <label>Apprentis</label>
                <!-- Repeat the following structure for each section -->
                <div id="AS1" class="form-row">S1
                    <div class="col">
                        <input type="text" class="form-control" pattern="[0-9]+" name="tauxs1_apprentis" placeholder="S1 Taux" required>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" pattern="[0-9]+" name="montantchiffres1_apprentis" placeholder="S1 Montant (Chiffres)" readonly disabled>
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
                        <input type="text" class="form-control" pattern="[0-9]+" name="montantchiffres2_apprentis" placeholder="S2 Montant (Chiffres)" readonly disabled>
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
                        <input type="text" class="form-control" pattern="[0-9]+" name="montantchiffres3_apprentis" placeholder="S3 Montant (Chiffres)" readonly disabled>
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
                        <input type="text" class="form-control" pattern="[0-9]+" name="montantchiffres4_apprentis" placeholder="S4 Montant (Chiffres)" readonly disabled>
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
                        <input type="text" class="form-control" pattern="[0-9]+" name="montantchiffres5_apprentis" placeholder="S5 Montant (Chiffres)" readonly disabled>
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
                <!-- Repeat the following structure for each section -->
                <div id="MS1" class="form-row">S1
                    <div class="col">
                        <input type="text" class="form-control" pattern="[0-9]+" name="tauxs1_maitreapprentis" placeholder="S1 Taux" required>
                    </div>
                    <div class="col">
                        <input type="text" class="form-control" pattern="[0-9]+" name="montantchiffres1_maitreapprentis" placeholder="S1 Montant (Chiffres)" readonly disabled>
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
                        <input type="text" class="form-control" name="montantlettres2_maitreapprentis" placeholder="S2 Montant (Lettres)" required>
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
        <div class="form-group">
            <label for="status">Statut :</label>
            <select class="form-control" name="statut" id="status">
                <option value="actif">Actif</option>
                <option value="inactif">Inactif</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var diplomeSelect = document.querySelector('select[name="diplome_id"]');
        var sectionsToShow = [];

        // Define sections to show based on selected diploma
        var sectionsMap = {
            1: ['AS1', 'AS2', 'MS1', 'MS2'],
            2: ['AS1', 'AS2', 'MS1', 'MS2'],
            3: ['AS1', 'AS2', 'AS3', 'MS1', 'MS2', 'MS3'],
            4: ['AS1', 'AS2', 'AS3', 'AS4', 'MS1', 'MS2', 'MS3', 'MS4'],
            5: ['AS1', 'AS2', 'AS3', 'AS4', 'MS1', 'MS2', 'MS3', 'MS4', 'AS5', 'MS5']
        };

        // Function to show sections and hide the rest
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

        // Function to handle change in diploma selection
        function handleDiplomeChange() {
            var selectedDiplome = parseInt(diplomeSelect.value);
            if (sectionsMap[selectedDiplome]) {
                showSections(sectionsMap[selectedDiplome]);
            }
        }

        // Initial setup based on selected diploma
        handleDiplomeChange();

        // Event listener for diploma selection change
        diplomeSelect.addEventListener('change', handleDiplomeChange);
    });
</script>
