@extends('layouts.app')

@section('title', 'Edit Vehicle')

@section('content')

<div style="padding:2rem; max-width:500px; margin:auto;">

    <h1>Edit Vehicle</h1>

    <form method="POST" action="{{ route('vehicles.update', $vehicle->id) }}"
          style="background:white; padding:20px; border-radius:10px;">

        @csrf
        @method('PUT')

        <label>Plate Number</label><br>
        <input type="text" name="plate_number" value="{{ $vehicle->plate_number }}" required>
        <br><br>

        <label>Model</label><br>
        <input type="text" name="model" value="{{ $vehicle->model }}" required>
        <br><br>

        <label>Type</label><br>
        <input type="text" name="type" value="{{ $vehicle->type }}" required>
        <br><br>

        <label>Status</label><br>
        <input type="text" name="status" value="{{ $vehicle->status }}" required>
        <br><br>

        <button type="submit"
                style="background:green; color:white; padding:10px; border:none;">
            Update Vehicle
        </button>

        <a href="{{ route('vehicles.index') }}"
           style="margin-left:10px;">
            Cancel
        </a>

    </form>

</div>

@endsection