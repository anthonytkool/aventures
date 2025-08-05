@component('mail::message')
# Booking Confirmation

Hi {{ $booking->name }},

Thank you for booking with AventureTrip!
Your booking for the tour "{{ $booking->tour->title ?? '-' }}" has been received.

**Travel Date:** {{ $booking->travel_date }}

We will contact you soon for more details.

Thanks,<br>
AventureTrip Team
@endcomponent
