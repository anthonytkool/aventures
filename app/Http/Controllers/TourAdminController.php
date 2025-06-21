<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tour;
use Illuminate\Http\Request;

class TourAdminController extends Controller
{
    public function index()
    {
        $tours = Tour::latest()->paginate(10);
        return view('admin.tours.index', compact('tours'));
    }

    public function create()
    {
        return view('admin.tours.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'country' => 'nullable|string',
            'start_location' => 'nullable|string',
            'price' => 'required|numeric',
            'days' => 'nullable|integer',
            'overview' => 'nullable|string',
            'full_description' => 'nullable|string',

            // ✅ ฟิลด์ใหม่
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date',
            'start_country' => 'nullable|string',
            'end_country' => 'nullable|string',
            'trip_style' => 'nullable|string',
            'difficulty' => 'nullable|string',
            'min_age' => 'nullable|integer',
            'group_size' => 'nullable|integer',
        ]);

        Tour::create($data);

        return redirect()->route('admin.tours.index')->with('success', 'Tour created successfully!');
    }



    public function edit(Tour $tour)
    {
        return view('admin.tours.edit', compact('tour'));
    }

    public function update(Request $request, Tour $tour)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'country' => 'required|string',
            'start_location' => 'required|string',
            'price' => 'required|numeric|min:0',
            'days' => 'required|integer|min:1',
            'overview' => 'nullable|string',
            'full_description' => 'nullable|string',
        ]);

        $tour->update($data);

        return redirect()->route('admin.tours.index')->with('success', 'Tour updated successfully.');
    }

    public function destroy(Tour $tour)
    {
        $tour->delete();
        return redirect()->route('admin.tours.index')->with('success', 'Tour deleted.');
    }
}
