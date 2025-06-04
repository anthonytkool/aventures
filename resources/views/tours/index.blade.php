@extends('layouts.app')

@section('content')
<div class="container py-5">

  <h1 class="fw-bold text-center mb-4">All Tours</h1>

  <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4">
    @foreach ($tours as $tour)
    <div class="col">
      <div class="card h-100 shadow-sm">
        <img src="{{ asset($tour->image_url) }}" alt="{{ $tour->title }}"
             style="height: 180px; object-fit: cover; width: 100%;" class="rounded-top">
        <div class="card-body d-flex flex-column">
          <small class="text-muted">{{ $tour->days }} DAY TOUR</small>
          <h6 class="fw-bold mt-1">{{ $tour->title }}</h6>
          <small class="text-muted mb-2">Valid on {{ \Carbon\Carbon::parse($tour->valid_date)->format('M d, Y') }}</small>
          <p class="fw-bold mt-auto mb-2">{{ number_format($tour->price, 2) }} ฿ <span class="text-muted small">per person</span></p>
          <a href="{{ route('tours.show', $tour->id) }}" class="btn btn-outline-primary btn-sm">View Itinerary</a>
        </div>
      </div>
    </div>
    @endforeach
  </div>

 <div class="d-flex justify-content-center mt-5">
  {{ $tours->links() }}
</div>


</div>
@endsection
