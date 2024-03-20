@extends('layouts.layout')
@section('title', 'Apprenti | Ajouter')
@section('content')
<h1 class="text-center mb-4">Ajouter un apprenti</h1>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
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

                    <form method="POST" action="{{ route('apprentis.submit') }}">
                        @csrf
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control" id="nom" name="nom" required>
                            </div>
                            <div class="col-md-6">
                                <label for="prenom" class="form-label">Prenom</label>
                                <input type="text" class="form-control" id="prenom" name="prenom" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="civilite" class="form-label">Civilité</label>
                                <select class="form-select" id="civilite" name="civilite" required>
                                    <option value="Homme">Homme</option>
                                    <option value="Femme">Femme</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="nationalite" class="form-label">Nationalité</label>
                                <select class="form-select" id="nationalite" name="nationalite" required>
                                    <option value="algerienne">Algerienne</option>
                                    <option value="etrangere">Etrangere</option>
                                </select>
                            </div>
                        </div>
                        <div>
                            <label for="datenaissance">Date de naissance</label>
                            <input type="date" id="datenaissance" name="datenaissance" required>
                        </div>
                        <div class="mb-3">
                            <label for="adresse" class="form-label">Adresse</label>
                            <input type="text" class="form-control" id="adresse" name="adresse" required>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$">
                            </div>
                            <div class="col-md-6">
                                <label for="telephone" class="form-label">Telephone</label>
                                <input type="text" class="form-control" id="telephone" name="telephone" required pattern="[0-9]{10}">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="niveauscolaire" class="form-label">Niveau Scolaire</label>
                                <select class="form-select" id="niveauscolaire" name="niveauscolaire" required>
                                    <option value="primaire">Primaire</option>
                                    <option value="moyen">Moyen</option>
                                    <option value="secondaire">Secondaire</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="specialite" class="form-label">Specialité</label>
                                <input type="text" class="form-control" id="specialite" name="specialite" required>
                            </div>
                            <div class="col-md-4">
                                <label for="status" class="form-label">Status</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="actif">Actif</option>
                                    <option value="inactif">Inactif</option>
                                </select>
                            </div>
                        </div>
                        <h4>Ajouter un maitre d'apprentis</h4>
                        <div class="col-md-6">
                            <label for="maitre_apprenti" class="form-label">Maitre d'apprentis</label>
                            <select class="form-select" id="maitre_apprenti" name="maitre_apprenti" required>
                                @foreach($maitre_apprentis as $maitreApprenti)
                                    <option value="{{ $maitreApprenti->id }}">{{ $maitreApprenti->matricule }} - {{ $maitreApprenti->nom }}</option>
                                @endforeach
                            </select>
                        </div>
                        <h4>Ajouter l'apprentissage</h4>
                        <div class="col-md-6">
                            <label for="diplomes" class="form-label">Diplome</label>
                            <select class="form-select" id="diplomes" name="diplomes" placeholder="selectionner un diplome" required>
                                <option>selectionner un diplome</option>
                                @foreach($diplomes as $diplome)
                                    <option value="{{ $diplome->id }}" data-name="{{ $diplome->nom }}" data-duration="{{ $diplome->duree }}">{{ $diplome->id }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label for="diplome_name" class="form-label">Nom du diplôme</label>
                            <input type="text" class="form-control" id="diplome_name" name="diplome_name" readonly>
                        </div>

                        <div class="col-md-6">
                            <label for="diplome_duration" class="form-label">Durée du diplôme</label>
                            <input type="text" class="form-control" id="diplome_duration" name="diplome_duration" readonly>
                        </div>

                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $('#diplomes').change(function() {
                                    var selectedDiplome = $(this).find('option:selected');
                                    var diplomeName = selectedDiplome.data('name');
                                    var diplomeDuration = selectedDiplome.data('duration');

                                    $('#diplome_name').val(diplomeName);
                                    $('#diplome_duration').val(diplomeDuration);
                                });
                            });
                        </script>
                         <!-- Date selection -->
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="datedebut">Date de début</label>
                                <input type="date" id="datedebut" name="datedebut">
                            </div>
                            <div class="col-md-6">
                                <label for="datefin">Date de fin</label>
                                <input type="date" id="datefin" name="datefin" readonly>
                            </div>
                        </div>
                        <div>
                            <label for="datetransfert">Date de transfert</label>
                            <input type="date" id="datetransfert" name="datetransfert">
                        </div>
                        <div>
                            <label for="numPV">Num PV d'installation</label>
                            <input type="text" id="numPV" name="numPV">
                            <label for="datepv">Date du PV d'installation</label>
                            <input type="date" id="datepv" name="datepv">
                        </div>
                        <!-- JavaScript/jQuery for dynamic calculation -->
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                        <script>
                            $(document).ready(function() {
                                $('#diplomes, #datedebut').change(function() {
                                    var selectedDiplome = $('#diplomes').find('option:selected');
                                    var diplomeDurationMonths = selectedDiplome.data('duration');
                                    var datedebut = $('#datedebut').val();

                                    if (diplomeDurationMonths && datedebut) {
                                        var dateDebut = new Date(datedebut);
                                        var datefin = new Date(dateDebut.setMonth(dateDebut.getMonth() + parseInt(diplomeDurationMonths)));
                                        var formattedDateFin = datefin.toISOString().split('T')[0];
                                        $('#datefin').val(formattedDateFin);
                                    }
                                });
                            });
                        </script>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
