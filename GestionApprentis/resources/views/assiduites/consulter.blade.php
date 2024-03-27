@extends('layouts.layout')
@section('title', 'Assiduités | Consulter')
@section('content')
<h1>Consulter</h1>
    <div class="row">
        <div class="col-md-12">
        @foreach($assiduites as $assiduite)
            <div>
                <p>Assiduité ID: {{ $assiduite->id }}</p>
                <p>Preuve: <a href="{{ Storage::url($assiduite->preuve) }}">{{ $assiduite->preuve }}</a></p>
            </div>
        @endforeach
        </div>
    </div>
@endsection
