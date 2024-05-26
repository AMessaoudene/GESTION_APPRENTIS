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
                <option value="{{$parametre->id}}">{{ $parametre->reference }}</option>
                @endif
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="bareme_id">Bareme:</label>
            <select class="form-control" name="bareme_id" id="bareme_id">
                <option value="">-- choisir --</option>
                @foreach($baremes as $bareme)
                @if($bareme->statut == 'actif')
                <option value="{{$bareme->id}}">{{ $bareme->refsalariaires_id }}</option>
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
        <div id="bareme_details">
            <!-- Display bareme details here -->
        </div>
        <div class="text-center">
        <button type="submit" class="btn btn-primary">Enregistrer</button>
        </div>    
    </form>
</div>
@endsection
