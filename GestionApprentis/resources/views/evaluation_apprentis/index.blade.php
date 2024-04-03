@extends('layouts.layout')
@section('title', 'Evaluation Apprenti | Ajouter')
@section('content')
<div>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
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
    <form action="{{ route('evaluation_apprentis.submit') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
          <label for="">Apprenti</label>
          <select name="apprenti_id" class="form-control" required>
              @foreach ($apprentis as $apprenti)
                  <option value="{{$apprenti->id}}">{{$apprenti->id}} - {{$apprenti->nom}} {{$apprenti->prenom}}</option>
              @endforeach
          </select>
          <input type="text" value="{{$maitre_apprentis->nom}} {{$maitre_apprentis->prenom}}">
          <input type="text" value="{{$maitre_apprentis->fonction}}">
          <label for="">Structure
            <select name="" id="">
                @foreach ($structures as $structure)
                    <option value="{{$structure->id}}">{{$structure->nom}}</option>
                @endforeach
            </select>
          </label>
        </div>
        <label for="">Reference
            <input type="text" name="reference" required>
        </label>
        <div class="row">
            <div class="col">
                <label for="exampleInputPassword1">Date début</label>
                <input type="date" name="date" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="col">
                <label for="heureseance">Date fin</label>
                <input type="date" name="date_fin" class="form-control" id="heureseance">
            </div>
        </div>

        <label for="">
            <select name="reference" id="" required>
                <option value="Très bon"></option>
                <option value="Bon"></option>
                <option value="Moyen"></option>
                <option value="Faible"></option>
            </select>
            <input type="text" name="">
        </label>
        <label for="">
            <select name="comportementsociabilite" id="" required>
                <option value="Très bon"></option>
                <option value="Bon"></option>
                <option value="Moyen"></option>
                <option value="Faible"></option>
            </select>
            <input type="text" name="observationcs">
        </label>
        <label for="">
            <select name="communication" id="" required>
                <option value="Très bon"></option>
                <option value="Bon"></option>
                <option value="Moyen"></option>
                <option value="Faible"></option>
            </select>
            <input type="text" name="observationc">
        </label>
        <label for="">
            <select name="organisationhygiene" id="" required>
                <option value="Très bon"></option>
                <option value="Bon"></option>
                <option value="Moyen"></option>
                <option value="Faible"></option>
            </select>
            <input type="text" name="observationoh">
        </label>
        <label for="">
            <select name="ponctualiteassiduite" id="" required>
                <option value="Très bon"></option>
                <option value="Bon"></option>
                <option value="Moyen"></option>
                <option value="Faible"></option>
            </select>
            <input type="text" name="observationpa">
        </label>
        <label for="">
            <select name="respectreglementinterieur" id="" required>
                <option value="Très bon"></option>
                <option value="Bon"></option>
                <option value="Moyen"></option>
                <option value="Faible"></option>
            </select>
            <input type="text" name="observationrri">
        </label>
        <label for="">
            <select name="discipline" id="" required>
                <option value="Très bon"></option>
                <option value="Bon"></option>
                <option value="Moyen"></option>
                <option value="Faible"></option>
            </select>
            <input type="text" name="observationd">
        </label>
        <label for="">
            <select name="interettravail" id="" required>
                <option value="Très bon"></option>
                <option value="Bon"></option>
                <option value="Moyen"></option>
                <option value="Faible"></option>
            </select>
            <input type="text" name="observationit">
        </label>
        <label for="">
            <select name="motivation" id="" required>
                <option value="Très bon"></option>
                <option value="Bon"></option>
                <option value="Moyen"></option>
                <option value="Faible"></option>
            </select>
            <input type="text" name="observationm">
        </label>
        <label for="">
            <select name="espritinitiative" id="" required>
                <option value="Très bon"></option>
                <option value="Bon"></option>
                <option value="Moyen"></option>
                <option value="Faible"></option>
            </select>
            <input type="text" name="observationei">
        </label>
        <label for="">
            <select name="qualificationsprofessionelles" id="" required>
                <option value="Très bon"></option>
                <option value="Bon"></option>
                <option value="Moyen"></option>
                <option value="Faible"></option>
            </select>
            <input type="text" name="observationqp">
        </label>
        <label for="">
            <select name="evolutionprocessusintegration" id="" required>
                <option value="Très bon"></option>
                <option value="Bon"></option>
                <option value="Moyen"></option>
                <option value="Faible"></option>
            </select>
            <input type="text" name="observationepi">
        </label>
        <label for="">
            <select name="sensresponsabilite" id="" required>
                <option value="Très bon"></option>
                <option value="Bon"></option>
                <option value="Moyen"></option>
                <option value="Faible"></option>
            </select>
            <input type="text" name="observationsr">
        </label>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Apprenti</th>
            <th>Date</th>
            <th>Heure de début</th>
            <th>Heure de fin</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($evaluations as $evaluation)
            <tr>
                <td>{{ $evaluation->id }}</td>
                <td>{{ $evaluation->apprenti_id }}</td>
                <td>{{ $evaluation->date }}</td>
                <td>{{ $evaluation->heure_debut }}</td>
                <td>{{ $evaluation->heure_fin }}</td>
                <td>
                    <a href="{{ route('evaluation_apprentis.edit', $evaluation->id) }}" class="btn btn-primary">Modifier</a>
                    <form action="{{ route('evaluation_apprentis.destroy', $evaluation->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr> 
        @endforeach
    </tbody>  
</table>
@endsection