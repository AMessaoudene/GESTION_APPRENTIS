@extends('layouts.layout')
@section('title', 'Parametres')
@section('content')
<h1>Parametres</h1><br/>
<form method="POST" action="{{ route('parametres.store') }}" class="form-horizontal" enctype="multipart/form-data">
    @csrf
    <label for="">Reference
        <input type="text" name="reference" id="">
    </label>
    <label>
        Decision responsable
    </label>
    <input type="text" name="decisionresponsable">
    <label>
        Date decision responsable
    </label>
    <input type="date" name="datedecisionresponsable">
    <label>
        Nom responsable
    </label>
    <input type="text" name="nomresponsable">
    <label>
        Prenom responsable
    </label>
    <input type="text" name="prenomresponsable">
    <label>
        Civilite responsable
    </label>
    <select name="civiliteresponsable">
        <option value="">-- Choisir --</option>
        <option value="Monsieur">Mr</option>
        <option value="Madame">Mme</option>
        <option value="Mademoiselle">Mlle</option>
    </select>
    <label>
        Fonction responsable
    </label>
    <input type="text" name="fonctionresponsable">
    <label>
        Type Decision DG
    </label>
    <input type="text" name="typedecisiondg">
    <label>
        Date Decision DG
    </label>
    <input type="date" name="datedecisiondg">
    <label>
        Nom et Prenom DG
    </label>
    <input type="text" name="nomprenomdg">
    <label>
        Decision premier responsable
    </label>
    <input type="text" name="decisionpremierresponsable">
    <label>
        Date decision premier responsable
    </label>
    <input type="date" name="datedecisionpremierresponsable">
    <label>
        Nom et Prenom premier responsable
    </label>
    <input type="text" name="nomprenompremierresponsable">
    <label>
        Fonction premier responsable
    </label>
    <input type="text" name="fonctionpremierresponsable">
    <label>
        Civilite DRH
    </label>
    <select name="civilitedrh" id="">
        <option value="">-- Choisir --</option>
        <option value="Monsieur">Mr</option>
        <option value="Madame">Mme</option>
        <option value="Mademoiselle">Mlle</option>
    </select>
    <label>
        Civilite DFC
    </label>
    <select name="civilitedfc" id="">
        <option value="">-- Choisir --</option>
        <option value="Monsieur">Mr</option>
        <option value="Madame">Mme</option>
        <option value="Mademoiselle">Mlle</option>
    </select>
    <input type="submit" value="Enregistrer">
</form>
<table id="parametres-table">
    <tr>
        <th>Reference</th>
        <th>Decision responsable</th>
        <th>Date decision responsable</th>
        <th>Nom responsable</th>
        <th>Prenom responsable</th>
        <th>Civilite responsable</th>
        <th>Fonction responsable</th>
        <th>Decision DG</th>
        <th>Date decision DG</th>
        <th>Nom et prenom DG</th>
        <th>Decision premier responsable</th>
        <th>Date decision premier responsable</th>
        <th>Nom et prenom premier responsable</th>
        <th>Fonction premier responsable</th>
        <th>Civilite RH</th>
        <th>Civilite Fc</th>
    </tr>
    @foreach ($parametres as $parametre)
        <tr>
            <td>{{ $parametre->reference }}</td>
            <td>{{ $parametre->decisionresponsable }}</td>
            <td>{{ $parametre->datedecisionresponsable }}</td>
            <td>{{ $parametre->nomresponsable }}</td>
            <td>{{ $parametre->prenomresponsable }}</td>
            <td>{{ $parametre->civiliteresponsable }}</td>
            <td>{{ $parametre->fonctionresponsable }}</td>
            <td>{{ $parametre->typedecisiondg }}</td>
            <td>{{ $parametre->datedecisiondg }}</td>
            <td>{{ $parametre->nomprenomdg }}</td>
            <td>{{ $parametre->decisionpremierresponsable }}</td>
            <td>{{ $parametre->datedecisionpremierresponsable }}</td>
            <td>{{ $parametre->nomprenompremierresponsable }}</td>
            <td>{{ $parametre->fonctionpremierresponsable }}</td>
            <td>{{ $parametre->civilitedrh }}</td>
            <td>{{ $parametre->civilitedfc }}</td>
        </tr>
    @endforeach
</table>
@endsection
<script>
    $(document).ready(function() {
        $('#parametres-table').DataTable();
    });
    // AJAX for editing a diplome
    $(document).on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var row = $(this).closest('tr');
            var nomresponsable = row.find('td:eq(1)').text();
            var prenomresponsable = row.find('td:eq(2)').text();
            var civiliteresponsable = row.find('td:eq(3)').text();
            var fonctionresponsable = row.find('td:eq(4)').text();
            var typedecisiondg = row.find('td:eq(5)').text();
            var datedecisiondg = row.find('td:eq(6)').text();
            var nomprenomdg = row.find('td:eq(7)').text();
            var decisionpremierresponsable = row.find('td:eq(8)').text();
            var datedecisionpremierresponsable = row.find('td:eq(9)').text();
            var nomprenompremierresponsable = row.find('td:eq(10)').text();
            var fonctionpremierresponsable = row.find('td:eq(11)').text();
            var civilitedrh = row.find('td:eq(12)').text();
            var civilitedfc = row.find('td:eq(13)').text();

            // Replace html of the row with the edit form
            row.find('td:eq(1)').html(`
                <form method="POST" action="/parametres/${id}" class="edit-form">
                    @csrf
                    @method('PUT')
                    <input type="text" name="nomresponsable" value="${nomresponsable}">
                    <input type="text" name="prenomresponsable" value="${prenomresponsable}">
                    <select name="civiliteresponsable" value="${civiliteresponsable}">
                        <option value="">-- Choisir --</option>
                        <option value="Monsieur">Mr</option>
                        <option value="Madame">Mme</option>
                        <option value="Mademoiselle">Mlle</option>
                    </select>
                    <input type="text" name="fonctionresponsable" value="${fonctionresponsable}">
                    <input type="text" name="typedecisiondg" value="${typedecisiondg}">
                    <input type="date" name="datedecisiondg" value="${datedecisiondg}">
                    <input type="text" name="nomprenomdg" value="${nomprenomdg}">
                    <input type="text" name="decisionpremierresponsable" value="${decisionpremierresponsable}">
                    <input type="date" name="datedecisionpremierresponsable" value="${datedecisionpremierresponsable}">
                    <input type="text" name="nomprenompremierresponsable" value="${nomprenompremierresponsable}">
                    <input type="text" name="fonctionpremierresponsable" value="${fonctionpremierresponsable}">
                    <select name="civilitedrh" value="${civilitedrh}">
                        <option value="">-- Choisir --</option>
                        <option value="Monsieur">Mr</option>
                        <option value="Madame">Mme</option>
                        <option value="Mademoiselle">Mlle</option>
                    </select>
                    <select name="civilitedfc" value="${civilitedfc}">
                        <option value="">-- Choisir --</option>
                        <option value="Monsieur">Mr</option>
                        <option value="Madame">Mme</option>
                        <option value="Mademoiselle">Mlle</option>
                    </select>
                    <input type="submit" value="Enregistrer">
                    <button type="button" class="cancel-edit">Annuler</button>
                </form>
            `);
        });

        // Submit edit form
        $(document).on('submit', '.edit-form', function(event) {
            event.preventDefault();
            var form = $(this);
            $.ajax({
                url: form.attr('action'),
                type: 'PUT', // Changed from POST to PUT for update
                data: form.serialize(),
                success: function(response) {
                    // Reload the page to update the table
                    location.reload();
                },
                error: function(xhr, textStatus, errorThrown) {
                    // Handle error
                    console.error('Error updating diplome:', errorThrown);
                }
            });
        });
</script>
