@extends('layouts.app')

@section('content')
<div class="container">
  <h1 class="mb-4">Booking: {{ $tour->title }}</h1>

  {{-- Tour Summary --}}
  <div class="mb-4">
    <p><strong>Country:</strong> {{ $tour->country }}</p>
    <p><strong>Start from:</strong> {{ $tour->start_location }}</p>
    <p><strong>Price:</strong> <span class="text-primary fw-bold">{{ number_format($tour->price, 2) }} ฿</span> per person</p>
  </div>

  {{-- Success Message --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  {{-- Booking Form --}}
  <form method="POST" action="{{ route('booking.store') }}" class="row g-3">
    @csrf
    <input type="hidden" name="tour_id" value="{{ $tour->id }}">

    <div class="col-md-6">
      <label class="form-label">Full Name</label>
      <input type="text" name="full_name" class="form-control" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Phone</label>
      <input type="text" name="phone" class="form-control" required>
    </div>

    <div class="col-md-6">
      <label class="form-label">Nationality</label>
      <input type="text" name="nationality" class="form-control">
    </div>

    <div class="col-md-6">
      <label class="form-label">Travel Date</label>
      <input type="date" name="travel_date" class="form-control" required>
    </div>

    <div class="col-md-3">
      <label class="form-label">Adults</label>
      <input type="number" name="adults" class="form-control" min="1" value="1" required>
    </div>

    <div class="col-md-3">
      <label class="form-label">Children</label>
      <input type="number" name="children" class="form-control" min="0" value="0">
    </div>

    <div class="col-12">
      <label class="form-label">Special Request</label>
      <textarea name="special_request" class="form-control" rows="3"></textarea>
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-primary btn-lg w-100">Confirm Booking</button>
    </div>
  </form>

  <a href="{{ route('tours.index') }}" class="btn btn-outline-secondary mt-4">← Back to All Tours</a>
</div>
@endsection
