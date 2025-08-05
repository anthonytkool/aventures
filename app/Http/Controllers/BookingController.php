<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tour;
use App\Models\TourDeparture;
use App\Models\Booking;
use Mail;

class BookingController extends Controller
{
    public function create(Request $request, $tourId, $departureId)
    {
        $tour = Tour::findOrFail($tourId);
        $departure = TourDeparture::findOrFail($departureId);

        return view('tours.booking', [
            'tour' => $tour,
            'departure' => $departure,
        ]);
    }

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
        $booking->user_id           = Auth::id(); // 🔐 ผูก user ที่ login
        $booking->tour_id           = $validated['tour_id'];
        $booking->tour_departure_id = $validated['departure_id'];
        $booking->name              = $validated['full_name'];
        $booking->email             = $validated['email'] ?? null;
        $booking->phone             = $validated['phone'] ?? null;
        $booking->nationality       = $validated['nationality'] ?? null;
        $booking->passport_number   = $validated['passport_number'] ?? null;
        $booking->whatsapp          = $validated['whatsapp'] ?? null;
        $booking->adults            = $validated['adults'];
        $booking->children          = $validated['children'];
        $booking->num_people        = $validated['num_people'];
        $booking->special_request   = $validated['special_request'] ?? null;
        $booking->total_price       = $validated['total_price'];
        $booking->status            = 'pending'; // 🕐 เริ่มต้นรอชำระเงิน

        $booking->save();

        // ส่งอีเมลแจ้งเตือน (ถ้ามีอีเมล)
        if (!empty($booking->email)) {
            try {
                Mail::to($booking->email)->send(new \App\Mail\BookingConfirmation($booking));
            } catch (\Exception $e) {
                // จะเลือก log หรือแสดง error message เพิ่มเติมก็ได้
            }
        }

        return redirect()->route('thankyou')->with('success', 'Booking confirmed!');
    }
}