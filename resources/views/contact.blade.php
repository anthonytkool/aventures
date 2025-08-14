@extends('layouts.app')

<style>
  .bg-yellow {
    background-color: #ffd93d; /* brand yellow */
    padding-bottom: 15px;
  }
  .qr-img {
    width: 80%;
    height: 80px;          /* was 150px; keep small and uniform */
    object-fit: cover;
    border-radius: 6px;
  }
</style>

@section('content')
{{-- Hero Banner --}}
<div style="width:100vw; max-width:100vw; margin-left:calc(50% - 50vw); overflow:hidden; height:clamp(180px, 24vw, 320px);">
  <img src="{{ asset('storage/assets/beach.jpg') }}" alt="Explore Our Tours"
       style="width:100%; height:100%; object-fit:cover; object-position:center;">
</div>

{{-- Contact Section --}}
<div class="container py-3">
  <div class="row align-items-center justify-content-center">

    {{-- Left Image --}}
    <div class="col-lg-6 mb-4 mb-lg-0 text-center">
      <img src="{{ asset('storage/assets/contact.png') }}" alt="Discover Southeast Asia"
           class="img-fluid rounded shadow" style="max-height: 520px; object-fit: cover;">
    </div>

    {{-- Right Contact Form --}}
    <div class="col-lg-6">
      <div class="card shadow-lg rounded-4 border-0">
        <div class="card-body p-5">
          <h2 class="mb-4 text-center fw-bold">
            <i class="bi bi-envelope-paper-heart text-primary me-2"></i>Contact Us
          </h2>

          {{-- Success / Ref --}}
          @if (session('contact_ok'))
            <div class="alert alert-success">
              Thanks! Your message has been received.
              @if (session('contact_ref'))
                <div class="small text-muted">Ref: <strong>{{ session('contact_ref') }}</strong></div>
              @endif
            </div>
          @endif

          {{-- Validation errors --}}
          @if ($errors->any())
            <div class="alert alert-danger">
              <ul class="mb-0">
                @foreach ($errors->all() as $e)
                  <li>{{ $e }}</li>
                @endforeach
              </ul>
            </div>
          @endif

          <form method="POST" action="{{ route('contact.store') }}" class="row g-3" novalidate>
            @csrf

            <div class="col-12">
              <label for="name" class="form-label">Your Name *</label>
              <input id="name" name="name"
                     class="form-control @error('name') is-invalid @enderror"
                     value="{{ old('name') }}" autocomplete="name" required>
              @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label for="email" class="form-label">Email *</label>
              <input id="email" type="email" name="email"
                     class="form-control @error('email') is-invalid @enderror"
                     value="{{ old('email') }}" autocomplete="email" required>
              @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label for="phone" class="form-label">Phone / WhatsApp (optional)</label>
              <input id="phone" name="phone"
                     class="form-control @error('phone') is-invalid @enderror"
                     value="{{ old('phone') }}" inputmode="tel" autocomplete="tel">
              @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
              <label for="message" class="form-label">Message *</label>
              <textarea id="message" name="message" rows="5"
                        class="form-control @error('message') is-invalid @enderror"
                        placeholder="Tell us which tour, travel dates, and number of guests"
                        required>{{ old('message') }}</textarea>
              @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            {{-- Honeypot --}}
            <input type="text" name="website" value="" hidden>

            <div class="col-12">
              <button class="btn btn-primary w-100" type="submit">
                Send Message
              </button>
            </div>
          </form>

        </div>
      </div>
    </div>

  </div>

  {{-- Contact methods --}}
  <section class="container mt-3 mb-0 bg-yellow" style="padding-top: 30px; padding-bottom: 10px;">
    <div class="text-center mb-4">
      <h2 class="fw-bold">Contact Us Easily</h2>
      <p class="text-muted fs-5">Reach out via your favorite app or use our direct contacts below.</p>
    </div>

    <div class="row justify-content-center g-4">
      <div class="col-6 col-md-3">
        <div class="card shadow-sm p-3 h-100 text-center">
          <img src="{{ asset('storage/qrcodes/line-qr.png') }}" alt="LINE QR Code"
               class="img-fluid rounded mb-3 qr-img mx-auto d-block">
          <h6 class="fw-bold">LINE Official</h6>
          <p class="small text-muted mb-0">Scan to chat with us on LINE</p>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="card shadow-sm p-3 h-100 text-center">
          <img src="{{ asset('storage/qrcodes/whatsapp-qr.png') }}" alt="WhatsApp QR Code"
               class="img-fluid rounded mb-3 qr-img mx-auto d-block">
          <h6 class="fw-bold">WhatsApp</h6>
          <p class="small text-muted mb-0">Instant chat via WhatsApp</p>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="card shadow-sm p-3 h-100 text-center d-flex flex-column justify-content-center">
          <div class="mb-3">
            <i class="bi bi-telephone-fill fs-1 text-primary"></i>
          </div>
          <h6 class="fw-bold">Call Us</h6>
          <p class="small text-muted mb-1"><b>+66 98 836 1459</b></p>
        </div>
      </div>

      <div class="col-6 col-md-3">
        <div class="card shadow-sm p-3 h-100 text-center d-flex flex-column justify-content-center">
          <div class="mb-3">
            <i class="bi bi-envelope-fill fs-1 text-primary"></i>
          </div>
          <h6 class="fw-bold">Email Us</h6>
          <p class="small text-muted mb-1">contact@aventuretrip.com</p>
        </div>
      </div>
    </div>
  </section>
</div>
@endsection
