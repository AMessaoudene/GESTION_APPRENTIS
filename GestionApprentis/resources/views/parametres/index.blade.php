@extends('layouts.layout')
@section('title', 'Parametres')
@section('content')
<form method="POST" action="{{ route('parametres.submit') }}" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    <label></label>
    <input type="text" name="">
    <label></label>
    <input type="date" name="">
    <label></label>
    <input type="text" name="">
    <label></label>
    <input type="text" name="">
    <label></label>
    <input type="text" name="">
    <label></label>
    <input type="text" name="">
    <label></label>
    <input type="text" name="">
    <label></label>
    <input type="date" name="">
    <label></label>
    <input type="text" name="">
    <label></label>
    <input type="text" name="">
    <label></label>
    <input type="date" name="">
    <label></label>
    <input type="text" name="">
    <label></label>
    <input type="text" name="">
    <label></label>
    <input type="text" name="">
    <label></label>
    <input type="text" name="">
    <label></label>
    <input type="" name="">
</form>
@endserction