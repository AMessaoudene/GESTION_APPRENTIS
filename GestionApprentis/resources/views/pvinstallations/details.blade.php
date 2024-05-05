@extends('layouts.layout')
@section('title','PVs')
@section('content')
<table>
    <tr>
        <td>Id</td>
        <td>{{$pvinstallations->id}}</td>
    </tr>
    
    <tr>
        <td>Etat</td>
        <td>{{$pvinstallations->etat}}</td>
    </tr>
</table>
@endsection