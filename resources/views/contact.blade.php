@extends('layouts.app')

@section('content')
{{-- Travel Banner --}}
<div style="width:100vw; max-width:100vw; margin-left:calc(50% - 50vw); background:#f6fafc; overflow:hidden; height:clamp(180px, 24vw, 320px);">
    <img src="{{ asset('storage/assets/summer.jpg') }}" alt="Explore Our Tours"
        style="width:100vw; min-width:100vw; height:100%; object-fit:cover; object-position:center; display:block;">
</div>


<div class="container py-5" style="min-height: 70vh;">
    <div class="row justify-content-center">
        <div class="col-lg-6 col-md-8">
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
</div>
@endsection
