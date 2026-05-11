<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    // SHOW ALL VEHICLES
    public function index()
    {
        $vehicles = Vehicle::all();
        return view('vehicles.index', compact('vehicles'));
    }

    // SHOW CREATE FORM
    public function create()
    {
        return view('vehicles.create');
    }

    // STORE NEW VEHICLE
    public function store(Request $request)
    {
        Vehicle::create([
            'plate_number' => $request->plate_number,
            'model' => $request->model,
            'type' => $request->type,
            'status' => $request->status,
        ]);

        return redirect('/vehicles')->with('success', 'Vehicle added successfully!');
    }

    // SHOW EDIT FORM
    public function edit($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        return view('vehicles.edit', compact('vehicle'));
    }

    // UPDATE VEHICLE
    public function update(Request $request, $id)
    {
        $vehicle = Vehicle::findOrFail($id);

        $vehicle->update([
            'plate_number' => $request->plate_number,
            'model' => $request->model,
            'type' => $request->type,
            'status' => $request->status,
        ]);

        return redirect('/vehicles')->with('success', 'Vehicle updated successfully!');
    }

    // DELETE VEHICLE
    public function destroy($id)
    {
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->delete();

        return redirect('/vehicles')->with('success', 'Vehicle deleted successfully!');
    }
}