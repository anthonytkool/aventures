@extends('layouts.app')

@section('head')
<link href="https://cdn.jsdelivr.net/npm/lightbox2@2/dist/css/lightbox.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css" />
<style>
  .hero-video-container {
    position: relative;
    width: 100vw;
    max-width: 100vw;
    height: 65vh;
    overflow: hidden;
    margin-left: calc(50% - 50vw);
  }

  .hero-video-container video,
  .hero-video-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
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

  @media (max-width: 768px) {
    .hero-video-container video {
      display: none;
    }

    .hero-video-container img {
      display: block;
    }
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
</style>
@endsection

@section('content')
<div class="container-fluid px-0">
  <div class="hero-video-container">
    <video id="heroVideo" autoplay muted loop playsinline>
      <source src="{{ asset('video/hero.mp4') }}" type="video/mp4">
    </video>
    <img src="{{ asset('storage/assets/hero.png') }}" alt="Hero Image" class="img-fluid d-block d-md-none">
    <button id="muteToggle" class="mute-toggle-btn">🔇 Mute</button>
  </div>
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
    {{-- ✅ ใส่การ์ดทัวร์ของคุณไว้เหมือนเดิม --}}
    <div class="card shadow-sm mx-2" style="min-width: 18rem;">
      @php
        $coverPath = 'storage/TourCover/' . $tour->id . '.jpg';
        $imgSrc = asset($coverPath);
      @endphp

      <img src="{{ $imgSrc }}" alt="{{ $tour->title }}" onerror="this.onerror=null; this.src='https://via.placeholder.com/300x200?text=No+Image';" class="card-img-top" style="height:220px; object-fit:cover;">

      <div class="card-body d-flex flex-column">
        <small class="text-primary"><b>{{ $tour->id == 4 || $tour->id == 5 ? '3 Days 2 Nights' : 'Full Day Tour' }}</b></small>
        <h6 class="fw-bold">{{ $tour->title }}</h6>
        <small class="text-muted">Available on {{ \Carbon\Carbon::parse($tour->valid_date ?? now())->format('M d, Y') }}</small>
        <p class="fw-bold mt-2">${{ number_format($tour->price, 2) }} <span class="text-muted small">per person</span></p>
        <a href="{{ route('tours.show', $tour->id) }}" class="btn btn-outline-primary btn-sm mt-auto">View itinerary</a>
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
    @foreach ([
    ['country' => 'Thailand', 'img' => 'thailand.png'],
    ['country' => 'Cambodia', 'img' => 'cambodia.jpg'],
    ['country' => 'Vietnam', 'img' => 'vietnam.jpg'],
    ['country' => 'Laos', 'img' => 'laos.jpg'],
    ] as $c)
    <div class="col-md-3">
      <a href="{{ route('tours.index', ['country' => $c['country']]) }}" class="text-decoration-none">
        <div class="card shadow-sm">
          <img src="{{ asset('storage/assets/' . $c['img']) }}" alt="{{ $c['country'] }}" class="rounded-top" style="height: 250px; object-fit: cover; width: 100%;">
          <div class="bg-dark text-white py-2 fw-bold">{{ $c['country'] }}</div>
        </div>
      </a>
    </div>
    @endforeach
  </div>
</section>

@if (isset($outboundTours) && count($outboundTours))
<section class="container my-5">
  <div class="text-center mb-4">
    <h2 class="fw-bold">Outbound Tours</h2>
    <p class="text-muted fs-5">Exciting international tour packages now available.</p>
  </div>
  <div class="position-relative pb-2">
    <div class="glide glide-outbound">
      <div class="glide__track" data-glide-el="track">
        <ul class="glide__slides">
          @foreach ($outboundTours as $tour)
          <li class="glide__slide">
            <div class="card h-100 shadow-sm mx-2 mb-0" style="min-width: 22rem; max-width: 26rem;">
              <img src="{{ asset('storage/outbound/' . $tour['image']) }}" class="card-img-top" style="height: 360px; object-fit: cover;" alt="{{ $tour['title'] }}">
              <div class="card-body d-flex flex-column pt-3">
                <h5 class="fw-bold">{{ $tour['title'] }}</h5>
                <p class="text-muted">{{ $tour['desc'] }}</p>
                @if ($tour['pdf'])
                <a href="{{ asset('storage/outbound/' . $tour['pdf']) }}" class="btn btn-success mt-auto" target="_blank" style="margin-bottom: 4px;">📄 Download PDF</a>
                @else
                <button class="btn btn-secondary mt-auto" disabled>❌ Coming Soon</button>
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