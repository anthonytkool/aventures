@extends('layouts.app')

@section('content')

{{-- Hero Banner --}}
<div style="width:100vw; max-width:100vw; margin-left:calc(50% - 50vw); overflow:hidden; height:clamp(200px, 26vw, 360px);">
  <img src="{{ asset('storage/assets/banner.png') }}" alt="Explore Our Tours"
    style="width:100%; height:100%; object-fit:cover; object-position:center; display:block;">
</div>

<div class="container py-5">
{{-- Filter Dropdown with Flags --}}
<div class="dropdown text-center mb-4">
  <button class="btn btn-outline-primary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
    🌐 {{ request('country') ?? 'All Destinations' }}
  </button>
  <ul class="dropdown-menu" aria-labelledby="filterDropdown">
    <li><a class="dropdown-item" href="{{ route('tours.index') }}">
      <img src="{{ asset('icons/flags/world.png') }}" width="20" class="me-2"> All Destinations
    </a></li>
    <li><a class="dropdown-item" href="{{ route('tours.index', ['country' => 'Thailand']) }}">
      <img src="{{ asset('icons/flags/thailand_flag.png') }}" width="20" class="me-2">TH-Thailand
    </a></li>
    <li><a class="dropdown-item" href="{{ route('tours.index', ['country' => 'Cambodia']) }}">
      <img src="{{ asset('icons/flags/cambodia_flag.png') }}" width="20" class="me-2">CAM-Cambodia
    </a></li>
    <li><a class="dropdown-item" href="{{ route('tours.index', ['country' => 'Vietnam']) }}">
      <img src="{{ asset('icons/flags/vietnam_flag.png') }}" width="20" class="me-2">VN-Vietnam
    </a></li>
    <li><a class="dropdown-item" href="{{ route('tours.index', ['country' => 'Laos']) }}">
      <img src="{{ asset('icons/flags/laos_flag.png') }}" width="20" class="me-2">LA-Laos
    </a></li>
  </ul>
</div>


    </form>
  </div>

  {{-- Page Heading --}}
  <div class="text-center mb-4">
    <h1 class="fw-bold display-5 mb-2">All Tours</h1>
    <p class="text-muted fs-5">Browse all our amazing tours by destination</p>
  </div>

  {{-- Tour Cards --}}
  <div class="row g-4">
    @forelse ($tours as $tour)
    <div class="col-md-6 col-lg-3">
      <div class="card shadow-sm h-100">
        @php
        $firstImage = $tour->images->first();
        $imgSrc = $firstImage
            ? asset("storage/eachTours/{$tour->id}/{$firstImage->filename}")
            : 'https://via.placeholder.com/300x200?text=No+Image';
        @endphp
        <img src="{{ $imgSrc }}" alt="{{ $tour->title }}" class="card-img-top" style="height: 200px; object-fit: cover;">
        <div class="card-body d-flex flex-column">
          <small class="text-muted">{{ $tour->duration ?? $tour->days }} DAY TOUR</small>
          <h6 class="fw-bold mt-1">{{ $tour->title }}</h6>
          <small class="text-muted">Valid on {{ \Carbon\Carbon::parse($tour->valid_date ?? now())->format('M d, Y') }}</small>
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
