@extends('layouts.app')

@section('head')
<link href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container">

  {{-- ✅ Hero Section with Swiper --}}
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
      <div class="swiper-slide d-flex align-items-center justify-content-center" style="background-color: #f8f8f8;">
        <img src="{{ $img }}" 
             alt="Tour Image" 
             style="max-height: 500px; max-width: 100%; object-fit: contain; border-radius: 8px;">
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

  {{-- ✅ Title and Details --}}
  <div class="mb-4">
    <h1 class="text-start">{{ $tour->title }}</h1>
    <p class="text-muted text-start">{{ $tour->country }} • Start from {{ $tour->start_location }}</p>
    <h4 class="text-primary text-start">{{ number_format($tour->price, 2) }} ฿ / per person</h4>
  </div>

  {{-- ✅ Available Departures --}}
  @if($tour->departures->count())
  <div class="my-4">
    <h5>🗓 Available Departures</h5>
    <div class="d-flex flex-wrap gap-2 mt-2">
      @php
        $grouped = $tour->departures->where('start_date', '>', now())->groupBy(fn($d) => \Carbon\Carbon::parse($d->start_date)->format('F Y'));
      @endphp

      @foreach($grouped as $month => $list)
        @php $lowestPrice = $list->min('price'); @endphp
        <a href="{{ url('/bookings/' . $tour->id . '?month=' . urlencode($month)) }}" class="btn btn-outline-primary btn-sm">
          {{ $month }} – From ฿{{ number_format($lowestPrice, 0) }} – Book Now
        </a>
      @endforeach
    </div>
  </div>
  @endif

  {{-- ✅ Tabs --}}
  <ul class="nav nav-tabs mb-3" id="tourTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="overview-tab" data-bs-toggle="tab" href="#overview">Overview</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="itinerary-tab" data-bs-toggle="tab" href="#itinerary">Itinerary</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="faq-tab" data-bs-toggle="tab" href="#faq">FAQs</a>
    </li>
  </ul>

  <div class="tab-content" id="tourTabContent">
    <div class="tab-pane fade show active" id="overview">
      <p>{{ $tour->full_description ?? 'No overview available.' }}</p>
    </div>
    <div class="tab-pane fade" id="itinerary">
      <ul>
        @for ($d = 1; $d <= $tour->days; $d++)
          <li><strong>Day {{ $d }}:</strong> Activity for day {{ $d }}</li>
        @endfor
      </ul>
    </div>
    <div class="tab-pane fade" id="faq">
      <p>Q: What is included?<br>A: Accommodation, guide, transport.</p>
      <p>Q: Can I cancel?<br>A: Yes, up to 7 days before departure.</p>
    </div>
  </div>

  {{-- ✅ Booking Button --}}
  @php
  $upcomingDeparture = $tour->departures->where('start_date', '>', now())->sortBy('start_date')->first();
  $monthParam = $upcomingDeparture ? \Carbon\Carbon::parse($upcomingDeparture->start_date)->format('F Y') : '';
  @endphp

  <div class="text-center mt-4">
    @if($upcomingDeparture)
      <a href="{{ url('/bookings/' . $tour->id . '?month=' . urlencode($monthParam)) }}" class="btn btn-primary btn-lg w-100">
        Book now – ฿{{ number_format($upcomingDeparture->price, 0) }}
      </a>
    @else
      <button class="btn btn-secondary btn-lg w-100" disabled>No departures available</button>
    @endif
  </div>

  <div class="mt-3">
    <a href="{{ route('tours.index') }}" class="btn btn-outline-secondary">&larr; Back to All Tours</a>
  </div>

</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const heroSwiper = new Swiper('.hero-swiper', {
      loop: false,
      pagination: { el: '.swiper-pagination', clickable: true },
      navigation: { nextEl: '.swiper-button-next', prevEl: '.swiper-button-prev' },
    });

    document.querySelectorAll('.thumbnail-img').forEach((thumb) => {
      thumb.addEventListener('click', function () {
        const index = parseInt(this.dataset.index);
        heroSwiper.slideTo(index);
      });
    });
  });
</script>
@endsection
