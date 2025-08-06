<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tour;

class AdminTourController extends Controller
{
    public function index()
    {
        $tours = Tour::all();
        return view('admin.tours.admindashboard', compact('tours'));
    }

    public function create()
    {
        return view('admin.tours-create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:255',
        ]);
        Tour::create($data);
        return redirect()->route('admin.tours.index')->with('success', 'Tour added!');
    }

    public function show(Tour $tour)
    {
        return view('admin.tours-show', compact('tour'));
        // return view('tours.show', compact('tour'));
    }

    public function edit($id)
    {
        $tour = Tour::findOrFail($id);
        return view('admin.tours-edit', compact('tour'));
    }

    public function update(Request $request, $id)
    {
        $tour = Tour::findOrFail($id);
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'country' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration' => 'required|string|max:255',
        ]);
        $tour->update($data);
        return redirect()->route('admin.tours.index')->with('success', 'Tour updated!');
    }

    public function destroy($id)
    {
        $tour = Tour::findOrFail($id);
        $tour->delete();
        return back()->with('success', 'Tour deleted!');
    }
}