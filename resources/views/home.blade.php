@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Hero Banner -->
    <div class="row mb-5">
        <div class="col-12">
            <img  src="{{ asset('storage/assets/hero.png') }}" class="img-fluid rounded shadow-sm" alt="Hero Banner">
        </div>
    </div>

    <!-- Heading -->
    <div class="text-center mb-4">
        <h2 class="fw-bold">Popular Tours</h2>
    </div>

    <!-- Tour Cards Grid -->
    <div class="row g-4">
        @foreach ($tours as $tour)
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <img src="{{ asset('storage/' . $tour->image) }}" class="card-img-top" alt="{{ $tour->title }}">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $tour->title }}</h5>
                    <p class="card-text text-muted">{{ $tour->start_location }} to {{ $tour->end_location }}</p>
                    <p class="fw-bold text-success">฿{{ number_format($tour->price, 2) }}</p>
                    <a href="{{ route('tours.show', $tour->id) }}" class="btn btn-outline-primary mt-auto">View Itinerary</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Browse Button -->
    <div class="text-center mt-5">
        <a href="{{ route('tours.index') }}" class="btn btn-primary px-4">Browse Tour Packages</a>
    </div>

</div>
@endsection
