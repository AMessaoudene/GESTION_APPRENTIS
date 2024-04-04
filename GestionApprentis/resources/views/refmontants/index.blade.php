@extends('layouts.layout')
@section('title', 'Baremes | GestionApprentis')
@section('content')
<form method="POST" action="{{ route('baremes.submit') }}">
    @csrf
    <div>
        <select name="refsalariaires_id" id="" required>
            @foreach($refs as $ref)
            @if($ref->status == 'active')
                <option value="{{ $ref->id }}">{{ $ref->nom }}</option>
            @endforeach
        </select>
        <select name="diplome_id" for="" required>Niveau de qualification
            @foreach($diplomes as $diplome)
                <option value="{{ $diplome->id }}">{{ $diplome->nom }}</option>
            @endforeach
        </select>
    </div>
    <div>Apprentis
    <div>S1
            <div>Taux
                <input type="text" pattern="[0-9]+" name="tauxAS1" required>
            </div>
            <div>Montant
                <input type="text" pattern="[0-9]+" name="montantAS1" readonly disabled>
            </div>
            <div>Montant lettres
                <input type="text" name="montantLettresAS1" required>
            </div>
        </div>
        <div>S2
            <div>Taux
                <input type="text" pattern="[0-9]+" name="tauxAS2" required>
            </div>
            <div>Montant
                <input type="text" pattern="[0-9]+" name="montantAS2" readonly disabled>
            </div>
            <div>Montant lettres
                <input type="text" name="montantLettresAS2" required>
            </div>
        </div>
        <div>S3
            <div>Taux
                <input type="text" pattern="[0-9]+" name="tauxAS3" required>
            </div>
            <div>Montant
                <input type="text" pattern="[0-9]+" name="montantAS3" readonly disabled>
            </div>
            <div>Montant lettres
                <input type="text" name="montantLettresAS3" required>
            </div>
        </div>
        <div>S4
            <div>Taux
                <input type="text" pattern="[0-9]+" name="tauxAS4" required>
            </div>
            <div>Montant
                <input type="text" pattern="[0-9]+" name="montantAS4" readonly disabled>
            </div>
            <div>Montant lettres
                <input type="text" name="montantLettresAS4" required>
            </div>
        </div>
        <div>S5
            <div>Taux
                <input type="text" pattern="[0-9]+" name="tauxAS5" required>
            </div>
            <div>Montant
                <input type="text" pattern="[0-9]+" name="montantAS5" readonly disabled>
            </div>
            <div>Montant lettres
                <input type="text" name="montantLettresAS5" required>
            </div>
        </div>
    </div>
    <div>Maitre Apprentis
        <div>S1
            <div>Taux
                <input type="text" pattern="[0-9]+" name="tauxMAS1" required>
            </div>
            <div>Montant
                <input type="text" pattern="[0-9]+" name="montantMAS1" readonly disabled>
            </div>
            <div>Montant lettres
                <input type="text" name="montantLettresMAS1" required>
            </div>
        </div>
        <div>S2
            <div>Taux
                <input type="text" pattern="[0-9]+" name="tauxMAS2" required>
            </div>
            <div>Montant
                <input type="text" pattern="[0-9]+" name="montantMAS2" readonly disabled>
            </div>
            <div>Montant lettres
                <input type="text" name="montantLettresMAS2" required>
            </div>
        </div>
        <div>S3
            <div>Taux
                <input type="text" pattern="[0-9]+" name="tauxMAS3" required>
            </div>
            <div>Montant
                <input type="text" pattern="[0-9]+" name="montantMAS3" readonly disabled>
            </div>
            <div>Montant lettres
                <input type="text" name="montantLettresMAS3" required>
            </div>
        </div>
        <div>S4
            <div>Taux
                <input type="text" pattern="[0-9]+" name="tauxMAS4" required>
            </div>
            <div>Montant
                <input type="text" pattern="[0-9]+" name="montantMAS4" readonly disabled>
            </div>
            <div>Montant lettres
                <input type="text" name="montantLettresMAS4" required>
            </div>
        </div>
        <div>S5
            <div>Taux
                <input type="text" pattern="[0-9]+" name="tauxMAS5" required>
            </div>
            <div>Montant
                <input type="text" pattern="[0-9]+" name="montantMAS5" readonly disabled>
            </div>
            <div>Montant lettres
                <input type="text" name="montantLettresMAS5" required>
            </div>
        </div>
    </div>
    <button type="submit">Valider</button>
</form>
@endsection