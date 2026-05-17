<?php

namespace App\Http\Controllers;

use App\Models\TripLog;
use App\Models\Vehicle;
use App\Models\Driver;
use Illuminate\Http\Request;

class TripLogController extends Controller
{
    public function index()
    {
        $tripLogs = TripLog::latest()->get();
        $vehicles = Vehicle::all();
        $drivers = Driver::all();

        return view('trip-logs.index', compact('tripLogs', 'vehicles', 'drivers'));
    }

    public function create()
    {
        $vehicles = Vehicle::all();
        $drivers = Driver::all();

        return view('trip-logs.create', compact('vehicles', 'drivers'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'vehicle' => 'required',
            'driver' => 'required',
            'destination' => 'required',
            'purpose' => 'required',
            'departure' => 'required',
            'return' => 'nullable',
            'odometer_start' => 'required|integer',
            'odometer_end' => 'required|integer',
        ]);

        $data['distance'] =
            $data['odometer_end'] - $data['odometer_start'];

        TripLog::create($data);

        return redirect()->route('trip-logs.index')
            ->with('success', 'Trip Log created successfully!');
    }

    public function edit($id)
    {
        $tripLog = TripLog::findOrFail($id);

        return view('trip-logs.edit', compact('tripLog'));
    }

    public function update(Request $request, $id)
    {
        $trip = TripLog::findOrFail($id);

        $data = $request->validate([
            'vehicle' => 'required',
            'driver' => 'required',
            'destination' => 'required',
            'purpose' => 'required',
            'departure' => 'required',
            'return' => 'nullable',
            'odometer_start' => 'required|integer',
            'odometer_end' => 'required|integer',
        ]);

        $data['distance'] =
            $data['odometer_end'] - $data['odometer_start'];

        $trip->update($data);

        return redirect()->route('trip-logs.index')
            ->with('success', 'Trip Log updated successfully!');
    }

    public function destroy($id)
    {
        $trip = TripLog::findOrFail($id);
        $trip->delete();

        return redirect()->route('trip-logs.index')
            ->with('success', 'Trip Log deleted successfully!');
    }
}