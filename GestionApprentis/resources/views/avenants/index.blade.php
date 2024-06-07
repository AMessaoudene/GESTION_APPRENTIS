@extends('layouts.layout')
@section('title', 'avenants')
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
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="container">
                @if (Auth::user()->role == 'DFP' || Auth::user()->role == 'SA')    
                <div class="container mt-5">
                    <div class="row justify-content-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAccountModal">
                            Ajouter un avenant
                        </button>
                    </div>
                </div>

                <!-- Modal depart -->
                <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAccountModalLabel">Gestion Des avenants</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="avenantForm" action="{{ route('avenants.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group mb-3">
                                        <label for="decisionapprenti_id">Sélectionner une decision d'un apprenti</label>
                                        <select name="decisionapprenti_id" id="decisionapprenti_id">
                                            <option value="">-- Choisir --</option>
                                            @foreach ($apprentis as $apprenti)
                                                @if (Auth::user()->role == 'DFP' || (Auth::user()->role == 'SA' && Auth::user()->structures_id == $apprenti->structure_id))
                                                    @foreach ($pvs as $pv)
                                                        @if ($pv->apprenti_id == $apprenti->id)
                                                            @foreach ($decisions as $decision)
                                                                @if ($decision->pv_id == $pv->id)
                                                                    <option value="{{ $decision->id }}" data-diplome-id="{{ $apprenti->diplome1_id }}">{{ $decision->referenceda }} - {{ $apprenti->nom }} {{ $apprenti->prenom }}
                                                                        @foreach ($specialites as $specialite)
                                                                            @if ($specialite->id == $apprenti->specialite_id)
                                                                                - {{ $specialite->nom }}
                                                                            @endif
                                                                        @endforeach
                                                                        @foreach ($structures as $structure)
                                                                            @if ($structure->id == $apprenti->structure_id)
                                                                                - {{ $structure->nom }}
                                                                            @endif
                                                                        @endforeach
                                                                    </option>
                                                                @endif
                                                            @endforeach
                                                        @endif
                                                    @endforeach
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="date">Date</label>
                                        <input type="date" class="form-control" name="date" id="date" required>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="type">Type</label>
                                        <select class="form-control" name="type" id="type" required>
                                            <option value="">-- Choisir --</option>
                                            <option value="rattrapage">Rattrapage</option>
                                            <option value="passerelle">Passerelle</option>
                                        </select>
                                    </div>
                                    <div class="form-group mb-3">
                                        <label for="diplome">Diplome</label>
                                        <select class="form-control" name="diplome_id" id="diplome">
                                            <option value="">-- Choisir --</option>
                                            @foreach ($diplomes as $diplome)
                                                <option value="{{ $diplome->id }}" data-duree="{{ $diplome->duree }}">{{ $diplome->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="row mt-4">
                    <div class="col-md-12">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Decision Apprenti ID</th>
                                    <th>Date</th>
                                    <th>Type</th>
                                    @if (Auth::user()->role == 'DFP' || Auth::user()->role == 'SA')
                                        <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($avenants as $avenant)
                                    <tr>
                                        <td>{{ $avenant->decisionapprenti_id }}</td>
                                        <td>{{ $avenant->date }}</td>
                                        <td>{{ $avenant->type }}</td>
                                        @if (Auth::user()->role == 'DFP')
                                            <td>
                                                <form action="{{ route('avenants.destroy', $avenant->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                                </form>
                                            </td>
                                        @elseif(Auth::user()->role == 'SA')
                                        @foreach($decisions as $decision)
                                            @if($decision->id == $avenant->decisionapprenti_id)
                                                @foreach ($pvs as $pv)
                                                    @if ($pv->id == $decision->pv_id)
                                                        @foreach ($apprentis as $apprenti)
                                                            @if ($apprenti->id == $pv->apprenti_id && Auth::user()->structures_id == $apprenti->structure_id)
                                                                <td>
                                                                    <form action="{{ route('avenants.destroy', $avenant->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit" class="btn btn-danger">Supprimer</button>
                                                                    </form>
                                                                </td>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.7.0.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const avenantForm = document.getElementById('avenantForm');
    const diplomeSelect = document.getElementById('diplome');
    const decisionSelect = document.getElementById('decisionapprenti_id');
    let currentDiplomeId = null;
    let currentDiplomeDuree = null;

    decisionSelect.addEventListener('change', function() {
        const selectedOption = decisionSelect.options[decisionSelect.selectedIndex];
        currentDiplomeId = selectedOption.getAttribute('data-diplome-id');

        // Filter diplomas to exclude the current one
        for (let i = 0; i < diplomeSelect.options.length; i++) {
            let option = diplomeSelect.options[i];
            if (option.value == currentDiplomeId) {
                option.style.display = 'none';
            } else {
                option.style.display = 'block';
            }
        }
    });

    avenantForm.addEventListener('submit', function(event) {
        const selectedDiplomeOption = diplomeSelect.options[diplomeSelect.selectedIndex];
        const selectedDiplomeId = selectedDiplomeOption.value;
        const selectedDiplomeDuree = parseInt(selectedDiplomeOption.getAttribute('data-duree'));

        if (!selectedDiplomeId || isNaN(selectedDiplomeDuree)) {
            alert('Veuillez sélectionner un diplôme valide.');
            event.preventDefault();
            return;
        }

        if (selectedDiplomeId == currentDiplomeId) {
            alert('Veuillez sélectionner un diplôme différent.');
            event.preventDefault();
            return;
        }

        if (currentDiplomeDuree && selectedDiplomeDuree < currentDiplomeDuree) {
            alert('La durée du diplôme sélectionné doit être égale ou supérieure à celle du diplôme actuel.');
            event.preventDefault();
            return;
        }
    });
});
</script>
