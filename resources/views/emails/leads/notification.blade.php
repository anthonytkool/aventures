@component('mail::message')
# New Tour Enquiry

**Ref:** {{ $ref }}

- **Tour:** {{ optional($lead->tour)->title ?? '-' }}
- **Start date:** {{ $lead->start_date ? \Illuminate\Support\Carbon::parse($lead->start_date)->toFormattedDateString() : '-' }}
- **Guests:** Adults {{ $lead->adults }}{{ $lead->children ? ", Children ".$lead->children : '' }}

- **Name:** {{ $lead->name }}
- **Email:** {{ $lead->email }}
- **Phone:** {{ $lead->phone ?: '-' }}

@isset($lead->hotel)
- **Hotel:** {{ $lead->hotel ?: '-' }}
@endisset
@isset($lead->pickup)
- **Pickup:** {{ $lead->pickup ?: '-' }}
@endisset

**Message:**  
{{ $lead->message ?: '-' }}

@php
    $phone = config('services.whatsapp.phone', '66988361459');
    $tour  = optional($lead->tour)->title ?: 'a tour';
    $pax   = "Adults: {$lead->adults}".($lead->children ? ", Children: {$lead->children}" : "");
    $text  = rawurlencode("Ref {$ref} — {$tour} ({$pax})");
    $waUrl = "https://wa.me/{$phone}?text={$text}";
@endphp

@component('mail::button', ['url' => $waUrl])
WhatsApp follow-up
@endcomponent
@endcomponent
