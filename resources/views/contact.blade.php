@extends('layouts.app')

<style>
    .bg-yellow {
        background-color: #ffd93d;
        /* สีเหลืองโลโก้ */
        padding-bottom: 15px;
    }

    .qr-img {
  width: 80%;
  height: 80px;  /* ลดจาก 150px เหลือ 120px */
  object-fit: cover;
  border-radius: 6px;
}
</style>


@section('content')
{{-- Hero Banner --}}
<div style="width:100vw; max-width:100vw; margin-left:calc(50% - 50vw); overflow:hidden; height:clamp(180px, 24vw, 320px);">
    <img src="{{ asset('storage/assets/summer.jpg') }}" alt="Explore Our Tours"
        style="width:100%; height:100%; object-fit:cover; object-position:center;">
</div>

{{-- Contact Section --}}
<div class="container py-3">
    <div class="row align-items-center justify-content-center">

        {{-- Left Image --}}
        <div class="col-lg-6 mb-4 mb-lg-0 text-center">
            <img src="{{ asset('storage/assets/discover.png') }}" alt="Discover Southeast Asia"
                class="img-fluid rounded shadow" style="max-height: 520px; object-fit: cover;">
        </div>

        {{-- Right Contact Form --}}
        <div class="col-lg-6">
            <div class="card shadow-lg rounded-4 border-0">
                <div class="card-body p-5">
                    <h2 class="mb-4 text-center fw-bold">
                        <i class="bi bi-envelope-paper-heart text-primary me-2"></i>Contact Us
                    </h2>
                    @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form method="POST" action="{{ route('contact.send') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">ชื่อของคุณ <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control rounded-3" required value="{{ old('name') }}">
                            @error('name') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">อีเมล <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control rounded-3" required value="{{ old('email') }}">
                            @error('email') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">ข้อความ <span class="text-danger">*</span></label>
                            <textarea name="message" id="message" class="form-control rounded-3" rows="4" required>{{ old('message') }}</textarea>
                            @error('message') <div class="text-danger small">{{ $message }}</div> @enderror
                        </div>
                        <button type="submit" class="btn btn-primary w-100 py-2 fs-5 rounded-3">
                            <i class="bi bi-send-check me-1"></i> ส่งข้อความ
                        </button>
                    </form>
                </div>
            </div>
        </div>

    </div>
    <section class="container mt-3 mb-0 bg-yellow" style="padding-top: 30px; padding-bottom: 10px;">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Contact Us Easily</h2>
            <p class="text-muted fs-5">Reach out to us anytime via your favorite app or direct contact below</p>
        </div>

        <div class="row justify-content-center g-4">

            <div class="col-6 col-md-3">
                <div class="card shadow-sm p-3 h-100 text-center">
                    <img src="{{ asset('storage/qrcodes/line-qr.png') }}" alt="LINE QR Code"
                        class="img-fluid rounded mb-3 qr-img qr-img mx-auto d-block">
                    <h6 class="fw-bold">LINE Official</h6>
                    <p class="small text-muted mb-0">Scan to chat with us via LINE</p>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="card shadow-sm p-3 h-100 text-center">
                    <img src="{{ asset('storage/qrcodes/whatsapp-qr.png') }}" alt="WhatsApp QR Code"
                        class="img-fluid rounded mb-3 qr-img qr-img mx-auto d-block">
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
                    <p class="small text-muted mb-1"> <b>+66 98 836 1459</b></p>
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