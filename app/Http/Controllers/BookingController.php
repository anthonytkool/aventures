<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Tour;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Tour $tour)
    {
        $tour->load('departures'); // โหลด departure dates
        return view('bookings.create', compact('tour'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'tour_departure_id' => 'required|exists:tour_departures,id',
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:50',
            'nationality' => 'nullable|string|max:100',
            'num_people' => 'required|integer|min:1',
            'adults' => 'required|integer|min:0',
            'children' => 'required|integer|min:0',
            'special_request' => 'nullable|string|max:500',
            'total_price' => 'required|numeric|min:0',
        ]);

        $validated['user_id'] = auth()->check() ? auth()->id() : null;
        $validated['status'] = 'pending';

        Booking::create($validated);

        return redirect()
            ->route('tours.show', $validated['tour_id'])
            ->with('success', 'Booking completed successfully! AventureTrip thanks you.');
    }
}
