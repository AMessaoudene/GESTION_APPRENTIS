@extends('layouts.layout')

@section('title', 'SA Dashboard')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3">
                <div class="sidebar">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="#">
                                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-users mr-2"></i> Manage Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="fas fa-building mr-2"></i> Manage Structures
                            </a>
                        </li>
                        <!-- Add more sidebar links as needed -->
                    </ul>
                </div>
            </div>
            <!-- End Sidebar -->

            <!-- Main Content -->
            <div class="col-md-9">
                <div class="content">
                    <h1 class="mb-4">SA Dashboard</h1>
                    
                    <!-- Placeholder content -->
                    <div class="card">
                        <div class="card-body">
                            Welcome to the SA Dashboard! Here, you can manage users, structures, and more.
                        </div>
                    </div>
                    
                    <!-- Add more dashboard components here -->
                </div>
            </div>
            <!-- End Main Content -->
        </div>
    </div>
@endsection
