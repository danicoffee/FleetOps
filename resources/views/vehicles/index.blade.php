@extends('layouts.app')

@section('title', 'Vehicles')

@section('content')

<div style="padding:2rem;">

    <h1>Vehicles</h1>

    <!-- ADD BUTTON -->
<a href="{{ route('vehicles.create') }}"
   style="background:blue; color:white; padding:10px; display:inline-block; margin-bottom:15px; text-decoration:none; border-radius:5px;">
    + Add Vehicle
</a>

    <br><br>

    <!-- TABLE -->
    @if($vehicles->count() > 0)

    <table border="1" cellpadding="10" style="width:100%; background:white;">
        <tr>
            <th>ID</th>
            <th>Plate Number</th>
            <th>Model</th>
            <th>Type</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>

        @foreach($vehicles as $vehicle)
        <tr>
            <td>{{ $vehicle->id }}</td>
            <td>{{ $vehicle->plate_number }}</td>
            <td>{{ $vehicle->model }}</td>
            <td>{{ $vehicle->type }}</td>
            <td>{{ $vehicle->status }}</td>

            <!-- ACTIONS -->
            <td>
                <!-- EDIT BUTTON -->
                <a href="{{ route('vehicles.edit', $vehicle->id) }}"
                   style="padding:5px 10px; background:orange; color:white; text-decoration:none; border-radius:5px;">
                    Edit
                </a>

                <!-- DELETE BUTTON -->
                <form method="POST"
                      action="{{ route('vehicles.destroy', $vehicle->id) }}"
                      style="display:inline;">
                    @csrf
                    @method('DELETE')

                    <button onclick="return confirm('Delete this vehicle?')"
                            style="padding:5px 10px; background:red; color:white; border:none; border-radius:5px;">
                        Delete
                    </button>
                </form>
            </td>
        </tr>
        @endforeach

    </table>

    @else
        <div style="padding:20px; background:#f1f5f9; text-align:center;">
            <h3>No vehicles found</h3>
            <p>Click Add Vehicle to start</p>
        </div>
    @endif

</div>

@endsection