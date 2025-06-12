@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 720px">

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

  {{-- Validation Errors --}}
  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  {{-- Booking Form --}}
  <form action="{{ route('bookings.store') }}" method="POST">
    @csrf
    <input type="hidden" name="tour_id" value="{{ $tour->id }}">
    <input type="hidden" name="total_price" value="{{ $tour->price }}">

    <div class="row">
      <div class="col-md-6 mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
      </div>

      <div class="col-md-6 mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
      </div>

      <div class="col-md-6 mb-3">
        <label class="form-label">Phone</label>
        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
      </div>

      <div class="col-md-6 mb-3">
        <label class="form-label">Nationality</label>
        <input type="text" name="nationality" class="form-control" value="{{ old('nationality') }}">
      </div>

      <div class="col-md-6 mb-3">
        <label class="form-label">Select Departure Date</label>
        <select name="tour_departure_id" class="form-control" required>
          <option value="">-- Select a date --</option>
          @foreach($tour->departures as $departure)
            <option value="{{ $departure->id }}" {{ old('tour_departure_id') == $departure->id ? 'selected' : '' }}>
              {{ \Carbon\Carbon::parse($departure->start_date)->format('F j, Y') }} - ฿{{ number_format($departure->price, 2) }}
            </option>
          @endforeach
        </select>
      </div>

      <div class="col-md-6 mb-3">
        <label class="form-label">Adults</label>
        <input type="number" name="adults" class="form-control" min="1" value="{{ old('adults', 1) }}" required>
      </div>

      <div class="col-md-6 mb-3">
        <label class="form-label">Children</label>
        <input type="number" name="children" class="form-control" min="0" value="{{ old('children', 0) }}">
      </div>

      <div class="col-md-6 mb-3">
        <label class="form-label">Number of People</label>
        <input type="number" name="num_people" class="form-control" min="1" value="{{ old('num_people', 1) }}" required>
      </div>

      <div class="col-12 mb-4">
        <label class="form-label">Special Request</label>
        <textarea name="special_request" class="form-control" rows="3">{{ old('special_request') }}</textarea>
      </div>

      <div class="col-12">
        <button type="submit" class="btn btn-primary btn-lg w-100">Confirm Booking</button>
      </div>
    </div>
  </form>

  <a href="{{ route('tours.index') }}" class="btn btn-outline-secondary mt-4">← Back to All Tours</a>
</div>
@endsection
