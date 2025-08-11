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

   .home-outbound .outbound-card .tour-img{
    width:100%;
    height:380px;
    object-fit:cover;
    border-top-left-radius:8px;border-top-right-radius:8px;
  }
  .home-outbound .tour-description{
    display:-webkit-box;
    -webkit-line-clamp:3;
    -webkit-box-orient:vertical;
    overflow:hidden;
    margin-bottom:.25rem;
    line-height:1.3;
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

  @if ($tours->count())
  <div class="glide mb-5">
    <div class="glide__track" data-glide-el="track">
      <ul class="glide__slides">
        @foreach ($tours as $tour)
        <li class="glide__slide">
          <div class="card shadow-sm mx-2" style="min-width: 18rem;">

            @php
            // ✅ รูป cover แบบ robust: ลอง 3 ที่ เลือกไฟล์แรกที่เจอ
            $candidates = [
            "storage/TourCover/{$tour->id}.jpg", // legacy by ID
            "storage/tourCovers/{$tour->image}", // ชื่อไฟล์จากคอลัมน์ image (ถ้ามี)
            "storage/tourCovers/{$tour->slug}.jpg", // ตาม slug
            ];
            $imgSrc = null;
            foreach ($candidates as $path) {
            if ($path && file_exists(public_path($path))) {
            $imgSrc = asset($path);
            break;
            }
            }
            if (!$imgSrc) {
            $imgSrc = 'https://via.placeholder.com/640x420?text=No+Image';
            }

            // ✅ แสดง duration สวย ๆ
            $durationDisplay = ($tour->duration && trim($tour->duration) !== '1')
            ? $tour->duration
            : 'Full Day Tour';
            @endphp

            <img src="{{ $imgSrc }}" alt="{{ $tour->title }}"
              class="card-img-top" style="height:220px; object-fit:cover;">

            <div class="card-body d-flex flex-column">
              <small class="text-primary fw-bold">{{ $durationDisplay }}</small>

              <h5 class="fw-bold mt-1">{{ $tour->title }}</h5>

              @if ($tour->available_note)
              <p class="text-danger fw-semibold small mb-1">{{ $tour->available_note }}</p>
              @endif

              <p class="fw-bold mt-2">
                {{ number_format($tour->price, 0) }} THB
                <span class="text-muted small ms-1">per person</span>
              </p>

              @if(in_array($tour->id, [3,5]))
              <p class="text-danger small mb-0">📌 Group Tour Available</p>
              <p class="text-muted small">🗓️ Oct–Dec Options</p>
              @endif

              <small class="text-muted">*Approx. $1 = 33 THB for your reference</small>

              <a href="{{ route('tour.show', $tour) }}" class="btn btn-outline-primary btn-sm mt-auto">
                View itinerary
              </a>
              
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
  @else
  <div class="text-center text-muted py-5">
    No tours available at the moment. Please check back soon.
  </div>
  @endif
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
  ['label' => 'Cross-Border Laos Series', 'img' => 'laos.jpg', 'link' => route('tours.index', ['country' => 'Laos'])],
  ['label' => 'Thailand', 'img' => 'thailand.png', 'link' => route('tours.index', ['country' => 'Thailand'])],
  ['label' => 'Cross-Border Vietnam Series', 'img' => 'vietnam.jpg', 'link' => route('tours.index', ['country' => 'Vietnam'])],
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

{{-- Outbound Tours Section --}}
@if (!empty($overseasTours) && count($overseasTours))
<section class="container my-5 home-outbound">
  <div class="text-center mb-4">
    <h2 class="fw-bold">Outbound Tours 🌐 ทัวร์ต่างประเทศ</h2>
    <p class="text-muted fs-5">Exciting international tour packages now available | แพ็กเกจทัวร์ต่างประเทศสุดตื่นเต้น พร้อมให้คุณจองแล้ววันนี้!</p>
  </div>

  <div class="position-relative pb-2">
    <div class="glide glide-outbound">
      <div class="glide__track" data-glide-el="track">
        <ul class="glide__slides">
          @foreach ($overseasTours as $tour)
          @php
          $img = $tour['image'] ?? null;
          $pdf = $tour['pdf'] ?? null;
          @endphp
          <li class="glide__slide h-100">
            <div class="card h-100 outbound-card w-100 d-flex flex-column justify-content-between">
              <img
                src="{{ asset('storage/highlight-outbounds/' . $img) }}"
                class="tour-img"
                alt="{{ $tour['title'] }}"
                onerror="this.onerror=null;this.src='https://via.placeholder.com/800x500?text=No+Image';">
              <div class="card-body d-flex flex-column">
                <h5 class="card-title fw-bold">{{ $tour['title'] }}</h5>

                @if (!empty($tour['desc']))
                <p class="card-text tour-description">{{ $tour['desc'] }}</p>
                @endif

                @if (!empty($pdf))
                <a href="{{ asset('storage/highlight-outbounds/' . $pdf) }}" class="btn btn-success mt-auto" target="_blank">
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
        <a href="{{ route('overseas.index') }}" class="btn btn-outline-primary">ดูทัวร์ต่างประเทศทั้งหมด</a>
      </div>
    </div>
  </div>
</section>
@else
<section class="container my-5">
  <div class="text-center text-muted py-5">
    Outbound tours จะอัปเดตเร็ว ๆ นี้ กรุณาตรวจสอบอีกครั้งภายหลัง
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