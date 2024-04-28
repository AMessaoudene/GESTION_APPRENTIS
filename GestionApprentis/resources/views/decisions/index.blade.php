@extends('layouts.layout')
@section('title', 'Decisions')
@section('content')
<form action="{{ route('decisions.store') }}" method="POST">
    @csrf
    <div>
        <label for="">
            <select name="planbesoins_id" id="planbesoins_id">
                @foreach($plans as $plan)
                    <option value="{{ $plan->id }}">{{ $plan->reference }}</option>
                @endforeach
            </select>
        </label>
    </div>
    <label for="reference">Reference
        <input type="text" name="reference" id="reference">
    </label>
    <label for="datedecision">date de decision
        <input type="date" name="datedecision" id="datedecision">
    </label>
    <ul>
        @foreach($apprenti->getAttributes() as $key => $value)
            <li>{{ $key }} : {{ $value }}</li>
        @endforeach
    </ul>
    <br>
    <ul>
        @foreach($pv->getAttributes() as $key => $value)
            <li>{{ $key }} : {{ $value }}</li>
        @endforeach
    </ul>
    <div>
        <label for="">Nom
            <input type="text" value="{{ $apprenti->nom }}" readonly disabled>
        </label>
        <label for="">Prenom
            <input type="text" value="{{ $apprenti->prenom }}" readonly disabled>
        </label>
        <label for="">
            <input type="text" value="{{ $apprenti->civilite }}" readonly disabled>
        </label>
        <label for="">Numéro du contrat
            <input type="text" value="{{ $apprenti->numcontrat }}" readonly disabled>
        </label>
        <label for="">Date du contrat
            <input type="date" value="{{ $apprenti->datecontrat }}" readonly disabled>
        </label>
        <label for="">Date de debut du contrat
            <input type="date" value="{{ $apprenti->datedebut }}" readonly disabled>
        </label>
        <label for="">Date de fin du contrat
            <input type="date" value="{{ $apprenti->datefin }}" readonly disabled>
        </label>
        <label for="">Date du transfert
            <input type="date" name="datetransfert">
        </label>
    </div>
    <br>
    <div>Maitre Apprentis
        <label for="">Matricule
            <input type="text" value="{{ $maitreapprenti->matricule }}" readonly disabled>
        </label>

        <label for="">Nom
            <input type="text" value="{{ $maitreapprenti->nom }}" readonly disabled>
        </label>
        <label for="">Prenom
            <input type="text" value="{{ $maitreapprenti->prenom }}" readonly disabled>
        </label>
        <label for="">Civilité
            <input type="text" value="{{ $maitreapprenti->civilite }}" readonly disabled>
        </label>
        <label for="">Fonction
            <input type="text" value="{{ $maitreapprenti->fonction }}" readonly disabled>
        </label>
    </div>
    <div>Diplome
        <label for="">Niveau
            <input type="text" value="{{ $diplome->id }}" readonly disabled>
        </label>
        <label for="">Sanction
            <input type="text" value="{{ $diplome->nom }}" readonly disabled>
        </label>
        <label for="">Duree
            <input type="text" value="{{ $diplome->duree }}" readonly disabled>
        </label>
    </div>
    <select name="parametre_id" id="parametre_id">
        @foreach($parametres as $parametre)
            @if($parametre->status == 'actif')
                <option value="{{$parametre->id}}">{{ $parametre->reference }}</option>
            @endif
        @endforeach
    </select>
    <select name="bareme_id" id="bareme_id">
        <option value="">Sélectionnez un bareme</option>
        @foreach($baremes as $bareme)
            @if($bareme->statut == 'actif')
                <option value="{{$bareme->id}}">{{ $bareme->refsalariaires_id }}</option>
            @endif
        @endforeach
    </select>
    <div id="bareme_details">
        <!-- Display bareme details here -->
    </div>
    <button type="submit">Enregistrer</button>
</form>
@endsection