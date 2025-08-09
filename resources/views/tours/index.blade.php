@extends('layouts.app')

@section('content')

{{-- ✅ Hero Banner --}}
<div style="width:100vw; max-width:100vw; margin-left:calc(50% - 50vw); overflow:hidden; height:clamp(200px, 26vw, 360px);">
  <img src="{{ asset('storage/assets/banner.png') }}" alt="Explore Our Tours"
    style="width:100%; height:100%; object-fit:cover; object-position:center; display:block;">
</div>

<div class="container py-5">

 {{-- ✅ Filter Dropdown --}}
<div class="dropdown text-center mb-4">
  <button class="btn btn-outline-primary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
    🌐 
    @if(request('country'))
      {{ ucfirst(request('country')) }}
    @elseif(request('series'))
      {{ request('series') }} Series
    @else
      All Destinations
    @endif
  </button>
  <ul class="dropdown-menu" aria-labelledby="filterDropdown">
    <li>
      <a class="dropdown-item" href="{{ route('tours.index') }}">
        <img src="{{ asset('icons/flags/world.png') }}" width="20" class="me-2"> All Destinations
      </a>
    </li>
    <li>
      <a class="dropdown-item" href="{{ route('tours.index', ['country' => 'Thailand']) }}">
        <img src="{{ asset('icons/flags/thailand_flag.png') }}" width="20" class="me-2"> Thailand
      </a>
    </li>
    <li>
      <a class="dropdown-item" href="{{ route('tours.index', ['country' => 'Vietnam']) }}">
        <img src="{{ asset('icons/flags/vietnam_flag.png') }}" width="20" class="me-2"> Vietnam
      </a>
    </li>
    <li>
      <a class="dropdown-item" href="{{ route('tours.index', ['country' => 'Laos']) }}">
        <img src="{{ asset('icons/flags/laos_flag.png') }}" width="20" class="me-2"> Laos
      </a>
    </li>
    <li>
      <a class="dropdown-item" href="{{ route('tours.index', ['series' => 'Combo Tour']) }}">
        🌐 Combo Tour Series
      </a>
    </li>
    <li>
      <a class="dropdown-item" href="{{ route('tours.index', ['series' => 'Adventure Ride']) }}">
        🌐 Adventure Ride Series
      </a>
    </li>
  </ul>
</div>

  {{-- ✅ Page Heading --}}
  <div class="text-center mb-4">
    <h1 class="fw-bold display-5 mb-2">All Tours</h1>
    <p class="text-muted fs-5">Browse all our amazing tours by destination</p>
  </div>

  {{-- ✅ Tour Cards --}}
  <div class="row g-4">
    @forelse ($tours as $tour)
    <div class="col-md-6 col-lg-3">
      <div class="card shadow-sm border-0" style="height: 480px; max-width: 360px; margin-left: auto; margin-right: auto;">
        
        <img
          src="{{ asset('storage/tourCovers/' . $tour->image) }}"
          alt="{{ $tour->title }}"
          onerror="this.onerror=null; this.src='https://via.placeholder.com/300x200?text=No+Image';"
          class="card-img-top"
          style="height: 200px; object-fit: cover;">

        <div class="card-body d-flex flex-column">
          <small class="text-muted">{{ $tour->duration ?? $tour->days }} DAY TOUR</small>
          <h6 class="fw-bold mt-1">{{ $tour->title }}</h6>
          <small class="text-muted">Valid on {{ \Carbon\Carbon::parse($tour->valid_date ?? now())->format('M d, Y') }}</small>
          <p class="fw-bold mt-2">
            {{ number_format($tour->price, 0) }}&nbsp;THB
            <span class="text-muted small">per person</span>
          </p>
          <p class="text-muted small mt-auto">*Approx. $1 = 33 THB for your reference</p>
          <a href="{{ route('tour.show', $tour->slug) }}" class="btn btn-outline-primary btn-sm mt-2">View itinerary</a>
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