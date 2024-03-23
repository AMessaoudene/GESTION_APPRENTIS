@extends('layouts.layout')
@section('title', 'Consulter un diplome')
@section('content')
@foreach  ($diplomes as $diplome)
    <h1>{{$diplome->id}}</h1>
    <p>{{$diplome->nom}}</p>
    <p>{{$diplome->duree}}</p>
    <p>{{$diplome->description}}</p>
    <p>{{$diplome->created_at}}</p>
@endforeach
@endsection