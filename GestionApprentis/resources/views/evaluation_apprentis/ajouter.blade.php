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
    <form>
        @csrf
        <div class="form-group">
          <label for="exampleInputEmail1">Apprenti</label>
          <select name="apprenant_id" class="form-control">
              @foreach ($apprentis as $apprenti)
                  <option value="{{$apprenti->id}}">{{$apprenti->id}} - {{$apprenti->nom}} {{$apprenti->prenom}}</option>
              @endforeach
          </select>
        </div>
        
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
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
</div>
@endsection