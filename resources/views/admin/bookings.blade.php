@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-4">Booking Management</h2>
    <table class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>Tour</th>
                <th>Name</th>
                <th>Email</th>
                <th>Travel Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        @forelse($bookings as $booking)
            <tr>
                <td>{{ $booking->tour->title ?? '-' }}</td>
                <td>{{ $booking->name }}</td>
                <td>{{ $booking->email }}</td>
                <td>{{ $booking->travel_date }}</td>
                <td>{{ ucfirst($booking->status) }}</td>
                <td>
                    <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm btn-info">View</a>
                    <form method="POST" action="{{ route('admin.bookings.destroy', $booking->id) }}" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this booking?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" class="text-center">No bookings found.</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection