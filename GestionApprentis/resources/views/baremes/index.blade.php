@extends('layouts.layout')
@section('title', 'Baremes | GestionApprentis')
@section('content')
<form method="POST" action="{{ route('baremes.submit') }}">
@csrf

</form>
@endsection