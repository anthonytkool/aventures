{{-- ✅ ใช้ไฟล์ที่คุณให้มา แล้วลบส่วนแสดงราคาใน Itinerary & FAQ ออก --}}

@extends('layouts.app')

@section('head')
<link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">
  {{-- ✅ Hero Section --}}
  @php
  $imagePath = 'storage/eachTours/' . $tour->id;
  $fullPath = public_path('storage/eachTours/' . $tour->id);
  $images = [];

  if (file_exists($fullPath) && is_dir($fullPath)) {
    $files = scandir($fullPath);
    foreach ($files as $file) {
      if (in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif'])) {
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
        <img src="{{ $img }}" alt="Tour Image" style="max-height: 500px; max-width: 100%; object-fit: contain; border-radius: 8px;">
      </div>
      @endforeach
    </div>
    <div class="swiper-pagination"></div>
    <div class="swiper-button-next"></div>
    <div class="swiper-button-prev"></div>
  </div>

  <div class="d-flex justify-content-center gap-2 mt-3">
    @foreach($images as $index => $img)
    <img src="{{ $img }}" data-index="{{ $index }}" class="thumbnail-img" style="width: 90px; height: 60px; object-fit: cover; cursor: pointer; border: 2px solid #ccc; border-radius: 4px;">
    @endforeach
  </div>
  @endif

  {{-- ✅ Title & Price --}}
  <div class="d-flex justify-content-between align-items-center flex-wrap">
  <h4 class="text-primary mb-2">
    5,250 THB / person <span class="text-muted small">(minimum 2 people)</span><br>
    <span class="text-muted small">* Lower price applies for larger groups — see table below</span>
  </h4>

  <div class="bg-light text-dark border rounded px-3 py-2 small">
    <strong>Available:</strong> "August 15st to December 23rd, daily."
  </div>
</div>


  {{-- ✅ Tabs --}}
  <ul class="nav nav-tabs mb-3" id="tourTab" role="tablist">
    <li class="nav-item"><a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview">Overview</a></li>
    <li class="nav-item"><a class="nav-link" id="itinerary-tab" data-bs-toggle="tab" href="#itinerary">Itinerary</a></li>
    <li class="nav-item"><a class="nav-link" id="faq-tab" data-bs-toggle="tab" href="#faq">FAQs</a></li>
  </ul>

  <div class="tab-content" id="tourTabContent">
    {{-- ✅ Overview --}}
    <div class="tab-pane fade show active" id="overview">
      <h4>Overview</h4>

      @if($tour->overview)
        {!! $tour->overview !!}
      @else
        <p class="text-muted">Overview information is being prepared. Please check back soon.</p>
      @endif

      {{-- ✅ Group Pricing Table แสดงที่นี่เท่านั้น --}}
      @if($tour->prices && $tour->prices->count())
        <div class="mt-4">
            <h5 class="fw-bold mb-3">💰 Group Pricing Table</h5>
            <table class="table table-bordered table-sm">
                <thead class="table-light">
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Number of Pax</th>
                        <th scope="col">Price per Person</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tour->prices->sortBy('pax_min') as $index => $price)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $price->pax_min }}{{ $price->pax_min != $price->pax_max ? ' - ' . $price->pax_max : '' }} pax</td>
                            <td>{{ number_format($price->price_per_person) }} THB</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <p class="text-muted small">* Prices are per person and apply to the group size range shown.</p>
        </div>
      @endif
    </div>

    {{-- ✅ Itinerary --}}
    <div class="tab-pane fade" id="itinerary">
      <h4>Sample Itinerary</h4>
      @if($tour->itinerary)
        {!! $tour->itinerary !!}
      @else
        <p class="text-muted">Itinerary information is being prepared. Please check back soon.</p>
      @endif
    </div>

    {{-- ✅ FAQ --}}
    <div class="tab-pane fade" id="faq">
      <h4>Frequently Asked Questions</h4>
      @if($tour->faq)
        {!! $tour->faq !!}
      @else
        <p class="text-muted">Frequently asked questions will be available soon.</p>
      @endif
    </div>
  </div>

  {{-- ✅ Book Button --}}
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
