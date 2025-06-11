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
            'tour_id'         => 'required|exists:tours,id',
            'first_name'      => 'required|string|max:255',
            'middle_name'     => 'nullable|string|max:255',
            'last_name'       => 'required|string|max:255',
            'email'           => 'required|email',
            'phone'           => 'required|string|max:50',
            'nationality'     => 'nullable|string|max:100',
            'travel_date'     => 'required|date',
            'adults'          => 'required|integer|min:1',
            'children'        => 'nullable|integer|min:0',
            'special_request' => 'nullable|string',
        ]);

        $data['status'] = 'pending';

        Booking::create($data);

        return redirect()
            ->route('tours.show', $data['tour_id'])
            ->with('success', 'Booking completed successfully! AventureTrip Thank you for your booking.');
    }
}
