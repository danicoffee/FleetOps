<div id="tripModal" style="display:none; position:fixed; inset:0; background:rgba(0,0,0,0.5);">

    <div style="background:#fff; width:400px; margin:8% auto; padding:20px;">

        <h3 id="modalTitle">Add Trip</h3>

        <form id="tripForm" method="POST" action="{{ route('trip-logs.store') }}">
            @csrf

            <input type="hidden" name="_method" id="methodField" value="POST">

            <input name="vehicle" placeholder="Vehicle"><br>
            <input name="driver" placeholder="Driver"><br>
            <input name="destination" placeholder="Destination"><br>
            <input name="purpose" placeholder="Purpose"><br>

            <input type="datetime-local" name="departure"><br>
            <input type="datetime-local" name="return"><br>

            <input type="number" name="odometer_start" placeholder="Start"><br>
            <input type="number" name="odometer_end" placeholder="End"><br>

            <button type="submit">Save</button>
            <button type="button" onclick="closeTripModal()">Close</button>
        </form>

    </div>
</div>

<script>
function openTripModal() {
    document.getElementById('tripModal').style.display = 'block';

    let form = document.getElementById('tripForm');

    form.action = "{{ route('trip-logs.store') }}";
    document.getElementById('methodField').value = "POST";

    document.getElementById('modalTitle').innerText = "Add Trip";

    form.reset();
}

function closeTripModal() {
    document.getElementById('tripModal').style.display = 'none';
}

function editTrip(id) {

    fetch(`/trip-logs/${id}/edit`)
        .then(res => res.json())
        .then(data => {

            document.getElementById('tripModal').style.display = 'block';

            let form = document.getElementById('tripForm');

            form.action = `/trip-logs/${id}`;
            document.getElementById('methodField').value = "PUT";

            document.getElementById('modalTitle').innerText = "Edit Trip";

            form.vehicle.value = data.vehicle;
            form.driver.value = data.driver;
            form.destination.value = data.destination;
            form.purpose.value = data.purpose;
            form.departure.value = data.departure;
            form.return.value = data.return;
            form.odometer_start.value = data.odometer_start;
            form.odometer_end.value = data.odometer_end;
        });
}
</script>