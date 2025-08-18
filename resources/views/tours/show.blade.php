@extends('layouts.app')

@php

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

/* ---------- Cleaner (ตัดตัวเพี้ยนให้เกลี้ยง) ---------- */
$clean = function (string $s): string {
    // ลบไบต์ที่ไม่ใช่ UTF-8 ทิ้งไปเลย
    $s = @iconv('UTF-8', 'UTF-8//IGNORE', $s) ?: $s;

    // ลบ replacement char และ control/formatting ต่าง ๆ
    $s = str_replace("\xEF\xBF\xBD", '', $s); // U+FFFD
    $s = preg_replace('/[\x{0000}-\x{001F}\x{007F}]/u', '', $s);                   // ASCII control
    $s = preg_replace('/[\x{2000}-\x{206F}\x{FE00}-\x{FE0F}\x{FEFF}]/u', '', $s);  // zero-width/formatting/variation
    // ลบสัญลักษณ์หมวด So (พวก icon/emoji แปลก ๆ) ที่โผล่ขึ้นต้นหรือคั่นอยู่
    $s = preg_replace('/[\p{So}\x{FFFD}]+/u', '', $s);

    // เก็บแค่ช่องว่างเดียว
    $s = preg_replace('/\s+/u', ' ', $s);
    return trim($s);
};


/* ---------- Images ---------- */
$dir = "eachTours/{$tour->id}";
$images = collect(Storage::disk('public')->files($dir))
    ->filter(fn($p) => preg_match('/\.(jpe?g|png|webp)$/i', $p))
    ->sort()
    ->map(fn($p) => Storage::url($p))
    ->values();

/* ---------- Splitter (ขึ้นบรรทัด/จุด bullet) ---------- */
$splitter = '/\r?\n|•/u';

/* ---------- Cleaner: ตัดตัว �, zero-width, bullet/dash นำหน้า ---------- */
$clean = function (string $s): string {
    $s = str_replace("\xEF\xBF\xBD", '', $s);                // U+FFFD
    $s = preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', $s); // zero-widths
    $s = preg_replace('/^[\p{So}\p{Sk}\x{2022}\x{25CF}\x{25A0}\x{25CB}\x{25E6}\x{FFFD}\-\—\–\•\·\s]+/u', '', $s);
    return trim($s);
};

/* ---------- Highlights ---------- */
$highlights = collect(
        preg_split($splitter, strip_tags($tour->highlights ?? $tour->overview ?? ''))
    )
    ->map($clean)
    ->filter()
    ->reject(fn($s) => preg_match('/^tour\s*highlights\s*[:：\-]?$/iu', $s)) // ตัดหัวข้อที่ติดมา
    ->take(12)
    ->values();

/* ---------- Included (tour_inclusions->notes) ---------- */
$includedRaw = (string) (DB::table('tour_inclusions')->where('tour_id', $tour->id)->value('notes') ?? '');
$included = collect(preg_split($splitter, strip_tags($includedRaw)))
    ->map($clean)
    ->filter()
    ->values();

/* ---------- Not included (ดีฟอลต์) ---------- */
$excludedRaw = "Personal expenses
Temple dress items
Pick-ups outside central Bangkok (surcharge may apply)";
$excluded = collect(preg_split($splitter, strip_tags($excludedRaw)))
    ->map($clean)
    ->filter()
    ->values();

/* ลบ “Temple dress items” เฉพาะทัวร์ Floating Market */
if ($tour->slug === 'floating-market-railway-tour') {
    $excluded = $excluded->reject(fn($x) => stripos($x, 'temple dress') !== false)->values();
}

/* ---------- Itinerary ---------- */
// ใช้ HTML itinerary เดิม
  $itineraryHtml = $itineraryHtml ?? ($tour->itinerary ?? '');

  // แปลงเป็นข้อความเรียบ ๆ แล้วล้างตัวประหลาดออกก่อนจับเวลา
  $itinText = strip_tags($itineraryHtml);
  $itinText = preg_replace('/\s+/', ' ', $itinText);
  $itinText = str_replace("\xEF\xBF\xBD", '', $itinText);                             // ลบ U+FFFD
  $itinText = preg_replace('/[\x{200B}-\x{200D}\x{FEFF}\x{E000}-\x{F8FF}\x{FE0E}\x{FE0F}]/u', '', $itinText); // ลบ zero-width + PUA + variation selectors

  // จับคู่: เวลา + เนื้อหา (07:00, 7:00, 07:00 am/pm)
  $pattern = '/\b(\d{1,2}:\d{2}\s*(?:[ap]\.?m\.?)?)\b\s*[—\-–]?\s*(.*?)(?=(?:\b\d{1,2}:\d{2}\s*(?:[ap]\.?m\.?)?\b)|$)/iu';

  $steps = [];
  if (preg_match_all($pattern, $itinText, $m, PREG_SET_ORDER)) {
      foreach ($m as $x) {
          $time = strtoupper(preg_replace('/\s*(a|p)\.?m\.?/i', ' $1M', trim($x[1])));
          $text = $clean(trim($x[2]));   // 👈 สำคัญ: ล้างข้อความแต่ละบรรทัดด้วย $clean
          if ($text !== '') {
              $steps[] = ['time' => $time, 'text' => $text];
          }
      }
  }

/* ---------- FAQs ---------- */
$faqs = [];
if (!empty($tour->faqs_json)) {
    $faqs = json_decode($tour->faqs_json, true) ?: [];
}
@endphp


@section('head')
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<style>
  /* ===== Gallery ===== */
  .tour-photo{height:460px;object-fit:cover;border-radius:10px}
  .thumb{height:80px;width:120px;object-fit:cover;border-radius:6px;opacity:.85;border:2px solid transparent;transition:.12s}
  .thumb:hover{opacity:1;border-color:#0d6efd}
  .thumb-hide{display:none!important}
  .thumbs-row{display:flex;gap:.6rem;overflow-x:auto;padding:.4rem .2rem;-webkit-overflow-scrolling:touch}
  .gallery-arrows{display:flex;justify-content:center;gap:.5rem}
  .gallery-arrows .btn{border:1px solid #ddd}

  /* ===== Layout ===== */
  .sticky-lg-top{top:90px}
  .info-list li{margin:.15rem 0}

  /* Pills (Included/Excluded) */
  .icon-dot{width:1.05rem;height:1.05rem;display:inline-grid;place-items:center;border-radius:50%;margin-right:.45rem;font-size:.75rem}
  .ok{background:#eaf7ef;color:#2e7d32;border:1px solid #cdebd7}
  .no{background:#fdecea;color:#b42318;border:1px solid #f3c1bd}

  /* ===== Quick Info ===== */
  .qi-badges{display:flex;gap:.4rem;flex-wrap:wrap;margin:-.25rem 0 .5rem}
  .qi-badge{font-size:.8rem;background:#f1f5ff;color:#0d6efd;border:1px solid #dbe7ff;padding:.2rem .55rem;border-radius:9999px;display:inline-flex;align-items:center;gap:.35rem}
  .qi-list{list-style:none;padding-left:0;margin:0}
  .qi-item{display:flex;gap:.6rem;padding:.35rem 0;border-bottom:1px dashed #eee}
  .qi-item i{width:1.25rem;text-align:center;color:#6c757d}
  .qi-note{font-size:.85rem;color:#6c757d}

  /* ไม่มี CSS ของ timeline แล้ว — Itinerary ใช้ Bootstrap list-group */
</style>

@endsection

@section('content')
<div class="container py-4">
  <div class="row g-4">

    {{-- =================== LEFT: Gallery + Tabs =================== --}}
    <div class="col-lg-7">

      {{-- Gallery --}}
      @if ($images->count())
      <div id="mainImageWrap" class="mb-2">
        <img id="mainImage" src="{{ $images[0] }}" class="w-100 tour-photo" alt="tour">
      </div>
      <div id="thumbs" class="thumbs-row mb-2">
        @foreach ($images as $idx => $img)
        <img data-index="{{ $idx }}" src="{{ $img }}" class="thumb {{ $idx===0 ? 'thumb-hide' : '' }}" alt="thumb">
        @endforeach
      </div>
      <div class="gallery-arrows mb-3">
        <button class="btn btn-light" id="prevSlide">‹</button>
        <button class="btn btn-light" id="nextSlide">›</button>
      </div>
      @else
      <div class="alert alert-light">No images yet.</div>
      @endif

      {{-- Title --}}
      <h2 class="fw-bold mb-1">{{ $tour->title ?? $tour->name }}</h2>

      {{-- Optional tour code/badges ตาม slug (ถ้าอยากเก็บไว้) --}}
      <div class="mt-1 mb-3">
        @if ($tour->slug === 'floating-market-railway-tour')
        <span class="badge bg-primary fs-6">Code: FLTBKK</span>
        @elseif ($tour->slug === 'bangkok-grand-palace-temple-tour')
        <span class="badge bg-primary fs-6">Code: FDBKKX</span>
        <span class="badge bg-danger fs-6">Exclusive</span>
        @endif
      </div>

      {{-- Tabs --}}
      <ul class="nav nav-tabs" role="tablist">
        <li class="nav-item"><button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tabOverview" type="button">Overview</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabItinerary" type="button">Itinerary</button></li>
        <li class="nav-item"><button class="nav-link" data-bs-toggle="tab" data-bs-target="#tabFaqs" type="button">FAQs</button></li>
      </ul>

      <div class="tab-content">
        {{-- Overview --}}
        <div class="tab-pane fade show active" id="tabOverview">
          @if($highlights->count())
          <h5 class="mt-3">Tour Highlights</h5>
          <ul class="list-unstyled info-list">
            @foreach($highlights as $h)
            <li><span class="icon-dot ok">✓</span>{{ $h }}</li>
            @endforeach
          </ul>
          @endif

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

          @if(!empty($tour->description))
          <hr>
          {!! $tour->description !!}
          @endif
        </div>

    

      {{-- Itinerary (แบบเรียบ ใช้ CSS น้อย) --}}
<div class="tab-pane fade" id="tabItinerary">
  @php
    // 1) ดึง HTML itinerary เดิม
    $itineraryHtml = (string) ($tour->itinerary ?? '');

    // 2) แปลงเป็นข้อความเรียบ + ล้างอักขระเพี้ยน
    $itinText = trim(preg_replace('/\s+/', ' ', strip_tags($itineraryHtml)));
    $itinText = str_replace("\xEF\xBF\xBD", '', $itinText);                      // ตัด � (U+FFFD)
    $itinText = preg_replace('/[\x{200B}-\x{200D}\x{FEFF}]/u', '', $itinText);   // ตัด zero-width

    // 3) จับคู่ เวลา + เนื้อหา (รองรับ 07:00 / 7:00 / 07:00 am/pm)
    $pattern = '/\b(\d{1,2}:\d{2}\s*(?:[ap]\.?m\.?)?)\b\s*(.*?)(?=(?:\b\d{1,2}:\d{2}\s*(?:[ap]\.?m\.?)?\b)|$)/i';
    preg_match_all($pattern, $itinText, $m, PREG_SET_ORDER);

    // 4) ทำความสะอาดทีละสเต็ป (ตัด bullet/ขีด/ช่องว่างเกิน ฯลฯ)
    $steps = [];
    foreach ($m as $x) {
      $time = strtoupper(preg_replace('/\s*(a|p)\.?m\.?/i', ' $1M', trim($x[1])));
      $text = trim($x[2]);
      // ตัด bullet/ขีด/เว้นวรรคต้นบรรทัด
      $text = preg_replace('/^[\p{So}\p{Sk}\x{2022}\x{25CF}\x{25A0}\x{25CB}\x{25E6}\x{FFFD}\-\—\–\•\·\s]+/u', '', $text);
      if ($text !== '') {
        $steps[] = ['time' => $time, 'text' => $text];
      }
    }
  @endphp

  @if(count($steps))
    <ul class="list-group list-group-flush mt-3">
      @foreach($steps as $s)
        <li class="list-group-item d-flex align-items-start">
          {{-- ปรับความกว้างคอลัมน์เวลาได้ที่ width:72px --}}
          <div class="me-3 text-muted fw-semibold" style="width:72px">{{ $s['time'] }}</div>
          <div>{{ $s['text'] }}</div>
        </li>
      @endforeach
    </ul>
    <div class="small text-muted mt-2">
      * Timing may vary with traffic, queueing and weather conditions.
    </div>
  @else
    {{-- ถ้าจับเวลาไม่สำเร็จ แสดง HTML เดิมไว้ก่อน --}}
    @if($itineraryHtml)
      {!! $itineraryHtml !!}
    @else
      <p class="text-muted mt-3">Itinerary will be provided soon.</p>
    @endif
  @endif
</div>




        {{-- FAQs --}}
        <div class="tab-pane fade" id="tabFaqs">
          @if(count($faqs))
          <div class="accordion" id="faqAcc">
            @foreach($faqs as $i => $qa)
            <div class="accordion-item">
              <h2 class="accordion-header" id="q{{ $i }}">
                <button class="accordion-button {{ $i? 'collapsed':'' }}" type="button" data-bs-toggle="collapse" data-bs-target="#a{{ $i }}">
                  {{ $qa['q'] ?? 'Question' }}
                </button>
              </h2>
              <div id="a{{ $i }}" class="accordion-collapse collapse {{ $i? '':'show' }}" data-bs-parent="#faqAcc">
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

    {{-- =================== RIGHT: Quick Info =================== --}}
    <div class="col-lg-5">
      <div class="card shadow-sm sticky-lg-top">
        <div class="card-body">
          <h5 class="fw-bold text-primary mb-2">Quick Info</h5>

          @php $quick = $quick ?? ($quickInfo ?? []); @endphp

          @if(!empty($quick['badges']))
          <div class="qi-badges mb-2">
            @foreach(($quick['badges'] ?? []) as $b)
            <span class="qi-badge"><i class="bi bi-patch-check"></i> {{ $b }}</span>
            @endforeach
          </div>
          @endif

          {{-- Price (supports tiered pricing + promo) --}}
          @if(!empty($quick['pricing']))
          <div class="mb-2">
            <strong>Price:</strong> {{ $quick['pricing']['headline'] }}
            <div class="small text-muted mt-1">
              @foreach($quick['pricing']['tiers'] as $t)
              <div>• {{ $t }}</div>
              @endforeach
              @if(!empty($quick['pricing']['promo']))
              <div class="mt-1">
                <span class="badge bg-warning text-dark">{{ $quick['pricing']['promo'] }}</span>
              </div>
              @endif
            </div>
          </div>
          @else
          <div class="mb-2">
            <strong>Price:</strong> {{ $tour->price ? number_format($tour->price).' ฿' : 'N/A' }}
          </div>
          @endif


          <ul class="qi-list">
            <li class="qi-item"><i class="bi bi-clock-history"></i>
              <span><strong>Duration:</strong> {{ $quick['duration'] ?? '-' }}</span>
            </li>

            <li class="qi-item"><i class="bi bi-geo-alt"></i>
              <span><strong>Start / End:</strong> {{ $quick['start_end'] ?? '-' }}</span>
            </li>

            <li class="qi-item"><i class="bi bi-alarm"></i>
              <span><strong>Start time:</strong> {{ $quick['start_time'] ?? '-' }}</span>
            </li>

            <li class="qi-item"><i class="bi bi-truck"></i>
              <span><strong>Pickup:</strong> {{ $quick['pickup'] ?? '-' }}</span>
            </li>

            {{-- Transport --}}
            @if(!empty($quick['transport']))
            <div class="mb-2">
              <i class="bi bi-car-front-fill me-2" aria-hidden="true"></i>
 <strong>Transport:</strong> {{ $quick['transport'] }}
            </div>
            @endif


            <li class="qi-item"><i class="bi bi-people"></i>
              <span><strong>Group size:</strong> {{ $quick['group'] ?? $quick['group_size'] ?? '-' }}</span>
            </li>

            <li class="qi-item"><i class="bi bi-translate"></i>
              <span><strong>Language:</strong> {{ $quick['language'] ?? '-' }}</span>
            </li>

            <li class="qi-item"><i class="bi bi-check2-circle"></i>
              <span><strong>Dress:</strong> {{ $quick['dress'] ?? '-' }}</span>
            </li>

            <li class="qi-item"><i class="bi bi-activity"></i>
              <span><strong>Activity:</strong> {{ $quick['activity'] ?? '-' }}</span>
            </li>

            <li class="qi-item"><i class="bi bi-emoji-smile"></i>
              <span><strong>Children:</strong> {{ $quick['child'] ?? $quick['children'] ?? '-' }}</span>
            </li>

            <li class="qi-item"><i class="bi bi-shield-check"></i>
              <span><strong>Cancellation:</strong> {{ $quick['cancel'] ?? '-' }}</span>
            </li>
          </ul>

          @if(!empty($quick['note']))
          <div class="qi-note mt-2"><i class="bi bi-info-circle"></i> {{ $quick['note'] }}</div>
          @endif

          <a href="{{ route('enquiries.create', $tour) }}" class="btn btn-primary w-100 mt-3">Book Now</a>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection

@section('scripts')
<script>
  // ====== Simple gallery (Vanilla JS)
  const imgs = @json($images);
  let active = 0;
  const main = document.getElementById('mainImage');
  const thumbs = document.querySelectorAll('#thumbs .thumb');
  const prev = document.getElementById('prevSlide');
  const next = document.getElementById('nextSlide');

  function render(idx) {
    if (!imgs.length) return;
    active = (idx + imgs.length) % imgs.length;
    if (main) main.src = imgs[active];
    thumbs.forEach((t, i) => t.classList.toggle('thumb-hide', i === active));
  }

  thumbs.forEach(t => {
    t.addEventListener('click', e => render(+e.currentTarget.dataset.index));
  });
  prev?.addEventListener('click', () => render(active - 1));
  next?.addEventListener('click', () => render(active + 1));
</script>
@endsection