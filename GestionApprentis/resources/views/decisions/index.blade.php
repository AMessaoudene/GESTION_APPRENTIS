@extends('layouts.layout')
@section('title', 'Decisions')
@section('content')
<form action="{{ route('decisions.store') }}" method="POST">
<input type="date" name="datetransfert">
<select name="" id="">
    @foreach($parametres as $parametre)
        <option value="{{$parametre->id}}">{{ $parametre->nom }}</option>
    @endforeach
</select>
<select name="" id="">
    @foreach($baremes as $bareme)
        <option value="{{$bareme->id}}">{{ $bareme->version }}</option>
    @endforeach
</select>
<input type="date" name="datetransfert" id="">
</form>
@endsection