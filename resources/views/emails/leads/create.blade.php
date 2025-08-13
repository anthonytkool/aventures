@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h3 class="mb-3">Enquire: {{ $tour->title }}</h3>

  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <form method="POST" action="{{ route('enquiries.store', $tour) }}" class="row g-3" id="enquiry-form">
    @csrf
    <div class="col-md-6">
      <label class="form-label">First name</label>
      <input name="first_name" class="form-control @error('first_name') is-invalid @enderror"
             value="{{ old('first_name') }}" required>
      @error('first_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
      <label class="form-label">Last name</label>
      <input name="last_name" class="form-control @error('last_name') is-invalid @enderror"
             value="{{ old('last_name') }}" required>
      @error('last_name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
      <label class="form-label">Email</label>
      <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
             value="{{ old('email') }}" required>
      @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
      <label class="form-label">Phone / WhatsApp / Line</label>
      <input name="phone" class="form-control @error('phone') is-invalid @enderror"
             value="{{ old('phone') }}">
      @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
      <label class="form-label">Tour start date</label>
      <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror"
             value="{{ old('start_date') }}" required>
      @error('start_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3">
      <label class="form-label">Adults</label>
      <input type="number" name="adults" min="1" max="99"
             class="form-control @error('adults') is-invalid @enderror"
             value="{{ old('adults', 1) }}" required>
      @error('adults') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-3">
      <label class="form-label">Children</label>
      <input type="number" name="children" min="0" max="99"
             class="form-control @error('children') is-invalid @enderror"
             value="{{ old('children', 0) }}">
      @error('children') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12">
      <label class="form-label">Message</label>
      <textarea name="message" rows="4"
        class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
      @error('message') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <input type="hidden" name="website" value="">

    <div class="col-12">
      <button id="submit-btn" class="btn btn-primary">Send enquiry</button>
    </div>
  </form>
</div>

<script>
  const form = document.getElementById('enquiry-form');
  const btn  = document.getElementById('submit-btn');
  form.addEventListener('submit', () => { btn.disabled = true; btn.innerText = 'Sending...'; });
</script>
@endsection
