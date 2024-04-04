@extends('layouts.layout')
@section('title', 'References Salariaires')
@section('content')
<form action="{{ route('refsalariaires.submit') }}" method="POST">
    @csrf
    <label>version
        <input type="text" name="version" id="">
    </label>
    <label for="">SNMG
        <input type="text" pattern="[0-9]+" name="snmg" required>
    </label>
    <label for="">Salaire Reference
        <input type="text" pattern="[0-9]+" name="salairereference" required>
    </label>
    <input type="submit" value="Ajouter">
</form>
<table>
    <tr>
        <th>version</th>
        <th>SNMG</th>
        <th>Salaire Reference</th>
    </tr>
    @foreach ($refsalariaires as $refsalariaire)
    <tr>
        <td>{{ $refsalariaire->version }}</td>
        <td>{{ $refsalariaire->snmg }}</td>
        <td>{{ $refsalariaire->salairereference }}</td>
    </tr>
    @endforeach
</table>
@endsection