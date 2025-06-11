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
 
  <form action="{{ route('booking.store') }}" method="POST">
  @csrf
  <input type="hidden" name="tour_id" value="{{ $tour->id }}">

  <div class="row">
    <div class="col-md-4 mb-3">
      <label for="first_name" class="form-label">First Name</label>
      <input type="text" class="form-control" name="first_name" value="{{ old('first_name') }}" required>
    </div>

    <div class="col-md-4 mb-3">
      <label for="middle_name" class="form-label">Middle Name</label>
      <input type="text" class="form-control" name="middle_name" value="{{ old('middle_name') }}">
    </div>

    <div class="col-md-4 mb-3">
      <label for="last_name" class="form-label">Last Name</label>
      <input type="text" class="form-control" name="last_name" value="{{ old('last_name') }}" required>
    </div>

    <div class="col-md-6 mb-3">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control" required>
    </div>

    <div class="col-md-6 mb-3">
      <label class="form-label">Phone</label>
      <input type="text" name="phone" class="form-control" required>
    </div>

    <div class="col-md-6 mb-3">
      <label class="form-label">Nationality</label>
      <input type="text" name="nationality" class="form-control">
    </div>

    <div class="col-md-6 mb-3">
      <label class="form-label">Travel Date</label>
      <input type="date" name="travel_date" class="form-control" required>
    </div>

    <div class="col-md-3 mb-3">
      <label class="form-label">Adults</label>
      <input type="number" name="adults" class="form-control" min="1" value="1" required>
    </div>

    <div class="col-md-3 mb-3">
      <label class="form-label">Children</label>
      <input type="number" name="children" class="form-control" min="0" value="0">
    </div>

    <div class="col-12 mb-4">
      <label class="form-label">Special Request</label>
      <textarea name="special_request" class="form-control" rows="3"></textarea>
    </div>

    <div class="col-12">
      <button type="submit" class="btn btn-primary btn-lg w-100">Confirm Booking</button>
    </div>
  </div>
</form>


  <a href="{{ route('tours.index') }}" class="btn btn-outline-secondary mt-4">← Back to All Tours</a>
</div>
@endsection
