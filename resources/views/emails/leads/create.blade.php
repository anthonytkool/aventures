@extends('layouts.app')

@section('content')

<style>
  /* ===== Enquiry Page Styling (local to this page) ===== */
  .enquiry-wrap {
    background: linear-gradient(135deg, #fdf7e3 0%, #e6f0ff 100%); /* yellow + blue soft */
    padding: 2rem 1rem;
  }
  .enquiry-hero {
    background: #ffffffaa;
    border: 2px solid #dbeafe;         /* blue-100 */
    border-radius: 14px;
    padding: 1.25rem 1.5rem;
    box-shadow: 0 6px 18px rgba(2,132,199,.08);
  }
  .enquiry-hero h1 {
    font-weight: 800;
    letter-spacing: .2px;
    margin: 0 0 .25rem 0;
  }
  .enquiry-hero .lead {
    color: #334155;                     /* slate-700 */
    margin: 0;
  }
  .enquiry-card {
    border: 2px solid #dbeafe;
    border-radius: 14px;
    transition: box-shadow .15s ease, transform .15s ease;
  }
  .enquiry-card:hover {
    transform: translateY(-1px);
    box-shadow: 0 10px 28px rgba(2,132,199,.12);
  }
  .label-small {
    font-size: .95rem;
    font-weight: 600;
    color: #0f172a;                     /* slate-900 */
  }
  /* ขยายกล่องข้อความให้เต็ม พร้อมปรับมุมโค้ง */
  textarea[name="message"] {
    width: 100% !important;
    min-height: 140px;
    resize: vertical;
    border-radius: .6rem;
  }
  /* ปุ่มให้เข้าธีม + ไอคอน */
  .btn-enquiry {
    background: #1d4ed8;
    border-color: #1d4ed8;
    font-weight: 700;
    border-radius: .6rem;
  }
  .btn-enquiry:hover {
    background: #1e40af;
    border-color: #1e40af;
  }
  .hint {
    color: #64748b;                     /* slate-500 */
    font-size: .875rem;
  }
  .badge-soft {
    background: #fde68a;                /* yellow-300 */
    color: #1f2937;                     /* gray-800 */
    border-radius: 999px;
    padding: .35rem .65rem;
    font-weight: 600;
    box-shadow: 0 2px 6px rgba(0,0,0,.08);
  }
</style>

<div class="enquiry-wrap">
  <div class="container" style="max-width: 980px;">
    {{-- Header / Hero --}}
    <div class="enquiry-hero mb-4">
      <div class="d-flex align-items-center gap-2 flex-wrap">
        <span class="badge-soft"><i class="bi bi-clock-history me-1"></i>Lead time: {{ $leadDays ?? 2 }} day(s)</span>
      </div>
      <h1 class="h3 mt-3 mb-1">
        Enquiry — {{ $tour->title ?? $tour->name ?? 'Tour' }}
      </h1>
      <p class="lead">
        Please book at least <strong>{{ $leadDays ?? 2 }} day(s)</strong> in advance so we can organize vehicle, driver and guide.
      </p>
    </div>

    {{-- Error summary --}}
    @if ($errors->any())
      <div class="alert alert-danger border-0 shadow-sm">
        <div class="fw-semibold mb-1">Please fix the following:</div>
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Form Card --}}
    <div class="card enquiry-card shadow-sm mb-5">
      <div class="card-body p-4 p-md-5">
        <form method="POST" action="{{ route('enquiries.store', $tour) }}" novalidate>
          @csrf

          <div class="row g-3">
            <div class="col-md-6">
              <label class="form-label label-small">First name</label>
              <input type="text" name="first_name"
                     class="form-control @error('first_name') is-invalid @enderror"
                     value="{{ old('first_name') }}" maxlength="120" required>
              @error('first_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label class="form-label label-small">Last name</label>
              <input type="text" name="last_name"
                     class="form-control @error('last_name') is-invalid @enderror"
                     value="{{ old('last_name') }}" maxlength="120" required>
              @error('last_name')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label class="form-label label-small">Email</label>
              <input type="email" name="email"
                     class="form-control @error('email') is-invalid @enderror"
                     value="{{ old('email') }}" required>
              @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label class="form-label label-small">Phone (optional)</label>
              <input type="text" name="phone"
                     class="form-control @error('phone') is-invalid @enderror"
                     value="{{ old('phone') }}" maxlength="60">
              @error('phone')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-6">
              <label class="form-label label-small">Start date</label>
              <input type="date" name="start_date"
                     class="form-control @error('start_date') is-invalid @enderror"
                     min="{{ $minDate }}"
                     value="{{ old('start_date') }}"
                     required>
              @error('start_date')<div class="invalid-feedback">{{ $message }}</div>@enderror
              <div class="hint mt-1">
                Must be on or after {{ \Carbon\Carbon::parse($minDate)->format('M d, Y') }}
              </div>
            </div>

            <div class="col-md-3">
              <label class="form-label label-small">Adults</label>
              <input type="number" name="adults" min="1" max="99"
                     class="form-control @error('adults') is-invalid @enderror"
                     value="{{ old('adults', 2) }}" required>
              @error('adults')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-md-3">
              <label class="form-label label-small">Children</label>
              <input type="number" name="children" min="0" max="99"
                     class="form-control @error('children') is-invalid @enderror"
                     value="{{ old('children', 0) }}">
              @error('children')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            <div class="col-12">
              <label class="form-label label-small">Message (optional)</label>
              <textarea name="message" class="form-control @error('message') is-invalid @enderror"
                        placeholder="Any notes or preferences..." maxlength="1200">{{ old('message') }}</textarea>
              @error('message')<div class="invalid-feedback">{{ $message }}</div>@enderror
            </div>

            {{-- Honeypot --}}
            <input type="text" name="website" value="" style="display:none !important">

            <div class="col-12 mt-2">
              <button type="submit" class="btn btn-enquiry w-100">
                <i class="bi bi-send me-1"></i> Send enquiry
              </button>
            </div>
          </div>
        </form>
      </div>
    </div>

    {{-- Trust badges / small info (optional) --}}
    <div class="text-center text-muted small">
    <b>TAT License No. 11/12659 — AventureTrip • Secure form — your details are kept private.</b>  
    </div>
  </div>
</div>

{{-- Realtime date guard (เลือกวันก่อน min จะเตือนและล้างค่า) --}}
<script>
  document.addEventListener('DOMContentLoaded', function () {
    const dateInput = document.querySelector('input[name="start_date"]');
    const minDate = new Date("{{ $minDate }}");
    dateInput?.addEventListener('change', function () {
      const d = new Date(this.value);
      if (this.value && d < minDate) {
        alert('Please select a date on or after {{ \Carbon\Carbon::parse($minDate)->format('M d, Y') }}.');
        this.value = '';
        this.focus();
      }
    });
  });
</script>

@endsection
