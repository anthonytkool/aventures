@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="fw-bold">Booking: {{ $tour->title }}</h1>
    <p class="text-muted">{{ $tour->days }} days | From {{ $tour->start_location }} to {{ $tour->end_location }}</p>

    <form action="{{ route('booking.store') }}" method="POST" class="mt-4">
        @csrf
        <input type="hidden" name="tour_id" value="{{ $tour->id }}">

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="fullname" class="form-label">Full Name</label>
                <input type="text" name="fullname" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="phone" class="form-label">Phone</label>
                <input type="text" name="phone" class="form-control" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="travelers" class="form-label">Number of Travelers</label>
                <input type="number" name="travelers" class="form-control" min="1" required>
            </div>

            <div class="col-md-6 mb-3">
                <label for="schedule_id" class="form-label">Select Travel Date</label>
                <select name="schedule_id" class="form-select" required>
                    @foreach ($tour->schedules as $schedule)
                        <option value="{{ $schedule->id }}">
                            {{ \Carbon\Carbon::parse($schedule->start_date)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($schedule->end_date)->format('d M Y') }}
                            ({{ $schedule->seats_left }} seats left)
                        </option>
                    @endforeach
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary px-5">Proceed to Payment</button>
    </form>
</div>
@endsection
