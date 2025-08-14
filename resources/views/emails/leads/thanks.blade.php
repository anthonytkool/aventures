@extends('layouts.app')

@section('content')
<div class="container py-5" style="max-width: 760px;">
  <div class="card shadow-sm">
    <div class="card-body p-4">
      <h1 class="h3 mb-2">Thank you! Your enquiry has been sent.</h1>
      <p class="text-muted mb-4">
        We’ve received your enquiry and will confirm availability shortly.
      </p>

      <div class="alert alert-success">
        <div class="fw-semibold">Reference:</div>
        <div class="fs-5">{{ $ref }}</div>
      </div>

      <p class="mb-3">You’ll also receive an email confirmation shortly. If you need to make any changes, just reply to that email and include your reference.</p>

      <a href="{{ route('tours.index') }}" class="btn btn-primary">
        ← Back to all tours
      </a>
    </div>
  </div>
</div>
@endsection
