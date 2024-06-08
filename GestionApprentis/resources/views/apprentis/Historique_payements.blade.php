@extends('layouts.layout')
@section('title','Apprentis | Historique des paiements')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @if (Auth::user()->role == 'DFP')
        @include('layouts.dfpsidenav')
        @elseif(Auth::user()->role == 'SA')
        @include('layouts.sasidenav')
        @elseif(Auth::user()->role == 'DRH')
        @include('layouts.drhsidenav')
        @elseif(Auth::user()->role == 'EvaluateurGradé')
        @include('layouts.egsidenav')
        @endif

        <!-- Page Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <table id="departs-table" class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th scope="col">Version</th>
                            <th scope="col">SNMG</th>
                            <th scope="col">Salaire Reference</th>
                            <th scope="col">Taux S1 Apprentis</th>
                            <th scope="col">Date debut S1</th>
                            <th scope="col">Date fin S1</th>
                            <th scope="col">Taux S2 Apprentis</th>
                            <th scope="col">Date debut S2</th>
                            <th scope="col">Date fin S2</th>
                            <th scope="col">Taux S3 Apprentis</th>
                            <th scope="col">Date debut S3</th>
                            <th scope="col">Date fin S3</th>
                            <th scope="col">Taux S4 Apprentis</th>
                            <th scope="col">Date debut S4</th>
                            <th scope="col">Date fin S4</th>
                            <th scope="col">Taux S5 Apprentis</th>
                            <th scope="col">Date debut S5</th>
                            <th scope="col">Date fin S5</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($decisions as $decision)
                            @foreach ($pvs as $pv)
                                @if ($pv->id == $decision->pv_id)                      
                                    <tr>
                                        <td>{{ $maitre->nom }}</td>
                                        <td>{{ $maitre->prenom }}</td>
                                        @foreach ($structures as $structure)
                                            @if ($maitre->affectation == $structure->id)
                                                <td>{{ $structure->nom }}</td>
                                            @endif
                                        @endforeach
                                        @foreach ($specialites as $specialite)
                                            @if ($maitre->fonction == $specialite->id)
                                                <td>{{ $specialite->nom }}</td>
                                            @endif
                                        @endforeach
                                        <td>{{ $maitre->statut }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </main>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>