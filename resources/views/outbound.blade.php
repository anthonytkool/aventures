@extends('layouts.app')

@section('content')
<div class="container py-5">
  <div class="text-center mb-5">
    <h1 class="fw-bold">Outbound Tours</h1>
    <p class="text-muted fs-5">Explore our exciting international tour packages.</p>
  </div>

  <div class="row g-4">
    @foreach ($outboundTours as $tour)
    <div class="col-md-4">
      <div class="card shadow-sm h-100 mb-0">
        <img src="{{ asset('storage/outbound/' . $tour['image']) }}" class="card-img-top" alt="{{ $tour['title'] }}" style="height: 250px; object-fit: cover;">
        <div class="card-body d-flex flex-column">
          <h5 class="fw-bold">{{ $tour['title'] }}</h5>
          <p class="text-muted">{{ $tour['desc'] }}</p>

          @if ($tour['pdf'])
            <a href="{{ asset('storage/outbound/' . $tour['pdf']) }}" target="_blank" 
            class="btn btn-success mt-auto" style="margin-bottom: 4px;">
              📄 Download PDF
            </a>
          @else
            <button class="btn btn-secondary mt-auto" disabled>
              🚫 Coming Soon
            </button>
          @endif
        </div>
      </div>
    </div>
    @endforeach
  </div>

  <div class="mt-5">
    @include('partials.announcement')
  </div>
</div>
@endsection
