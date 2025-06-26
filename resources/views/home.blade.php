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

  .navbar-nav .nav-link {
    color: #0d6efd !important;
  }

  .navbar-nav .nav-link:hover {
    color: #000 !important;
  }
</style>


@endsection

@section('content')
<div class="container-fluid px-0">
  {{-- Hero Section --}}

  <div class="hero-video-container">
    <video id="heroVideo" autoplay muted loop playsinline>
      <source src="{{ asset('video/hero.mp4') }}" type="video/mp4">
    </video>
    <img src="{{ asset('storage/assets/hero.png') }}" alt="Hero Image" class="img-fluid d-block d-md-none">
    <button id="muteToggle" class="mute-toggle-btn">🔇 Mute</button>
  </div>
</div>

</div>

{{-- Popular Tours --}}
<div class="container">
  <div class="text-center my-5">
    <h1 class="fw-bold display-5">Popular Tours</h1>
    <p class="text-muted fs-5">Explore our most popular tours across Thailand, Cambodia, Vietnam, and Laos.<br>Don’t miss our best-selling tours!</p>
  </div>

  <div class="glide mb-5">
    <div class="glide__track" data-glide-el="track">
      <ul class="glide__slides">
        @foreach ($tours as $tour)
        <li class="glide__slide">
          <div class="card shadow-sm mx-2" style="min-width: 16rem;">
            @php
            $firstImage = $tour->images->first();
            $imgSrc = $firstImage
            ? asset("storage/eachTours/{$tour->id}/{$firstImage->filename}")
            : 'https://via.placeholder.com/300x200?text=No+Image';
            @endphp
            <img src="{{ $imgSrc }}" class="card-img-top" style="height: 200px; object-fit: cover;">
            <div class="card-body d-flex flex-column">
              <small class="text-muted">{{ $tour->duration ?? $tour->days }} DAY TOUR</small>
              <h6 class="fw-bold">{{ $tour->title }}</h6>
              <small class="text-muted">Valid on {{ \Carbon\Carbon::parse($tour->valid_date ?? now())->format('M d, Y') }}</small>
              <p class="fw-bold mt-2">${{ number_format($tour->price, 2) }} <span class="text-muted small">per person</span></p>
              <a href="{{ route('tours.show', $tour->id) }}" class="btn btn-outline-primary btn-sm mt-auto">View itinerary</a>
            </div>
          </div>
        </li>
        @endforeach
      </ul>
    </div>
    <div class="glide__arrows" data-glide-el="controls">
      <button class="glide__arrow glide__arrow--left btn btn-light shadow-sm" data-glide-dir="<">&larr;</button>
      <button class="glide__arrow glide__arrow--right btn btn-light shadow-sm" data-glide-dir=">">&rarr;</button>
    </div>
  </div>

  {{-- Why Travel --}}
  <section class="bg-light py-5">
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
          <div class="bg-white p-4 rounded shadow-sm h-100">
            <div class="mb-3"><i class="bi bi-{{ $feature['icon'] }} fs-1 text-primary"></i></div>
            <h5 class="fw-bold">{{ $feature['title'] }}</h5>
            <p class="text-muted">{{ $feature['desc'] }}</p>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </section>

  {{-- Gallery --}}
  <section class="container my-5">
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

  {{-- Explore by Destination --}}
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
  @include('partials.outbound')

</div>


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

  // 🎧 Hero video mute toggle
  const heroVideo = document.getElementById('heroVideo');
  const muteToggle = document.getElementById('muteToggle');

  muteToggle.addEventListener('click', () => {
    heroVideo.muted = !heroVideo.muted;
    muteToggle.innerText = heroVideo.muted ? '🔇 Mute' : '🔊 Unmute';
  });
</script>
@endsection