@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">All Tour Packages</h1>

    <div class="row">
        @foreach($tours as $tour)
        <div class="col-md-4">
            <div class="card mb-4">
                @if($tour->image)
                    <img src="{{ asset('storage/' . $tour->image) }}" class="card-img-top" alt="{{ $tour->title }}">
                @else
                    <img src="https://via.placeholder.com/300x200" class="card-img-top" alt="No image">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $tour->title }}</h5>
                    <p class="card-text">{{ Str::limit($tour->description, 100) }}</p>
                    <p class="card-text"><strong>Location:</strong> {{ $tour->location }}</p>
                    <p class="card-text text-success"><strong>Price:</strong> ฿{{ number_format($tour->price, 2) }}</p>
                    <a href="#" class="btn btn-primary">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
