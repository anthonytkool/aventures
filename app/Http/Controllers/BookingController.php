<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Tour $tour)
    {
        $tour->load('departures');
        return view('bookings.create', compact('tour'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'tour_departure_id' => 'nullable|exists:tour_departures,id',
            'num_people' => 'required|integer|min:1',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:50',
            'total_price' => 'required|numeric|min:0',
        ]);

        $validated['user_id'] = auth()->id();
        $validated['status'] = 'pending';

        Booking::create($validated);

        return redirect()
            ->route('tours.show', $validated['tour_id'])
            ->with('success', 'Booking completed successfully! AventureTrip thank you for your booking.');
    }
}
