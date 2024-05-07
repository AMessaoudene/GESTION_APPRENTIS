@extends('layouts.layout')
@section('title', 'Dashboard')
@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('layouts.sidenav')

        <!-- Page Content -->
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
            <div class="container mt-5 mb-5">
                <h1 class="text-center mb-5">Bienvenue sur DFP Dashboard</h1>
                <!-- Your main content here -->
            </div>
        </main>
    </div>
</div>
@endsection
