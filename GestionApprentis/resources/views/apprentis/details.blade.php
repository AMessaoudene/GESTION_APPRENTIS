@extends('layouts.layout')
@section('title','Apprenti | details')
@section('content')
<div class="container">
    <h1 style="text-align:center;">Dossier de l'apprenti</h1>
    <div class="row">
        <div class="col-lg-6">
            <h2>Informations personnelles</h2>
            <ul class="list-group">
                <li class="list-group-item">Nom : {{ $apprenti->nom }}</li>
                <li class="list-group-item">Prénom : {{ $apprenti->prenom }}</li>
                <li class="list-group-item">Adresse : {{ $apprenti->adresse }}</li>
                <li class="list-group-item">Téléphone : {{ $apprenti->telephone }}</li>
                <li class="list-group-item">Email : {{ $apprenti->email }}</li>
                <li class="list-group-item">Civilité : {{ $apprenti->civilite }}</li>
                <li class="list-group-item">Numéro du contrat : {{ $apprenti->numcontrat }}</li>
                <li class="list-group-item">Date du contrat : {{ $apprenti->datecontrat }}</li>
                <li class="list-group-item">Date de début du contrat : {{ $apprenti->datedebut }}</li>
                <li class="list-group-item">Date de fin du contrat : {{ $apprenti->datefin }}</li>
                <li class="list-group-item">Date du transfert : 
                    @if($apprenti->datetransfert)
                        {{ $apprenti->datetransfert }}
                    @else
                        /
                    @endif
                </li>
                <li class="list-group-item">Niveau Scolaire : {{ $apprenti->niveauscolaire }}</li>
                <li class="list-group-item">Spécialité : {{ $specialite->nom }}</li>
                <li class="list-group-item">Diplôme : {{ $diplome->nom }} - {{ $diplome-> duree }} mois</li>
                <li class="list-group-item">Structure : {{ $structure->nom }}</li>
            </ul>
        </div>
        <div class="col-lg-6">
            <h2>PV</h2>
            <ul class="list-group">
                <li class="list-group-item">Référence : {{ $pv->reference }}</li>
                <li class="list-group-item">Date du PV : {{ $pv->datepv }}</li>
                <li class="list-group-item">Maitre Apprenti : 
                @foreach($maitreapprentis as $maitreapprenti)
                    @if($maitreapprenti->id == $pv->maitreapprenti_id)
                    {{ $maitreapprenti->nom }} {{ $maitreapprenti->prenom}}
                    @endif
                @endforeach
                </li>
                <li class="list-group-item">Date installation : {{ $pv->dateinstallationchiffre }}</li>
                <li class="list-group-item">Année d'installation (lettre) : {{ $pv->anneeinstallationlettre }}</li>
                <li class="list-group-item">Mois d'installation (lettre) : {{ $pv->moisinstallationlettre }}</li>
                <li class="list-group-item">Jour d'installation (lettre) : {{ $pv->jourinstallationlettre }}</li>
                <li class="list-group-item">Direction d'affectation : {{ $pv->directionaffectation }}</li>
                <li class="list-group-item">Service d'affectation : {{ $pv->serviceaffectation }}</li>
                <li class="list-group-item">Dotations : {{ $pv->dotations }}</li>
            </ul>
            <div class="text-center">
                <form action="{{ route('dossiers.pv_pdfdownload', $apprenti->id) }}" method="POST" enctype="multipart/form-data">    
                    @csrf
                    <button type="submit" class="btn btn-primary">Telecharger</button>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h2>Decision Apprenti</h2>
            <ul class="list-group">
                @foreach($decisionapprentis as $decisionapprenti)
                    @if($decisionapprenti->pv_id == $pv->id)
                        <li class="list-group-item">Plan Besoin : 
                            @foreach ($plans as $plan)
                                @if($plan->id == $decisionapprenti->planbesoins_id && $plan->status == 'accepté')
                                    {{ $plan->reference }} - 
                                    @foreach($exercices as $exercice)
                                        @if($exercice->id == $plan->exercice_id)
                                            {{ $exercice->annee }}
                                        @endif
                                    @endforeach
                                    -  
                                    {{ $structure->nom }}    
                                    - 
                                    {{ $specialite->nom }}
                                @endif
                            @endforeach
                        </li>
                        <li class="list-group-item">Référence : {{ $decisionapprenti->referenceda }}</li>
                        <li class="list-group-item">Date Decision : {{ $decisionapprenti->dateda }}</li>
                        <li class="list-group-item">Parametre : 
                        @foreach ($parametres as $parametre)
                            @if($parametre->id == $decisionapprenti->parametre_id)
                                {{ $parametre->reference }}
                            @endif
                        @endforeach
                        </li>
                        <li class="list-group-item">Bareme : 
                            @foreach ($baremes as $bareme)
                                @if($bareme->id == $decisionapprenti->bareme_id)
                                    @foreach ($refs as $ref)
                                        @if($ref->id == $bareme->refsalariaires_id)
                                            {{ $ref->version }}
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </li>
                        @if($decisionapprenti->datetransfert)
                            <li class="list-group-item">Date Transfert : {{ $decisionapprenti->datetransfert }}</li>
                        @endif
                        <div class="text-center">
                            <form action="{{ route('dossiers.decisiona_pdfdownload',$apprenti->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Telecharger</button>
                            </form>
                        </div>
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="col-lg-6">
            <h2>Decision Maitre Apprenti</h2>
            <ul class="list-group">
                @foreach($decisionmaitreapprentis as $decisionmaitreapprenti)
                    @if($decisionmaitreapprenti->pv_id == $pv->id)
                        <li class="list-group-item">Référence : {{ $decisionmaitreapprenti->referencedma }}</li>
                        <li class="list-group-item">Date Decision : {{ $decisionmaitreapprenti->datedma }}</li>
                        <li class="list-group-item">Parametre : 
                        @foreach ($parametres as $parametre)
                            @if($parametre->id == $decisionmaitreapprenti->parametre_id)
                                {{ $parametre->reference }}
                            @endif
                        @endforeach
                        </li>
                        <li class="list-group-item">Bareme : 
                            @foreach ($baremes as $bareme)
                                @if($bareme->id == $decisionapprenti->bareme_id)
                                    @foreach ($refs as $ref)
                                        @if($ref->id == $bareme->refsalariaires_id)
                                            {{ $ref->version }}
                                        @endif
                                    @endforeach
                                @endif
                            @endforeach
                        </li>
                        <div class="text-center">
                            <form action="{{ route('dossiers.decisionma_pdfdownload',$apprenti->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Telecharger</button>
                            </form>
                        </div>
                    @endif
                @endforeach
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <h2>Documents</h2>
            <ul class="list-group">
            @foreach($dossiers as $dossier)
                @if($dossier->apprentis_id == $apprenti->id)
                    @if ($dossier->contratapprenti || $dossier->contratapprenti !='')
                    <li class="list-group-item">
                        <a href="{{ url('/apprentis/fichiers/download', $dossier->contratapprenti) }}">Contrat</a>
                        @if ($dossier->status != 'valide')
                            <form action="{{ route('dossiers.deletefichier', ['id' => $dossier->id, 'fichier' => 'contratapprenti']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endif
                    </li>
                    @else
                    <li class="list-group-item">Aucun contrat</li>
                    @endif
                    @if($dossier->pvinstallation || $dossier->pvinstallation !='')
                    <li class="list-group-item">
                        <a href="{{ url('/apprentis/fichiers/download', $dossier->pvinstallation) }}">PV</a>
                        @if ($dossier->status != 'valide')
                            <form action="{{ route('dossiers.deletefichier', ['id' => $dossier->id, 'fichier' => 'pvinstallation']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endif
                    </li>
                    @else
                    <li class="list-group-item">Aucun PV</li>
                    @endif
                    @if($dossier->extraitnaissance || $dossier->extraitnaissance !='')
                    <li class="list-group-item">
                        <a href="{{ url('/apprentis/fichiers/download', $dossier->extraitnaissance) }}">Extrait de naissance</a>
                        @if ($dossier->status != 'valide')
                            <form action="{{ route('dossiers.deletefichier', ['id' => $dossier->id, 'fichier' => 'extraitnaissance']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endif
                    </li>
                    @else
                    <li class="list-group-item">Aucun extrait de naissance</li>
                    @endif
                    @if($dossier->decisionapprenti || $dossier->decisionapprenti !='')
                    <li class="list-group-item">
                        <a href="{{ url('/apprentis/fichiers/download', $dossier->decisionapprenti) }}">Decision Apprenti</a>
                        @if ($dossier->status != 'valide')
                            <form action="{{ route('dossiers.deletefichier', ['id' => $dossier->id, 'fichier' => 'decisionapprenti']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endif
                    </li>
                    @else
                    <li class="list-group-item">Aucune decision apprenti</li>
                    @endif
                    @if($dossier->decisionmaitreapprenti || $dossier->decisionmaitreapprenti !='')
                    <li class="list-group-item">
                        <a href="{{ url('/apprentis/fichiers/download', $dossier->decisionmaitreapprenti) }}">Decision Maitre d'apprentis</a>
                        @if ($dossier->status != 'valide')
                            <form action="{{ route('dossiers.deletefichier', ['id' => $dossier->id, 'fichier' => 'decisionmaitreapprenti']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endif
                    </li>
                    @else
                    <li class="list-group-item">Aucune decision maitre d'apprentis</li>
                    @endif
                    @if($dossier->copiecheque || $dossier->copiecheque !='')
                    <li class="list-group-item">
                        <a href="{{ url('/apprentis/fichiers/download', $dossier->copiecheque) }}">Copie cheque</a>
                        @if ($dossier->status != 'valide')
                            <form action="{{ route('dossiers.deletefichier', ['id' => $dossier->id, 'fichier' => 'copiecheque']) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        @endif
                    </li>
                    @else
                    <li class="list-group-item">Aucune copie cheque</li>
                    @endif
                    @if($dossier->photo || $dossier->photo !='')
                        <li class="list-group-item">
                            <a href="{{ url('/apprentis/fichiers/download', $dossier->photo) }}">Photo</a>
                            @if ($dossier->status != 'valide')
                                <form action="{{ route('dossiers.deletefichier', ['id' => $dossier->id, 'fichier' => 'photo']) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @endif
                        </li>
                    @else
                    <li class="list-group-item">Aucune photo</li>
                    @endif
                    @if($dossier->autorisationparentele || $dossier->autorisationparentele !='')
                        <li class="list-group-item">
                            <a href="{{ url('/apprentis/fichiers/download', $dossier->autorisationparentele) }}">Autorisation parentale</a>
                            @if ($dossier->status != 'valide')
                                <form action="{{ route('dossiers.deletefichier', ['id' => $dossier->id, 'fichier' => 'autorisationparentele']) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @endif
                        </li>
                    @else
                    <li class="list-group-item">Aucune autorisation parentale</li>
                    @endif
                    @if($dossier->pieceidentite || $dossier->pieceidentite !='')
                        <li class="list-group-item">
                            <a href="{{ url('/apprentis/fichiers/download', $dossier->pieceidentite) }}">Piece d'identité</a>
                            @if ($dossier->status != 'valide')
                                <form action="{{ route('dossiers.deletefichier', ['id' => $dossier->id, 'fichier' => 'pieceidentite']) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @endif
                        </li>
                    @else
                    <li class="list-group-item">Aucune piece d'identité</li>
                    @endif
                    @if ($dossier->status == 'en cours' && Auth::user()->role == 'DFP')
                        <form action="{{ route('apprentis.updatedossier',$dossier->id) }}" method="POST">
                            @csrf
                            <label for="">Status du dossier</label>
                            <select name="status" value="{{ $dossier->status }}" required>
                                <option value="#">Choisir</option>
                                <option value="valide">Valide</option>
                                <option value="refuse">Refuse</option>
                            </select>
                            <label for="">Motif</label>
                            <input type="text" name="motif" id="">
                            <button type="submit">Valider</button>
                        </form>
                        @else
                        <input type="text" name="status" id="" value="{{ $dossier->status }}" disabled readonly>
                        @endif
                    @endif
                @endforeach
            </ul>
        </div>
        <div class="col-lg-6">
            <h2>Maitre d'apprenti</h2>
            <ul class="list-group">
                @foreach($maitreapprentis as $maitreapprenti)
                    @if($maitreapprenti->apprenti1_id == $apprenti->id || $maitreapprenti->apprenti2_id == $apprenti->id)
                        <li class="list-group-item">Nom : {{ $maitreapprenti->nom }}</li>
                        <li class="list-group-item">Prenom : {{ $maitreapprenti->prenom }}</li>
                        <li class="list-group-item">Diplome : 
                        @foreach($diplomes as $diplome)
                            @if($diplome->id == $maitreapprenti->diplome_id)
                                {{ $diplome->nom }} - {{ $diplome->duree }} Mois
                            @endif
                        @endforeach
                        </li>
                        <li class="list-group-item">Structure : 
                        @foreach($structures as $structure)
                            @if($structure->id == $maitreapprenti->affectation)
                                {{ $structure->nom }}
                            @endif
                        @endforeach
                        </li>
                        <li class="list-group-item">Spécialité : 
                        @foreach($specialites as $specialite)
                            @if($specialite->id == $maitreapprenti->fonction)
                                {{ $specialite->nom }}
                            @endif
                        @endforeach
                        </li>
                        <li class="list-group-item">Civilite : {{ $maitreapprenti->civilite }}</li>
                        <li class="list-group-item">Telephone : {{ $maitreapprenti->telephonepro }}</li>
                        <li class="list-group-item">Adresse : {{ $maitreapprenti->adresse }}</li>
                        <li class="list-group-item">Email : {{ $maitreapprenti->email }}</li>
                        <li class="list-group-item">Statut : {{ $maitreapprenti->statut }}</li>
                    @endif
                @endforeach
            </ul>
        </div>
        <div>
            <div>
                <h2>Pré-Salaire d'Apprenti</h2>
                <ul class="list-group">
                    <div>
                        <h3>Pre-Salaire S1</h3>
                        <li>Date debut : {{$decisiona->datedebutpresalaireS1}}</li>
                        <li>Date fin :{{$decisiona->datefinpresalaireS1}}</li>
                    </div>
                    <div>
                        <h3>Pre-Salaire S2</h3>
                        <li>Date debut :{{$decisiona->datedebutpresalaireS2}}</li>
                        <li>Date fin :{{$decisiona->datefinpresalaireS2}}</li>
                    </div>
                    @if ($decisiona->datedebutpresalaireS3)
                    <div>
                        <h3>Pre-Salaire S3</h3>
                        <li>Date debut :{{$decisiona->datedebutpresalaireS3}}</li>
                        @if ($decisiona->datefinpresalaireS3)
                        <li>Date fin :{{$decisiona->datefinpresalaireS3}}</li>
                        @endif
                    </div>
                    @endif
                    @if ($decisiona->datedebutpresalaireS4)
                    <div>
                        <h3>Pre-Salaire S4</h3>
                        <li>Date debut :{{$decisiona->datedebutpresalaireS4}}</li>
                        @if ($decisiona->datefinpresalaireS4)
                        <li>Date fin :{{$decisiona->datefinpresalaireS4}}</li>
                        @endif
                    </div>
                    @endif
                    @if ($decisiona->datedebutpresalaireS5)
                    <div>
                        <h3>Pre-Salaire S5</h3>
                        <li>Date debut :{{$decisiona->datedebutpresalaireS5}}</li>
                        @if ($decisiona->datefinpresalaireS5)
                        <li>Date fin :{{$decisiona->datefinpresalaireS5}}</li>
                        @endif
                    </div>
                    @endif
                </ul>
            </div>
            <div>
                <h2>Salaire du maitre d'Apprenti</h2>
                <ul class="list-group">
                    <div>
                        <h3>Salaire S1</h3>
                        <li>Date debut :{{$decisionm->datedebutsalaireS1}}</li>
                        <li>Date fin :{{$decisionm->datefinsalaireS1}}</li>
                    </div>
                    <div>
                        <h3>Salaire S2</h3>
                        <li>Date debut :{{$decisionm->datedebutsalaireS2}}</li>
                        <li>Date fin :{{$decisionm->datefinsalaireS2}}</li>
                    </div>
                    @if ($decisionm->datedebutsalaireS3)
                    <div>
                        <h3>Salaire S3</h3>
                        <li>Date debut :{{$decisionm->datedebutsalaireS3}}</li>
                        @if ($decisionm->datefinsalaireS3)
                        <li>Date fin :{{$decisionm->datefinsalaireS3}}</li>
                        @endif
                    </div>
                    @endif
                    @if ($decisionm->datedebutsalaireS4)
                    <div>
                        <h3>Salaire S4</h3>
                        <li>Date debut :{{$decisionm->datedebutsalaireS4}}</li>
                        @if ($decisionm->datefinsalaireS4)
                        <li>Date fin :{{$decisionm->datefinsalaireS4}}</li>
                        @endif
                    </div>
                    @endif
                    @if ($decisionm->datedebutsalaireS5)
                    <div>
                        <h3>Salaire S5</h3>
                        <li>Date debut :{{$decisionm->datedebutsalaireS5}}</li>
                        @if ($decisionm->datefinsalaireS5)
                        <li>Date fin :{{$decisionm->datefinsalaireS5}}</li>
                        @endif
                    </div>
                    @endif
                </ul>
            </div>
        </div>
        @if ($apprenti->status == "actif")
        <p style="text-align:center;">Statut de l'apprenti : <span style="color:green;">{{ $apprenti->status }}</span></p>
        @elseif($apprenti->status == "inactif")
        <p style="text-align:center;">Statut de l'apprenti : <span style="color:red;">{{ $apprenti->status }}</span></p>
        @endif
    </div>
</div>
@endsection
