@extends('layouts.app')

@section('content')

{{-- ✅ Hero Section: กว้างเต็มจอจริง --}}
<div class="container-fluid p-0">
    <div class="hero-section text-center">
        <img src="{{ asset('storage/assets/hero.png') }}"
             alt="Tour & Travel Southeast Asia"
             style="width: 100%; height: 500px; object-fit: cover;">
    </div>
</div>

{{-- ✅ Intro และ Tour Cards อยู่ใน Container ปกติ --}}
<div class="container my-5">

    {{-- ✅ Introduction --}}
    <div class="text-center mb-5">
        <h1 class="fw-bold">Explore Southeast Asia with AventureTrip</h1>
        <p class="text-muted">Thailand • Cambodia • Vietnam • Laos</p>
        <a href="{{ route('tours.index') }}" class="btn btn-primary btn-lg mt-2">Browse Tour Packages</a>
    </div>

    {{-- ✅ Popular Tours --}}
    <h2 class="mb-4 text-center">Popular Tours</h2>
    <div class="row">
        @foreach($tours as $tour)
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm">
                @if($tour->image)
                    <img src="{{ asset('storage/' . $tour->image) }}" 
                         class="card-img-top" 
                         style="height: 200px; object-fit: cover;">
                @else
                    <img src="https://via.placeholder.com/400x200" class="card-img-top">
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ $tour->title }}</h5>
                    <p class="card-text">{{ Str::limit($tour->description, 80) }}</p>
                    <p><strong>Location:</strong> {{ $tour->location }}</p>
                    <p class="text-success"><strong>Price:</strong> ฿{{ number_format($tour->price, 2) }}</p>
                    <a href="#" class="btn btn-outline-primary btn-sm">View Details</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>

</div>

@endsection
