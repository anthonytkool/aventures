<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\TourDeparture;
use App\Models\Booking;


class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tour_id'           => 'required|exists:tours,id',
            'departure_id'      => 'required|exists:tour_departures,id',
            'full_name'         => 'required|string|max:255',
            'email'             => 'nullable|email',
            'phone'             => 'nullable|string|max:30',
            'nationality'       => 'nullable|string|max:100',
            'passport_number'   => 'nullable|string|max:50',
            'whatsapp'          => 'nullable|string|max:50',
            'adults'            => 'required|integer|min:1',
            'children'          => 'required|integer|min:0',
            'num_people'        => 'required|integer|min:1',
            'special_request'   => 'nullable|string|max:1000',
            'total_price'       => 'required|numeric|min:0',
        ]);

        $booking = new Booking();
        $booking->tour_id          = $validated['tour_id'];
        $booking->tour_departure_id = $validated['departure_id'];
        $booking->full_name        = $validated['full_name'];
        $booking->email            = $validated['email'] ?? null;
        $booking->phone            = $validated['phone'] ?? null;
        $booking->nationality      = $validated['nationality'] ?? null;
        $booking->passport_number  = $validated['passport_number'] ?? null;
        $booking->whatsapp         = $validated['whatsapp'] ?? null;
        $booking->adults           = $validated['adults'];
        $booking->children         = $validated['children'];
        $booking->num_people       = $validated['num_people'];
        $booking->total_price      = $validated['total_price'];
        $booking->special_request  = $validated['special_request'] ?? null;

        $booking->save();

        return redirect()->route('thankyou')->with('success', 'Booking confirmed!');
    }
    
    public function create(Request $request, $tourId)
{
    $tour = Tour::findOrFail($tourId);

    // คัดกรอง month จาก query string
    $monthFilter = $request->query('month');
    
    $departures = TourDeparture::where('tour_id', $tour->id)
        ->orderBy('start_date');

    if ($monthFilter) {
        $departures->whereMonth('start_date', \Carbon\Carbon::parse($monthFilter)->month);
    }

    $grouped = $departures->get()->groupBy(function ($item) {
        return \Carbon\Carbon::parse($item->start_date)->format('F Y');
    });

    return view('tours.departures', [
        'tour' => $tour,
        'months' => $grouped
    ]);
}

}
