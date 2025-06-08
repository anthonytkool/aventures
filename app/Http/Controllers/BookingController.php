<?php

namespace App\Http\Controllers;

use App\Models\Tour;
use App\Models\Booking;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function create(Tour $tour)
    {
        return view('bookings.create', compact('tour'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tour_id' => 'required|exists:tours,id',
            'full_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|string',
            'nationality' => 'nullable|string',
            'travel_date' => 'required|date',
            'adults' => 'required|integer|min:1',
            'children' => 'nullable|integer|min:0',
            'special_request' => 'nullable|string',
        ]);

        $data['status'] = 'pending';

        $booking = Booking::create($data);

        return redirect()
            ->route('bookings.create', $data['tour_id'])
            ->with('success', 'Booking completed successfully!');
    }
}
