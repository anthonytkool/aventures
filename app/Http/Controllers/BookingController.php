<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Booking;

class BookingController extends Controller
{
    public function create($tour_id)
    {
        $tour = Tour::with('schedules')->findOrFail($tour_id);
        return view('bookings.create', compact('tour'));
    }

   public function store(Request $request)
{
    // รับค่าจากฟอร์ม
    $validated = $request->validate([
        'tour_id' => 'required|exists:tours,id',
        'fullname' => 'required|string',
        'email' => 'required|email',
        'phone' => 'required|string',
        'travelers' => 'required|integer|min:1',
        'schedule_id' => 'required|exists:tour_schedules,id',
    ]);

    // บันทึก
    $booking = \App\Models\Booking::create($validated);

    return redirect()->route('home')->with('success', 'Booking submitted!');
}

}
