@extends('layouts.layout')
@section('title','Departs')
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
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (Auth::user()->role == 'DFP' || Auth::user()->role == 'SA')
            <div class="container mt-5">
                    <div class="row justify-content-center">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addAccountModal">
                            Ajouter un depart
                        </button>
                    </div>
                </div>

                <!-- Modal depart -->
                <div class="modal fade" id="addAccountModal" tabindex="-1" aria-labelledby="addAccountModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addAccountModalLabel">Gestion Des departs</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="departForm" action="{{ route('departs.store') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="apprenti_id" class="form-label">Apprenti</label>
                                        <select name="apprenti_id" id="apprenti_id" class="form-select" aria-label="Sélectionner un apprenti" required>
                                            <option value="">Sélectionner un apprenti</option>
                                            @foreach($apprentis as $apprenti)
                                                @if((Auth::user()->role == "DFP"|| (Auth::user()->role == 'SA' && $user->structures_id == $apprenti->structure_id) && $apprenti->status == "actif"))
                                                    <option value="{{ $apprenti->id }}" data-nom="{{ $apprenti->nom }}" data-prenom="{{ $apprenti->prenom }}">
                                                        {{ $apprenti->nom }} {{ $apprenti->prenom }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                        <div class="invalid-feedback">
                                            Veuillez sélectionner un apprenti.
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="datedepart" class="form-label">Date de départ</label>
                                        <input type="date" name="datedepart" id="datedepart" class="form-control" aria-label="Date de départ" required>
                                        <div class="invalid-feedback">
                                            Veuillez entrer une date de départ.
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="motif" class="form-label">Motif</label>
                                        <select name="motif" id="motif" class="form-select" aria-label="Sélectionner un motif" required>
                                            <option value="">Sélectionner un motif</option>
                                            <option value="résiliation">Résiliation</option>
                                            <option value="transfert">Transfert</option>
                                        </select>
                                        <div class="invalid-feedback">
                                            Veuillez sélectionner un motif.
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="refcourrier" class="form-label">Référence Courrier</label>
                                        <input type="text" name="refcourrier" id="refcourrier" class="form-control" aria-label="Référence Courrier" required>
                                        <div class="invalid-feedback">
                                            Veuillez entrer la référence du courrier.
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="datecourrier" class="form-label">Date Courrier</label>
                                        <input type="date" name="datecourrier" id="datecourrier" class="form-control" aria-label="Date Courrier" required>
                                        <div class="invalid-feedback">
                                            Veuillez entrer la date du courrier.
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Ajouter</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
            @endif
            <table id="departs-table" class="table table-striped mt-4">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Apprenti ID</th>
                            <th scope="col">Date de depart</th>
                            <th scope="col">Motif</th>
                            <th scope="col">Ref. courrier</th>
                            <th scope="col">Date courrier</th>
                                @if (Auth::user()->role == 'DFP' || Auth::user()->role == 'SA') 
                            <th scope="col">Actions</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($departs as $depart)
                            <tr>
                                <td>{{ $depart->id }}</td>
                                <td>{{ $depart->apprenti_id }}</td>
                                <td>{{ $depart->datedepart }}</td>
                                <td>{{ $depart->motif }}</td>
                                <td>{{ $depart->refcourrier }}</td>
                                <td>{{ $depart->datecourrier }}</td>
                                @if (Auth::user()->role == 'DFP' || (Auth::user()->role == 'SA' && $depart->apprenti_id == $apprenti->id && $apprenti->structure_id == Auth::user()->structures_id))
                                    <td>
                                        <form id="deleteForm{{ $depart->id }}" action="{{ route('departs.destroy', $depart->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $depart->id }})">Supprimer</button>
                                        </form>
                                    </td>
                                @endif
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
<script>
    function confirmDelete(id) {
        if (confirm('Voulez-vous supprimer cet compte?')) {
            // Submit the form if confirmed
            document.getElementById('deleteForm' + id).submit();
        }
    }
    document.getElementById('apprenti_id').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var nom = selectedOption.getAttribute('data-nom') || '';
        var prenom = selectedOption.getAttribute('data-prenom') || '';

        document.getElementById('nom').value = nom;
        document.getElementById('prenom').value = prenom;
    });

    document.getElementById('departForm').addEventListener('submit', function(event) {
        var forms = document.querySelectorAll('.needs-validation');
        Array.prototype.slice.call(forms).forEach(function(form) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        });
    });
</script>
