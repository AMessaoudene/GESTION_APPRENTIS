@extends('layouts.layout')
@section('title', 'References Salariaires')
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
            @if (Auth::user()->role == 'DFP' || Auth::user()->role == 'DRH') 
            <div class="container mt-5 mb-5">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title text-center">Ajouter un Reference salariaire</h5>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('refsalariaires.store') }}" method="POST">
                            @csrf
                            <label>version
                                <input type="text" name="version" id="">
                            </label>
                            <label for="">SNMG
                                <input type="text" pattern="[0-9]+" name="snmg" required>
                            </label>
                            <label for="">Salaire Reference
                                <input type="text" pattern="[0-9]+" name="salairereference" required>
                            </label>
                            <input type="submit" value="Ajouter">
                        </form>
                    </div>
                </div>
            </div>
            @endif
            <table id="refs-table" class="table table-striped" style="width:100%">
                <thead>
                <tr>
                    <th>id</th>
                    <th>version</th>
                    <th>SNMG</th>
                    <th>Salaire Reference</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($refsalariaires as $refsalariaire)
                <tr>
                    <td>{{ $refsalariaire->id }}</td>
                    <td>{{ $refsalariaire->version }}</td>
                    <td>{{ $refsalariaire->snmg }}</td>
                    <td>{{ $refsalariaire->salairereference }}</td>
                    <td>{{ $refsalariaire->status }}</td>
                    <td>
                        <form action="{{ route('refsalariaires.destroy', $refsalariaire->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Supprimer</button>
                        </form>
                    </td>
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
    $(document).ready(function() {
        $('#refs-table').DataTable();

        // AJAX for adding a new diplome
        $('#add-form').submit(function(event) {
            event.preventDefault();
            var form = $(this);
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: form.serialize(),
                success: function(response) {
                    // Reload the page to update the table
                    location.reload();
                },
                error: function(xhr, textStatus, errorThrown) {
                    // Handle error
                    console.error('Error adding diplome:', errorThrown);
                }
            });
        });

        // AJAX for editing a diplome
        $(document).on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            var row = $(this).closest('tr');
            var nom = row.find('td:eq(1)').text();
            var duree = row.find('td:eq(2)').text();
            var description = row.find('td:eq(3)').text();
            var editForm = `
                <form method="POST" action="/diplomes/${id}" class="edit-form">
                    @csrf
                    @method('PUT')
                    <input type="text" name="nom" class="form-control" value="${nom}">
                    <input type="text" name="duree" class="form-control" value="${duree}">
                    <input type="text" name="description" class="form-control" value="${description}">
                    <button type="submit" class="btn btn-primary">Valider</button>
                </form>
            `;
            row.find('td:eq(1)').html(editForm);
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
    });
</script>
