@extends('layouts.app')

@section('content')
{{-- Hero Banner --}}
<div style="width:100vw; max-width:100vw; margin-left:calc(50% - 50vw); overflow:hidden; height:clamp(200px, 26vw, 360px);">
  <img src="{{ asset('storage/assets/hero-tours.jpg') }}" alt="Explore Our Tours"
    style="width:100%; height:100%; object-fit:cover; object-position:center; display:block;">
</div>

<div class="container py-5">
  {{-- Filter Header --}}
  <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">
    <div>
      <h2 class="fw-bold text-dark mb-1">All Tours</h2>
      <p class="text-muted fs-5 mb-0">Browse our curated multi-day adventures across <strong>Thailand, Cambodia, Vietnam, and Laos.</strong></p>
    </div>
    <form method="GET" action="{{ route('tours.index') }}" class="mt-3 mt-md-0">
      <select name="country" class="form-select" onchange="this.form.submit()">
        <option value="">🌍 All Destinations</option>
        <option value="Thailand" {{ request('country') == 'Thailand' ? 'selected' : '' }}>🇹🇭 Thailand</option>
        <option value="Cambodia" {{ request('country') == 'Cambodia' ? 'selected' : '' }}>🇰🇭 Cambodia</option>
        <option value="Vietnam" {{ request('country') == 'Vietnam' ? 'selected' : '' }}>🇻🇳 Vietnam</option>
        <option value="Laos" {{ request('country') == 'Laos' ? 'selected' : '' }}>🇱🇦 Laos</option>
      </select>
    </form>
  </div>

  {{-- Tour Cards --}}
  <div class="row g-4">
    @forelse ($tours as $tour)
    <div class="col-md-6 col-lg-3">
      <div class="card shadow-sm h-100">
        <img src="{{ asset($tour->image_url) }}" alt="{{ $tour->title }}" class="card-img-top"
          style="height: 200px; object-fit: cover;">
        <div class="card-body d-flex flex-column">
          <small class="text-muted">{{ $tour->days }} DAY TOUR</small>
          <h6 class="fw-bold mt-1">{{ $tour->title }}</h6>
          <small class="text-muted">Valid on {{ \Carbon\Carbon::parse($tour->valid_date)->format('M d, Y') }}</small>

          <p class="fw-bold mt-2">${{ number_format($tour->price, 2) }} <span class="text-muted small">per person</span></p>
          <a href="{{ route('tours.show', $tour->id) }}" class="btn btn-outline-primary btn-sm mt-auto">View itinerary</a>
        </div>
      </div>
    </div>
    @empty
    <div class="col-12">
      <div class="alert alert-warning text-center">No tours available for the selected destination.</div>
    </div>
    @endforelse
  </div>
</div>
@endsection
