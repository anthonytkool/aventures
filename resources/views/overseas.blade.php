@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2 class="mb-4 fw-bold text-center">ทัวร์ต่างประเทศ</h2>
  <div class="row">
    @foreach($overseasTours as $tour)
    <div class="col-md-4 mb-4 d-flex align-items-stretch">
      <div class="card shadow-sm w-100" style="min-height: 540px;">
        <img
          src="{{ asset('storage/overseas/' . $tour['image']) }}"
          class="card-img-top"
          alt="{{ $tour['title'] }}"
          style="height: 380px; object-fit: cover;"
          onerror="this.onerror=null;this.src='https://via.placeholder.com/400x325?text=No+Image';" />
        <div class="card-body d-flex flex-column">
          <h5 class="card-title fw-bold">{{ $tour['title'] }}</h5>
          <p class="card-text text-muted">{{ $tour['desc'] }}</p>
          <div class="mb-2">
            <span class="fw-bold">{{ number_format($tour['price'], 0) }} THB</span>
            <span class="text-muted small">ต่อคน</span>
          </div>
          <div class="mt-auto d-flex justify-content-center">
            @if(!empty($tour['pdf']))
            <a href="{{ asset('storage/overseas/' . $tour['pdf']) }}" class="btn btn-success btn-sm" target="_blank">
              📄 ดาวน์โหลดโปรแกรม PDF
            </a>
            @else
            <button class="btn btn-secondary btn-sm" disabled>🚫 Coming Soon</button>
            @endif
          </div>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection