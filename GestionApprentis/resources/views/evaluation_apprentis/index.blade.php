@extends('layouts.layout')
@section('title', 'Evaluation Apprenti | Ajouter')
@section('content')
<div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
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
    <form action="{{ route('evaluation_apprentis.submit') }}" method="POST" enctype="multipart/form-data" class="container mt-5">
        @csrf
        <div class="form-group mb-3">
            <label for="apprenti" class="form-label">Apprenti</label>
            <select name="apprenti_id" id="apprenti" class="form-control" required>
                <option value="">-- Choisir --</option>
                @foreach ($apprentis as $apprenti)
                    @if($apprenti->status == 'actif' && Auth::user()->structures_id == $apprenti->structure_id)
                        @php
                            $supervision = $supervisions->firstWhere('apprenti_id', $apprenti->id);
                            $maitre = $supervision ? $maitreapprentis->firstWhere('id', $supervision->maitreapprenti_id) : null;
                        @endphp
                        <option value="{{ $apprenti->id }}" 
                                data-nom="{{ $apprenti->nom }}" 
                                data-prenom="{{ $apprenti->prenom }}" 
                                data-civilite="{{ $apprenti->civilite }}"
                                data-maitre-nom="{{ $maitre->nom ?? '' }}" 
                                data-maitre-prenom="{{ $maitre->prenom ?? '' }}">
                            {{ $apprenti->id }} - {{ $apprenti->nom }} {{ $apprenti->prenom }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>

        <div id="apprenti-info" class="d-none">
            <h4>Infos sur l'apprenti</h4>
            <div class="form-group mb-3">
                <label for="nom" class="form-label">Nom</label>
                <input type="text" id="nom" class="form-control" disabled readonly>
            </div>
            <div class="form-group mb-3">
                <label for="prenom" class="form-label">Prenom</label>
                <input type="text" id="prenom" class="form-control" disabled readonly>
            </div>
            <div class="form-group mb-3">
                <label for="civilite" class="form-label">Civilité</label>
                <input type="text" id="civilite" class="form-control" disabled readonly>
            </div>
        </div>

        <div id="maitre-info" class="d-none">
            <h4>Infos sur le maitre apprenti</h4>
            <div class="form-group mb-3">
                <label for="maitre-nom" class="form-label">Nom</label>
                <input type="text" id="maitre-nom" class="form-control" disabled readonly>
            </div>
            <div class="form-group mb-3">
                <label for="maitre-prenom" class="form-label">Prenom</label>
                <input type="text" id="maitre-prenom" class="form-control" disabled readonly>
            </div>
        </div>

        <div class="form-group mb-3">
            <label for="reference" class="form-label">Reference</label>
            <input type="text" name="reference" class="form-control" id="reference" required>
        </div>

        <div class="form-group row mb-3">
            <div class="col-md-6">
                <label for="date_debut" class="form-label">Date début</label>
                <input type="date" name="datedebut" class="form-control" id="date_debut">
            </div>
            <div class="col-md-6">
                <label for="date_fin" class="form-label">Date fin</label>
                <input type="date" name="datefin" class="form-control" id="date_fin">
            </div>
        </div>
            <div class="form-group row mb-3">
    <label for="comportementsociabilite" class="form-label">Comportement et Sociabilité</label>
    
            <div class="col-md-6">
    <select name="comportementsociabilite" id="comportementsociabilite" class="form-control" required>
        <option value="">-- Choisir --</option>
        <option value="Très bon">Très bon</option>
        <option value="Bon">Bon</option>
        <option value="Moyen">Moyen</option>
        <option value="Faible">Faible</option>
    </select>
    </div>
    <div class="col-md-6">
    <input type="text" name="observationcs" class="form-control" placeholder="Observations">
</div>
</div>

<div class="form-group row mb-3">
<label for="communication" class="form-label">Communication</label>
        
<div class="col-md-6">
    <select name="communication" id="communication" class="form-control" required>
        <option value="">-- Choisir --</option>
        <option value="Très bon">Très bon</option>
        <option value="Bon">Bon</option>
        <option value="Moyen">Moyen</option>
        <option value="Faible">Faible</option>
    </select>
    </div>
    <div class="col-md-6">
    <input type="text" name="observationc" class="form-control" placeholder="Observations">
</div>
</div>

<div class="form-group row mb-3">
<label for="organisationhygiene" class="form-label">Organisation et Hygiène</label>
        
<div class="col-md-6">
    <select name="organisationhygiene" id="organisationhygiene" class="form-control" required>
        <option value="">-- Choisir --</option>
        <option value="Très bon">Très bon</option>
        <option value="Bon">Bon</option>
        <option value="Moyen">Moyen</option>
        <option value="Faible">Faible</option>
    </select>
    </div>
    <div class="col-md-6">
    <input type="text" name="observationoh" class="form-control" placeholder="Observations">
</div>
</div>

<div class="form-group row mb-3">
<label for="ponctualiteassiduite" class="form-label">Ponctualité et Assiduité</label>
        
<div class="col-md-6">
    <select name="ponctualiteassiduite" id="ponctualiteassiduite" class="form-control" required>
        <option value="">-- Choisir --</option>
        <option value="Très bon">Très bon</option>
        <option value="Bon">Bon</option>
        <option value="Moyen">Moyen</option>
        <option value="Faible">Faible</option>
    </select>
    </div>
    <div class="col-md-6">
    <input type="text" name="observationpa" class="form-control" placeholder="Observations">
</div>
</div>

<div class="form-group row mb-3">
<label for="respectreglementinterieur" class="form-label">Respect du Règlement Intérieur</label>
        
<div class="col-md-6">
    <select name="respectreglementinterieur" id="respectreglementinterieur" class="form-control" required>
        <option value="">-- Choisir --</option>
        <option value="Très bon">Très bon</option>
        <option value="Bon">Bon</option>
        <option value="Moyen">Moyen</option>
        <option value="Faible">Faible</option>
    </select>
    </div>
    <div class="col-md-6">
    <input type="text" name="observationrri" class="form-control" placeholder="Observations">
</div>
</div>

<div class="form-group row mb-3">
<label for="discipline" class="form-label">Discipline</label>
        
<div class="col-md-6">
    <select name="discipline" id="discipline" class="form-control" required>
        <option value="">-- Choisir --</option>
        <option value="Très bon">Très bon</option>
        <option value="Bon">Bon</option>
        <option value="Moyen">Moyen</option>
        <option value="Faible">Faible</option>
    </select>
    </div>
    <div class="col-md-6">
    <input type="text" name="observationd" class="form-control" placeholder="Observations">
</div>
</div>

<div class="form-group row mb-3">
<label for="interettravail" class="form-label">Intérêt pour le Travail</label>
        
<div class="col-md-6">
    <select name="interettravail" id="interettravail" class="form-control" required>
        <option value="">-- Choisir --</option>
        <option value="Très bon">Très bon</option>
        <option value="Bon">Bon</option>
        <option value="Moyen">Moyen</option>
        <option value="Faible">Faible</option>
    </select>
    </div>
    <div class="col-md-6">
    <input type="text" name="observationit" class="form-control" placeholder="Observations">
</div>
</div>

<div class="form-group row mb-3">
<label for="motivation" class="form-label">Motivation</label>
        
<div class="col-md-6">
    <select name="motivation" id="motivation" class="form-control" required>
        <option value="">-- Choisir --</option>
        <option value="Très bon">Très bon</option>
        <option value="Bon">Bon</option>
        <option value="Moyen">Moyen</option>
        <option value="Faible">Faible</option>
    </select>
    </div>
    <div class="col-md-6">
    <input type="text" name="observationm" class="form-control" placeholder="Observations">
</div>
</div>

<div class="form-group row mb-3">
<label for="espritinitiative" class="form-label">Esprit d'Initiative</label>
        
<div class="col-md-6">
    <select name="espritinitiative" id="espritinitiative" class="form-control" required>
        <option value="">-- Choisir --</option>
        <option value="Très bon">Très bon</option>
        <option value="Bon">Bon</option>
        <option value="Moyen">Moyen</option>
        <option value="Faible">Faible</option>
    </select>
    </div>
    <div class="col-md-6">
    <input type="text" name="observationei" class="form-control" placeholder="Observations">
</div>
</div>

<div class="form-group row mb-3">
<label for="evolutionprocessusintegration" class="form-label">Évolution et Processus d'Intégration</label>
        
<div class="col-md-6">
    <select name="evolutionprocessusintegration" id="evolutionprocessusintegration" class="form-control" required>
        <option value="">-- Choisir --</option>
        <option value="Très bon">Très bon</option>
        <option value="Bon">Bon</option>
        <option value="Moyen">Moyen</option>
        <option value="Faible">Faible</option>
    </select>
    </div>
    <div class="col-md-6">
    <input type="text" name="observationepi" class="form-control" placeholder="Observations">
</div>
</div>

<div class="form-group row mb-3">
<label for="qualificationsprofessionelles" class="form-label">Qualifications Professionnelles</label>
        
<div class="col-md-6">
    <select name="qualificationsprofessionelles" id="qualificationsprofessionelles" class="form-control" required>
        <option value="">-- Choisir --</option>
        <option value="Très bon">Très bon</option>
        <option value="Bon">Bon</option>
        <option value="Moyen">Moyen</option>
        <option value="Faible">Faible</option>
    </select>
    </div>
    <div class="col-md-6">
    <input type="text" name="observationqp" class="form-control" placeholder="Observations">
</div>
</div>

<div class="form-group row mb-3">
<label for="sensresponsabilite" class="form-label">Sens de la Responsabilité</label>
        
<div class="col-md-6">
    <select name="sensresponsabilite" id="sensresponsabilite" class="form-control" required>
        <option value="">-- Choisir --</option>
        <option value="Très bon">Très bon</option>
        <option value="Bon">Bon</option>
        <option value="Moyen">Moyen</option>
        <option value="Faible">Faible</option>
    </select>
    </div>
    <div class="col-md-6">
    <input type="text" name="observationsr" class="form-control" placeholder="Observations">
</div>
</div>


        <button type="submit" class="btn btn-primary w-100">Ajouter</button>
    </form>
</div>

<script>
    document.getElementById('apprenti').addEventListener('change', function() {
        const selectedOption = this.options[this.selectedIndex];
        const nom = selectedOption.getAttribute('data-nom');
        const prenom = selectedOption.getAttribute('data-prenom');
        const civilite = selectedOption.getAttribute('data-civilite');
        const maitreNom = selectedOption.getAttribute('data-maitre-nom');
        const maitrePrenom = selectedOption.getAttribute('data-maitre-prenom');

        // Display apprenti information
        if (nom && prenom && civilite) {
            document.getElementById('nom').value = nom;
            document.getElementById('prenom').value = prenom;
            document.getElementById('civilite').value = civilite;
            document.getElementById('apprenti-info').classList.remove('d-none');
        } else {
            document.getElementById('apprenti-info').classList.add('d-none');
        }

        // Display maitre apprenti information
        if (maitreNom && maitrePrenom) {
            document.getElementById('maitre-nom').value = maitreNom;
            document.getElementById('maitre-prenom').value = maitrePrenom;
            document.getElementById('maitre-info').classList.remove('d-none');
        } else {
            document.getElementById('maitre-info').classList.add('d-none');
        }
    });
</script>
@endsection
