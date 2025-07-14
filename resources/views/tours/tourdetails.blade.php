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
<div class="mb-4">
  <h1 class="text-start">{{ $tour->title }}</h1>
  <p class="text-muted text-start">{{ $tour->country }} • Start from {{ $tour->start_location }}</p>
  <div class="d-flex justify-content-between align-items-center flex-wrap">
    <h4 class="text-primary mb-2">{{ number_format($tour->price, 2) }} THB / per person</h4>
    <div class="bg-light text-dark border rounded px-3 py-2 small">
      <strong>Available:</strong> 20 Jul, 24 Jul, 28 Jul
    </div>
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
    <p>
      Cruise through the Chao Phraya River on a private longtail boat, discovering the hidden beauty of Bangkok's canals and riverside life. This tour blends Thai heritage with royal landmarks such as the Grand Palace, Emerald Buddha Temple, and Wat Pho. Cross the river to explore Wat Arun (Temple of Dawn), then visit the majestic Royal Barge Museum.
    </p>

    {{-- ✅ เพิ่มหัวข้อก่อนย่อหน้า 2 --}}
    <h5>Why You’ll Love This Experience</h5>
    <p>
      Thailand – a country of golden temples, rich traditions, and friendly locals. In just one day, you'll dive into the nation's spiritual essence, historical wonders, and peaceful canals. Whether you're a first-timer or a returning visitor, this tour opens a window into authentic Thai life that most tourists never see. It’s more than sightseeing – it’s storytelling, it’s culture, it’s connection. Book now to unlock a truly immersive day you'll never forget.
    </p>
  </div>


    {{-- ✅ Itinerary & Pricing --}}
    <div class="tab-pane fade" id="itinerary">
      <h4>Sample Itinerary</h4>
      <ul class="list-unstyled">
        <li><strong>08:00</strong> – Hotel pickup in Bangkok</li>
        <li><strong>08:30</strong> – Arrive at River City Pier and board private longtail boat</li>
        <li><strong>09:00</strong> – Canal tour with fish feeding and visit to Royal Barge Museum</li>
        <li><strong>10:30</strong> – Visit the Grand Palace and Temple of the Emerald Buddha</li>
        <li><strong>12:30</strong> – Free time for lunch (not included)</li>
        <li><strong>14:00</strong> – Explore Wat Pho, home to the Reclining Buddha</li>
        <li><strong>15:30</strong> – Cross river to Wat Arun (Temple of Dawn)</li>
        <li><strong>16:30</strong> – Return to hotel</li>
      </ul>

      <h4 class="mt-4">Pricing & Private Experience</h4>
      <p>This is a fully private tour – no other travelers will join. You’ll travel in a private vehicle and boat, guided by a licensed English-speaking tour guide.</p>
      <table class="table table-bordered">
        <thead><tr><th>Group Size</th><th>Price per Person</th><th>Total (approx.)</th></tr></thead>
        <tbody>
          <tr><td>1 person</td><td>8,500 THB</td><td>8,500 THB</td></tr>
          <tr><td>2 persons</td><td>5,250 THB</td><td>10,500 THB</td></tr>
          <tr><td>3 persons</td><td>4,250 THB</td><td>12,750 THB</td></tr>
          <tr><td>4 persons</td><td>3,850 THB <span class="badge bg-success">Best Value</span></td><td>15,400 THB</td></tr>
          <tr><td>5–6 persons</td><td>~4,000 THB</td><td>~17,000 – 20,400 THB</td></tr>
          <tr><td>7–9 persons</td><td>~2,800 THB</td><td>~19,600 – 25,200 THB</td></tr>
        </tbody>
      </table>
      <small class="text-muted d-block">*All prices are for a private tour with a personal guide, private boat, and no hidden fees.</small>
    </div>

    {{-- ✅ FAQ --}}
    <div class="tab-pane fade" id="faq">
      <h4>Is this tour for me?</h4>
      <p>This private tour is ideal for travelers seeking a comfortable and culturally rich day in Bangkok. With minimal walking, air-conditioned transport, and a professional English-speaking guide, it’s perfect for families, seniors, and first-time visitors.</p>

      <h5>Tour Style</h5>
      <p><strong>Classic</strong> – Iconic temples, canals, history, and access to cultural gems all in one day.</p>

      <h5>Service Level</h5>
      <p><strong>Premium Private</strong> – Private vehicle, licensed guide, and flexible itinerary.</p>

      <h5>Physical Rating</h5>
      <p><strong>1 – Very Easy</strong> – Light walking and boat rides. Suitable for most fitness levels.</p>

      <h5>Trip Type</h5>
      <p><strong>Private Tour</strong> – Just your group. No strangers. Fully guided.</p>

      <h5>Age Requirement</h5>
      <p>All ages welcome. Children under 12 must be accompanied by an adult.</p>

      <h5>What's Included</h5>
      <ul>
        <li>Round-trip air-conditioned transfers</li>
        <li>English-speaking tour guide</li>
        <li>Private longtail boat ride</li>
        <li>All entrance fees</li>
        <li>1 bottle of drinking water and cold towel</li>
        <li>Basic travel insurance</li>
      </ul>

      <h5>What's Not Included</h5>
      <ul>
        <li>Lunch and personal expenses</li>
        <li>Tipping (optional)</li>
        <li>Additional activities not mentioned in the program</li>
      </ul>

      <h5>Dress Code</h5>
      <p>Please wear appropriate clothing to visit temples – no sleeveless tops or short pants. Closed shoes are recommended.</p>

      <h5>What to Bring</h5>
      <ul>
        <li>Sunblock, hat, and sunglasses or umbrella</li>
        <li>Personal medicine if needed</li>
      </ul>

      <h5>👤 Solo Traveler Notice</h5>
      <p>If you’re traveling solo and would like to take this tour privately, please <a href="/contact">contact us</a> for customized arrangements and pricing.</p>

      <h5>🌟 Child Pricing</h5>
      <p>Children under 5 join for free. Children aged 6–11 enjoy a 30% discount when traveling with 2 or more adults.</p>
    </div>
  </div>

  {{-- ✅ Book Button --}}
  <div class="text-center mt-4">
    <a href="/contact" class="btn btn-primary btn-lg w-100" style="color: yellow;">
      Book now!
    </a>
    <p class="text-muted mt-2">Available next dates: 20 Jul, 24 Jul, 28 Jul – please contact us to confirm your spot.</p>
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
