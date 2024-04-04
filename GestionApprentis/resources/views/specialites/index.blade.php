@extends('layouts.layout')
@section('title', 'Specialites')
@section('content')
<form action="{{ route('specialites.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="">Specialite
        <input type="text" name="nom" required>
    </label>
    <textarea name="description" id="" cols="30" rows="10"></textarea>
    <input type="submit" value="Ajouter">
</form>
@endsection