@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">{{ $tour->name }} - Available Departures</h2>

    <h5>Please select a month:</h5>
    <div class="mb-3">
        @foreach ($months as $month => $group)
        <a href="{{ route('bookings.create', ['tour' => $tour->slug]) }}?month={{ urlencode($month) }}"
           class="btn btn-outline-primary btn-sm me-2 mb-2">
            {{ $month }}
        </a>
        @endforeach
    </div>

    @foreach ($months as $month => $group)
    <h5 id="month-{{ Str::slug($month) }}" class="mt-4">{{ $month }}</h5>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th>Date</th>
                <th>Price (Adult/Child)</th>
                <th>Available Spots</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($group as $departure)
            <tr>
                <td>{{ \Carbon\Carbon::parse($departure->start_date)->format('D, d M Y') }}</td>
                <td>
                    Adult: ฿{{ number_format($departure->price) }}<br>
                    Child: ฿{{ number_format($departure->child_price) }}
                </td>
                <td>{{ $departure->spots }} spots</td>
                <td>
                    <a href="{{ route('bookings.departure', ['tour' => $tour->slug, 'departure' => $departure->id]) }}"
                       class="btn btn-primary btn-sm">
                        Book Now
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endforeach
</div>
@endsection
