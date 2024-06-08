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
                            <th scope="col">ID</th>
                            <th scope="col">Version</th>
                            <th scope="col">SNMG</th>
                            <th scope="col">Salaire Reference</th>
                            <th scope="col">Date debut S1</th>
                            <th scope="col">Date fin S1</th>
                            <th scope="col">Date debut S2</th>
                            <th scope="col">Date fin S2</th>
                            <th scope="col">Date debut S3</th>
                            <th scope="col">Date fin S3</th>
                            <th scope="col">Date debut S4</th>
                            <th scope="col">Date fin S4</th>
                            <th scope="col">Date debut S5</th>
                            <th scope="col">Date fin S5</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $decision->id }}</td>
                            @foreach ($baremes as $bareme)
                                @if ($bareme->id == $decision->bareme_id)
                                    @foreach ($refs as $ref)
                                        @if ($ref->id == $bareme->refsalariaires_id)
                                            <td>{{ $ref->version }}</td>
                                            <td>{{ $ref->snmg }}</td>
                                            <td>{{ $ref->salairereference }}</td>
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                            <td>{{ $decision->datedebutsalaireS1 }}</td>
                            <td>{{ $decision->datefinsalaireS1 }}</td>
                            <td>{{ $decision->datedebutsalaireS2 }}</td>
                            <td>{{ $decision->datefinsalaireS2 }}</td>
                            <td>{{ $decision->datedebutsalaireS3 }}</td>
                            <td>{{ $decision->datefinsalaireS3 }}</td>
                            <td>{{ $decision->datedebutsalaireS4 }}</td>
                            <td>{{ $decision->datefinsalaireS4 }}</td>
                            <td>{{ $decision->datedebutsalaireS5 }}</td>
                            <td>{{ $decision->datefinsalaireS5 }}</td>
                        </tr>
                    </tbody>
                </table>
            </main>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>