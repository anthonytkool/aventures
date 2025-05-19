@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h2 class="mb-4">All Tours</h2>
    <div class="row g-4">
        @foreach ($tours as $tour)
        <div class="col-md-4">
            <div class="card shadow-sm h-100">
                <img src="{{ asset('storage/'.$tour->image) }}" class="card-img-top" alt="{{ $tour->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $tour->title }}</h5>
                    <p class="text-muted">{{ $tour->start_location }} to {{ $tour->end_location }}</p>
                    <p class="fw-bold">${{ number_format($tour->price, 2) }}</p>
                    <a href="{{ route('tours.show', $tour->id) }}" class="btn btn-outline-primary w-100">View itinerary</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
