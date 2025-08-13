@component('mail::message')
# New Tour Enquiry

**Tour:** {{ $lead->tour->title }}
@isset($lead->start_date)
**Start date:** {{ \Illuminate\Support\Carbon::parse($lead->start_date)->toFormattedDateString() }}
@endisset

**Guests:** {{ $lead->adults }} adult(s){{ $lead->children ? ", $lead->children child(ren)" : '' }}

**Name:** {{ $lead->name }}
**Email:** {{ $lead->email }}
**Phone:** {{ $lead->phone }}

- Adults: {{ $lead->adults }}
- Children: {{ $lead->children }}


**Hotel:** {{ $lead->hotel ?: '-' }}
**Pickup:** {{ $lead->pickup ?: '-' }}

**Message:**
{{ $lead->message ?: '-' }}

@component('mail::button', ['url' => 'https://wa.me/66812345678?text=Enquiry%20'.$lead->tour->title])
WhatsApp follow-up
@endcomponent

@endcomponent
