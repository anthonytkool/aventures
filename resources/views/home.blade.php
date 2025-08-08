@extends('layouts.app')

@section('head')
<link href="https://cdn.jsdelivr.net/npm/lightbox2@2/dist/css/lightbox.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css" />
<style>
  .hero-video-container {
    position: relative;
    width: 100vw;
    max-width: 100vw;
    height: 75vh;
    overflow: hidden;

    margin-left: calc(50% - 50vw);
  }

  .hero-video-container video,
  .hero-video-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;

    z-index: 1;
  }



  .outbound-card .tour-img {
    width: 100%;
    height: 380px;
    /* 🔼 สูงขึ้นจาก 250 */
    object-fit: cover;
    border-top-left-radius: 8px;
    border-top-right-radius: 8px;
  }

  .outbound-card .tour-description {
    min-height: 3.6em;
    /* คงไว้ 4 บรรทัด */
    line-height: 1.2em;
    margin-bottom: 0.2rem;
    /* 🔽 ลดระยะห่างล่าง */
  }

  /* 
  .outbound-card {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    height: calc(100% + 20px);
    /* 🔼 เพิ่มสูงขึ้น */
  */ .glide__slide {
    height: 100%;
  }

  .glide__slide {
    display: flex;
    flex-direction: column;
    height: 100%;
  }

  .glide__slide>.card {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
  }


  .outbound-card {
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
  }



  .destination-card img {
    width: 100%;
    height: 240px;
    object-fit: cover;
  }



  .destination-card .card {
    height: 100%;
  }

  .destination-card .card-body {
    padding: 0;
  }


  .mute-toggle-btn {
    position: absolute;
    top: 15px;
    right: 15px;
    z-index: 10;
    background: rgba(0, 0, 0, 0.5);
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 6px 12px;
    font-weight: bold;
    cursor: pointer;
  }


  .glide__arrows {
    display: flex;
    justify-content: center;
    margin-top: 4px;
  }

  .glide__arrow {
    width: 3rem;
    height: 2.5rem;
    font-size: 1.2rem;
  }

  .glide-outbound .glide__slides {
    padding: 0 10%;
    display: flex !important;
    justify-content: center;
  }

  .hero-mobile-img {
    width: 100%;
    height: clamp(200px, 26vw, 360px);
    object-fit: cover;
    display: none;
  }

  .card {
    height: 100%;
    display: flex;
    flex-direction: column;
  }

  .card-body {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
  }

  .card-body .btn {
    margin-top: auto;
    /* ดันปุ่ม View itinerary ลงล่างสุด */
  }
</style>
@endsection

@section('content')
{{-- ✅ Mobile Hero Image --}}
<img src="{{ asset('assets/hero.png') }}" alt="Hero Image" class="hero-mobile-img">

{{-- ✅ Desktop Hero Video --}}
<div class="hero-video-container">
  <video id="heroVideo" autoplay muted loop playsinline>
    <source src="{{ asset('video/hero.mp4') }}" type="video/mp4">
  </video>
  <button id="muteToggle" class="mute-toggle-btn">🔇 Mute</button>
</div>


<div class="container">
  <div class="text-center" style="margin-top: px; margin-bottom: 1.5rem;">
    <h1 class="fw-bold display-5">Popular Tours</h1>
    <p class="text-muted fs-5"><b> Explore our most popular tours across Thailand and Indo-China, Don’t miss our best-selling tours!</b></p>
  </div>


  <div class="glide mb-5">
    <div class="glide__track" data-glide-el="track">
      <ul class="glide__slides">
        @forelse ($tours as $tour)

        <li class="glide__slide">
          <div class="card shadow-sm h-100 d-flex flex-column" style="min-width: 18rem;">

            @php
            $coverPath = 'storage/TourCovers/' . $tour->image;
            $durationDisplay = $tour->duration && trim($tour->duration) !== '1' ? $tour->duration : 'Full Day Tour';
            @endphp

            <img src="{{ asset($coverPath) }}" alt="{{ $tour->title }}">

            <div class="card-body d-flex flex-column">
              <small class="text-primary fw-bold">{{ $durationDisplay }}</small>

              <h5 class="fw-bold mt-1">{{ $tour->title }}</h5>

              <p class="fw-bold mt-2">
                {{ number_format($tour->price, 0) }} THB <span class="text-muted small ms-1">per person</span>
              </p>

              <div class="tour-highlight">
                <p>Just put some tour explanation or invitation here</p>
                <strong>Book now for the best experience!</strong>
              </div>

              @if ($tour->slug === 1)
              <p class="text-danger mb-0">
                Available Daily — Private Exclusive Tour
              </p>
              <p class="text-muted small">

                🏛️ Explore Grand Palace and Emerald Buddha - the ultimate symbol of Thailand’s royal legacy , Also visiting Wat Arun - Landmark of Bangkok, Reclining Buddha - Wat Pho
                Experience the Hidden Canal Life by longtail boat to cruise on Chao Phraya River and Thonburi Canals.
                🌟 The #1 Bangkok's Best-Selling One Day Tour!
                📍 Departs from Bangkok and returns the same day by private Van.<br>
                🚗 Includes hotel pickup & drop-off, or flexible drop-off anywhere in Bangkok.
              </p>
              @endif

              @if ($tour->slug === 2)
              <p class="text-danger mb-0">
                Available Daily — Private Cultural Experience
              </p>
              <p class="text-muted small">
                🚂 Train & Floating Market Adventure<br>
                🥥 Visit a Coconut Farm & See How Palm Sugar Is Made<br>
                🏡 Learn Authentic Thai Ways of Life <br>
                🌟 Most Popular & Iconic One Day Tour
              </p>
              📍 Departs from Bangkok and returns the same day.<br>
              🚗 Includes hotel pickup & drop-off, or flexible drop-off anywhere in Bangkok.
              </p>

              @endif

              @if ($tour->slug === 3)
              <p class="text-danger mb-0">
                📌 Advance Booking Required-Private Exclusive tour.
              </p>

              🏯 Journey through Thailand’s Ancient Empires — explore Ayutthaya's Royal Temples and the Phimai Historical Park.
              🌿 Discover the wild beauty of Khao Yai National Park, wildlife, and stunning nature.

              🌊 Cross into Laos and explore the Bolaven Plateau, visit Tad Fane Waterfall, coffee plantations, and experience local life.
              </p>
              @endif

              @if ($tour->slug === 7)
              <p class="text-danger mb-0">
                Advance Booking Recommended — Private Exclusive Tour
              </p>
              <p class="text-muted small">
                🛤️ Relive WWII History on the iconic Death Railway — visit the River Kwai Bridge, Hellfire Pass Memorial, and ride the original train route through Krasae Cave.
                <br>
                🚣‍♀️ Stay on unique Jungle Rafts floating hotel, surrounded by serene river views and green jungle scenery.
                <br>
                🌊 Discover hidden waterfalls, relax in nature, and experience the true story of courage and resilience.
              </p>


              @endif

              @if ($tour->slug === 4)
              <p class="text-danger mb-0">
                Advance Booking Recommended — Private Exclusive Tour
              </p>
              <p class="text-muted small">
                🌴 Discover Eastern Thailand’s Hidden Charms: br
                🏖️ Coastal beaches, countryside temples & vintage towns <br>
                🏡 Stay local — enjoy homestays & seafood by the sea
                🍍 Taste fresh tropical fruits right from the orchard<br>
                🎨 Walk charming old streets & explore unique local markets<br>
                🌿 Break Free from Bangkok — Enjoy Nature, Culture & Local Life in One Trip!
                🚗 Private trip with flexible pace — perfect for family & friends
              </p>
              @endif

              @if ($tour->slug === 5)
              <p class="text-danger mb-0">
                Booking opens — confirmed once group is formed.
              </p>
              <p class="text-muted small">
                🏍️ Ride across Thailand, Laos & Vietnam in 8 days — unforgettable journey<br>
                🏯 Explore ancient temples, scenic waterfalls & lush jungles<br>
                🏞️ Experience authentic local life, charming old towns & riverside stays<br>
                🍜 Taste iconic street food in 3 countries — adventure for true explorers!<br>
                ✈️ Perfect cross-border trip with flexible start dates & group booking options <br>
                🌏 "The Ultimate Bucket List Journey — 3 Nations, 1 Epic Ride of a Lifetime!"
              </p>
              @endif


              @if ($tour->slug === 6)
              <p class="text-danger mb-0">
                Available Daily — Private Exclusive Day Trip
              </p>
              <!-- <p class="text-muted small"> -->

              <p class="text-muted small">
                🏛️ Step back in time and explore the Ancient Capital of Siam — Discover Ancient Temples & Historical of Siam, Visit majestic temples, royal monasteries, and UNESCO World Heritage ruins.
                <br>

                📸 Perfect for history lovers and culture explorers who want a rich and memorable experience in just one day.
              </p>
              <p>🚗 Pick up at the hotel from Bangkok and Return Same Day.</p>

              @endif


              <small class="text-muted">*Approx. $1 = 33 THB for your reference</small>


              <a href="{{ route('tour.show', ['slug' => $tour->slug]) }}" class="btn btn-primary btn-sm mt-2">
                View itinerary
              </a>


            </div>
          </div>
        </li>
        @empty
        <div class="text-center text-muted py-5">
          No tours available at the moment. Please check back soon.
        </div>
        @endforelse
      </ul>

    </div>
    <div class="glide__arrows" data-glide-el="controls">
      <button class="glide__arrow glide__arrow--left btn btn-light shadow-sm" data-glide-dir="<">&larr;</button>
      <button class="glide__arrow glide__arrow--right btn btn-light shadow-sm" data-glide-dir=">">&rarr;</button>
    </div>
  </div>
</div>

<section class="bg-light py-2">
  <div class="container">
    <div class="text-center mb-4">
      <h2 class="fw-bold">Why travel with AventureTrip?</h2>
      <p class="fs-5 text-muted">As Southeast Asia travel experts, we design every tour with safety, comfort, and authentic experiences in mind.</p>
    </div>
    <div class="row g-4">
      @foreach ([
      ['icon' => 'people-fill', 'title' => 'Small Groups', 'desc' => 'Join like-minded travelers and enjoy personalized experiences.'],
      ['icon' => 'shield-check', 'title' => 'Guaranteed Departures', 'desc' => 'Book with confidence — our tours run as scheduled.'],
      ['icon' => 'person-lines-fill', 'title' => 'Local Guides', 'desc' => 'Our local guides bring unmatched knowledge.'],
      ['icon' => 'house-heart', 'title' => 'Community Support', 'desc' => 'We give back to the communities you visit.'],
      ['icon' => 'airplane', 'title' => 'Flexible Itineraries', 'desc' => 'Balanced adventure and leisure for your pace.'],
      ['icon' => 'globe', 'title' => 'Sustainable Travel', 'desc' => 'We prioritize eco-friendly, carbon-conscious travel.'],
      ] as $feature)
      <div class="col-md-4">
        <div class="p-4 rounded shadow-sm h-100" style="background-color: #ffd93d;">
          <div class="mb-3"><i class="bi bi-{{ $feature['icon'] }} fs-1 text-primary"></i></div>
          <h5 class="fw-bold text-dark">{{ $feature['title'] }}</h5>
          <p class="text-dark">{{ $feature['desc'] }}</p>
        </div>
      </div>
      @endforeach
    </div>
  </div>
</section>


<section class="container my-3">
  <h2 class="text-center fw-bold mb-4">Photo Gallery</h2>
  <div class="row g-3 justify-content-center">
    @foreach (["gallery1.jpg","gallery2.jpg","gallery3.jpg","gallery4.jpg","gallery5.jpg","gallery6.jpg","gallery7.jpg","gallery8.jpg"] as $img)
    <div class="col-6 col-md-4 col-lg-3">
      <a href="{{ asset('storage/gallery/' . $img) }}" data-lightbox="gallery" data-title="{{ $img }}">
        <img src="{{ asset('storage/gallery/' . $img) }}" class="img-fluid rounded shadow-sm" style="aspect-ratio:4/3;object-fit:cover" alt="gallery">
      </a>
    </div>
    @endforeach
  </div>
</section>

<section class="container my-5 text-center">
  <h2 class="fw-bold">Explore by Destination</h2>
  <p class="text-muted fs-5">Choose a country to discover amazing tours</p>
  <div class="row justify-content-center g-4 mt-4">
    @php
    $destinations = [
    ['label' => 'Thailand', 'img' => 'thailand.png', 'link' => route('tours.index', ['country' => 'Thailand'])],
    ['label' => 'Cross-Border Trips Series', 'img' => 'series.jpg', 'link' => route('tours.index', ['country' => 'Cross-Border Trips Series'])],
    ['label' => 'Vietnam', 'img' => 'vietnam.jpg', 'link' => url('/tours/5')], // <-- ลิงก์ตรง
      ['label'=> 'Laos', 'img' => 'laos.jpg', 'link' => url('/tours/3')], // <-- ลิงก์ตรง
        ];
        @endphp

        <div class="row justify-content-center g-4 mt-4">
        @foreach ($destinations as $d)
        <div class="col-md-3 destination-card">
          <a href="{{ $d['link'] }}" class="text-decoration-none">
            <div class="card shadow-sm">
              <img src="{{ asset('storage/assets/' . $d['img']) }}" alt="{{ $d['label'] }}">
              <div class="bg-dark text-white py-2 fw-bold text-center">
                {{ $d['label'] }}
              </div>
            </div>
          </a>
        </div>
        @endforeach
  </div>


</section>

@if (isset($outboundTours) && count($outboundTours))
<section class="container my-5">
  <div class="text-center mb-4">
    <h2 class="fw-bold">Outbound Tours 🌐 ทัวร์ต่างประเทศ</h2>
    <p class="text-muted fs-5">Exciting international tour packages now available | แพ็กเกจทัวร์ต่างประเทศสุดตื่นเต้น พร้อมให้คุณจองแล้ววันนี้!
    </p>
  </div>
  <div class="position-relative pb-2">
    <div class="glide glide-outbound">
      <div class="glide__track" data-glide-el="track">
        <ul class="glide__slides">
          @foreach ($outboundTours as $tour)
          <li class="glide__slide h-100">
            <div class="card h-100 outbound-card w-100 d-flex flex-column justify-content-between">

              <img src="{{ asset('storage/highlight-outbounds/' . $tour['image']) }}" class="tour-img" alt="{{ $tour['title'] }}">
              <div class="card-body d-flex flex-column" style="min-height: 300px;">
                <h5 class="card-title fw-bold">{{ $tour['title'] }}</h5>
                <p class="card-text tour-description">{{ $tour['desc'] }}</p>
                @if ($tour['pdf'])
                <a href="{{ asset('storage/highlight-outbounds/' . $tour['pdf']) }}" class="btn btn-success mt-auto" target="_blank">
                  <i class="bi bi-file-earmark-pdf"></i> Download PDF
                </a>
                @endif
              </div>
            </div>

          </li>
          @endforeach
        </ul>
      </div>
      <div class="d-flex flex-column align-items-center mt-2">
        <div class="glide__arrows mb-2" data-glide-el="controls">
          <button class="glide__arrow glide__arrow--left btn btn-outline-secondary me-2" data-glide-dir="<">⬅</button>
          <button class="glide__arrow glide__arrow--right btn btn-outline-secondary" data-glide-dir=">">➡</button>
        </div>
        <a href="{{ route('outbounds') }}" class="btn btn-outline-primary">ดูทัวร์ต่างประเทศทั้งหมด</a>
      </div>
    </div>
  </div>
</section>
@endif


@include('partials.announcement')
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/lightbox2@2/dist/js/lightbox-plus-jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
<script>
  new Glide('.glide', {
    type: 'carousel',
    perView: 4,
    gap: 20,
    autoplay: 4000,
    hoverpause: true,
    breakpoints: {
      1200: {
        perView: 3
      },
      992: {
        perView: 2
      },
      576: {
        perView: 1
      }
    }
  }).mount();

  new Glide('.glide-outbound', {
    type: 'carousel',
    perView: 3,
    gap: 20,
    autoplay: 4000,
    hoverpause: true,
    breakpoints: {
      1200: {
        perView: 2
      },
      768: {
        perView: 1
      }
    }
  }).mount();

  const heroVideo = document.getElementById('heroVideo');
  const muteToggle = document.getElementById('muteToggle');
  muteToggle.addEventListener('click', () => {
    heroVideo.muted = !heroVideo.muted;
    muteToggle.innerText = heroVideo.muted ? '🔇 Mute' : '🔊 Unmute';
  });
</script>
@endsection