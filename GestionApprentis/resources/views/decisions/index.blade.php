@extends('layouts.layout')
@section('title', 'Decisions')
@section('content')
<div class="container">
    <h2 class="text-center">Decisions de l'apprenti et maitre d'apprenti</h2>
    <form action="{{ route('decisions.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="planbesoins_id">Plan Besoins:</label>
            <select class="form-control" name="planbesoins_id" id="planbesoins_id">
                <option value="">-- choisir --</option>
                @foreach($plans as $plan)
                @if($plan->status == 'accepté')
                    <option value="{{ $plan->id }}">{{ $plan->reference }} - {{ $plan->structure_id}} - {{$plan->specialites_id}}</option>
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
                        <option value="{{$parametre->id}}"> {{ $parametre->reference }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="bareme_id">Bareme:</label>
            <select class="form-control" name="bareme_id" id="bareme_id" onchange="showBaremeDetails()">
                <option value="">-- choisir --</option>
                @foreach($baremes as $bareme)
                    @if($bareme->statut == 'actif')
                        <option value="{{$bareme->id}}" data-bareme="{{ json_encode($bareme) }}">{{ $bareme->refsalariaires_id }}</option>
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
                <input type="text" class="form-control" value="{{ $diplome->id }}" readonly disabled>
                <!-- Include other diploma details here -->
            </div>
        </div>
        <div id="bareme_details" style="display: none;">
            <!-- Include the bareme details here -->
            <div>Apprentis
                <div>S1
                    <input type="text" name="" id="tauxs1_apprentis" readonly disabled>
                    <input type="text" name="" id="montantchiffres1_apprentis" readonly disabled>
                    <input type="text" name="" id="montantlettres1_apprentis" readonly disabled>
                    <input type="date" name="datedebutpresalaireS1" id="">
                    <input type="date" name="datefinpresalaireS1" id="">
                </div>
                <div>S2
                    <input type="text" name="" id="tauxs2_apprentis" readonly disabled>
                    <input type="text" name="" id="montantchiffres2_apprentis" readonly disabled>
                    <input type="text" name="" id="montantlettres2_apprentis" readonly disabled>
                    <input type="date" name="datedebutpresalaireS2" id="">
                    <input type="date" name="datefinpresalaireS2" id="">
                </div>
                <div>S3
                    <input type="text" name="" id="tauxs3_apprentis" readonly disabled>
                    <input type="text" name="" id="montantchiffres3_apprentis" readonly disabled>
                    <input type="text" name="" id="montantlettres3_apprentis" readonly disabled>
                    <input type="date" name="datedebutpresalaireS3" id="">
                    <input type="date" name="datefinpresalaireS3" id="">
                </div>
                <div>S4
                    <input type="text" name="" id="tauxs4_apprentis" readonly disabled>
                    <input type="text" name="" id="montantchiffres4_apprentis" readonly disabled>
                    <input type="text" name="" id="montantlettres4_apprentis" readonly disabled>
                    <input type="date" name="datedebutpresalaireS4" id="">
                    <input type="date" name="datefinpresalaireS4" id="">
                </div>
                <div>S5
                    <input type="text" name="" id="tauxs5_apprentis" readonly disabled>
                    <input type="text" name="" id="montantchiffres5_apprentis" readonly disabled>
                    <input type="text" name="" id="montantlettres5_apprentis" readonly disabled>
                    <input type="date" name="datedebutpresalaireS5" id="">
                    <input type="date" name="datefinpresalaireS5" id="">
                </div>
            </div>
            <div>Maitre d'apprenti
                <div>S1
                    <input type="text" name="" id="tauxs1_maitreapprentis" readonly disabled>
                    <input type="text" name="" id="montantchiffres1_maitreapprentis" readonly disabled>
                    <input type="text" name="" id="montantlettres1_maitreapprentis" readonly disabled>
                    <input type="date" name="datedebutsalaireS1" id="">
                    <input type="date" name="datefinsalaireS1" id="">
                </div>
                <div>S2
                    <input type="text" name="" id="tauxs2_maitreapprentis" readonly disabled>
                    <input type="text" name="" id="montantchiffres2_maitreapprentis" readonly disabled>
                    <input type="text" name="" id="montantlettres2_maitreapprentis" readonly disabled>
                    <input type="date" name="datedebutsalaireS2" id="">
                    <input type="date" name="datefinsalaireS2" id="">
                </div>
                <div>S3
                    <input type="text" name="" id="tauxs3_maitreapprentis" readonly disabled>
                    <input type="text" name="" id="montantchiffres3_maitreapprentis" readonly disabled>
                    <input type="text" name="" id="montantlettres3_maitreapprentis" readonly disabled>
                    <input type="date" name="datedebutsalaireS3" id="">
                    <input type="date" name="datefinsalaireS3" id="">
                </div>
                <div>S4
                    <input type="text" name="" id="tauxs4_maitreapprentis" readonly disabled>
                    <input type="text" name="" id="montantchiffres4_maitreapprentis" readonly disabled>
                    <input type="text" name="" id="montantlettres4_maitreapprentis" readonly disabled>
                    <input type="date" name="datedebutsalaireS4" id="">
                    <input type="date" name="datefinsalaireS4" id="">
                </div>
                <div>S5
                    <input type="text" name="" id="tauxs5_maitreapprentis" readonly disabled>
                    <input type="text" name="" id="montantchiffres5_maitreapprentis" readonly disabled>
                    <input type="text" name="" id="montantlettres5_maitreapprentis" readonly disabled>
                    <input type="date" name="datedebutsalaireS5" id="">
                    <input type="date" name="datefinsalaireS5" id="">
                </div>
            </div>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>    
    </form>
</div>

<script>
function showBaremeDetails() {
    const baremeSelect = document.getElementById('bareme_id');
    const baremeDetails = document.getElementById('bareme_details');
    const selectedOption = baremeSelect.options[baremeSelect.selectedIndex];
    const baremeData = selectedOption.getAttribute('data-bareme');

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

        baremeDetails.style.display = 'block';
    } else {
        baremeDetails.style.display = 'none';
    }
}
</script>
@endsection

