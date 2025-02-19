@extends('layouts.layout')
@section('title', 'PV Installations')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h2 class="text-center">PV Installations</h2>
                    <form method="POST" action="{{ route('pvinstallations.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="reference">Reference</label>
                            <input type="text" class="form-control" id="reference" name="reference" required>
                        </div>
                        <div class="form-group">
                            <label for="datepv">Date PV</label>
                            <input type="date" class="form-control" id="datepv" name="datepv" required>
                        </div>
                        <div class="form-group">
                            <label for="dateinstallationchiffre">Date Installation (Chiffre)</label>
                            <input type="date" class="form-control" id="dateinstallationchiffre" name="dateinstallationchiffre" required>
                        </div>
                        <div class="form-group">
                            <label for="anneeinstallationlettre">Année Installation (Lettre)</label>
                            <input type="text" class="form-control" id="anneeinstallationlettre" name="anneeinstallationlettre" required>
                        </div>
                        <div class="form-group">
                            <label for="moisinstallationlettre">Mois Installation (Lettre)</label>
                            <input type="text" class="form-control" id="moisinstallationlettre" name="moisinstallationlettre" required>
                        </div>
                        <div class="form-group">
                            <label for="jourinstallationlettre">Jour Installation (Lettre)</label>
                            <input type="text" class="form-control" id="jourinstallationlettre" name="jourinstallationlettre" required>
                        </div>
                        <div class="form-group">
                            <label for="directionaffectation">Direction Affectation</label>
                            <input type="text" class="form-control" id="directionaffectation" name="directionaffectation" required>
                        </div>
                        <div class="form-group">
                            <label for="serviceaffectation">Service Affectation</label>
                            <input type="text" class="form-control" id="serviceaffectation" name="serviceaffectation" required>
                        </div>
                        <div class="form-group">
                            <label for="dotations">Dotations</label>
                            <input type="text" class="form-control" id="dotations" name="dotations" required>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
