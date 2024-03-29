@extends('layouts.layout')
@section('title', 'PV Installations')
@section('content')
<form method="POST" action="{{ route('pvinstallations.submit') }}" enctype="multipart/form-data">
    @csrf
    <label>reference
        <input type="text" name="reference">
    </label>
    <ul>
        @foreach($apprenti->getAttributes() as $key => $value)
            <li>{{ $key }} : {{ $value }}</li>
        @endforeach
    </ul>
    <label>direction
        <input type="text" name="direction">
    </label>
    <label>datepv
        <input type="date" name="datepv">
    </label>
    <label!>dateinstallationchiffre
        <input type="date" name="dateinstallationchiffre">
    </label>
    <label!>anneeinstallationlettre
        <input type="text" name="anneeinstallationlettre">
    </label>
    <label>moisinstallationlettre
        <input type="text" name="moisinstallationlettre">
    </label>
    <label>jourinstallationlettre
        <input type="text" name="jourinstallationlettre">
    </label>
    <label>directionaffectation
        <input type="text" name="directionaffectation">
    </label>
    <label>serviceaffectation
        <input type="text" name="serviceaffectation">
    </label>
    <label>dotations
        <input type="text" name="dotations">
    </label>
    <label>PDF
        <input type="file" name="pdf">
    </label>
    <button type="submit">Submit</button>
</form>
@endsection