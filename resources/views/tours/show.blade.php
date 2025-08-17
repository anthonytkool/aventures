@extends('layouts.app')

@php
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

/* ============ รูปจาก storage/app/public/eachTours/{id} ============ */
$dir = "eachTours/{$tour->id}";
$images = collect(Storage::disk('public')->files($dir))
->filter(fn($p) => preg_match('/\.(jpe?g|png|webp)$/i', $p))
->sort()->map(fn($p) => Storage::url($p))->values();

/* ============ เตรียมข้อมูลให้แท็บ (ค่าเดิม) ============ */
$highlightsRaw = strip_tags($tour->highlights ?? $tour->overview ?? '');
$splitter = '/\r?\n|•/u';
$highlights = collect(preg_split($splitter, $highlightsRaw))
->map(fn($s)=>trim($s))->filter()->take(12);

// ✅ Included: อ่านจากตาราง tour_inclusions (คอลัมน์ notes)
$includedRaw = (string) (DB::table('tour_inclusions')
->where('tour_id', $tour->id)
->value('notes') ?? '');

$included = collect(preg_split($splitter, strip_tags($includedRaw)))
->map(fn($s)=>trim($s))->filter();

// ❌ Not included: ใช้ข้อความ fallback (ไม่ query ตาราง tour_exclusions)
$excludedRaw = "Personal expenses & optional drinks
Temple dress items (if needed)
Pick-ups outside central Bangkok (surcharge may apply)";

$excluded = collect(preg_split($splitter, strip_tags($excludedRaw)))
->map(fn($s)=>trim($s))->filter();

/* Itinerary: ถ้ามี $tour->itinerary (HTML) ก็ใช้เลย
ถ้าไม่มี พยายามแตกจาก description โดยหา "Day " */
$itineraryHtml = $tour->itinerary ?? null;
$days = [];
if (!$itineraryHtml) {
$tmp = preg_split('/\bDay\s*\d+/i', strip_tags($tour->description ?? ''), -1, PREG_SPLIT_NO_EMPTY);
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

/* ============ Quick Info (ค่า default ใช้ได้ทุกทัวร์) ============ */
$quick = [
'duration' => $tour->duration ?? 'Full Day (≈ 7–8 hrs)',
'start_end' => 'Bangkok hotel pick-up & drop-off',
'start_time'=> 'Morning start ≈ 08:00',
'pickup' => 'Central Bangkok pick-up included',
'group' => !empty($tour->group_size) ? $tour->group_size : 'Small group (private on request)',
'language' => !empty($tour->guide) ? $tour->guide : 'English-speaking local guide',
'dress' => 'Dress: shoulders & knees covered',
'activity' => 'Activity: Easy–Moderate (6–9k steps)',
'child' => 'Children welcome',
'cancel' => 'Free ≥15 days; 50% for 14–8 days; 100% ≤7 days',
'note' => '',
'badges' => ['Temple','Boat','Royal heritage'],
];

/* ============ Override เฉพาะทัวร์ Bangkok Royal Heritage ============ */
$slug = (string)($tour->slug ?? '');
$isBkkRoyal = $slug === 'bangkok-grand-palace-temple-tour';

if ($isBkkRoyal) {
// ป้ายบน Quick Info
$quick['badges'] = ['Grand Palace','Wat Pho','Wat Arun','Canal ride'];
$quick['note'] = 'Royal Barge Museum visit on open days/times.';

// Highlights (fallback เมื่อ DB ยังว่าง)
$highlightsManual = [
'Grand Palace & Emerald Buddha — Thailand’s most revered royal complex',
'Wat Pho — home of the 46 m (150 ft) Reclining Buddha & traditional massage school',
'Royal Barge Museum — unique ceremonial boats used in royal processions',
'Cross to Wat Arun (Temple of Dawn) for skyline views + King Taksin founding story',
'Long-tail canal ride — glimpse local riverside life',
'Short tuk-tuk hop near the Grand Palace (fun photo moment)',
'Small-group pace with licensed English-speaking guide',
];
if (!$highlights->count()) {
$highlights = collect($highlightsManual);
}

// Included / Excluded (fallback)
$includedManual = [
'Licensed English-speaking guide',
'Hotel pick-up & drop-off (central Bangkok)',
'All entrance fees (Grand Palace, Wat Pho, Wat Arun; Royal Barge Museum when open)',
'Long-tail canal ride',
'Transport as per itinerary',
];
$excludedManual = [
'Meals & personal expenses',
'Temple dress items (if needed)',
'Pick-ups outside central Bangkok (surcharge may apply)',
];
if (!$included->count()) $included = collect($includedManual);
if (!$excluded->count()) $excluded = collect($excludedManual);

// Itinerary (fallback เป็น bullet รายชั่วโมง)
if (empty($itineraryHtml) && empty($days)) {
$days = collect([
'08:00 Pick-up from hotel (central Bangkok).',
'Grand Palace & Emerald Buddha — royal halls & sacred chapel.',
'Wat Pho — Reclining Buddha & temple grounds.',
'Long-tail canal ride — scenic khlongs & riverside life.',
'Royal Barge Museum — exquisitely carved ceremonial boats (when open).',
'Ferry across to Wat Arun — skyline views + King Taksin founding story.',
'Drop-off back at hotel (late afternoon).',
]);
}

// FAQs (fallback)
if (empty($faqs)) {
$faqs = [
['q'=>'Is the Grand Palace dress code strict?',
'a'=>'Yes. Shoulders and knees must be covered. Avoid sleeveless tops, short shorts, ripped jeans. Sarongs can be rented onsite.'],
['q'=>'How much walking is involved?',
'a'=>'Easy–moderate on paved temple grounds (typically 6,000–9,000 steps).'],
['q'=>'Can vegetarians/vegans be catered for at lunch?',
'a'=>'Lunch is not included but your guide will recommend suitable places. Please tell us in advance.'],
['q'=>'Is the canal boat safe?',
'a'=>'Yes. Boats operate on calm canals/river and carry life jackets.'],
['q'=>'What if it rains?',
'a'=>'Tours run in light rain; we adjust timing/routes and provide ponchos if needed.'],
['q'=>'What’s the cancellation policy?',
'a'=>'Free ≥15 days before the tour; 50% for 14–8 days; 100% for 7 days or less prior.'],
];
}
}
@endphp

@section('head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
<style>
  /* ====== Gallery ====== */
  .tour-photo {
    height: 460px;
    object-fit: cover;
    border-radius: 10px
  }

  .thumb {
    height: 80px;
    width: 120px;
    object-fit: cover;
    border-radius: 6px;
    opacity: .8;
    border: 2px solid transparent;
    transition: .12s
  }

  .thumb:hover {
    opacity: 1;
    border-color: #0d6efd
  }

  .thumb-hide {
    display: none !important
  }

  .thumbs-row {
    display: flex;
    gap: .6rem;
    overflow-x: auto;
    padding: .4rem .2rem
  }

  .gallery-arrows {
    display: flex;
    justify-content: center;
    gap: .5rem
  }

  .gallery-arrows .btn {
    border: 1px solid #ddd
  }

  /* ====== Layout ====== */
  .sticky-lg-top {
    top: 90px
  }

  .info-list li {
    margin: .15rem 0
  }

  .icon-dot {
    width: 1.05rem;
    height: 1.05rem;
    display: inline-grid;
    place-items: center;
    border-radius: 50%;
    margin-right: .45rem;
    font-size: .75rem
  }

  .ok {
    background: #eaf7ef;
    color: #2e7d32;
    border: 1px solid #cdebd7
  }

  .no {
    background: #fdecea;
    color: #b42318;
    border: 1px solid #f3c1bd
  }

  .tab-pane {
    padding-top: 1rem
  }

  /* ====== Quick Info (ใหม่) ====== */
  .qi-badges {
    display: flex;
    gap: .4rem;
    flex-wrap: wrap;
    margin: -.25rem 0 .5rem
  }

  .qi-badge {
    font-size: .8rem;
    background: #f1f5ff;
    color: #0d6efd;
    border: 1px solid #dbe7ff;
    padding: .2rem .55rem;
    border-radius: 9999px;
    display: inline-flex;
    align-items: center;
    gap: .35rem
  }

  .qi-list {
    list-style: none;
    padding-left: 0;
    margin: 0
  }

  .qi-item {
    display: flex;
    gap: .6rem;
    padding: .35rem 0;
    border-bottom: 1px dashed #eee
  }

  .qi-item i {
    width: 1.25rem;
    text-align: center;
    color: #6c757d
  }

  .qi-note {
    font-size: .85rem;
    color: #6c757d
  }
</style>
@endsection

@section('content')
<div class="container py-4">
  <div class="row g-4">
    {{-- ===== Left: Gallery & Tabs ===== --}}
    <div class="col-lg-7">

      {{-- ====== GALLERY ====== --}}
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
      <h2 class="fw-bold mb-1">{{ $tour->title }}
      </h2>
      <span class="badge bg-primary ms-2">Code: FDBKKX</span>
      <span class="badge bg-danger ms-2">Exclusive Tour</span>

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

    {{-- ===== Right: Quick Info (อัปเกรดใหม่ แต่คงปุ่ม Book Now เดิม) ===== --}}
    <div class="col-lg-5">
      <div class="card shadow-sm sticky-lg-top">
        <div class="card-body">
          <h5 class="fw-bold text-primary mb-2">Quick Info</h5>

          <div class="qi-badges mb-2">
            @foreach(($quick['badges'] ?? []) as $b)
            <span class="qi-badge"><i class="bi bi-patch-check"></i> {{ $b }}</span>
            @endforeach
          </div>

          <div class="mb-2"><strong>Price:</strong>
            {{ $tour->price ? number_format($tour->price).' ฿' : 'N/A' }}
            <span class="qi-note"> / person</span>
          </div>

          <ul class="qi-list">
            <li class="qi-item"><i class="bi bi-clock-history"></i><span><strong>Duration:</strong> {{ $quick['duration'] }}</span></li>
            <li class="qi-item"><i class="bi bi-geo-alt"></i><span><strong>Start / End:</strong> {{ $quick['start_end'] }}</span></li>
            <li class="qi-item"><i class="bi bi-alarm"></i><span><strong>Start time:</strong> {{ $quick['start_time'] }}</span></li>
            <li class="qi-item"><i class="bi bi-truck"></i><span><strong>Pickup:</strong> {{ $quick['pickup'] }}</span></li>
            <li class="qi-item"><i class="bi bi-people"></i><span><strong>Group size:</strong> {{ $quick['group'] }}</span></li>
            <li class="qi-item"><i class="bi bi-translate"></i><span><strong>Language:</strong> {{ $quick['language'] }}</span></li>
            <li class="qi-item"><i class="bi bi-check2-circle"></i><span><strong>{{ $quick['dress'] }}</strong></span></li>
            <li class="qi-item"><i class="bi bi-activity"></i><span><strong>{{ $quick['activity'] }}</strong></span></li>
            <li class="qi-item"><i class="bi bi-emoji-smile"></i><span><strong>{{ $quick['child'] }}</strong></span></li>
            <li class="qi-item"><i class="bi bi-shield-check"></i><span><strong>Cancellation:</strong> {{ $quick['cancel'] }}</span></li>
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
  // ====== Simple gallery (ไม่ใช้ lib เพื่อความเสถียร) ======
  const imgs = @json($images);
  let active = 0;
  const main = document.getElementById('mainImage');
  const thumbs = document.querySelectorAll('#thumbs .thumb');
  const prev = document.getElementById('prevSlide');
  const next = document.getElementById('nextSlide');

  function render(idx) {
    active = (idx + imgs.length) % imgs.length;
    if (main) {
      main.src = imgs[active];
    }
    thumbs.forEach((t, i) => t.classList.toggle('thumb-hide', i === active));
  }
  thumbs.forEach(t => {
    t.addEventListener('click', e => {
      render(+e.currentTarget.dataset.index);
    });
  });
  prev?.addEventListener('click', () => render(active - 1));
  next?.addEventListener('click', () => render(active + 1));
</script>
@endsection