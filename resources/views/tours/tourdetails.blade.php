@extends('layouts.app')

@section('head')
<link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">

  {{-- ✅ Hero Section --}}
  @php
    $imagePath = 'storage/eachTours/' . $tour->id;
    $fullPath = public_path($imagePath);
    $images = [];

    if (file_exists($fullPath) && is_dir($fullPath)) {
      $files = scandir($fullPath);
      foreach ($files as $file) {
        if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg','jpeg','png','gif'])) {
          $images[] = asset($imagePath . '/' . $file);
        }
      }
      sort($images);
    }
  @endphp

  @if(count($images))
  <div class="swiper hero-swiper rounded" style="background-color: #f8f8f8;">
    <div class="swiper-wrapper">
      @foreach ($images as $img)
      <div class="swiper-slide d-flex align-items-center justify-content-center">
        <img src="{{ $img }}" style="max-height: 500px; max-width: 100%; object-fit: contain; border-radius: 8px;">
      </div>
      @endforeach
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>

  <div class="d-flex justify-content-center gap-2 mt-3">
    @foreach($images as $index => $img)
      <img src="{{ $img }}" data-index="{{ $index }}" class="thumbnail-img"
           style="width: 90px; height: 60px; object-fit: cover; cursor: pointer; border: 2px solid #ccc; border-radius: 4px;">
    @endforeach
  </div>
  @endif

  {{-- ✅ Title & Price --}}
  <p class="h5 fw-bold text-primary mb-0 me-2">
    {{ number_format($tour->price) }} THB / person
  </p>

  <div class="text-muted small">
    @if(in_array($tour->id, [1,2,6]))
      <b>(minimum 2 pax)</b> |
    @endif
    Start from Bangkok
  </div>

  {{-- ✅ Show group info for ID 3,5 --}}
  @if(in_array($tour->id, [3,5]))
    <div class="text-danger small mt-1">📌 <b>Booking opens — confirmed once group is formed</b></div>
    <div class="text-muted small">🗓️<b> Group Dates: Oct 1–8, Oct 15–22, Nov 1–8, Nov 15–22, Dec 1–8</b></div>
  @endif

  {{-- ✅ Tabs --}}
  <ul class="nav nav-tabs mb-3 mt-4" id="tourTab" role="tablist">
    <li class="nav-item"><a class="nav-link active" data-bs-toggle="tab" href="#overview">Overview</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#itinerary">Itinerary</a></li>
    <li class="nav-item"><a class="nav-link" data-bs-toggle="tab" href="#faqs">FAQs</a></li>
  </ul>

  <div class="tab-content" id="tourTabContent">

    {{-- ✅ Overview Tab --}}
    <div class="tab-pane fade show active" id="overview">
      <h4 class="fw-bold text-primary mt-4">{{ $tour->title }}</h4>
      @if($tour->overview)
        {!! nl2br(e($tour->overview)) !!}
      @else
        <p>Overview information is being prepared. Please check back soon.</p>
      @endif

{{-- ✅ Group Pricing Table --}}
@if($tour->prices && $tour->prices->count())
<div class="mt-4">
  <h5 class="fw-bold mb-3">💰 Group Pricing Table</h5>
  <table class="table table-bordered table-striped table-hover">
    <thead class="table-primary">
      <tr>
        <th class="text-center" style="width: 10%;">No.</th>
        <th style="width: 60%;">👥 Group Size (Pax)</th>
        <th class="text-end" style="width: 30%;">💵 Price per Person</th>
      </tr>
    </thead>
    <tbody>
      @foreach($tour->prices->sortBy('pax_min') as $index => $price)
      <tr>
        <td class="text-center fw-bold">{{ $index + 1 }}</td>
        <td>{{ $price->pax_min }}{{ $price->pax_min != $price->pax_max ? ' - ' . $price->pax_max : '' }} pax</td>
        <td class="text-end fw-bold">{{ number_format($price->price_per_person) }} THB</td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <p class="text-muted small">* Prices are per person and apply to the group size range shown. Minimum 2 pax required to operate.</p>
</div>
@endif


    </div>

    {{-- ✅ Itinerary Tab --}}
    <div class="tab-pane fade" id="itinerary">
      <h4 class="fw-bold text-primary mt-4">Sample Itinerary</h4>
      @if($tour->itinerary)
        {!! nl2br(e($tour->itinerary)) !!}
      @else
        <p class="text-muted">Itinerary information is being prepared. Please check back soon.</p>
      @endif
    </div>

    {{-- ✅ FAQs Tab --}}
    <div class="tab-pane fade" id="faqs">
      <h4 class="fw-bold text-primary mt-4">Frequently Asked Questions</h4>
      @if($tour->faqs)
        {!! nl2br(e($tour->faqs)) !!}
      @else
        <p class="text-muted">Frequently asked questions will be available soon.</p>
      @endif
    </div>
  </div>

  {{-- ✅ Booking Button --}}
  <div class="text-center mt-4">
    <a href="/contact" class="btn btn-primary btn-lg w-100" style="color: yellow;">
      Book now!
    </a>
    <p class="text-muted mt-2"><b>Advance booking is required – please contact us to confirm your spot.</b></p>
  </div>

  <div class="mt-3">
    <a href="{{ route('tours.index') }}" class="btn btn-outline-secondary">&larr; Back to All Tours</a>
  </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function() {
    const heroSwiper = new Swiper('.hero-swiper', {
      loop: false,
      pagination: {
        el: '.swiper-pagination',
        clickable: true
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
    });

    document.querySelectorAll('.thumbnail-img').forEach((thumb) => {
      thumb.addEventListener('click', function() {
        const index = parseInt(this.dataset.index);
        heroSwiper.slideTo(index);
      });
    });
  });
</script>
@endsection
