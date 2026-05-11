@extends('layouts.app')

@section('title', 'Add Vehicle')

@section('content')

<div style="padding:2rem; max-width:500px; margin:auto;">

    <h1>Add Vehicle</h1>

    <form method="POST" action="{{ route('vehicles.store') }}"
          style="background:white; padding:20px; border-radius:10px;">

        @csrf

        <label>Plate Number</label><br>
        <input type="text" name="plate_number" required>
        <br><br>

        <label>Model</label><br>
        <input type="text" name="model" required>
        <br><br>

        <label>Type</label><br>
        <input type="text" name="type" required>
        <br><br>

        <label>Status</label><br>
        <input type="text" name="status" required>
        <br><br>

        <button type="submit"
                style="background:blue; color:white; padding:10px; border:none;">
            Save Vehicle
        </button>

    </form>

</div>

@endsection