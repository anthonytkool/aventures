@extends('layouts.app')

@section('head')
<link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid p-0">
  {{-- Hero Carousel --}}
  <div class="swiper hero-swiper">
    <div class="swiper-wrapper">
      @foreach (range(1, 5) as $i)
        <div class="swiper-slide">
          <img src="{{ asset('storage/assets/sample' . $i . '.jpg') }}" class="w-100" style="height: 400px; object-fit: cover;" alt="Tour Image {{ $i }}">
        </div>
      @endforeach
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>

  <div class="container py-5">
    <h1 class="fw-bold">{{ $tour->title }}</h1>
    <p class="text-muted"><i class="bi bi-geo-alt"></i> {{ $tour->country }} • Start from {{ $tour->start_location }}</p>
    <h4 class="text-primary fw-bold">{{ number_format($tour->price, 2) }} ฿ per person</h4>

    <ul class="nav nav-tabs mt-4" id="tourTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab">Overview</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="itinerary-tab" data-bs-toggle="tab" data-bs-target="#itinerary" type="button" role="tab">Itinerary</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" id="faq-tab" data-bs-toggle="tab" data-bs-target="#faq" type="button" role="tab">FAQs</button>
      </li>
    </ul>
    <div class="tab-content p-4 border border-top-0" id="tourTabsContent">
      <div class="tab-pane fade show active" id="overview" role="tabpanel">
        <h5 class="fw-bold">Tour Overview</h5>
        <p>{{ $tour->full_description ?? 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio.' }}</p>
      </div>
      <div class="tab-pane fade" id="itinerary" role="tabpanel">
        <h5 class="fw-bold">Sample Itinerary</h5>
        <ul>
          @for ($d = 1; $d <= $tour->days; $d++)
            <li><strong>Day {{ $d }}:</strong> Activity for day {{ $d }} (you can update this later)</li>
          @endfor
        </ul>
      </div>
      <div class="tab-pane fade" id="faq" role="tabpanel">
        <h5 class="fw-bold">Frequently Asked Questions</h5>
        <p>Q: What is included?<br>A: Accommodation, guide, transport.</p>
        <p>Q: Can I cancel the trip?<br>A: Yes, up to 7 days before departure.</p>
      </div>
    </div>

    <a href="{{ route('tours.index') }}" class="btn btn-outline-secondary mt-4">← Back to All Tours</a>
  </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  new Swiper('.hero-swiper', {
    loop: true,
    pagination: { el: '.swiper-pagination', clickable: true },
    navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
  });
</script>
@endsection