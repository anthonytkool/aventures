@extends('layouts.app')

@php
use Illuminate\Support\Facades\Storage;

/* รูปจาก storage/app/public/eachTours/{id} */
$dir = "eachTours/{$tour->id}";
$files  = Storage::disk('public')->exists($dir) ? Storage::disk('public')->files($dir) : [];
$images = collect($files)
  ->filter(fn($p) => preg_match('/\.(jpe?g|png|webp)$/i', $p))
  ->sort()
  ->map(fn($p) => Storage::url($p))   // -> /storage/eachTours/{id}/xxx.jpg
  ->values();
@endphp

@section('head')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css">
<style>
  .tour-photo{height:460px;object-fit:cover;border-radius:10px}
  /* thumbnails เป็น flex ธรรมดา ไม่ใช้สไลด์ -> ไม่ค้าง */
  #thumbs{display:flex;gap:8px;overflow-x:auto;padding:.5rem .25rem}
  #thumbs .thumb{
    height:80px;width:120px;object-fit:cover;border-radius:6px;
    border:2px solid transparent;opacity:.85;cursor:pointer;transition:.15s
  }
  #thumbs .thumb:hover{opacity:1;border-color:#0d6efd}
  #thumbs .thumb.active{opacity:1;border-color:#0d6efd}
  .gallery-nav{display:flex;justify-content:center;gap:.5rem;margin-top:.5rem}
  .btn-nav{background:#fff;border:1px solid #ddd;border-radius:.5rem;padding:.5rem 1rem}
  .btn-nav:focus{outline:0;box-shadow:none} /* กันโฟกัสเป็นสี่เหลี่ยม */
</style>
@endsection

@section('content')
<div class="container py-4">
  <div class="row">
    <div class="col-md-7">

      @if ($images->count())
        {{-- สไลด์ภาพใหญ่ --}}
        <div class="glide tour-gallery mb-2">
          <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
              @foreach ($images as $i => $img)
                <li class="glide__slide" data-index="{{ $i }}">
                  <img src="{{ $img }}" class="w-100 tour-photo" alt="Tour photo {{ $i+1 }}">
                </li>
              @endforeach
            </ul>
          </div>
        </div>

        {{-- แถบ thumbnails (ไม่ซ่อนรูปไหนทั้งนั้น) --}}
        <div id="thumbs" class="mb-1">
          @foreach ($images as $i => $img)
            <img src="{{ $img }}" class="thumb" data-index="{{ $i }}" alt="Thumb {{ $i+1 }}">
          @endforeach
        </div>

        {{-- ปุ่มเลื่อน ใต้ thumbnails (ควบคุมสไลด์ใหญ่) --}}
        <div class="gallery-nav">
          <button type="button" class="btn-nav" id="galPrev">‹</button>
          <button type="button" class="btn-nav" id="galNext">›</button>
        </div>
      @else
        <div class="alert alert-light">No images yet.</div>
      @endif

      {{-- เนื้อหา --}}
      <h2 class="fw-bold mt-3">{{ $tour->title ?? 'Tour Title' }}</h2>
      <p class="lead text-muted">{{ $tour->short_description ?? 'Short description of the tour.' }}</p>
      <hr>
      {!! $tour->description ?? '<p>Tour details and itinerary will be shown here.</p>' !!}
    </div>

    <div class="col-md-5">
      <div class="card mb-3">
        <div class="card-body">
          <h4 class="fw-bold text-primary mb-3">Quick Info</h4>
          <p><b>Price:</b> {{ $tour->price ? number_format($tour->price).' ฿' : 'N/A' }}</p>
          <p><b>Duration:</b> {{ $tour->duration ?? 'N/A' }}</p>
          <p><b>Available Dates:</b> {{ $tour->dates ?? 'N/A' }}</p>
          <a href="#" class="btn btn-primary mt-2 w-100">Book Now</a>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
@if ($images->count())
<script>
  // สไลด์หลัก
  const main = new Glide('.tour-gallery', {
    type: 'carousel',
    perView: 1,
    focusAt: 'center',
    gap: 12
  });

  // ไฮไลต์ thumb ปัจจุบัน + เลื่อนให้เห็นกลางแถว
  function setActiveThumb(i){
    document.querySelectorAll('#thumbs .thumb').forEach(el=>{
      el.classList.toggle('active', parseInt(el.dataset.index,10)===i);
    });
    const active = document.querySelector('#thumbs .thumb.active');
    if(active) active.scrollIntoView({inline:'center', block:'nearest', behavior:'smooth'});
  }

  main.on(['mount.after','run.after'], () => setActiveThumb(main.index));

  // ปุ่มเลื่อน (ควบคุมสไลด์ใหญ่)
  document.getElementById('galPrev').addEventListener('click', ()=> main.go('<'));
  document.getElementById('galNext').addEventListener('click', ()=> main.go('>'));

  // คลิกที่ thumbnail -> ไปสไลด์นั้น
  document.getElementById('thumbs').addEventListener('click', (e)=>{
    const t = e.target.closest('.thumb');
    if(!t) return;
    main.go('=' + t.dataset.index);
  });

  main.mount();
</script>
@endif
@endsection
