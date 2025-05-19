@extends('layouts.app')

@section('content')
<div class="container my-5">
    <!-- Header -->
    <div class="row">
        <div class="col-md-8">
            <h1 class="fw-bold">{{ $tour->title }}</h1>
            <p>{{ $tour->days }} days, {{ $tour->start_location }} to {{ $tour->end_location }}</p>
            <img src="{{ asset('storage/'.$tour->image) }}" class="img-fluid rounded shadow-sm" alt="tour image">
        </div>
        <div class="col-md-4">
            <div class="border p-4 rounded shadow-sm bg-light">
                @if($tour->on_sale)
                <span class="badge bg-danger mb-2">ON SALE</span>
                @endif
                <h4 class="fw-bold">{{ $tour->days }} days</h4>
                <p>{{ $tour->start_location }} to {{ $tour->end_location }}</p>
                <h3 class="text-primary fw-bold">${{ number_format($tour->price, 2) }}</h3>
                <p class="text-muted">Valid on {{ \Carbon\Carbon::parse($tour->valid_date)->format('M d, Y') }}</p>

                <!-- ✅ ปุ่ม Book Now -->
                <a href="{{ route('booking.form', $tour->id) }}" class="btn btn-primary w-100 my-2">Book Now</a>
                <button class="btn btn-outline-secondary w-100">Save to wishlist</button>
            </div>
        </div>
    </div>

    <!-- Tabs -->
    <ul class="nav nav-tabs mt-5" id="tourTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="overview-tab" data-bs-toggle="tab" data-bs-target="#overview" type="button">Overview</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="itinerary-tab" data-bs-toggle="tab" data-bs-target="#itinerary" type="button">Itinerary</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="details-tab" data-bs-toggle="tab" data-bs-target="#details" type="button">What's Included</button>
        </li>
    </ul>

    <div class="tab-content p-4 border-bottom border-start border-end" id="tourTabContent">
        <div class="tab-pane fade show active" id="overview" role="tabpanel">
            <h4>Overview</h4>
            <p>{{ $tour->description }}</p>
        </div>

        <div class="tab-pane fade" id="itinerary" role="tabpanel">
            <h4>Itinerary</h4>
            {!! $tour->itinerary !!}
            @if ($tour->map_url)
            <div class="text-center mt-4">
                <img src="{{ asset('storage/'.$tour->map_url) }}" class="img-fluid rounded shadow" alt="Tour Map">
            </div>
            @endif
        </div>

        <div class="tab-pane fade" id="details" role="tabpanel">
            <h4>What's Included</h4>
            <ul>
                @foreach (explode("\n", $tour->included) as $item)
                <li>{{ $item }}</li>
                @endforeach
            </ul>
        </div>
    </div>

    <!-- Departure Table -->
    <div class="mt-5">
        <h4>Departures</h4>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Dates</th>
                    <th>Availability</th>
                    <th>Price</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tour->schedules as $schedule)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($schedule->start_date)->format('d M') }} - {{ \Carbon\Carbon::parse($schedule->end_date)->format('d M Y') }}</td>
                    <td>{{ $schedule->seats_left }} Available</td>
                    <td>${{ number_format($schedule->price, 2) }}</td>
                    <td>
                        @if($schedule->seats_left > 0)
                        <a href="{{ route('booking.form', [$tour->id, 'schedule' => $schedule->id]) }}" class="btn btn-primary btn-sm">Book now</a>
                        @else
                        <button class="btn btn-secondary btn-sm" disabled>Sold Out</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- Recommended -->
    <div class="mt-5">
        <h4>Recommended for you</h4>
        <div class="row g-4">
            @foreach ($recommendedTours as $rec)
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/'.$rec->image) }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h6>{{ $rec->title }}</h6>
                        <p class="fw-bold">${{ number_format($rec->price, 2) }}</p>
                        <a href="{{ route('tours.show', $rec->id) }}" class="btn btn-outline-primary btn-sm w-100">View itinerary</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection
