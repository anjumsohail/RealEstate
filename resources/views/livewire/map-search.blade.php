
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
       <!-- Debug: Check what type geoData is -->
    <div style="display: none;">
        geoData type: {{ gettype($geoData) }}, 
        is array: {{ is_array($geoData) ? 'yes' : 'no' }}, 
        is object: {{ is_object($geoData) ? 'yes' : 'no' }},
        class: {{ is_object($geoData) ? get_class($geoData) : 'not object' }}
    </div>

    @if($searched)
               <div class="boxes" style="display: flex; flex-wrap: wrap; gap: 10px;">

          @if($geoCount > 0)
             @foreach($geoData as $row)
                     <div style="padding: 10px; border: 1px solid #ccc; min-width: 150px;">
                         {{ $row['name'] }} - ({{ $row['level'] }})
                    </div>
            @endforeach
            @endif
                </div>

        <div class="mt-1">
            {{-- Links --}}

        </div>

    @endif

@if($propertyCount > 0)
<p> Total {{$propertyCount}} Properties Found</p>
@livewire('property-list', [
    'propertyCount' => $propertyCount,
    'properties' => $properties,    
])
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
