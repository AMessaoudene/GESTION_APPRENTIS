@extends('layouts.layout')
@section('title','Historique des evaluations')
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
            <table id="evaluations-table" class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th scope="col">datedebut</th>
                            <th scope="col">datefin</th>
                            <th scope="col">comportementsociabilite</th>
                            <th scope="col">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($evaluations as $evaluation)
                            <tr>
                                <td>{{ $evaluation->datedebut }}</td>
                                <td>{{ $evaluation->datefin }}</td>
                                <td>{{ $evaluation->comportementsociabilite }}</td>
                                <td>{{ $evaluation->statut }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </main>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>