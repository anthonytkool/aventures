{{-- resources/views/emails/leads/thanks.blade.php --}}
@extends('layouts.app')

@section('content')
@php
  $ref   = session('lead_ref');        // AT-YYMMDD-ID
  $tour  = session('tour_title');      // ชื่อทัวร์
  $phone = config('services.whatsapp.phone', '66988361459');

  $text  = rawurlencode("Hi AventureTrip, my ref is {$ref}. I'm following up about: {$tour}");
  $waUrl = "https://wa.me/{$phone}?text={$text}";
@endphp

<div class="container py-5 text-center">
  <h3>Thanks! We’ve received your enquiry.</h3>
  @if($ref)
    <p class="text-muted mb-1">Reference: <b>{{ $ref }}</b></p>
  @endif
  <p>We’ll get back to you shortly.</p>

  <div class="mt-3">
    <a href="{{ $waUrl }}" class="btn btn-success me-2">Chat on WhatsApp</a>
    <a href="{{ route('home') }}" class="btn btn-outline-secondary">Back to Home</a>
  </div>
</div>
@endsection
