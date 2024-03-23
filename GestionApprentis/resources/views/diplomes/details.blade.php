@extends('layouts.layout')
@section('title','Diplome | Details')
@section('content')
<h1>Diplome Details</h1>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Durée</th>
            <!-- Add more columns as needed -->
        </tr>
        <tr>
            <td>{{ $diplome->id }}</td>
            <td>{{ $diplome->nom }}</td>
            <td>{{ $diplome->duree }}</td>
            <!-- Add more columns as needed -->
        </tr>
    </table>
@endsection