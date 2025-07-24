@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Booking: {{ $tour->name }}</h2>
    <div class="row">
        <!-- LEFT: Booking Form -->
        <div class="col-md-8">
            <p><strong>Departure Date:</strong> {{ \Carbon\Carbon::parse($departure->start_date)->format('d M Y') }}</p>
            <p><strong>Price:</strong> Adult ฿{{ number_format($departure->price) }} | Child ฿{{ number_format($departure->child_price) }}</p>

            <form action="{{ route('bookings.store', [$tour->id, $departure->id]) }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Full Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    <div class="col-md-6">
                        <label>Nationality</label>
                        <input type="text" class="form-control" name="nationality">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label>Phone</label>
                        <input type="text" class="form-control" name="phone" required>
                    </div>
                    <div class="col-md-6">
                        <label>Email</label>
                        <input type="email" class="form-control" name="email" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label>Adults</label>
                        <input type="number" class="form-control" name="adults" value="1" min="0" required>
                    </div>
                    <div class="col-md-4">
                        <label>Children</label>
                        <input type="number" class="form-control" name="children" value="0" min="0">
                    </div>
                    <div class="col-md-4">
                        <label>Total People</label>
                        <input type="number" class="form-control" name="num_people" value="1" min="1" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label>Special Requests</label>
                    <textarea class="form-control" name="special_request" rows="3" placeholder="Food allergies, health conditions, etc."></textarea>
                </div>

                {{-- ✅ Optional: Hidden total price (to submit to controller if needed) --}}
                <input type="hidden" name="total_price" id="total_price_input" value="">

                <button class="btn btn-primary w-100">✅ Confirm Booking</button>
            </form>

            <div class="alert alert-info mt-4">
                <ul class="mb-0">
                    <li>✔ Guaranteed departures – your seat is secured once booked.</li>
                    <li>❗ Non-refundable after 7 days before departure.</li>
                    <li>🧾 Prices include all taxes and service charges.</li>
                </ul>
            </div>
        </div>

        <!-- RIGHT: Summary -->
        <div class="col-md-4">
            <div class="card p-3 shadow-sm mt-4 mt-md-0">
                <h5 class="mb-3">Tour Summary</h5>
                <p><strong>Tour:</strong> {{ $tour->name }}</p>
                <p><strong>Country:</strong> {{ $tour->country }}</p>
                <p><strong>Start From:</strong> {{ $tour->start_location ?? '-' }}</p>
                <p><strong>Departure Date:</strong> {{ \Carbon\Carbon::parse($departure->start_date)->format('d M Y') }}</p>
                <p><strong>Adult Price:</strong> ฿{{ number_format($departure->price) }}</p>
                <p><strong>Child Price:</strong> ฿{{ number_format($departure->child_price) }}</p>
                <hr>
                <p><strong>Total Price:</strong> <span id="total-price" class="text-primary fw-bold">฿0.00</span></p>
            </div>
        </div>
    </div>
</div>

{{-- ✅ JavaScript: Auto-calculate total --}}
<script>
    const adultPrice = {{ $departure->price }};
    const childPrice = {{ $departure->child_price }};
    const totalDisplay = document.getElementById('total-price');
    const totalInput = document.getElementById('total_price_input');

    function updateTotal() {
        const adults = parseInt(document.querySelector('[name="adults"]').value || 0);
        const children = parseInt(document.querySelector('[name="children"]').value || 0);
        const total = (adults * adultPrice) + (children * childPrice);
        totalDisplay.innerText = '฿' + total.toLocaleString();
        totalInput.value = total;
    }

    document.querySelector('[name="adults"]').addEventListener('input', updateTotal);
    document.querySelector('[name="children"]').addEventListener('input', updateTotal);
    window.addEventListener('DOMContentLoaded', updateTotal);
</script>
@endsection
