@extends('layouts.app')

@section('content')

{{-- Hero Image --}}
@if(isset($tour))
<div style="width:100vw; max-width:100vw; margin-left:calc(50% - 50vw); background:#f6fafc; overflow:hidden; height:clamp(180px, 24vw, 320px);">
  <img src="{{ asset($tour->image_url) }}" alt="{{ $tour->title }}" style="width:100%; height:100%; object-fit:cover; object-position:center;">
</div>
@endif

<div class="container py-5">
  <div class="row justify-content-center">
    <div class="col-lg-8">
      {{-- Title --}}
      <h1 class="fw-bold mb-3">{{ $tour->title }}</h1>

      {{-- Location Info --}}
      <p class="text-muted mb-1">
        <i class="bi bi-geo-alt"></i>
        {{ $tour->country }} &bull; Start from {{ $tour->start_location }}
      </p>

      {{-- Price --}}
      <p class="text-primary fw-bold fs-4">
        {{ number_format($tour->price, 2) }} ฿ per person
      </p>

      {{-- Description --}}
      <div class="mb-4">
        <h5 class="fw-semibold">Tour Overview</h5>
        <p>{{ $tour->full_description }}</p>
      </div>

      {{-- Back Button --}}
      <a href="{{ route('tours.index') }}" class="btn btn-outline-secondary">
        <i class="bi bi-arrow-left"></i> Back to All Tours
      </a>
    </div>
  </div>
</div>

@endsection
