@extends('layouts.layout')
@section('title','Departs')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('layouts.sidenav')

        <!-- Page Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="container mt-5 mb-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title">Ajouter un Départ</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('departs.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="apprenti_id" class="form-label">Apprenti</label>
                                <select name="apprenti_id" id="apprenti_id" class="form-select">
                                    <option value="">Sélectionner un apprenti</option>
                                    @foreach($apprentis as $apprenti)
                                        @if($user->structures_id == $apprenti->structure_id)
                                            <option value="{{ $apprenti->id }}">{{ $apprenti->nom }} {{ $apprenti->prenom }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="datedepart" class="form-label">Date de départ</label>
                                <input type="date" name="datedepart" id="datedepart" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="motif" class="form-label">Motif</label>
                                <select name="motif" id="motif" class="form-select">
                                    <option value="">Sélectionner un motif</option>
                                    <option value="résiliation">Résiliation</option>
                                    <option value="transfert">Transfert</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="refcourrier" class="form-label">Référence Courrier</label>
                                <input type="text" name="refcourrier" id="refcourrier" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label for="datecourrier" class="form-label">Date Courrier</label>
                                <input type="date" name="datecourrier" id="datecourrier" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection