<form action="{{ route('trip-logs.update', $tripLog->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="vehicle" value="{{ $tripLog->vehicle }}">
    <input type="text" name="driver" value="{{ $tripLog->driver }}">
    <input type="text" name="destination" value="{{ $tripLog->destination }}">
    <input type="text" name="purpose" value="{{ $tripLog->purpose }}">

    <input type="datetime-local" name="departure"
        value="{{ \Carbon\Carbon::parse($tripLog->departure)->format('Y-m-d\TH:i') }}">

    <input type="datetime-local" name="return"
        value="{{ $tripLog->return ? \Carbon\Carbon::parse($tripLog->return)->format('Y-m-d\TH:i') : '' }}">

    <input type="number" name="odometer_start" value="{{ $tripLog->odometer_start }}">
    <input type="number" name="odometer_end" value="{{ $tripLog->odometer_end }}">

    <button type="submit">Update</button>
</form>