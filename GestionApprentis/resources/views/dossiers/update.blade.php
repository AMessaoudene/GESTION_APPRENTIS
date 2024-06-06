@extends('layouts.layout')
@section('title','Apprenti | details')
@section('content')
<div class="container">
    <h1 style="text-align:center;">Dossier de l'apprenti</h1>
    <form action="{{ route('dossiers.update',$apprenti->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-lg-6">
                <h2>Informations personnelles</h2>
                <ul class="list-group">
                    <li class="list-group-item">ID <input type="text" placeholder="{{ $apprenti->id }}" readonly disabled></li>
                    <li class="list-group-item">Nom <input type="text" name="nom" value="{{ $apprenti->nom }}" placeholder="{{ $apprenti->nom }}"></li>
                    <li class="list-group-item">Prenom <input type="text" name="prenom" value="{{ $apprenti->prenom }}" placeholder="{{ $apprenti->prenom }}"></li>
                    <li class="list-group-item">Adresse <input type="text" name="adresse" value="{{ $apprenti->adresse }}" placeholder="{{ $apprenti->adresse }}"></li>
                    <li class="list-group-item">Date de naissance <input type="date" name="datenaissance" value="{{ $apprenti->datenaissance }}" placeholder="{{ $apprenti->datenaissance }}" id=""></li>
                    <li class="list-group-item">Téléphone <input type="text" name="telephone" value="{{ $apprenti->telephone }}" placeholder="{{ $apprenti->telephone }}"></li>
                    <li class="list-group-item">Email <input type="text" name="email" value="{{ $apprenti->email }}" placeholder="{{ $apprenti->email }}"> </li>
                    <li class="list-group-item">Civilité 
                        <select name="civilite" value="{{ $apprenti->civilite }}" placeholder="{{ $apprenti->civilite }}">
                            <option value="">-- Choisir --</option>
                            <option value="Homme" @if($apprenti->civilite == 'Homme') selected @endif>Homme</option>
                            <option value="Femme" @if($apprenti->civilite == 'Femme') selected @endif>Femme</option>
                        </select>
                    </li>
                    <li class="list-group-item">Numéro du contrat <input type="text" name="numcontrat" value="{{ $apprenti->numcontrat }}" placeholder="{{ $apprenti->numcontrat }}"></li>
                    <li class="list-group-item">Date du contrat <input type="date" name="datecontrat" value="{{ $apprenti->datecontrat }}" placeholder="{{ $apprenti->datecontrat }}"></li>
                    <li class="list-group-item">Date de début du contrat <input type="date" name="datedebut" value="{{ $apprenti->datedebut }}" placeholder="{{ $apprenti->datedebut }}"></li>
                    <li class="list-group-item">Date de fin du contrat <input type="date" name="datefin" value="{{ $apprenti->datefin }}" placeholder="{{ $apprenti->datefin }}"></li>
                    <li class="list-group-item">Date du transfert <input type="date" name="datetransfert" value="{{ $apprenti->datetransfert }}" placeholder="{{ $apprenti->datetransfert }}"> </li>
                    <li class="list-group-item">Niveau Scolaire 
                        <select name="niveauscolaire" placeholder="{{ $apprenti->niveauscolaire }}">
                            <option value="">-- Choisir --</option>
                            <option value="primaire" @if($apprenti->niveauscolaire == 'primaire') selected @endif>primaire</option>
                            <option value="moyen" @if($apprenti->niveauscolaire == 'moyen') selected @endif>moyen</option>
                            <option value="secondaire" @if($apprenti->niveauscolaire == 'secondaire') selected @endif>secondaire</option>
                        </select>
                    </li>
                    <li class="list-group-item">Spécialité 
                        <select name="specialite_id" placeholder="{{ $apprenti->specialite_id }}">
                            <option value="">-- Choisir --</option>
                            @foreach($specialites as $specialite)
                                <option value="{{ $specialite->id }}" @if($apprenti->specialite_id == $specialite->id) selected @endif>{{ $specialite->nom }}</option>
                            @endforeach
                        </select>
                    </li>
                    <li class="list-group-item">Diplôme 1
                        <select name="diplome1_id" placeholder="{{ $apprenti->diplome1_id }}">
                            <option value="">-- Choisir --</option>
                            @foreach($diplomes as $diplome)
                                <option value="{{ $diplome->id }}" @if($apprenti->diplome1_id == $diplome->id) selected @endif>{{ $diplome->nom }}</option>
                            @endforeach
                        </select>
                    </li>
                    @if ($apprenti->diplome2_id)
                    <li class="list-group-item">Diplome 2
                        <select name="diplome2_id" placeholder="{{ $apprenti->diplome2_id }}">
                            <option value="">-- Choisir --</option>
                            @foreach($diplomes as $diplome)
                                <option value="{{ $diplome->id }}" @if($apprenti->diplome2_id == $diplome->id) selected @endif>{{ $diplome->nom }}</option>
                            @endforeach
                        </select>
                    </li>
                    @endif
                    <li class="list-group-item">Structure 
                        <select name="structure_id" placeholder="{{ $apprenti->structures_id }}">
                            <option value="">-- Choisir --</option>
                            @foreach($structures as $structure)
                                <option value="{{ $structure->id }}" @if($apprenti->structure_id == $structure->id) selected @endif>{{ $structure->nom }}</option>
                            @endforeach
                        </select>
                    </li>
                </ul>
            </div>
            <div class="col-lg-6">
                <h2>PV</h2>
                @foreach($pvs as $pv)
                    @if($pv->apprenti_id == $apprenti->id)
                        <ul class="list-group">
                            <li class="list-group-item">ID <input type="text" value="{{ $pv->id }}" readonly disabled></li>
                            <li class="list-group-item">Référence <input type="text" name="reference" value="{{ $pv->reference }}" placeholder="{{ $pv->reference }}"></li>
                            <li class="list-group-item">Date du PV <input type="date" name="datepv" value="{{ $pv->datepv }}" placeholder="{{ $pv->datepv }}"></li>
                            <li class="list-group-item">Maitre Apprenti 
                                <select name="maitreapprenti_id" placeholder="{{ $pv->maitreapprenti_id }}">
                                    <option value="">-- Choisir --</option>
                                    @foreach($maitreapprentis as $maitreapprenti)
                                        <option value="{{ $maitreapprenti->id }}" @if($pv->maitreapprenti_id == $maitreapprenti->id) selected @endif>{{ $maitreapprenti->nom }}</option>
                                    @endforeach
                                </select>
                            </li>
                            <li class="list-group-item">Date installation <input type="date" name="dateinstallationchiffre" value="{{ $pv->dateinstallationchiffre }}" placeholder="{{ $pv->dateinstallationchiffre }}"> </li>
                            <li class="list-group-item">Année d'installation (lettre) <input type="text" name="anneeinstallationlettre" value="{{ $pv->anneeinstallationlettre }}" placeholder="{{ $pv->anneeinstallationlettre }}"> </li>
                            <li class="list-group-item">Mois d'installation (lettre) <input type="text" name="moisinstallationlettre" value="{{ $pv->moisinstallationlettre }}" placeholder="{{ $pv->moisinstallationlettre }}"> </li>
                            <li class="list-group-item">Jour d'installation (lettre) <input type="text" name="jourinstallationlettre" value="{{ $pv->jourinstallationlettre }}" placeholder="{{ $pv->jourinstallationlettre }}"> </li>
                            <li class="list-group-item">Direction d'affectation <input type="text" name="directionaffectation" value="{{ $pv->directionaffectation }}" placeholder="{{ $pv->directionaffectation }}"> </li>
                            <li class="list-group-item">Service d'affectation <input type="text" name="serviceaffectation" value="{{ $pv->serviceaffectation }}" placeholder="{{ $pv->serviceaffectation }}"> </li>
                            <li class="list-group-item">Dotations <input type="text" name="dotations" value="{{ $pv->dotations }}" placeholder="{{ $pv->dotations }}"> </li>
                        </ul>
                    @endif
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <h2>Decision Apprenti</h2>
                <ul class="list-group">
                    @foreach($decisionapprentis as $decisionapprenti)
                        @if($decisionapprenti->pv_id == $pv->id)
                        <li class="list-group-item">ID <input type="text" placeholder="{{ $decisionapprenti->id }}" readonly disabled></li>
                            <li class="list-group-item">Plan Besoin ID
                                <select name="planbesoins_id" placeholder="{{ $decisionapprenti->planbesoins_id }}">
                                    <option value="">-- Choisir --</option>
                                    @foreach($planbesoins as $planbesoin)
                                        @if($planbesoin->status == 'accepté')
                                            <option value="{{ $planbesoin->id }}" @if($planbesoin->id == $decisionapprenti->planbesoins_id) selected @endif>{{ $planbesoin->reference }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </li>
                            <li class="list-group-item">Référence <input type="text" name="referenceda" value="{{ $decisionapprenti->referenceda }}" placeholder="{{ $decisionapprenti->referenceda }}"> </li>
                            <li class="list-group-item">Date Decision <input type="date" name="dateda" value="{{ $decisionapprenti->dateda }}" placeholder="{{ $decisionapprenti->dateda }}"></li>
                            <li class="list-group-item">Parametre ID 
                                <select name="parametre_id" placeholder="{{ $decisionapprenti->parametre_id }}">
                                    <option value="">-- Choisir --</option>
                                    @foreach($parametres as $parametre)
                                        @if($parametre->status == 'actif')
                                            <option value="{{ $parametre->id }}" @if($decisionapprenti->parametre_id == $parametre->id) selected @endif>{{ $parametre->reference }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </li>
                            <li class="list-group-item">Bareme ID 
                                <select name="bareme_id" placeholder="{{ $decisionapprenti->bareme_id }}">
                                    <option value="">-- Choisir --</option>
                                    @foreach($baremes as $bareme)
                                        @if($bareme->statut == 'actif')
                                            <option value="{{ $bareme->id }}" @if($decisionapprenti->bareme_id == $bareme->id) selected @endif>{{ $bareme->refsalariaires_id }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </li>
                            <li class="list-group-item">Date Transfert <input type="date" name="datetransfert" value="{{$decisionapprenti->datetransfert }}" placeholder="{{ $decisionapprenti->datetransfert }}"></li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-6">
                <h2>Decision Maitre Apprenti</h2>
                <ul class="list-group">
                    @foreach($decisionmaitreapprentis as $decisionmaitreapprenti)
                        @if($decisionmaitreapprenti->pv_id == $pv->id)
                            <li class="list-group-item">ID <input type="text" name="" value="{{ $decisionmaitreapprenti->id }}" disabled readonly> </li>
                            <li class="list-group-item">Référence <input type="text" name="referencedma" value="{{ $decisionmaitreapprenti->referencedma }}" placeholder="{{ $decisionmaitreapprenti->referencedma }}"> </li>
                            <li class="list-group-item">Date Decision <input type="date" name="datedma" value="{{ $decisionmaitreapprenti->datedma }}" placeholder="{{ $decisionmaitreapprenti->datedma }}"></li>
                            <li class="list-group-item">Parametre ID 
                                <select name="parametre_id" placeholder="{{ $decisionmaitreapprenti->parametre_id }}">
                                    <option value="">-- Choisir --</option>
                                    @foreach($parametres as $parametre)
                                        @if($parametre->status == 'actif')
                                            <option value="{{ $parametre->id }}" @if($decisionmaitreapprenti->parametre_id == $parametre->id) selected @endif>{{ $parametre->reference }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </li>
                            <li class="list-group-item">Bareme ID 
                                <select name="bareme_id" placeholder="{{ $decisionmaitreapprenti->bareme_id }}">
                                    <option value="">-- Choisir --</option>
                                    @foreach($baremes as $bareme)
                                        @if($bareme->statut == 'actif')
                                            <option value="{{ $bareme->id }}" @if($decisionmaitreapprenti->bareme_id == $bareme->id) selected @endif>{{ $bareme->refsalariaires_id }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </li>
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
                            <label for="">Contrat Apprenti</label>
                            @if($dossier->contratapprenti)
                                <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->contratapprenti) }}">Contrat</a></li>
                            @else
                                <input type="file" accept=".pdf" name="contratapprenti" id="" required>
                            @endif
                            <label for="">PV</label>
                            @if($dossier->pvinstallation)
                            <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->pvinstallation) }}">PV</a></li>
                            @else
                                <input type="file" accept=".pdf" name="pvinstallation" id="" required>
                            @endif
                            <label for="">Extrait de naissance</label>
                            @if($dossier->extraitnaissance)
                            <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->extraitnaissance) }}">Extrait de naissance</a></li>
                            @else
                                <input type="file" accept=".pdf" name="extraitnaissance" id="" required>
                            @endif
                            <label for="">Decision d'apprenti</label>
                            @if($dossier->decisionapprenti)
                            <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->decisionapprenti) }}">Decision Apprenti</a></li>
                            @else
                                <input type="file" accept=".pdf" name="decisionapprenti" id="" required>
                            @endif
                            <label for="">Decision Maitre d'apprentis</label>
                            @if($dossier->decisionmaitreapprenti)
                            <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->decisionmaitreapprenti) }}">Decision Maitre d'apprentis</a></li>
                            @else
                                <input type="file" accept=".pdf" name="decisionmaitreapprenti" id="" required>
                            @endif
                            <label for="">Copie cheque</label>
                            @if($dossier->copiecheque)
                            <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->copiecheque) }}">Copie cheque</a></li>
                            @else
                                <input type="file" accept=".pdf" name="copiecheque" id="" required>
                            @endif
                            <label for="">Photo</label>
                            @if($dossier->photo)
                                <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->photo) }}">Photo</a></li>
                            @else
                                <input type="file" accept=".pdf,.jpg,.jpeg,.png" name="photo" id="">
                            @endif
                            <label for="">Autorisation parentale</label>
                            @if($dossier->autorisationparentele)
                                <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->autorisationparentele) }}">Autorisation parentale</a></li>
                            @else
                                <input type="file" accept=".pdf" name="autorisationparentele" id="">
                            @endif
                            <label for="">Piece d'identité</label>
                            @if($dossier->pieceidentite)
                                <li class="list-group-item"><a href="{{ url('/apprentis/fichiers/download', $dossier->pieceidentite) }}">Piece d'identité</a></li>
                            @else
                                <input type="file" accept=".pdf" name="pieceidentite" id="">
                            @endif
                            <li class="list-group-item">Status <input type="text" name="status" placeholder="{{$dossier->status}}" id="" readonly disabled></li>
                            @if ($dossier->status == 'refusé' || $dossier->status == 'en cours')
                                <li class="list-group-item">Motif du refus <input type="text" name="motif" placeholder="{{ $dossier->motif }}" readonly disabled></li>
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
                            <li class="list-group-item">Nom <input type="text" name="" id="" value="{{ $maitreapprenti->nom }}" disabled readonly></li>
                            <li class="list-group-item">Prenom <input type="text" name="" id="" value="{{ $maitreapprenti->prenom }}" disabled readonly></li>
                            <li class="list-group-item">Civilite <input type="text" name="" id="" value="{{ $maitreapprenti->civilite }}" disabled readonly></li>
                            <li class="list-group-item">Telephone <input type="text" name="" id="" value="{{ $maitreapprenti->telephonepro }}" disabled readonly></li>
                            <li class="list-group-item">Adresse <input type="text" name="" id="" value="{{ $maitreapprenti->adresse }}" disabled readonly></li>
                            <li class="list-group-item">Email <input type="text" name="" id="" value="{{ $maitreapprenti->email }}" disabled readonly></li>
                            <li class="list-group-item">Statut <input type="text" name="" id="" value="{{ $maitreapprenti->statut }}" disabled readonly></li>
                        @endif
                    @endforeach
                </ul>
            </div>
            <button class="" type="submit">Valider</button>
        </form>
        @if ($apprenti->status == "actif")
        <p style="text-align:center;">Statut de l'apprenti : <span style="color:green;">{{ $apprenti->status }}</span></p>
        @elseif($apprenti->status == "inactif")
        <p style="text-align:center;">Statut de l'apprenti : <span style="color:red;">{{ $apprenti->status }}</span></p>
        @endif
    </div>
</div>
@endsection
