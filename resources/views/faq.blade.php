@extends('layouts.app')

@section('content')
<div class="bg-warning-subtle py-4 border-bottom border-warning">
  <div class="container text-center">
    <h1 class="fw-bold mb-2"><i class="bi bi-info-circle-fill text-warning"></i> Guest Information & FAQs</h1>
    <p class="text-muted fs-5">All the essential information you need for a smooth and enjoyable trip.</p>
  </div>
</div>

<div class="container py-5">

  <div class="border-start border-primary border-4 rounded shadow-sm p-4 mb-4">
    <h4 class="fw-bold text-primary mb-3"><i class="bi bi-question-circle-fill text-warning me-2"></i> Frequently Asked Questions</h4>
    <ul>
      <li class="mb-2">
        <strong>Do I need a visa to visit Thailand?</strong><br>
        Visa requirements vary by nationality. Please check with your local embassy or official immigration websites before traveling.
      </li>
      <li class="mb-2">
        <strong>What vaccinations do I need?</strong><br>
        Recommended vaccinations include Hepatitis A, Typhoid, Tetanus, and routine shots. Consult your doctor for personalized advice.
      </li>
      <li class="mb-2">
        <strong>Can I customize my tour after booking?</strong><br>
        Changes can be made up to 30 days before departure. Some changes may incur additional fees. Contact us early to discuss modifications.
      </li>
    </ul>
  </div>

  <div class="border-start border-primary border-4 rounded shadow-sm p-4 mb-4">
    <h4 class="fw-bold text-primary mb-3"><i class="bi bi-cash-coin text-warning me-2"></i> Booking & Payment</h4>
    <ul>
      <li class="mb-2">
        <strong>Minimum Age Policy:</strong> The minimum age to join our group tours is 18 years. Youth aged 12–17 are welcome when accompanied by a parent or legal guardian.
      </li>
      <li class="mb-2">
        <strong>Payment Terms:</strong> Full payment is due 60 days before departure. Late payments may result in cancellation of your booking.
      </li>
      <li class="mb-2">
        <strong>Single Supplement:</strong> We offer shared accommodation by default. A single room may be available at additional cost on selected tours.
      </li>
    </ul>
  </div>

  <div class="border-start border-primary border-4 rounded shadow-sm p-4 mb-4">
    <h4 class="fw-bold text-primary mb-3"><i class="bi bi-airplane-engines text-warning me-2"></i> Travel Policies</h4>
    <ul>
      <li class="mb-2">
        <strong>Medical Requirements:</strong> Guests with medical conditions must complete a confidential Medical Form prior to travel.
      </li>
      <li class="mb-2">
        <strong>Travel Insurance:</strong> Comprehensive travel insurance covering health, accident, and trip cancellation is mandatory for all guests.
      </li>
      <li class="mb-2">
        <strong>Substance Use:</strong> The use of illegal substances is strictly prohibited. Violation may result in removal from the tour without refund.
      </li>
    </ul>
  </div>

  <div class="border-start border-primary border-4 rounded shadow-sm p-4 mb-4">
    <h4 class="fw-bold text-primary mb-3"><i class="bi bi-shield-lock-fill text-warning me-2"></i> Safety & Conduct</h4>
    <ul>
      <li class="mb-2">
        <strong>Follow Local Laws:</strong> We kindly ask all travelers to respect local laws and cultural customs to ensure a positive experience for everyone.
      </li>
      <li class="mb-2">
        <strong>Personal Responsibility:</strong> Please stay with the group, keep valuables secure, and follow the safety guidance provided by our tour leaders.
      </li>
      <li class="mb-2">
        <strong>Respectful Behavior:</strong> We promote kindness, respect, and inclusivity. Harassment, discrimination, or inappropriate behavior is not part of our journey.
      </li>
    </ul>
  </div>

  <div class="text-center mt-4">
    <a href="{{ route('home') }}" class="btn btn-primary">Return to Home</a>
  </div>

</div>
@endsection
