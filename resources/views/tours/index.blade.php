@extends('layouts.app')

@section('content')

{{-- ✅ Hero Banner --}}
<div style="width:100vw; max-width:100vw; margin-left:calc(50% - 50vw); overflow:hidden; height:clamp(200px, 26vw, 360px);">
  <img src="{{ asset('storage/assets/banner.png') }}" alt="Explore Our Tours"
    style="width:100%; height:100%; object-fit:cover; object-position:center; display:block;">
</div>

{{-- ✅ Card Styles (เฉพาะหน้านี้) --}}
<style>
  .tour-pro { border:2px solid #dbeafe; border-radius: .9rem; transition: transform .15s, box-shadow .15s, border-color .15s; }
  .tour-pro:hover { transform: translateY(-2px); border-color:#60a5fa; box-shadow: 0 10px 28px rgba(2,132,199,.12); }

  .tour-pro-img { aspect-ratio: 16/9; overflow:hidden; border-top-left-radius:.9rem; border-top-right-radius:.9rem; }
  .object-cover { object-fit:cover; }

  /* ป้ายแบบ “ไม่ทับรูป” */
  .tour-pro-badge-inline{
    display:inline-flex; align-items:center; gap:.4rem;
    padding:.35rem .7rem; border-radius:999px; font-size:.8rem; font-weight:600;
    background:#fde68a; color:#1f2937;
  }

  .chip-row { display:flex; gap:.75rem; flex-wrap:wrap; margin:.4rem 0 .6rem 0;}
  .chip { display:inline-flex; align-items:center; gap:.35rem; padding:.25rem .55rem; border-radius:999px; background:#eef2ff; color:#334155; font-size:.9rem; }
  .chip i{ font-size:1rem; }

  .hl-title{ font-weight:700; margin:.4rem 0 .35rem 0; }
  .hl-list{ list-style:none; padding-left:0; margin:0 0 .75rem 0; color:#334155; }
  .hl-list li{ display:flex; gap:.5rem; margin-bottom:.25rem; }
  .hl-list i{ margin-top:.15rem; }

  .price-usd{ font-weight:700; }
  .price-thb{ color:#64748b; font-size:.95rem; }
  .btn-pro{ background:#1d4ed8; border-color:#1d4ed8; }
  .btn-pro:hover{ background:#1e40af; border-color:#1e40af; }

  .tour-pro-badge-inline {
    display: flex;
    justify-content: center; /* จัดกึ่งกลางแนวนอน */
    align-items: center;     /* จัดกึ่งกลางแนวตั้ง */
    text-align: center;
}
.tour-pro-badge-inline i {
    margin-right: 6px; /* เว้นระยะห่างจากข้อความ */
}

</style>

<div class="container py-5">

  {{-- ✅ Filter Dropdown --}}
  <div class="dropdown text-center mb-4">
    <button class="btn btn-outline-primary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
      🌐 
      @if(request('country'))
        {{ ucfirst(request('country')) }}
      @elseif(request('series'))
        {{ request('series') }} Series
      @else
        All Destinations
      @endif
    </button>
    <ul class="dropdown-menu" aria-labelledby="filterDropdown">
      <li>
        <a class="dropdown-item" href="{{ route('tours.index') }}">
          <img src="{{ asset('icons/flags/world.png') }}" width="20" class="me-2"> All Destinations
        </a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ route('tours.index', ['country' => 'Vietnam']) }}">
          <img src="{{ asset('icons/flags/vietnam_flag.png') }}" width="20" class="me-2"> Vietnam
        </a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ route('tours.index', ['country' => 'Thailand']) }}">
          <img src="{{ asset('icons/flags/thailand_flag.png') }}" width="20" class="me-2"> Thailand
        </a>
      </li>
      <li>
        <a class="dropdown-item" href="{{ route('tours.index', ['country' => 'Laos']) }}">
          <img src="{{ asset('icons/flags/laos_flag.png') }}" width="20" class="me-2"> Laos
        </a>
      </li>
    </ul>
  </div>

  {{-- ✅ Page Heading --}}
  <div class="text-center mb-4">
    <h1 class="fw-bold display-5 mb-2">All Tours</h1>
    <p class="text-muted fs-5">Browse all our amazing tours by destination</p>
  </div>

  {{-- ✅ Tour Cards --}}
  <div class="row g-4">
    @forelse ($tours as $tour)
      @php
        // รูป cover: ใช้โครงเดิม + fallback
        $cover = !empty($tour->image)
          ? asset('storage/tourCovers/' . $tour->image)
          : (isset($tour->id) ? asset('storage/TourCover/'.$tour->id.'.jpg') : 'https://via.placeholder.com/600x338?text=No+Image');

        // ป้าย badge: days/nights > duration > Full Day
        $days   = $tour->days  ?? null;
        $nights = $tour->nights ?? null;
        $badge  = $days && $nights
                  ? "{$days} days {$nights} nights"
                  : (($tour->duration ?? $tour->days ?? 'Full Day') . ' Tour');

        // chips (ถ้ามี) และ highlights (ถ้ามี)
        $tags = is_array($tour->tags ?? null) ? $tour->tags : [];
        $iconMap = ['Temple'=>'bi-bank','Boat'=>'bi-water','Railway'=>'bi-train-front','Market'=>'bi-basket3','Waterfall'=>'bi-droplet','Nature'=>'bi-tree'];
        $highlights = is_array($tour->highlights ?? null) ? $tour->highlights : [];

        // ราคา/วันที่
        $rate = 33;
        $usd  = !empty($tour->price) ? round($tour->price / $rate) : null;
        $validOn = \Carbon\Carbon::parse($tour->valid_date ?? now())->format('M d, Y');
      @endphp

      <div class="col-12 col-md-6 col-lg-4 col-xl-3">
        <div class="card tour-pro h-100 d-flex flex-column">
          {{-- รูป (ไม่มีป้ายทับรูปแล้ว) --}}
          <div class="tour-pro-img">
            <img src="{{ $cover }}" class="w-100 h-100 object-cover" alt="{{ $tour->title }}"
                 onerror="this.onerror=null; this.src='https://via.placeholder.com/600x338?text=No+Image';">
          </div>

          <div class="card-body d-flex flex-column">
            {{-- ป้ายมาอยู่เหนือชื่อ --}}
            <span class="tour-pro-badge-inline mb-2">
              <i class="bi bi-clock-history"></i>{{ $badge }}
            </span>

            <h5 class="fw-semibold mb-1">{{ $tour->title }}</h5>

            {{-- chips ใต้หัวข้อ --}}
            @if(!empty($tags))
              <div class="chip-row">
                @foreach($tags as $t)
                  @php $ic = $iconMap[$t] ?? 'bi-geo'; @endphp
                  <span class="chip"><i class="bi {{ $ic }}"></i>{{ $t }}</span>
                @endforeach
              </div>
            @endif

            {{-- Tour Highlights --}}
            @if(!empty($highlights))
              <div class="hl-title">Tour Highlights:</div>
              <ul class="hl-list">
                @foreach($highlights as $hl)
                  <li><i class="bi bi-check2-circle text-success"></i><span>{{ $hl }}</span></li>
                @endforeach
              </ul>
            @endif

            {{-- ราคา/วันออกเดินทาง --}}
            <div class="mb-3">
              <div class="text-muted">Daily departures</div>
              @if(!empty($usd))
                <div class="price-usd">{{ $usd }} USD <span class="fw-normal">per person</span></div>
                <div class="price-thb">≈ {{ number_format($tour->price, 0) }} THB ($1 ≈ {{ $rate }})</div>
              @endif
            </div>

            <a href="{{ route('tour.show', $tour) }}" class="btn btn-pro text-white w-100 mt-auto">
              <i class="bi bi-eye me-1"></i> View itinerary
            </a>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12">
        <div class="alert alert-warning text-center">No tours available for the selected destination.</div>
      </div>
    @endforelse
  </div>

</div>

@endsection