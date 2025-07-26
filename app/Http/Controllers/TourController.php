<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use Carbon\Carbon;
use App\Models\TourDeparture;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $query = Tour::with('images');

        if ($request->filled('country')) {
            if ($request->country === 'Cross-Border Trips Series') {
                // หากเป็นซีรีส์ข้ามประเทศ ให้กรองเฉพาะทัวร์ ID 3 และ 5
                $query->whereIn('id', [3, 5]);
            } else {
                $query->where('country', $request->country);
            }
        }

        $tours = $query->get();

        return view('tours.index', compact('tours'));
    }

    public function show($id)
    {
        $tour = Tour::with(['departures', 'images', 'prices'])->findOrFail($id);
        return view('tours.tourdetails', compact('tour'));
    }

    public function showBooking($tourId, $departureId)
    {
        $tour = Tour::findOrFail($tourId);
        $departure = TourDeparture::findOrFail($departureId);

        return view('tours.booking', [
            'tour' => $tour,
            'departure' => $departure
        ]);
    }

    public function showDepartures(Tour $tour)
    {
        $departures = $tour->departures()->orderBy('start_date')->get();

        $months = $departures->groupBy(function ($departure) {
            return Carbon::parse($departure->date)->format('F Y');
        });

        return view('tours.departures', compact('tour', 'departures', 'months'));
    }
}
