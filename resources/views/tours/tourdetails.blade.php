@extends('layouts.app')

@section('head')
<link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">
<style>
  .sticky-book-btn {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 999;
    padding: 0.75rem 1.5rem;
    font-weight: bold;
  }
</style>
@endsection

@section('content')
<div class="container-fluid p-0">

  {{-- Hero Carousel --}}
  <div class="swiper hero-swiper">
    <div class="swiper-wrapper">
      @for ($i = 1; $i <= 5; $i++)
        @php
          $imgPath = "storage/eachTours/{$tour->id}/{$i}.jpg";
          $imgAbsolute = public_path($imgPath);
        @endphp
        @if (file_exists($imgAbsolute))
          <div class="swiper-slide">
            <img src="{{ asset($imgPath) }}" class="w-100" style="height: 450px; object-fit: cover;" alt="Tour Image {{ $i }}">
          </div>
        @endif
      @endfor
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>

  {{-- Thumbnails --}}
  <div class="d-flex justify-content-center gap-3 my-3">
    @for ($i = 1; $i <= 5; $i++)
      @php
        $thumbPath = "storage/eachTours/{$tour->id}/{$i}.jpg";
        $absolutePath = public_path($thumbPath);
      @endphp
      @if (file_exists($absolutePath))
        <img src="{{ asset($thumbPath) }}"
            data-index="{{ $i - 1 }}"
            class="thumbnail-img"
            style="width: 90px; height: 60px; object-fit: cover; cursor: pointer; border-radius: 5px; border: 2px solid #ddd;">
      @endif
    @endfor
  </div>

  <div class="container py-4">
    <h1 class="fw-bold">{{ $tour->title }}</h1>
    <p class="text-muted"><i class="bi bi-geo-alt"></i> {{ $tour->country }} • Start from {{ $tour->start_location }}</p>
    <h4 class="text-primary fw-bold">{{ number_format($tour->price, 2) }} ฿ per person</h4>

    {{-- Tabs --}}
    <ul class="nav nav-tabs mt-4" id="tourTabs" role="tablist">
      <li class="nav-item" role="presentation">
        <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#overview" type="button" role="tab">Overview</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#itinerary" type="button" role="tab">Itinerary</button>
      </li>
      <li class="nav-item" role="presentation">
        <button class="nav-link" data-bs-toggle="tab" data-bs-target="#faq" type="button" role="tab">FAQs</button>
      </li>
    </ul>
    <div class="tab-content p-4 border border-top-0">
      <div class="tab-pane fade show active" id="overview" role="tabpanel">
        <p>{{ $tour->overview ?? 'No overview available yet.' }}</p>
      </div>
      <div class="tab-pane fade" id="itinerary" role="tabpanel">
        <p>Sample itinerary will appear here.</p>
      </div>
      <div class="tab-pane fade" id="faq" role="tabpanel">
        <p>Q: What is included?<br>A: Accommodation, guide, transport.</p>
      </div>
    </div>

    
  </div>

<div class="container">
  <a href="{{ route('bookings.create', $tour->id) }}"
     class="btn btn-primary btn-lg w-100 mt-4">
    Book now – ฿{{ number_format($tour->price) }}
  </a>
</div>



</div>
<div class="container">
<a href="{{ route('tours.index') }}" class="btn btn-outline-secondary mt-4">← Back to All Tours</a>
</div>

@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  const heroSwiper = new Swiper('.hero-swiper', {
    loop: true,
    pagination: { el: '.swiper-pagination', clickable: true },
    navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
  });

  document.querySelectorAll('.thumbnail-img').forEach((thumb) => {
    thumb.addEventListener('click', function () {
      const index = parseInt(this.dataset.index);
      heroSwiper.slideToLoop(index);
    });
  });
</script>
@endsection
