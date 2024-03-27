@extends('layouts.layout')
@section('title','Diplome | Ajouter')
@section('content')
<style>
    @font-face {
        font-family: Font;
        src: url({{ asset('asset/fonts/EASPORTS15.ttf') }});
    }
    h1 {
        font-family: Font;
    }
</style>
<link  href="https://cdn.datatables.net/2.0.3/css/jquery.dataTables.min.css" rel="stylesheet">
<script src="https://cdn.datatables.net/2.0.3/js/jquery.dataTables.min.js"></script>
<h1 class="text-center mt-4 mb-4">AJOUTER UN DIPLOME</h1>
<div id="formemodal">
    <form NAME="forme" id="forme" action="{{ route('diplomes.submit') }}" method="POST">
        @csrf
        <div class="form-group mb-3">
            <label for="nom">Nom</label>
            <input type="text" class="form-control" id="nom" name="nom" required>
        </div>
        <div class="form-group mb-3">
            <label for="duree">Durée</label>
            <input type="text" class="form-control" id="duree" name="duree" required>
        </div>
        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
        </div>
        <div class="row justify-content-center mt-4">
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </div>
    </form>
</div>
@endsection
