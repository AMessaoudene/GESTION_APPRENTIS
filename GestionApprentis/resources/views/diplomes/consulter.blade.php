@extends('layouts.layout')
@section('title', 'Diplomes | Consulter')
@section('content')
<div class="container">
    <h1 class="text-center mb-4">Diplômes</h1>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Durée</th>
                    <th scope="col">Description</th>
                    <th scope="col">Date de création</th>
                </tr>
            </thead>
            <tbody>
                @foreach($diplomes as $diplome)
                <tr>
                    <td>{{ $diplome->id }}</td>
                    <td>{{ $diplome->nom }}</td>
                    <td>{{ $diplome->duree }}</td>
                    <td>{{ $diplome->description }}</td>
                    <td>{{ $diplome->created_at }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
