@extends('layouts.app')

@section('content')
<div class="container">
  <h1>ทัวร์ต่างประเทศ</h1>
  <div class="row">
    @forelse ($overseasTours as $tour)
    <div class="col-md-4 mb-4">
      <div class="card">
        <img src="{{ asset('storage/highlight-outbounds/' . $tour['image']) }}" class="card-img-top" alt="{{ $tour['title'] }}">
        <div class="card-body">
          <h5 class="card-title">{{ $tour['title'] }}</h5>
          <p class="card-text">{{ $tour['desc'] }}</p>
          @if (!empty($tour['pdf']))
          <a href="{{ asset('storage/highlight-outbounds/' . $tour['pdf']) }}" class="btn btn-warning" target="_blank">
            ดาวน์โหลดโปรแกรม PDF
          </a>
          @endif
          <p class="mt-2 fw-bold">
            @if(isset($tour['price']) && $tour['price'])
              {{ number_format($tour['price'], 0) }} THB <span class="text-muted small ms-1">ต่อคน</span>
            @else
              <span class="text-muted small">กรุณาติดต่อสอบถามราคา</span>
            @endif
          </p>
        </div>
      </div>
    </div>
    @empty
    <div class="text-center text-muted py-5">
      ขณะนี้ไม่มีทัวร์ กรุณากลับมาใหม่ภายหลัง
    </div>
    @endforelse
  </div>
</div>
@endsection