@component('mail::message')
# Thanks! We received your message

Hi {{ $data['name'] }},

Thanks for reaching out to **AventureTrip**.  
Your reference is **{{ $ref }}**.

We’ll get back to you shortly.  
If you’d like a faster chat, you can message us on WhatsApp:

@php
    $phone = config('services.whatsapp.phone', '66988361459');
    $text  = rawurlencode("Hi AventureTrip, my contact ref is {$ref}.");
    $waUrl = "https://wa.me/{$phone}?text={$text}";
@endphp

@component('mail::button', ['url' => $waUrl])
Chat on WhatsApp
@endcomponent

Thanks,  
**AventureTrip**
@endcomponent
