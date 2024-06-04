@extends('layouts.layout')
@section('title','Historique des maitre apprentis')
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
                            <th scope="col">Nom</th>
                            <th scope="col">Prenom</th>
                            <th scope="col">Structure</th>
                            <th scope="col">Specialité</th>
                            <th scope="col">Statut</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($supervisions as $supervision)
                            @foreach ($maitres as $maitre)
                                @if ($maitre->id == $supervision->maitreapprenti_id)                      
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