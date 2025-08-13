@extends('layouts.app')

@php
use Illuminate\Support\Facades\Storage;

/* รูปจาก storage/app/public/eachTours/{id} */
$dir     = "eachTours/{$tour->id}";
$images  = collect(Storage::disk('public')->files($dir))
    ->filter(fn($p) => preg_match('/\.(jpe?g|png|webp)$/i', $p))
    ->sort()->map(fn($p) => Storage::url($p))->values();

/* -------- สร้างข้อมูลให้แท็บ -------- */
$highlightsRaw = strip_tags($tour->highlights ?? $tour->overview ?? '');
$highlights = collect(preg_split('/[\r\n•\-–—]+/u', $highlightsRaw))
    ->map(fn($s)=>trim($s))->filter()->take(12);

/* รวม/ไม่รวม (ถ้ามีฟิลด์) */
$includedRaw = strip_tags($tour->included ?? '');
$included = collect(preg_split('/[\r\n•\-–—]+/u',$includedRaw))->map(fn($s)=>trim($s))->filter();

$excludedRaw = strip_tags($tour->excluded ?? '');
$excluded = collect(preg_split('/[\r\n•\-–—]+/u',$excludedRaw))->map(fn($s)=>trim($s))->filter();

/* Itinerary: ถ้ามี $tour->itinerary (HTML) ก็ใช้เลย
   ถ้าไม่มี พยายามแตกจาก description โดยหา "Day " */
$itineraryHtml = $tour->itinerary ?? null;
$days = [];
if (!$itineraryHtml) {
    $tmp = preg_split('/\bDay\s*\d+/i', strip_tags($tour->description ?? ''), -1, PREG_SPLIT_NO_EMPTY);
    // ถ้าแตกไม่ได้ ก็ไม่ทำอะไร
    if (count($tmp) > 1) {
        $days = collect($tmp)->map(fn($s)=>trim($s))->filter()->values();
    }
}

/* FAQs (ถ้ามี json/ข้อความ) */
$faqs = [];
if (!empty($tour->faqs_json)) {
    // สมมติเป็น JSON [{q:"",a:""}, ...]
    $faqs = json_decode($tour->faqs_json, true) ?: [];
}
@endphp

@section('head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css"/>
<style>
  /* ====== Gallery ====== */
  .tour-photo{height:460px;object-fit:cover;border-radius:10px}
  .thumb{height:80px;width:120px;object-fit:cover;border-radius:6px;opacity:.8;border:2px solid transparent;transition:.12s}
  .thumb:hover{opacity:1;border-color:#0d6efd}
  .thumb-hide{display:none!important}
  .thumbs-row{display:flex;gap:.6rem;overflow-x:auto;padding:.4rem .2rem}
  .gallery-arrows{display:flex;justify-content:center;gap:.5rem}
  .gallery-arrows .btn{border:1px solid #ddd}

  /* ====== Layout ====== */
  .sticky-lg-top{top:90px}              /* card ขวา ติดบนตอนเลื่อน */
  .info-list li{margin:.15rem 0}
  .icon-dot{
    width:1.05rem;height:1.05rem;display:inline-grid;place-items:center;
    border-radius:50%;margin-right:.45rem;font-size:.75rem
  }
  .ok{background:#eaf7ef;color:#2e7d32;border:1px solid #cdebd7}
  .no{background:#fdecea;color:#b42318;border:1px solid #f3c1bd}
  .tab-pane{padding-top:1rem}
</style>
@endsection

@section('content')
<div class="container py-4">
  <div class="row g-4">
    {{-- ===== Left: Gallery & Tabs ===== --}}
    <div class="col-lg-7">

      {{-- ====== GALLERY (ภาพหลัก + แถบ thumbnails + ปุ่มซ้ายขวา) ====== --}}
      @if ($images->count())
        <div id="mainImageWrap" class="mb-2">
          <img id="mainImage" src="{{ $images[0] }}" class="w-100 tour-photo" alt="tour">
        </div>

        <div id="thumbs" class="thumbs-row mb-2">
          @foreach ($images as $idx => $img)
            <img data-index="{{ $idx }}" src="{{ $img }}"
                 class="thumb {{ $idx===0 ? 'thumb-hide' : '' }}" alt="thumb">
          @endforeach
        </div>

        <div class="gallery-arrows mb-3">
          <button class="btn btn-light" id="prevSlide">‹</button>
          <button class="btn btn-light" id="nextSlide">›</button>
        </div>
      @else
        <div class="alert alert-light">No images yet.</div>
      @endif

      {{-- ====== TITLE ====== --}}
      <h2 class="fw-bold mb-1">{{ $tour->title }}</h2>
      <p class="text-muted">{{ $tour->short_description ?? 'Short description of the tour.' }}</p>

      {{-- ====== TABS ====== --}}
      <ul class="nav nav-tabs" id="tourTabs" role="tablist">
        <li class="nav-item" role="presentation">
          <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tabOverview" type="button" role="tab">
            Overview
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabItinerary" type="button" role="tab">
            Itinerary
          </button>
        </li>
        <li class="nav-item" role="presentation">
          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabFaqs" type="button" role="tab">
            FAQs
          </button>
        </li>
      </ul>

      <div class="tab-content">

        {{-- ====== OVERVIEW ====== --}}
        <div class="tab-pane fade show active" id="tabOverview" role="tabpanel">
          {{-- ไปที่ไหน/ไฮไลท์ --}}
          @if($highlights->count())
            <h5 class="mt-3">Tour Highlights</h5>
            <ul class="list-unstyled info-list">
              @foreach($highlights as $h)
                <li><span class="icon-dot ok">✓</span>{{ $h }}</li>
              @endforeach
            </ul>
          @endif

          {{-- รวม/ไม่รวม --}}
          @if($included->count() || $excluded->count())
            <div class="row g-4 mt-1">
              @if($included->count())
                <div class="col-md-6">
                  <h6 class="mb-2">Included</h6>
                  <ul class="list-unstyled info-list">
                    @foreach($included as $i)
                      <li><span class="icon-dot ok">✓</span>{{ $i }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
              @if($excluded->count())
                <div class="col-md-6">
                  <h6 class="mb-2">Not included</h6>
                  <ul class="list-unstyled info-list">
                    @foreach($excluded as $x)
                      <li><span class="icon-dot no">×</span>{{ $x }}</li>
                    @endforeach
                  </ul>
                </div>
              @endif
            </div>
          @endif

          {{-- รายละเอียดเสริม (ถ้ามี HTML เต็ม) --}}
          @if(!empty($tour->description))
            <hr>
            {!! $tour->description !!}
          @endif

      
        </div>

        {{-- ====== ITINERARY ====== --}}
        <div class="tab-pane fade" id="tabItinerary" role="tabpanel">
          @if($itineraryHtml)
            {!! $itineraryHtml !!}
          @elseif(count($days))
            <div class="accordion" id="itinAcc">
              @foreach($days as $i => $txt)
                <div class="accordion-item">
                  <h2 class="accordion-header" id="day{{ $i }}">
                    <button class="accordion-button {{ $i? 'collapsed':'' }}" type="button"
                            data-bs-toggle="collapse" data-bs-target="#dayBody{{ $i }}">
                      Day {{ $i+1 }}
                    </button>
                  </h2>
                  <div id="dayBody{{ $i }}" class="accordion-collapse collapse {{ $i? '':'show' }}"
                       data-bs-parent="#itinAcc">
                    <div class="accordion-body">
                      {{ $txt }}
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          @else
            <p class="text-muted mt-3">Itinerary will be provided soon.</p>
          @endif
        </div>

        {{-- ====== FAQs ====== --}}
        <div class="tab-pane fade" id="tabFaqs" role="tabpanel">
          @if(count($faqs))
            <div class="accordion" id="faqAcc">
              @foreach($faqs as $i => $qa)
                <div class="accordion-item">
                  <h2 class="accordion-header" id="q{{ $i }}">
                    <button class="accordion-button {{ $i? 'collapsed':'' }}" type="button"
                            data-bs-toggle="collapse" data-bs-target="#a{{ $i }}">
                      {{ $qa['q'] ?? 'Question' }}
                    </button>
                  </h2>
                  <div id="a{{ $i }}" class="accordion-collapse collapse {{ $i? '':'show' }}"
                       data-bs-parent="#faqAcc">
                    <div class="accordion-body">
                      {!! nl2br(e($qa['a'] ?? 'Answer')) !!}
                    </div>
                  </div>
                </div>
              @endforeach
            </div>
          @else
            <p class="text-muted mt-3">No FAQs yet.</p>
          @endif
        </div>

      </div>
    </div>

    {{-- ===== Right: Quick Info (sticky) ===== --}}
    <div class="col-lg-5">
      <div class="card shadow-sm sticky-lg-top">
        <div class="card-body">
          <h5 class="fw-bold text-primary mb-3">Quick Info</h5>
          <ul class="list-unstyled info-list">
            <li><b>Price:</b> {{ $tour->price ? number_format($tour->price).' ฿' : 'N/A' }}</li>
            <li><b>Duration:</b> {{ $tour->duration ?? 'N/A' }}</li>
            <li><b>Available dates:</b> {{ $tour->dates ?? 'N/A' }}</li>
            @if(!empty($tour->group_size)) <li><b>Group size:</b> {{ $tour->group_size }}</li> @endif
            @if(!empty($tour->guide)) <li><b>Guide:</b> {{ $tour->guide }}</li> @endif
          </ul>
          <a href="{{ route('enquiries.create', $tour) }}" class="btn btn-primary w-100">Book Now</a>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection

@section('scripts')
<script>
  // ====== Simple gallery (ไม่ใช้ lib เพื่อความเสถียร) ======
  const imgs = @json($images);
  let active = 0;
  const main = document.getElementById('mainImage');
  const thumbs = document.querySelectorAll('#thumbs .thumb');
  const prev = document.getElementById('prevSlide');
  const next = document.getElementById('nextSlide');

  function render(idx){
    active = (idx + imgs.length) % imgs.length;
    main.src = imgs[active];
    // ซ่อน thumb ของรูปที่กำลังโชว์
    thumbs.forEach((t,i)=> t.classList.toggle('thumb-hide', i===active));
  }
  thumbs.forEach(t=>{
    t.addEventListener('click', e=>{
      render(+e.currentTarget.dataset.index);
    });
  });
  prev?.addEventListener('click', ()=> render(active-1));
  next?.addEventListener('click', ()=> render(active+1));
</script>
@endsection
