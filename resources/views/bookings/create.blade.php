@extends('layouts.app')

@section('content')
<div class="container mt-5">
  <h1 class="mb-4">Booking: {{ $tour->title }}</h1>

  {{-- Success Message --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  {{-- Validation Errors --}}
  @if($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class="row">
    {{-- LEFT: Booking Form --}}
    <div class="col-md-8">
      <form action="{{ route('bookings.store') }}" method="POST">
        @csrf
        <input type="hidden" name="tour_id" value="{{ $tour->slug }}">
        <input type="hidden" name="total_price" id="total_price" value="0">

        {{-- Month Selector --}}
        <div class="mb-4">
          <h5>Please select a departure month:</h5>
          <div class="d-flex flex-wrap gap-2">
            @php
              $months = $tour->departures->groupBy(function($item) {
                return \Carbon\Carbon::parse($item->start_date)->format('F Y');
              });
            @endphp
            @foreach($months as $month => $group)
              <button type="button" class="btn btn-outline-primary btn-sm month-btn {{ $loop->first ? 'active' : '' }}" data-month="{{ $month }}">
                {{ $month }}
              </button>
            @endforeach
          </div>
        </div>

        {{-- Departure Table --}}
        <div id="departure-list" class="mt-3">
          <h6 class="fw-bold mb-3">Available Departures</h6>
          <div id="departure-table"></div>
        </div>

        {{-- Personal Info --}}
        <div class="row mt-4">
          <div class="col-md-6 mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Nationality</label>
            <input type="text" name="nationality" class="form-control" value="{{ old('nationality') }}">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Adults</label>
            <input type="number" name="adults" class="form-control" min="0" value="{{ old('adults', 1) }}" required>
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Children</label>
            <input type="number" name="children" class="form-control" min="0" value="{{ old('children', 0) }}">
          </div>
          <div class="col-md-6 mb-3">
            <label class="form-label">Number of People</label>
            <input type="number" name="num_people" class="form-control" min="1" value="{{ old('num_people', 1) }}" required>
          </div>
          <div class="col-12 mb-4">
            <label class="form-label">Special Request</label>
            <textarea name="special_request" class="form-control" rows="3">{{ old('special_request') }}</textarea>
          </div>

          <div class="alert alert-info small">
            <p><strong>✔ Guaranteed departures</strong> – your seat is secured once booked.</p>
            <p><strong>❗ Non-refundable</strong> after 7 days before departure.</p>
            <p><strong>🧾 Prices include taxes.</strong></p>
          </div>

          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-lg w-100">Confirm Booking</button>
          </div>
        </div>
      </form>
    </div>

    {{-- RIGHT: Summary Panel --}}
    <div class="col-md-4">
      <div class="card p-3">
        <h5>Tour Summary</h5>
        <p><strong>Tour:</strong> {{ $tour->title }}</p>
        <p><strong>Country:</strong> {{ $tour->country }}</p>
        <p><strong>Start from:</strong> {{ $tour->start_location }}</p>
        <p><strong>Departure Date:</strong> <span id="summary-date">-</span></p>
        <p><strong>Price per person:</strong> <span id="summary-price">฿0.00</span></p>
        <hr>
        <p class="fw-bold">Total: <span id="total-price" class="text-primary fs-5">฿0.00</span></p>
      </div>
    </div>
  </div>
</div>

<script>
const departures = @json($tour->departures);

function formatBaht(n) {
  return '฿' + parseFloat(n).toLocaleString(undefined, { minimumFractionDigits: 2 });
}

function updateTotal(selected) {
  const adults = parseInt(document.querySelector('[name="adults"]').value) || 0;
  const children = parseInt(document.querySelector('[name="children"]').value) || 0;
  const adultPrice = parseFloat(selected.price);
  const childPrice = parseFloat(selected.child_price ?? selected.price);
  const total = (adults * adultPrice) + (children * childPrice);

  document.getElementById('total-price').innerText = formatBaht(total);
  document.getElementById('total_price').value = total;
}

document.addEventListener('DOMContentLoaded', function () {
  const firstBtn = document.querySelector(".month-btn");
  if (firstBtn) firstBtn.click();

  document.querySelectorAll('.month-btn').forEach(btn => {
    btn.addEventListener('click', function () {
      document.querySelectorAll('.month-btn').forEach(b => b.classList.remove('active'));
      this.classList.add('active');

      const month = this.dataset.month;
      const list = departures.filter(dep => {
        const d = new Date(dep.start_date);
        const label = d.toLocaleString('default', { month: 'long' }) + ' ' + d.getFullYear();
        return label === month;
      });

      let html = `<table class="table table-sm"><thead><tr>
        <th>Select</th><th>Date</th><th>Price</th><th>Available</th>
        </tr></thead><tbody>`;

      list.forEach(dep => {
        html += `<tr>
          <td><input type="radio" name="tour_departure_id" value="${dep.id}"></td>
          <td>${new Date(dep.start_date).toLocaleDateString()}</td>
          <td>Adult: ${formatBaht(dep.price)}<br>Child: ${formatBaht(dep.child_price ?? dep.price)}</td>
          <td>${dep.capacity} spots</td>
        </tr>`;
      });

      html += `</tbody></table>`;
      document.getElementById('departure-table').innerHTML = html;

      document.querySelectorAll('input[name="tour_departure_id"]').forEach(input => {
        input.addEventListener('change', function () {
          const selected = departures.find(d => d.id == this.value);
          document.getElementById('summary-date').innerText = new Date(selected.start_date).toLocaleDateString();
          document.getElementById('summary-price').innerText = formatBaht(selected.price);
          updateTotal(selected);
        });
      });
    });
  });

  document.querySelector('[name="adults"]').addEventListener('input', () => {
    const selected = departures.find(d => d.id == document.querySelector('[name="tour_departure_id"]:checked')?.value);
    if (selected) updateTotal(selected);
  });
  document.querySelector('[name="children"]').addEventListener('input', () => {
    const selected = departures.find(d => d.id == document.querySelector('[name="tour_departure_id"]:checked')?.value);
    if (selected) updateTotal(selected);
  });
});
</script>
@endsection
