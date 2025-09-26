
<div>
<div>
    <div id="map" style="height: 400px;" wire:ignore></div>

    <!-- Livewire-bound hidden fields -->
    <input type="hidden" wire:model.live="latitude" id="latitude" name="latitude">
    <input type="hidden" wire:model.live="longitude" id="longitude" name="longitude">
    <input type="hidden" wire:model.live="radius" id="radius" name="radius">

    <div class="mt-2">
        <strong>Lat:</strong> {{ $latitude }},
        <strong>Lng:</strong> {{ $longitude }},
        <strong>Radius:</strong> {{ $radius }}
    </div>

    <button wire:click="PageReset" type="button" id="resetCircle" class="btn btn-danger mt-2">Reset Circle</button>
    <button wire:click="search"  type="button" class="btn btn-primary mt-2 rounded">Search</button>
</div>
<div class="mt-2">
    
     {{-- Results --}}
    @if($searched && $geoData->count())
        <table class="table-auto border-collapse border border-gray-400 w-full text-sm">
            <thead>
                <tr>
                    <th class="border px-2 py-1">Level</th>
                    <th class="border px-2 py-1">Name</th>
                    <th class="border px-2 py-1">Level</th>
                    <th class="border px-2 py-1">Name</th>
                    <th class="border px-2 py-1">Level</th>
                    <th class="border px-2 py-1">Name</th>
                </tr>
            </thead>
            <tbody>
                @foreach($geoData->chunk(3) as $row)
                    <tr>
                        @foreach($row as $item)
                            <td class="border px-2 py-1">{{ $item['level'] }}</td>
                            <td class="border px-2 py-1">{{ $item['name'] }}</td>
                        @endforeach

                        {{-- Fill empty cells if less than 3 pairs --}}
                        @for($i = $row->count(); $i < 3; $i++)
                            <td class="border px-2 py-1">&nbsp;</td>
                            <td class="border px-2 py-1">&nbsp;</td>
                        @endfor
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-1">
            {{ $geoData->links() }}
        </div>
    @elseif($searched)
        <p class="text-gray-600">No results found.</p>
    @endif

</div>
</div>


@push('scripts')
<script>
(function initMap() {
    const mapDiv = document.getElementById("map");
    if (!mapDiv) {
        setTimeout(initMap, 300);
        return;
    }

    let lat = parseFloat(document.getElementById('latitude').value) || 24.9480;
    let lng = parseFloat(document.getElementById('longitude').value) || 67.1541;

    // 🔹 Initialize map
    const map = L.map('map').setView([lat, lng], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© OpenStreetMap contributors'
    }).addTo(map);

    // 🔹 Feature group to hold drawn shapes
    let drawnItems = new L.FeatureGroup();
    map.addLayer(drawnItems);

    // 🔹 Enable draw controls (only circle allowed)
    const drawControl = new L.Control.Draw({
        draw: {
            polygon: false,
            marker: false,
            rectangle: false,
            polyline: false,
            circle: true,        // ✅ enable circle
            circlemarker: false
        },
        edit: {
            featureGroup: drawnItems
        }
    });
    map.addControl(drawControl);

    function updateInputs(lat, lng, radius = null) {
        document.getElementById('latitude').value = lat;
        document.getElementById('longitude').value = lng;
        document.getElementById('radius').value = radius || '';

        const component = Livewire.find(mapDiv.closest('[wire\\:id]').getAttribute('wire:id'));
        component.set('latitude', lat);
        component.set('longitude', lng);
        component.set('radius', radius);
    }

    // 🔹 Handle circle creation
map.on(L.Draw.Event.CREATED, function (e) {
    drawnItems.clearLayers();
    const layer = e.layer;
    drawnItems.addLayer(layer);

    const center = layer.getLatLng();
    let radiusKm = (layer.getRadius() / 1000).toFixed(2);
    updateInputs(center.lat, center.lng, radiusKm);
});

map.on(L.Draw.Event.EDITED, function (e) {
    e.layers.eachLayer(function (layer) {
        const center = layer.getLatLng();
        let radiusKm = (layer.getRadius() / 1000).toFixed(2);
        updateInputs(center.lat, center.lng, radiusKm);
    });
});

    // 🔹 Reset button clears everything
document.getElementById('resetCircle').addEventListener('click', function() {
    drawnItems.clearLayers();

    // Reset hidden inputs
    document.getElementById('latitude').value = '';
    document.getElementById('longitude').value = '';
    document.getElementById('radius').value = '';

    // Reset Livewire props
    const component = Livewire.find(mapDiv.closest('[wire\\:id]').getAttribute('wire:id'));
    component.set('latitude', null);
    component.set('longitude', null);
    component.set('radius', null);
});


})();



</script>
@endpush
