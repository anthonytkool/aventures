@component('mail::message')
# Thanks! We received your enquiry

Hi {{ $lead->name }}, thanks for contacting **AventureTrip** about:

**{{ optional($lead->tour)->title ?? 'a tour' }}**

Ref: **{{ $ref }}**

Our team will get back to you shortly.  
If you’d like faster chat, tap WhatsApp below.

@php
  $phone = config('services.whatsapp.phone', '66988361459');
  $tour  = optional($lead->tour)->title ?: 'a tour';
  $pax   = "Adults: {$lead->adults}" . ($lead->children ? ", Children: {$lead->children}" : "");
  // ใส่ ref ลงในข้อความเพื่ออ้างอิงเวลาคุย
  $text  = rawurlencode("Hi AventureTrip, my ref is {$ref}. I'm interested in: {$tour} ({$pax})");
  $waUrl = "https://wa.me/{$phone}?text={$text}";
@endphp

@component('mail::button', ['url' => $waUrl])
Chat on WhatsApp
@endcomponent

Thanks,  
**AventureTrip**
@endcomponent
