@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="mb-4 fw-bold">Admin Dashboard</h1>
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <a href="{{ route('admin.tours.index') }}" class="stretched-link text-decoration-none">
                        <i class="bi bi-map fs-1 text-primary"></i>
                        <h4 class="my-3">Manage Tours</h4>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <a href="{{ route('admin.bookings.index') }}" class="stretched-link text-decoration-none">
                        <i class="bi bi-journal-check fs-1 text-success"></i>
                        <h4 class="my-3">Manage Bookings</h4>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection