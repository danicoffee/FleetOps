@extends('layouts.app')

@section('title', 'Trip Logs')

@section('content')

<div class="app-shell">

    <aside class="sidebar">
        <div class="sidebar-card">

            <div class="sidebar-brand">
                <div class="sidebar-brand-icon">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 12a9 9 0 1 0 9-9" />
                        <path d="M12 3v9h9" />
                    </svg>
                </div>

                <div>
                    <p class="sidebar-brand-title">FleetOps</p>
                    <p class="sidebar-brand-subtitle">Console</p>
                </div>
            </div>

            @php $current = Route::currentRouteName(); @endphp

            <nav class="sidebar-nav">

                <a href="{{ route('dashboard') }}"
                   class="sidebar-link {{ $current === 'dashboard' ? 'active' : '' }}">
                    Dashboard
                </a>

                <a href="{{ route('vehicles.index') }}"
                   class="sidebar-link {{ $current === 'vehicles.index' ? 'active' : '' }}">
                    Vehicles
                </a>

                <a href="{{ route('drivers.index') }}"
                   class="sidebar-link {{ $current === 'drivers.index' ? 'active' : '' }}">
                    Drivers
                </a>

                <a href="{{ route('trip-logs.index') }}"
                   class="sidebar-link {{ $current === 'trip-logs.index' ? 'active' : '' }}">
                    Trip Logs
                </a>

                <a href="{{ route('maintenance.index') }}"
                   class="sidebar-link {{ $current === 'maintenance.index' ? 'active' : '' }}">
                    Maintenance
                </a>

            </nav>
        </div>
    </aside>

    <div style="width:100%;">

        <!-- HEADER -->
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:2rem;">

            <div>
                <h1 style="margin:0;">Trip Logs</h1>
                <p style="color:#64748b;">
                    Record and review trips
                </p>
            </div>

            <button onclick="openLogTripModal()"
                style="padding:0.8rem 1.2rem; border:none; background:#2563eb; color:white; border-radius:10px; cursor:pointer;">
                + Log Trip
            </button>

        </div>

        <!-- SUCCESS MESSAGE -->
        @if(session('success'))
            <div style="background:#dcfce7; color:#166534; padding:1rem; border-radius:10px; margin-bottom:1rem;">
                {{ session('success') }}
            </div>
        @endif

        <!-- TABLE -->
        <div style="overflow-x:auto;">

            <table style="width:100%; border-collapse:collapse; background:white;">

                <thead style="background:#f1f5f9;">
                    <tr>
                        <th style="padding:1rem;">Vehicle</th>
                        <th style="padding:1rem;">Driver</th>
                        <th style="padding:1rem;">Destination</th>
                        <th style="padding:1rem;">Purpose</th>
                        <th style="padding:1rem;">Departure</th>
                        <th style="padding:1rem;">Return</th>
                        <th style="padding:1rem;">Distance</th>
                        <th style="padding:1rem;">Actions</th>
                    </tr>
                </thead>

                <tbody>

                    @foreach($tripLogs as $trip)

                    <tr style="border-top:1px solid #e2e8f0;">

                        <td style="padding:1rem;">
                            {{ $trip->vehicle }}
                        </td>

                        <td style="padding:1rem;">
                            {{ $trip->driver }}
                        </td>

                        <td style="padding:1rem;">
                            {{ $trip->destination }}
                        </td>

                        <td style="padding:1rem;">
                            {{ $trip->purpose }}
                        </td>

                        <td style="padding:1rem;">
                            {{ $trip->departure }}
                        </td>

                        <td style="padding:1rem;">
                            {{ $trip->return_time }}
                        </td>

                        <td style="padding:1rem; font-weight:bold;">
                            {{ $trip->distance }} km
                        </td>

                        <td style="padding:1rem; display:flex; gap:0.5rem;">

                            <!-- EDIT -->
                            <button
                                onclick="openEditModal(
                                    '{{ $trip->id }}',
                                    '{{ $trip->vehicle }}',
                                    '{{ $trip->driver }}',
                                    '{{ $trip->destination }}',
                                    '{{ $trip->purpose }}',
                                    '{{ $trip->departure }}',
                                    '{{ $trip->return_time }}',
                                    '{{ $trip->distance }}'
                                )"
                                style="background:#dbeafe; color:#1d4ed8; border:none; padding:0.5rem 0.8rem; border-radius:8px; cursor:pointer;">
                                Edit
                            </button>

                            <!-- DELETE -->
                            <form action="{{ route('trip-logs.destroy', $trip->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Delete this trip log?')">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                    style="background:#fee2e2; color:#b91c1c; border:none; padding:0.5rem 0.8rem; border-radius:8px; cursor:pointer;">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>
</div>

<!-- ADD MODAL -->
<div id="logTripModal" class="modal">

    <div class="modal-overlay" onclick="closeLogTripModal()"></div>

    <div class="modal-content">

        <h2>Log Trip</h2>

        <form method="POST" action="{{ route('trip-logs.store') }}">

            @csrf

            <div class="form-row">

                <input type="text" name="vehicle" placeholder="Vehicle" class="form-input" required>

                <input type="text" name="driver" placeholder="Driver" class="form-input" required>

            </div>

            <div class="form-row">

                <input type="text" name="destination" placeholder="Destination" class="form-input" required>

                <input type="text" name="purpose" placeholder="Purpose" class="form-input" required>

            </div>

            <div class="form-row">

                <input type="datetime-local" name="departure" class="form-input" required>

                <input type="datetime-local" name="return_time" class="form-input" required>

            </div>

            <div class="form-row">

                <input type="number" name="odometer_start" placeholder="Odometer Start" class="form-input" required>

                <input type="number" name="odometer_end" placeholder="Odometer End" class="form-input" required>

            </div>

            <div style="margin-top:1rem; display:flex; gap:1rem; justify-content:flex-end;">

                <button type="button"
                    onclick="closeLogTripModal()"
                    style="padding:0.7rem 1rem;">
                    Cancel
                </button>

                <button type="submit"
                    style="padding:0.7rem 1rem; background:#2563eb; color:white; border:none; border-radius:8px;">
                    Save
                </button>

            </div>

        </form>

    </div>

</div>

<!-- EDIT MODAL -->
<div id="editTripModal" class="modal">

    <div class="modal-overlay" onclick="closeEditModal()"></div>

    <div class="modal-content">

        <!-- HEADER WITH EXIT BUTTON -->
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1rem;">

            <h2>Edit Trip</h2>

            <!-- EXIT (X BUTTON) -->
            <button type="button"
                onclick="closeEditModal()"
                style="background:transparent; border:none; font-size:1.5rem; cursor:pointer;">
                ✕
            </button>

        </div>

        <form id="editForm" method="POST">

            @csrf
            @method('PUT')

            <div class="form-row">

                <select name="vehicle" id="edit_vehicle" class="form-input">
                    @foreach($vehicles as $vehicle)
                        <option value="{{ $vehicle->plate_number ?? $vehicle->name }}">
                            {{ $vehicle->plate_number ?? $vehicle->name }}
                        </option>
                    @endforeach
                </select>

              <input list="driverList" name="driver" id="edit_driver" class="form-input">

<datalist id="driverList">
    @foreach($drivers as $driver)
        <option value="{{ $driver->name }}">
    @endforeach
</datalist>
            </div>

            <div class="form-row">

                <input type="text" name="destination" id="edit_destination" class="form-input">

                <input type="text" name="purpose" id="edit_purpose" class="form-input">

            </div>

            <div class="form-row">

                <input type="datetime-local" name="departure" id="edit_departure" class="form-input">

                <input type="datetime-local" name="return_time" id="edit_return_time" class="form-input">

            </div>

            <!-- FOOTER BUTTONS -->
            <div style="margin-top:1.5rem; display:flex; justify-content:flex-end; gap:1rem;">

                <!-- CANCEL BUTTON -->
                <button type="button"
                    onclick="closeEditModal()"
                    style="padding:0.7rem 1rem; background:#e2e8f0; border:none; border-radius:8px; cursor:pointer;">
                    Cancel
                </button>

                <!-- UPDATE BUTTON -->
                <button type="submit"
                    style="padding:0.7rem 1rem; background:#2563eb; color:white; border:none; border-radius:8px;">
                    Update
                </button>

            </div>

        </form>

    </div>

</div>
<style>

.modal{
    display:none;
    position:fixed;
    inset:0;
    justify-content:center;
    align-items:center;
    z-index:999;
}

.modal.active{
    display:flex;
}

.modal-overlay{
    position:absolute;
    inset:0;
    background:rgba(0,0,0,0.5);
}

.modal-content{
    position:relative;
    background:white;
    padding:2rem;
    width:600px;
    border-radius:16px;
    z-index:2;
}

.form-row{
    display:grid;
    grid-template-columns:1fr 1fr;
    gap:1rem;
    margin-bottom:1rem;
}

.form-input{
    width:100%;
    padding:0.8rem;
    border:1px solid #cbd5e1;
    border-radius:10px;
}

</style>

<script>

function openLogTripModal(){
    document.getElementById('logTripModal').classList.add('active');
}

function closeLogTripModal(){
    document.getElementById('logTripModal').classList.remove('active');
}

function openEditModal(id, vehicle, driver, destination, purpose, departure, return_time){

    document.getElementById('editTripModal').classList.add('active');

    document.getElementById('editForm').action = "/trip-logs/" + id;

    document.getElementById('edit_vehicle').value = vehicle;
const driverSelect = document.getElementById('edit_driver');

setTimeout(() => {

    const target = driver.trim().toLowerCase();

    for (let i = 0; i < driverSelect.options.length; i++) {

        const opt = driverSelect.options[i].value.trim().toLowerCase();

        if (opt === target) {
            driverSelect.selectedIndex = i;
            return;
        }
    }

    // fallback
    driverSelect.value = driver;

}, 100);
    document.getElementById('edit_destination').value = destination;
    document.getElementById('edit_purpose').value = purpose;
    document.getElementById('edit_departure').value = departure;
    document.getElementById('edit_return_time').value = return_time;
}

function closeEditModal(){
    document.getElementById('editTripModal').classList.remove('active');
}

</script>

@endsection