@extends('layouts.app')

@section('content')
<div class="container py-5">

  <h1 class="fw-bold text-center mb-3">Our Tour Packages</h1>
  <p class="text-center text-muted mb-4">
    Discover our curated tour packages across Thailand, Cambodia, Vietnam, and Laos.<br>
    Experience adventure, culture, and relaxation in every journey.
  </p>

  {{-- Filter + Search --}}
  <form method="GET" action="{{ route('tours.index') }}" class="row g-3 align-items-end mb-4">
    <div class="col-md-4">
      <label for="country" class="form-label fw-semibold">Filter by Country</label>
      <select name="country" id="country" class="form-select" onchange="this.form.submit()">
        <option value="">All Countries</option>
        <option value="Thailand" {{ request('country') == 'Thailand' ? 'selected' : '' }}>Thailand</option>
        <option value="Cambodia" {{ request('country') == 'Cambodia' ? 'selected' : '' }}>Cambodia</option>
        <option value="Vietnam" {{ request('country') == 'Vietnam' ? 'selected' : '' }}>Vietnam</option>
        <option value="Laos" {{ request('country') == 'Laos' ? 'selected' : '' }}>Laos</option>
      </select>
    </div>
    <div class="col-md-5">
      <label for="search" class="form-label fw-semibold">Search Tours</label>
      <input type="text" name="search" id="search" class="form-control"
             value="{{ request('search') }}" placeholder="Search by tour name or location...">
    </div>
    <div class="col-md-3 d-grid">
      <button type="submit" class="btn btn-primary">Apply Filters</button>
    </div>
  </form>

  {{-- Tour Grid --}}
  <div class="row g-4">
    @forelse ($tours as $tour)
    <div class="col-md-4">
      <div class="card h-100 shadow-sm border-0">
        <img src="{{ asset($tour->image_url ?? 'images/no-image.png') }}" class="card-img-top" style="height: 200px; object-fit: cover;" alt="{{ $tour->title }}">
         
        <div class="card-body">
          <p class="text-muted small mb-1">{{ $tour->country }} &bull; {{ $tour->start_location }}</p>
          <h5 class="fw-bold">{{ $tour->title }}</h5>
          <p class="fw-semibold text-primary mb-3">{{ number_format($tour->price, 2) }} ฿</p>
          <a href="{{ route('tours.show', $tour->id) }}" class="btn btn-outline-primary w-100">View Itinerary</a>
        </div>
      </div>
    </div>
    @empty
    <p class="text-center text-muted">No tours found matching your filters.</p>
    @endforelse
  </div>

  {{-- Pagination --}}
  <div class="mt-4 d-flex justify-content-center">
    {{ $tours->withQueryString()->links() }}
  </div>

</div>
@endsection
