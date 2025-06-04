@extends('layouts.app')

@section('content')
<div class="container">

  {{-- Hero Image Carousel --}}
  <div id="tourCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset($tour->image_url) }}" class="d-block w-100 rounded shadow" style="height: 450px; object-fit: cover;" alt="{{ $tour->title }}">
      </div>
      {{-- หากคุณมีรูปหลายรูป สามารถ loop เพิ่มได้ที่นี่ --}}
      {{-- <div class="carousel-item"><img src="..." /></div> --}}
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#tourCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#tourCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>

  {{-- Tour Overview --}}
  <div class="mb-4">
    <h2 class="fw-bold">{{ $tour->title }}</h2>
    <p class="text-muted"><i class="bi bi-geo-alt-fill text-primary"></i> {{ $tour->country }} • Start from {{ $tour->start_location }}</p>
    <p class="h4 text-primary fw-bold">{{ number_format($tour->price, 2) }} ฿ <small class="text-muted fs-6">per person</small></p>
  </div>

  {{-- Tabs --}}
  <ul class="nav nav-tabs mb-3" id="tourTab" role="tablist">
    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#overview">Overview</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#itinerary">Itinerary</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#additional">More Info</a></li>
  </ul>
  <div class="tab-content">
    <div class="tab-pane fade show active" id="overview">
      <p>{{ $tour->overview ?? 'No overview available yet.' }}</p>
    </div>
    <div class="tab-pane fade" id="itinerary">
      <p>Example itinerary coming soon...</p>
    </div>
    <div class="tab-pane fade" id="additional">
      <p>Additional information or FAQs will be shown here.</p>
    </div>
  </div>

  <a href="{{ route('tours.index') }}" class="btn btn-outline-secondary mt-4"><i class="bi bi-arrow-left"></i> Back to All Tours</a>
</div>
@endsection
