@extends('layouts.layout')
@section('title','Apprenti | depart')
@section('content')
<form action="{{ route('apprentis.depart') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label>Apprenti
        <select name="apprenti_id">
            <option value="">-- Choisir --</option>
            @foreach ($apprentis as $apprenti)
                @if($apprenti->status == 'actif')
                    <option value="{{ $apprenti->id }}">{{ $apprenti->nom }} {{ $apprenti->prenom }}</option>
                @endif
            @endforeach
        </select>
    </label>
    <br>
    <label>Date du depart
        <input type="date" name="datedepart">
    </label>
    <br>
    <label>Motif du depart
        <select name="motif">
            <option value="">-- Choisir --</option>
            <option value="résiliation">Résiliation</option>
            <option value="transfert">Transfert</option>
        </select>
    </label>
    <br>
    <label for="">Reference du courrier du motif de départ
        <input type="text" name="refcourrier">
    </label>
    <br>
    <label for="">Date du courrier du motif de depart
        <input type="date" name="datecourrier">
    </label>
    <br>
    <input type="submit">
</form>
@endsection