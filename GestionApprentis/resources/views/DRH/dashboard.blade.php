@extends('layouts.layout')
@section('title', 'Dashboard')
<style>
    .card {
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: box-shadow 0.3s ease;
        margin-bottom: 20px;
    }

    .card:hover {
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
    }

    .card-title {
        font-size: 1.2rem;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .card-body {
        padding: 20px;
    }

    .card-text {
        font-size: 1.1rem;
        color: #333;
    }

    .table-responsive {
        margin-bottom: 20px;
    }
</style>
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('layouts.drhsidenav')

        <!-- Page Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4" style="background-color:white">
            <div class="container-fluid mt-5 mb-5">
                <h1 class="text-center mb-5">Bienvenue sur DFP Dashboard</h1>
                <div class="row mb-4">
                    <!-- Card: Today's Date -->
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Date d'aujourd'hui</h5>
                                <p id="current-date" class="card-text"></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mb-4">
                    <!-- Card: Total Apprentices -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Apprentis</h5>
                                <p class="card-text">{{ $totalapprentis }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card: Total Masters -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Maîtres d'Apprentis</h5>
                                <p class="card-text">{{ $totalmaitres }}</p>
                            </div>
                        </div>
                    </div>
                    <!-- Card: Total Structures -->
                    <div class="col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Structures</h5>
                                <p class="card-text">{{ $totalstructures }}</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 mb-4">
                        <canvas id="myChart" width="400" height="200"></canvas>
                    </div>
                    <div class="col-lg-6">
                        <div class="table-responsive">
                            <h5 class="text-center mb-4">Liste des apprentis</h5>
                            <table id="apprentisTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($apprentis as $apprenti)
                                    <tr>
                                        <td>{{ $apprenti->nom }}</td>
                                        <td>{{ $apprenti->email }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <h5 class="text-center mb-4">Liste des structures</h5>
                            <table id="structuresTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Adresse courriel</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($structures as $structure)
                                    <tr>
                                        <td>{{ $structure->nom }}</td>
                                        <td>{{ $structure->adressecourriel }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="table-responsive">
                            <h5 class="text-center mb-4">Liste des maîtres d'apprentis</h5>
                            <table id="maitresTable" class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Nom</th>
                                        <th scope="col">Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($maitres as $maitre)
                                    <tr>
                                        <td>{{ $maitre->nom }}</td>
                                        <td>{{ $maitre->email }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Get today's date
        var today = new Date();
        var dateString = today.toLocaleDateString('fr-FR', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });

        // Update the paragraph with today's date
        document.getElementById('current-date').textContent = dateString;
        // Get the canvas element
        var ctx = document.getElementById('myChart').getContext('2d');

        // Define the data
        var data = {
            labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
            datasets: [{
                label: 'Apprentis',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                borderColor: 'rgba(255, 99, 132, 1)',
                borderWidth: 1,
                data: @json($monthlyCounts)
            }]
        };

        // Create the chart
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@section('scripts')
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        $('#apprentisTable').DataTable();
        $('#structuresTable').DataTable();
        $('#maitresTable').DataTable();
    });
</script>
@endsection