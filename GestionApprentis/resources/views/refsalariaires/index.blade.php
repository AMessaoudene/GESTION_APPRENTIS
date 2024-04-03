@extends('layouts.layout')
@section('title', 'References Salariaires')
@section('content')
<form action="{{ route('refsalariaires.submit') }}" method="POST">
    @csrf
    <label>version
        <select name="" id="">
            @foreach()
            
            @endforeach
        </select>
    </label>
    <label for="">SNMG
        <input type="number" name="snmg" required>
    </label>
    <label for="">Salaire Reference
        <input type="number" name="date" required>
    </label>
    <input type="submit" value="Ajouter">
</form>
@endsection