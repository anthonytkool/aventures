<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\TourDeparture;
use App\Models\Country;
use Carbon\Carbon;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $tourIds = [1, 2, 3, 4, 5, 6, 7];

        $query = Tour::with(['countries', 'images'])
            ->whereIn('id', $tourIds)
            ->orderByRaw('FIELD(id, ' . implode(',', $tourIds) . ')');

        if ($request->has('country')) {
            $country = $request->input('country');

            if ($country === 'Cross-Border Trips Series') {
                $tours = $query->get()->filter(function ($tour) {
                    return $tour->countries->count() > 1;
                })->values();
            } else {
                $query->whereHas('countries', function ($q) use ($country) {
                    $q->whereRaw('LOWER(slug) = ?', [strtolower($country)]);
                });

                $tours = $query->get();
            }
        } else {
            $tours = $query->get();
        }

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
