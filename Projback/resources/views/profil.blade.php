@extends('layouts.layout') <!-- Appel du layout -->
@section('content') <!-- Section dynamique -->
    <div class="main-content position-relative max-height-vh-100 h-100">
      
        <!-- End Navbar -->
      
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Edit Profile</p>
                                <button class="btn btn-primary btn-sm ms-auto">Profil</button>
                            </div>
                        </div>
                        <div class="card-body">
                            
                        @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <p class="text-uppercase text-sm">User Information</p>
    <form action="{{ route('profil.edit') }}" method="POST">
        @csrf <!-- Protection CSRF -->
        @method('PUT') <!-- Méthode HTTP PUT -->
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="username" class="form-control-label">Username</label>
                    <input class="form-control" type="text" name="name" id="name" value="{{ $user->name }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email" class="form-control-label">Email address</label>
                    <input class="form-control" type="email" name="email" id="email" value="{{ $user->email }}">
                </div>
            </div>
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">Modifier</button>
        </div>
    </form>


</div>


</body>

@endsection