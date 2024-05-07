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
                <form action="{{ route('departs.store') }}" method="POST">
                    @csrf
                    <label for="">Apprenti
                    <select name="apprenti_id" id="">
                        <option value="">Sélectionner un apprenti</option>
                        @foreach($apprentis as $apprenti)
                            @if($user->structures_id == $apprenti->structure_id)
                                <option value="{{ $apprenti->id }}">{{ $apprenti->nom }} {{ $apprenti->prenom }}</option>
                            @endif
                        @endforeach
                    </select>
                    </label>
                    <label for="">Date de depart
                        <input type="date" name="datedepart" id="">
                    </label>
                    <label for="">Motif
                        <select name="motif" id="">
                            <option value="">Sélectionner un motif</option>
                            <option value="résiliation">Résiliation</option>
                            <option value="transfert">Transfert</option>
                        </select>
                    </label>
                    <label for="">refcourrier
                        <input type="text" name="refcourrier">
                    </label>
                    <label for="">datecourrier
                        <input type="date" name="datecourrier">
                    </label>
                    <input type="submit" value="Ajouter" class="btn btn-primary">
                </form>
            </div>
        </main>
    </div>
</div>
@endsection