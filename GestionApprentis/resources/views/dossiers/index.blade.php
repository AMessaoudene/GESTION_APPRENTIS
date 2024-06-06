@extends('layouts.layout')
@section('title', 'Apprentis | Dossiers')
<link rel="stylesheet" href="//cdn.datatables.net/2.0.3/css/dataTables.dataTables.min.css">
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div>
                    <p class="text-center mb-4">Remarque : Pour les decisions du l'apprenti, maitre d'apprenti et le PV. Vous pouvez les ajouter dans la phase de la mise à jour du dossier pour qu'il doit etre accépté par la DFP</p>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('dossiers.store') }}" enctype="multipart/form-data" class="needs-validation" novalidate>
                        <h2 class="text-center mb-4">Ajouter les documents</h2>
                        @csrf
                        
                        <div class="document-section">
                            <h3>Contrats et Décisions</h3>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="contratapprenti">Contrat <span style="color:red;">*</span></label>
                                    <input type="file" class="form-control" id="contratapprenti" name="contratapprenti" accept=".pdf" required>
                                    <div class="invalid-feedback">Veuillez sélectionner un fichier.</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="decisionapprenti">Decision d'apprenti</label>
                                    <input type="file" class="form-control" id="decisionapprenti" name="decisionapprenti" accept=".pdf">
                                    <div class="invalid-feedback">Veuillez sélectionner un fichier.</div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="decisionmaitreapprenti">Decision Maitre d'apprentis</label>
                                    <input type="file" class="form-control" id="decisionmaitreapprenti" name="decisionmaitreapprenti" accept=".pdf">
                                    <div class="invalid-feedback">Veuillez sélectionner un fichier.</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="pvinstallation">PV d'Installation</label>
                                    <input type="file" class="form-control" id="pvinstallation" name="pvinstallation" accept=".pdf">
                                    <div class="invalid-feedback">Veuillez sélectionner un fichier.</div>
                                </div>
                            </div>
                        </div>

                        <div class="document-section">
                            <h3>Pièces Administratives</h3>
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="copiecheque">Copie Cheque <span style="color:red;">*</span></label>
                                    <input type="file" class="form-control" id="copiecheque" name="copiecheque" accept=".pdf" required>
                                    <div class="invalid-feedback">Veuillez sélectionner un fichier.</div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="extraitnaissance">Extrait de Naissance <span style="color:red;">*</span></label>
                                    <input type="file" class="form-control" id="extraitnaissance" name="extraitnaissance" accept=".pdf" required>
                                    <div class="invalid-feedback">Veuillez sélectionner un fichier.</div>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="autorisationparentele">Autorisation Parentale</label>
                                    <input type="file" class="form-control" id="autorisationparentele" accept=".pdf" name="autorisationparentele">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="photo">Photo</label>
                                    <input type="file" class="form-control" id="photo" accept=".pdf, .jpg, .jpeg, .png" name="photo">
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="pieceidentite">Piece d'Identite</label>
                                    <input type="file" class="form-control" id="pieceidentite" accept=".pdf" name="pieceidentite">
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary mt-3">Ajouter</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    <!--<table id="dossiers-table">
        <thead>
            <tr>
                <th>Apprenti ID</th>
                <th>PV d'installation</th>
                <th>Decision d'apprenti</th>
                <th>Decision Maitre d'apprentis</th>
                <th>Contrat Apprenti</th>
                <th>copie cheque</th>
                <th>extrait de naissance</th>
                <th>autorisationparentele</th>
                <th>photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @foreach($dossiers as $dossier)
    <tr>
        <td>{{ $dossier->apprentis_id }}</td>
        <td><a href="{{ url('/apprentis/fichiers/download', $dossier->pvinstallation) }}">PV d'installation</a></td>
        <td><a href="{{ url('/apprentis/fichiers/download', $dossier->decisionapprenti) }}">Decision Apprenti</a></td>
        <td><a href="{{ url('/apprentis/fichiers/download', $dossier->decisionmaitreapprenti) }}">Decision Maitre d'apprentis</a></td>
        <td><a href="{{ url('/apprentis/fichiers/download', $dossier->contratapprenti) }}">Contrat Apprenti</a></td>
        <td><a href="{{ url('/apprentis/fichiers/download', $dossier->copiecheque) }}">copie cheque</a></td>
        <td><a href="{{ url('/apprentis/fichiers/download', $dossier->extraitnaissance) }}">extrait de naissance</a></td>

        @if($dossier->autorisationparentele)
            <td><a href="{{ url('/apprentis/fichiers/download', $dossier->autorisationparentele) }}">autorisation parentale</a></td>
        @else
            <td>Aucun</td>
        @endif

        @if($dossier->photo)
            <td><a href="{{ url('/apprentis/fichiers/download', $dossier->photo) }}">Photo</a></td>
        @else
            <td>Aucun</td>
        @endif
    </tr>
@endforeach
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="//cdn.datatables.net/2.0.3/js/dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#dossiers-table').DataTable();
        });
    </script>
</form>-->
@endsection