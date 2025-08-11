@extends('layouts.app')

@section('head')
<link href="https://cdn.jsdelivr.net/npm/lightbox2@2/dist/css/lightbox.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css" />
<style>
  .hero-video-container{position:relative;width:100vw;max-width:100vw;height:75vh;overflow:hidden;margin-left:calc(50% - 50vw)}
  .hero-video-container video,.hero-video-container img{width:100%;height:100%;object-fit:cover;z-index:1}
  .mute-toggle-btn{position:absolute;top:15px;right:15px;z-index:10;background:rgba(0,0,0,.5);color:#fff;border:none;border-radius:8px;padding:6px 12px;font-weight:bold;cursor:pointer}
  .hero-mobile-img{width:100%;height:clamp(200px,26vw,360px);object-fit:cover;display:none}

  /* --- Tour card standard --- */
  :root{ --tour-img-h: 240px; }
  .tour-card{display:flex;flex-direction:column;height:100%}
  .tour-card .card-img-top{height:var(--tour-img-h);object-fit:cover}
  .tour-card .card-body{display:flex;flex-direction:column;flex:1 1 auto}
  .tour-card .tour-title{
    line-height:1.25;min-height:2.6rem;
    display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;
  }
  .tour-card .tour-highlights{min-height:3rem}
  .tour-card .btn-cta{margin-top:auto}

  /* duration pill */
  .duration-row{display:flex;justify-content:center}
  .duration-badge{display:inline-block;background:#eaf2ff;color:#0d6efd;padding:.28rem .6rem;border-radius:9999px;font-weight:600;font-size:.85rem}
  .duration-badge.nights{background:#fff3cd;color:#946200}

  .glide__slide{display:flex;flex-direction:column;height:100%}
  .glide__slide>.card{flex-grow:1;display:flex;flex-direction:column}
  .glide__arrows{display:flex;justify-content:center;margin-top:4px}
  .glide__arrow{width:3rem;height:2.5rem;font-size:1.2rem}
  .glide-outbound .glide__slides{padding:0 10%;display:flex!important;justify-content:center}

  .destination-card img{width:100%;height:240px;object-fit:cover}
  .destination-card .card{height:100%}
  .destination-card .card-body{padding:0}

  /* Outbound */
  .home-outbound .outbound-card .tour-img{width:100%;height:380px;object-fit:cover;border-top-left-radius:8px;border-top-right-radius:8px}
  .home-outbound .tour-description{display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden;margin-bottom:.25rem;line-height:1.3}
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
    <p class="text-muted fs-5"><b> Explore our most popular tours across Thailand and Indo-China. Don’t miss our best-selling tours!</b></p>
  </div>

  {{-- ===================== Popular Tours ===================== --}}
  @if ($tours->count())
    <div class="glide mb-5">
      <div class="glide__track" data-glide-el="track">
        <ul class="glide__slides">

          @foreach ($tours as $tour)
            @php
              // เลือกรูป cover
              $candidates = [
                "storage/TourCover/{$tour->id}.jpg",
                $tour->image ? "storage/tourCovers/{$tour->image}" : null,
                "storage/tourCovers/{$tour->slug}.jpg",
              ];
              $imgSrc = null;
              foreach ($candidates as $p) { if ($p && file_exists(public_path($p))) { $imgSrc = asset($p); break; } }
              if (!$imgSrc) $imgSrc = 'https://via.placeholder.com/640x420?text=No+Image';

              // badge
              $badge = $tour->duration ? trim($tour->duration) : 'Full Day Tour';
              $badgeClass = \Illuminate\Support\Str::contains(strtolower($badge), 'night') ? 'nights' : '';

              // highlights (2 บรรทัด)
              $src   = strip_tags($tour->highlights ?? $tour->overview ?? '');
              $src   = preg_replace('/(what\'?s included.*)$/i','', $src);
              $parts = preg_split('/[\r\n•\-–—]+/u', $src);
              $bullets = collect($parts)->map(fn($s)=>trim($s))->filter()->take(2)
                          ->map(fn($s)=> \Illuminate\Support\Str::limit($s, 80));

              // next departure
              $nextDeparture = optional(
                $tour->departures()->whereDate('start_date','>=', now())->orderBy('start_date')->first()
              )->start_date;
              $departureText = $nextDeparture
                ? 'Next: ' . \Illuminate\Support\Carbon::parse($nextDeparture)->format('M j, Y')
                : 'Daily departures';

              // ราคา USD
              $rate = (float) config('currency.usd_rate', 33);
              $thb  = (float) ($tour->price ?? $tour->base_price ?? 0);
              $usd  = $thb > 0 ? ceil($thb / $rate) : null;
            @endphp

            <li class="glide__slide">
              <div class="card shadow-sm mx-2 tour-card" style="min-width:18rem;">
                <img src="{{ $imgSrc }}" alt="{{ $tour->title }}" class="card-img-top" style="height:220px;object-fit:cover;">

                <div class="card-body d-flex flex-column">
                  {{-- ระยะเวลา --}}
                  <div class="duration-row text-center mb-2">
                    <span class="duration-badge {{ $badgeClass }}">
                      <i class="bi bi-clock-history me-1"></i>{{ $badge }}
                    </span>
                  </div>

                  {{-- ชื่อ --}}
                <h5 class="fw-bold tour-title"
    style="display:-webkit-box;-webkit-box-orient:vertical;-webkit-line-clamp:3;
           overflow:hidden; line-height:1.25; min-height:calc(1.25em*3);">
  {{ $tour->title }}
</h5>

                  {{-- ไฮไลท์ --}}
                  <ul class="tour-highlights list-unstyled small text-muted mb-2">
                    @foreach ($bullets as $b)
                      <li class="d-flex"><span class="me-2">✅</span><span class="flex-grow-1">{{ $b }}</span></li>
                    @endforeach
                  </ul>

                  {{-- วันออกเดินทาง --}}
                  <div class="text-muted small mb-2">{{ $departureText }}</div>

                  {{-- ราคา + ปุ่ม --}}
                  <div class="mt-auto">
                    @if ($usd)
                      <div class="fw-bold">{{ $usd }} USD <span class="text-muted small">per person</span></div>
                      <div class="text-muted small">≈ {{ number_format($thb) }} THB ($1 = {{ (int)$rate }})</div>
                    @else
                      <div class="fw-bold">{{ number_format($thb) }} THB <span class="text-muted small">per person</span></div>
                    @endif
                    <a href="{{ route('tour.show', $tour) }}" class="btn btn-primary w-100 mt-3">
                      <i class="bi bi-eye"></i> View itinerary
                    </a>
                  </div>
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
  {{-- =================== /Popular Tours =================== --}}
</div>

<section class="bg-light py-2">
  <div class="container">
    <div class="text-center mb-4">
      <h2 class="fw-bold">Why travel with AventureTrip?</h2>
      <p class="fs-5 text-muted">As Southeast Asia travel experts, we design every tour with safety, comfort, and authentic experiences in mind.</p>
    </div>
    <div class="row g-4">
      @foreach ([
        ['icon'=>'people-fill','title'=>'Small Groups','desc'=>'Join like-minded travelers and enjoy personalized experiences.'],
        ['icon'=>'shield-check','title'=>'Guaranteed Departures','desc'=>'Book with confidence — our tours run as scheduled.'],
        ['icon'=>'person-lines-fill','title'=>'Local Guides','desc'=>'Our local guides bring unmatched knowledge.'],
        ['icon'=>'house-heart','title'=>'Community Support','desc'=>'We give back to the communities you visit.'],
        ['icon'=>'airplane','title'=>'Flexible Itineraries','desc'=>'Balanced adventure and leisure for your pace.'],
        ['icon'=>'globe','title'=>'Sustainable Travel','desc'=>'We prioritize eco-friendly, carbon-conscious travel.'],
      ] as $feature)
        <div class="col-md-4">
          <div class="p-4 rounded shadow-sm h-100" style="background-color:#ffd93d;">
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

  @php
    $destinations = [
      ['label'=>'Thailand','img'=>'thailand.png','link'=>route('tours.index',['country'=>'Thailand'])],
      ['label'=>'Vietnam','img'=>'vietnam.jpg','link'=>route('tours.index',['country'=>'Vietnam'])],
      ['label'=>'Laos','img'=>'laos.jpg','link'=>route('tours.index',['country'=>'Laos'])],
    ];
  @endphp

  <div class="row justify-content-center g-4 mt-4">
    @foreach ($destinations as $d)
      <div class="col-md-3 destination-card">
        <a href="{{ $d['link'] }}" class="text-decoration-none">
          <div class="card shadow-sm">
            <img src="{{ asset('storage/assets/' . $d['img']) }}" alt="{{ $d['label'] }}">
            <div class="bg-dark text-white py-2 fw-bold text-center">{{ $d['label'] }}</div>
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
            @php $img = $tour['image'] ?? null; $pdf = $tour['pdf'] ?? null; @endphp
            <li class="glide__slide h-100">
              <div class="card h-100 outbound-card w-100 d-flex flex-column justify-content-between">
                <img src="{{ asset('storage/highlight-outbounds/' . $img) }}" class="tour-img" alt="{{ $tour['title'] }}"
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
    type:'carousel', perView:4, gap:20, autoplay:4000, hoverpause:true,
    breakpoints:{ 1200:{perView:3}, 992:{perView:2}, 576:{perView:1} }
  }).mount();

  new Glide('.glide-outbound', {
    type:'carousel', perView:3, gap:20, autoplay:4000, hoverpause:true,
    breakpoints:{ 1200:{perView:2}, 768:{perView:1} }
  }).mount();

  const heroVideo=document.getElementById('heroVideo');
  const muteToggle=document.getElementById('muteToggle');
  muteToggle.addEventListener('click',()=>{
    heroVideo.muted=!heroVideo.muted;
    muteToggle.innerText=heroVideo.muted?'🔇 Mute':'🔊 Unmute';
  });
</script>
@endsection
