@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 760px;">
  <h1 class="mb-3">Enquiry — {{ $tour->title ?? $tour->name ?? 'Tour' }}</h1>
  <p class="text-muted">
    Please book at least <strong>{{ $leadDays ?? 2 }}</strong> day(s) in advance so we can organize vehicle, driver and guide.
  </p>

  <div class="card shadow-sm">
    <div class="card-body">

    @if ($errors->any())
  <div class="alert alert-danger">
    <div class="fw-semibold mb-1">Please fix the following:</div>
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif


      <form action="{{ url('/enquire/'.$tour->slug) }}" method="POST" novalidate>
        @csrf

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">First name</label>
            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror"
              value="{{ old('first_name') }}" required maxlength="120">
            @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-md-6">
            <label class="form-label">Last name</label>
            <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror"
              value="{{ old('last_name') }}" required maxlength="120">
            @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-md-6">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
              value="{{ old('email') }}" required>
            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-md-6">
            <label class="form-label">Phone (optional)</label>
            <input type="text" name="phone" class="form-control @error('phone') is-invalid @enderror"
              value="{{ old('phone') }}" maxlength="60">
            @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
          </div>

          <div class="col-md-6">
            <label class="form-label">Start date</label>
            <input type="date" name="start_date"
              class="form-control @error('start_date') is-invalid @enderror"
              min="{{ $minDate }}"
              value="{{ old('start_date') }}"
              required>
            <div class="form-text">
              Must be on or after {{ \Carbon\Carbon::parse($minDate)->format('M d, Y') }}
            </div>


            <div class="col-md-3">
              <label class="form-label">Adults</label>
              <input type="number" name="adults" class="form-control @error('adults') is-invalid @enderror"
                value="{{ old('adults', 2) }}" min="1" max="99" required>
              @error('adults')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-3">
              <label class="form-label">Children</label>
              <input type="number" name="children" class="form-control @error('children') is-invalid @enderror"
                value="{{ old('children', 0) }}" min="0" max="99">
              @error('children')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
              <label class="form-label">Message (optional)</label>
              <textarea name="message" rows="4" class="form-control @error('message') is-invalid @enderror"
                maxlength="1200" placeholder="Any notes or preferences…">{{ old('message') }}</textarea>
              @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            {{-- Honeypot --}}
            <input type="text" name="website" value="" style="display:none !important;" tabindex="-1" autocomplete="off">

            <div class="col-12">
              <button type="submit" class="btn btn-primary w-100">Send enquiry</button>
            </div>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection