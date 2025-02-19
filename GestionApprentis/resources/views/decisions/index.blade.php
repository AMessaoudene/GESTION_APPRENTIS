@extends('layouts.layout')
@section('title', 'Decisions')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Decisions de l'apprenti et maitre d'apprenti</h2>
                    <form action="{{ route('decisions.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="planbesoins_id">Plan Besoins:</label>
                            <select class="form-control" name="planbesoins_id" id="planbesoins_id">
                                <option value="">-- choisir --</option>
                                @foreach($plans as $plan)
                                @if($plan->status == 'accepté' && $plan->structure_id == $apprenti->structure_id && $plan->specialites_id == $apprenti->specialite_id)
                                    <option value="{{ $plan->id }}">{{ $plan->reference }} - 
                                    @foreach ($structures as $structure)
                                    @if ($structure->id == $plan->structure_id)
                                        {{ $structure->nom }}
                                    @endif
                                    @endforeach
                                    -
                                    @foreach ($specialites as $specialite)
                                    @if ($plan->specialites_id == $specialite->id)
                                        {{ $specialite->nom }}
                                    @endif
                                    @endforeach
                                    </option>
                                @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="parametre_id">Parametre:</label>
                            <select class="form-control" name="parametre_id" id="parametre_id">
                                <option value="">-- choisir --</option>
                                @foreach($parametres as $parametre)
                                    @if($parametre->status == 'actif')
                                        <option value="{{$parametre->id}}"> {{ $parametre->reference }} - {{ $parametre->nomprenomdg }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="bareme_id">Bareme:</label>
                            <select class="form-control" name="bareme_id" id="bareme_id" onchange="showBaremeDetails()">
                                <option value="">-- choisir --</option>
                                @foreach($baremes as $bareme)
                                    @if($bareme->statut == 'actif' && $bareme->diplome_id == $diplome->id)
                                        <option value="{{$bareme->id}}" data-bareme="{{ json_encode($bareme) }}">
                                        @foreach ($refs as $ref)
                                        @if ($ref->id == $bareme->refsalariaires_id)
                                            {{ $ref->version }} - SNMG : {{ $ref->snmg }} - Salaire réference : {{ $ref->salairereference }}
                                        @endif
                                        @endforeach
                                        </option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="reference">Reference:</label>
                            <input type="text" class="form-control" id="reference" name="reference">
                        </div>
                        <div class="form-group">
                            <label for="datedecision">Date de Décision:</label>
                            <input type="date" class="form-control" id="datedecision" name="datedecision">
                        </div>
                        <hr>
                        <div class="form-group">
                            <label for="apprenti_info">Apprenti Information:</label>
                            <div>
                                <input type="text" class="form-control" value="{{ $apprenti->nom }}" readonly disabled>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="maitreapprenti_info">Maître Apprentis Information:</label>
                            <div>
                                <input type="text" class="form-control" value="{{ $maitreapprenti->nom }}" readonly disabled>
                                <!-- Include other master apprentice details here -->
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="diplome_info">Diplome Information:</label>
                            <div>
                                <input type="text" class="form-control" value="{{ $diplome->id }} - {{ $diplome->duree }}" readonly disabled>
                                <span></span>
                                <input type="hidden" id="diplome_duree" value="{{ $diplome->duree }}">
                                <!-- Include other diploma details here -->
                            </div>
                        </div>
                        <div id="bareme_details" style="display: none;">
                            <!-- Include the bareme details here -->
                            <div>Apprentis
                                <div>S1
                                    <label for="">Taux S1 Apprentis</label>
                                    <input type="text" name="" id="tauxs1_apprentis" readonly disabled>
                                    <label for="">Montant Chiffre S1 Apprentis</label>
                                    <input type="text" name="" id="montantchiffres1_apprentis" readonly disabled>
                                    <label for="">Montant Lettre S1 Apprentis</label>
                                    <input type="text" name="" id="montantlettres1_apprentis" readonly disabled>
                                    <label for="">Date debut presalaire S1</label>
                                    <input type="text" readonly name="datedebutpresalaireS1" id="datedebutpresalaireS1" value="{{ $apprenti->datedebut }}">
                                    <label for="">Date fin presalaire S1</label>
                                    <input type="text" readonly name="datefinpresalaireS1" id="datefinpresalaireS1">
                                </div>
                                <div>S2
                                    <label for="">Taux S2 Apprentis</label>
                                    <input type="text" name="" id="tauxs2_apprentis" readonly disabled>
                                    <label for="">Montant Chiffre S2 Apprentis</label>
                                    <input type="text" name="" id="montantchiffres2_apprentis" readonly disabled>
                                    <label for="">Montant Lettre S2 Apprentis</label>
                                    <input type="text" name="" id="montantlettres2_apprentis" readonly disabled>
                                    <label for="">Date debut presalaire S2</label>
                                    <input type="text" readonly name="datedebutpresalaireS2" id="datedebutpresalaireS2">
                                    <label for="">Date fin presalaire S2</label>
                                    <input type="text" readonly name="datefinpresalaireS2" id="datefinpresalaireS2">
                                </div>
                                <div id="S3_apprentis" style="display: none;">S3
                                    <label for="">Taux S3 Apprentis</label>
                                    <input type="text" name="" id="tauxs3_apprentis" readonly disabled>
                                    <label for="">Montant Chiffre S3 Apprentis</label>
                                    <input type="text" name="" id="montantchiffres3_apprentis" readonly disabled>
                                    <label for="">Montant Lettre S3 Apprentis</label>
                                    <input type="text" name="" id="montantlettres3_apprentis" readonly disabled>
                                    <label for="">Date debut presalaire S3</label>
                                    <input type="text" readonly name="datedebutpresalaireS3" id="datedebutpresalaireS3">
                                    <label for="">Date fin presalaire S3</label>
                                    <input type="text" readonly name="datefinpresalaireS3" id="datefinpresalaireS3">
                                </div>
                                <div id="S4_apprentis" style="display: none;">S4
                                    <label for="">Taux S4 Apprentis</label>
                                    <input type="text" name="" id="tauxs4_apprentis" readonly disabled>
                                    <label for="">Montant Chiffre S4 Apprentis</label>
                                    <input type="text" name="" id="montantchiffres4_apprentis" readonly disabled>
                                    <label for="">Montant Lettre S4 Apprentis</label>
                                    <input type="text" name="" id="montantlettres4_apprentis" readonly disabled>
                                    <label for="">Date debut presalaire S4</label>
                                    <input type="text" readonly name="datedebutpresalaireS4" id="datedebutpresalaireS4">
                                    <label for="">Date fin presalaire S4</label>
                                    <input type="text" readonly name="datefinpresalaireS4" id="datefinpresalaireS4">
                                </div>
                                <div id="S5_apprentis" style="display: none;">S5
                                    <label for="">Taux S5 Apprentis</label>
                                    <input type="text" name="" id="tauxs5_apprentis" readonly disabled>
                                    <label for="">Montant Chiffre S5 Apprentis</label>
                                    <input type="text" name="" id="montantchiffres5_apprentis" readonly disabled>
                                    <label for="">Montant Lettre S5 Apprentis</label>
                                    <input type="text" name="" id="montantlettres5_apprentis" readonly disabled>
                                    <label for="">Date debut presalaire S5</label>
                                    <input type="text" readonly name="datedebutpresalaireS5" id="datedebutpresalaireS5">
                                    <label for="">Date fin presalaire S5</label>
                                    <input type="text" readonly name="datefinpresalaireS5" id="datefinpresalaireS5">
                                </div>
                            </div>
                            <div>Maitre d'apprenti
                                <div>S1
                                    <label for="">Taux S1 Maitre d'apprenti</label>
                                    <input type="text" name="" id="tauxs1_maitreapprentis" readonly disabled>
                                    <label for="">Montant Chiffre S1 Maitre d'apprenti</label>
                                    <input type="text" name="" id="montantchiffres1_maitreapprentis" readonly disabled>
                                    <label for="">Montant Lettre S1 Maitre d'apprenti</label>
                                    <input type="text" name="" id="montantlettres1_maitreapprentis" readonly disabled>
                                    <label for="">Date debut presalaire S1</label>
                                    <input type="text" readonly name="datedebutsalaireS1" id="datedebutsalaireS1">
                                    <label for="">Date fin presalaire S1</label>
                                    <input type="text" readonly name="datefinsalaireS1" id="datefinsalaireS1">
                                </div>
                                <div>S2
                                    <label for="">Taux S2 Maitre d'apprenti</label>
                                    <input type="text" name="" id="tauxs2_maitreapprentis" readonly disabled>
                                    <label for="">Montant Chiffre S2 Maitre d'apprenti</label>
                                    <input type="text" name="" id="montantchiffres2_maitreapprentis" readonly disabled>
                                    <label for="">Montant Lettre S2 Maitre d'apprenti</label>
                                    <input type="text" name="" id="montantlettres2_maitreapprentis" readonly disabled>
                                    <label for="">Date debut presalaire S2</label>
                                    <input type="text" readonly name="datedebutsalaireS2" id="datedebutsalaireS2">
                                    <label for="">Date fin presalaire S2</label>
                                    <input type="text" readonly name="datefinsalaireS2" id="datefinsalaireS2">
                                </div>
                                <div id="S3_maitreapprentis" style="display: none;">S3
                                    <label for="">Taux S3 Maitre d'apprenti</label>
                                    <input type="text" name="" id="tauxs3_maitreapprentis" readonly disabled>
                                    <label for="">Montant Chiffre S3 Maitre d'apprenti</label>
                                    <input type="text" name="" id="montantchiffres3_maitreapprentis" readonly disabled>
                                    <label for="">Montant Lettre S3 Maitre d'apprenti</label>
                                    <input type="text" name="" id="montantlettres3_maitreapprentis" readonly disabled>
                                    <label for="">Date debut presalaire S3</label>
                                    <input type="text" readonly name="datedebutsalaireS3" id="datedebutsalaireS3">
                                    <label for="">Date fin presalaire S3</label>
                                    <input type="text" readonly name="datefinsalaireS3" id="datefinsalaireS3">
                                </div>
                                <div id="S4_maitreapprentis" style="display: none;">S4
                                    <label for="">Taux S4 Maitre d'apprenti</label>
                                    <input type="text" name="" id="tauxs4_maitreapprentis" readonly disabled>
                                    <label for="">Montant Chiffre S4 Maitre d'apprenti</label>
                                    <input type="text" name="" id="montantchiffres4_maitreapprentis" readonly disabled>
                                    <label for="">Montant Lettre S4 Maitre d'apprenti</label>
                                    <input type="text" name="" id="montantlettres4_maitreapprentis" readonly disabled>
                                    <label for="">Date debut presalaire S4</label>
                                    <input type="text" readonly name="datedebutsalaireS4" id="datedebutsalaireS4">
                                    <label for="">Date fin presalaire S4</label>
                                    <input type="text" readonly name="datefinsalaireS4" id="datefinsalaireS4">
                                </div>
                                <div id="S5_maitreapprentis" style="display: none;">S5
                                    <label for="">Taux S5 Maitre d'apprenti</label>
                                    <input type="text" name="" id="tauxs5_maitreapprentis" readonly disabled>
                                    <label for="">Montant Chiffre S5 Maitre d'apprenti</label>
                                    <input type="text" name="" id="montantchiffres5_maitreapprentis" readonly disabled>
                                    <label for="">Montant Lettre S5 Maitre d'apprenti</label>
                                    <input type="text" name="" id="montantlettres5_maitreapprentis" readonly disabled>
                                    <label for="">Date debut presalaire S5</label>
                                    <input type="text" readonly name="datedebutsalaireS5" id="datedebutsalaireS5">
                                    <label for="">Date fin presalaire S5</label>
                                    <input type="text" readonly name="datefinsalaireS5" id="datefinsalaireS5">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function showBaremeDetails() {
        const baremeSelect = document.getElementById('bareme_id');
        const baremeDetails = document.getElementById('bareme_details');
        const selectedOption = baremeSelect.options[baremeSelect.selectedIndex];
        const baremeData = selectedOption.getAttribute('data-bareme');
        const diplomeDuree = parseInt(document.getElementById('diplome_duree').value);

        if (baremeData) {
            const bareme = JSON.parse(baremeData);

            document.getElementById('tauxs1_apprentis').value = bareme.tauxs1_apprentis;
            document.getElementById('montantchiffres1_apprentis').value = bareme.montantchiffres1_apprentis;
            document.getElementById('montantlettres1_apprentis').value = bareme.montantlettres1_apprentis;

            document.getElementById('tauxs2_apprentis').value = bareme.tauxs2_apprentis;
            document.getElementById('montantchiffres2_apprentis').value = bareme.montantchiffres2_apprentis;
            document.getElementById('montantlettres2_apprentis').value = bareme.montantlettres2_apprentis;

            document.getElementById('tauxs3_apprentis').value = bareme.tauxs3_apprentis;
            document.getElementById('montantchiffres3_apprentis').value = bareme.montantchiffres3_apprentis;
            document.getElementById('montantlettres3_apprentis').value = bareme.montantlettres3_apprentis;

            document.getElementById('tauxs4_apprentis').value = bareme.tauxs4_apprentis;
            document.getElementById('montantchiffres4_apprentis').value = bareme.montantchiffres4_apprentis;
            document.getElementById('montantlettres4_apprentis').value = bareme.montantlettres4_apprentis;

            document.getElementById('tauxs5_apprentis').value = bareme.tauxs5_apprentis;
            document.getElementById('montantchiffres5_apprentis').value = bareme.montantchiffres5_apprentis;
            document.getElementById('montantlettres5_apprentis').value = bareme.montantlettres5_apprentis;

            document.getElementById('tauxs1_maitreapprentis').value = bareme.tauxs1_maitreapprentis;
            document.getElementById('montantchiffres1_maitreapprentis').value = bareme.montantchiffres1_maitreapprentis;
            document.getElementById('montantlettres1_maitreapprentis').value = bareme.montantlettres1_maitreapprentis;

            document.getElementById('tauxs2_maitreapprentis').value = bareme.tauxs2_maitreapprentis;
            document.getElementById('montantchiffres2_maitreapprentis').value = bareme.montantchiffres2_maitreapprentis;
            document.getElementById('montantlettres2_maitreapprentis').value = bareme.montantlettres2_maitreapprentis;

            document.getElementById('tauxs3_maitreapprentis').value = bareme.tauxs3_maitreapprentis;
            document.getElementById('montantchiffres3_maitreapprentis').value = bareme.montantchiffres3_maitreapprentis;
            document.getElementById('montantlettres3_maitreapprentis').value = bareme.montantlettres3_maitreapprentis;

            document.getElementById('tauxs4_maitreapprentis').value = bareme.tauxs4_maitreapprentis;
            document.getElementById('montantchiffres4_maitreapprentis').value = bareme.montantchiffres4_maitreapprentis;
            document.getElementById('montantlettres4_maitreapprentis').value = bareme.montantlettres4_maitreapprentis;

            document.getElementById('tauxs5_maitreapprentis').value = bareme.tauxs5_maitreapprentis;
            document.getElementById('montantchiffres5_maitreapprentis').value = bareme.montantchiffres5_maitreapprentis;
            document.getElementById('montantlettres5_maitreapprentis').value = bareme.montantlettres5_maitreapprentis;

            document.getElementById('datedebutpresalaireS1').value = "{{ $apprenti->datedebut }}";
            let debutPresalaireS1 = document.getElementById('datedebutpresalaireS1').value;
            let finPresalaireS1 = new Date(debutPresalaireS1);
            finPresalaireS1.setMonth(finPresalaireS1.getMonth() + 6);
            finPresalaireS1.setDate(finPresalaireS1.getDate() - 1); // Subtract 1 day
            document.getElementById('datefinpresalaireS1').value = finPresalaireS1.toISOString().slice(0,10);
            
            let debutPresalaireS2 = new Date(finPresalaireS1);
            debutPresalaireS2.setDate(finPresalaireS1.getDate() + 1);
            document.getElementById('datedebutpresalaireS2').value = debutPresalaireS2.toISOString().slice(0,10);
            let finPresalaireS2 = new Date(debutPresalaireS2);
            finPresalaireS2.setMonth(finPresalaireS2.getMonth() + 6);
            finPresalaireS2.setDate(finPresalaireS2.getDate() - 1); // Subtract 1 day
            document.getElementById('datefinpresalaireS2').value = finPresalaireS2.toISOString().slice(0,10);

            document.getElementById('datedebutsalaireS1').value = "{{ $apprenti->datedebut }}";
            let debutsalaireS1 = document.getElementById('datedebutsalaireS1').value;
            let finsalaireS1 = new Date(debutsalaireS1);
            finsalaireS1.setMonth(finsalaireS1.getMonth() + 6);
            finsalaireS1.setDate(finsalaireS1.getDate() - 1); // Subtract 1 day
            document.getElementById('datefinsalaireS1').value = finsalaireS1.toISOString().slice(0,10);
            
            let debutsalaireS2 = new Date(finsalaireS1);
            debutsalaireS2.setDate(finsalaireS1.getDate() + 1);
            document.getElementById('datedebutsalaireS2').value = debutsalaireS2.toISOString().slice(0,10);
            let finsalaireS2 = new Date(debutsalaireS2);
            finsalaireS2.setMonth(finsalaireS2.getMonth() + 6);
            finsalaireS2.setDate(finsalaireS2.getDate() - 1); // Subtract 1 day
            document.getElementById('datefinsalaireS2').value = finsalaireS2.toISOString().slice(0,10);

            // Hide all sections initially
            document.getElementById('S3_apprentis').style.display = 'none';
            document.getElementById('S4_apprentis').style.display = 'none';
            document.getElementById('S5_apprentis').style.display = 'none';
            document.getElementById('S3_maitreapprentis').style.display = 'none';
            document.getElementById('S4_maitreapprentis').style.display = 'none';
            document.getElementById('S5_maitreapprentis').style.display = 'none';

            // Show sections based on diplome duree
            if (diplomeDuree >= 18) {

                let debutPresalaireS3 = new Date(finPresalaireS2);
                debutPresalaireS3.setDate(finPresalaireS2.getDate() + 1);
                document.getElementById('datedebutpresalaireS3').value = debutPresalaireS3.toISOString().slice(0,10);
                let finPresalaireS3 = new Date(debutPresalaireS3);
                finPresalaireS3.setMonth(finPresalaireS3.getMonth() + 6);
                finPresalaireS3.setDate(finPresalaireS3.getDate() - 1); // Subtract 1 day

                document.getElementById('datefinpresalaireS3').value = finPresalaireS3.toISOString().slice(0,10);

                let debutsalaireS3 = new Date(finsalaireS2);
                debutsalaireS3.setDate(finsalaireS2.getDate() + 1);
                document.getElementById('datedebutsalaireS3').value = debutsalaireS3.toISOString().slice(0,10);
                let finsalaireS3 = new Date(debutsalaireS3);
                finsalaireS3.setMonth(finsalaireS3.getMonth() + 6);
                finsalaireS3.setDate(finsalaireS3.getDate() - 1); // Subtract 1 day
                document.getElementById('datefinsalaireS3').value = finsalaireS3.toISOString().slice(0,10);

                document.getElementById('S3_apprentis').style.display = 'block';
                document.getElementById('S3_maitreapprentis').style.display = 'block';
            }
            if (diplomeDuree >= 24) {

                let debutPresalaireS3 = new Date(finPresalaireS2);
                debutPresalaireS3.setDate(finPresalaireS2.getDate() + 1);
                document.getElementById('datedebutpresalaireS3').value = debutPresalaireS3.toISOString().slice(0,10);
                let finPresalaireS3 = new Date(debutPresalaireS3);
                finPresalaireS3.setMonth(finPresalaireS3.getMonth() + 6);
                finPresalaireS3.setDate(finPresalaireS3.getDate() - 1); // Subtract 1 day

                document.getElementById('datefinpresalaireS3').value = finPresalaireS3.toISOString().slice(0,10);

                let debutsalaireS3 = new Date(finsalaireS2);
                debutsalaireS3.setDate(finsalaireS2.getDate() + 1);
                document.getElementById('datedebutsalaireS3').value = debutsalaireS3.toISOString().slice(0,10);
                let finsalaireS3 = new Date(debutsalaireS3);
                finsalaireS3.setMonth(finsalaireS3.getMonth() + 6);
                finsalaireS3.setDate(finsalaireS3.getDate() - 1); // Subtract 1 day
                document.getElementById('datefinsalaireS3').value = finsalaireS3.toISOString().slice(0,10);

                document.getElementById('S3_apprentis').style.display = 'block';
                document.getElementById('S3_maitreapprentis').style.display = 'block';

                let debutPresalaireS4 = new Date(finPresalaireS3);
                debutPresalaireS4.setDate(finPresalaireS3.getDate() + 1);
                document.getElementById('datedebutpresalaireS4').value = debutPresalaireS4.toISOString().slice(0,10);
                let finPresalaireS4 = new Date(debutPresalaireS4);
                finPresalaireS4.setMonth(finPresalaireS4.getMonth() + 6);
                finPresalaireS4.setDate(finPresalaireS4.getDate() - 1); // Subtract 1 day
                document.getElementById('datefinpresalaireS4').value = finPresalaireS4.toISOString().slice(0,10);

                let debutsalaireS4 = new Date(finsalaireS3);
                debutsalaireS4.setDate(finsalaireS3.getDate() + 1);
                document.getElementById('datedebutsalaireS4').value = debutsalaireS4.toISOString().slice(0,10);
                let finsalaireS4 = new Date(debutsalaireS4);
                finsalaireS4.setMonth(finsalaireS4.getMonth() + 6);
                finsalaireS4.setDate(finsalaireS4.getDate() - 1); // Subtract 1 day
                document.getElementById('datefinsalaireS4').value = finsalaireS4.toISOString().slice(0,10);

                document.getElementById('S4_apprentis').style.display = 'block';
                document.getElementById('S4_maitreapprentis').style.display = 'block';
            }
            if (diplomeDuree >= 30) {

                let debutPresalaireS3 = new Date(finPresalaireS2);
                debutPresalaireS3.setDate(finPresalaireS2.getDate() + 1);
                document.getElementById('datedebutpresalaireS3').value = debutPresalaireS3.toISOString().slice(0,10);
                let finPresalaireS3 = new Date(debutPresalaireS3);
                finPresalaireS3.setMonth(finPresalaireS3.getMonth() + 6);
                finPresalaireS3.setDate(finPresalaireS3.getDate() - 1); // Subtract 1 day

                document.getElementById('datefinpresalaireS3').value = finPresalaireS3.toISOString().slice(0,10);

                let debutsalaireS3 = new Date(finsalaireS2);
                debutsalaireS3.setDate(finsalaireS2.getDate() + 1);
                document.getElementById('datedebutsalaireS3').value = debutsalaireS3.toISOString().slice(0,10);
                let finsalaireS3 = new Date(debutsalaireS3);
                finsalaireS3.setMonth(finsalaireS3.getMonth() + 6);
                finsalaireS3.setDate(finsalaireS3.getDate() - 1); // Subtract 1 day
                document.getElementById('datefinsalaireS3').value = finsalaireS3.toISOString().slice(0,10);

                document.getElementById('S3_apprentis').style.display = 'block';
                document.getElementById('S3_maitreapprentis').style.display = 'block';

                let debutPresalaireS4 = new Date(finPresalaireS3);
                debutPresalaireS4.setDate(finPresalaireS3.getDate() + 1);
                document.getElementById('datedebutpresalaireS4').value = debutPresalaireS4.toISOString().slice(0,10);
                let finPresalaireS4 = new Date(debutPresalaireS4);
                finPresalaireS4.setMonth(finPresalaireS4.getMonth() + 6);
                finPresalaireS4.setDate(finPresalaireS4.getDate() - 1); // Subtract 1 day
                document.getElementById('datefinpresalaireS4').value = finPresalaireS4.toISOString().slice(0,10);

                let debutsalaireS4 = new Date(finsalaireS3);
                debutsalaireS4.setDate(finsalaireS3.getDate() + 1);
                document.getElementById('datedebutsalaireS4').value = debutsalaireS4.toISOString().slice(0,10);
                let finsalaireS4 = new Date(debutsalaireS4);
                finsalaireS4.setMonth(finsalaireS4.getMonth() + 6);
                finsalaireS4.setDate(finsalaireS4.getDate() - 1); // Subtract 1 day
                document.getElementById('datefinsalaireS4').value = finsalaireS4.toISOString().slice(0,10);

                document.getElementById('S4_apprentis').style.display = 'block';
                document.getElementById('S4_maitreapprentis').style.display = 'block';

                let debutPresalaireS5 = new Date(finPresalaireS4);
                debutPresalaireS5.setDate(finPresalaireS4.getDate() + 1);
                document.getElementById('datedebutpresalaireS5').value = debutPresalaireS5.toISOString().slice(0,10);
                let finPresalaireS5 = new Date(debutPresalaireS5);
                finPresalaireS5.setMonth(finPresalaireS5.getMonth() + 6);
                finPresalaireS5.setDate(finPresalaireS5.getDate() - 1); // Subtract 1 day
                document.getElementById('datefinpresalaireS5').value = finPresalaireS5.toISOString().slice(0,10);

                let debutsalaireS5 = new Date(finsalaireS4);
                debutsalaireS5.setDate(finsalaireS4.getDate() + 1);
                document.getElementById('datedebutsalaireS5').value = debutsalaireS5.toISOString().slice(0,10);
                let finsalaireS5 = new Date(debutsalaireS5);
                finsalaireS5.setMonth(finsalaireS5.getMonth() + 6);
                finsalaireS5.setDate(finsalaireS5.getDate() - 1); // Subtract 1 day
                document.getElementById('datefinsalaireS5').value = finPresalaireS5.toISOString().slice(0,10);

                document.getElementById('S5_apprentis').style.display = 'block';
                document.getElementById('S5_maitreapprentis').style.display = 'block';
            }

            baremeDetails.style.display = 'block';
        } else {
            baremeDetails.style.display = 'none';
        }
    }
</script>
@endsection
