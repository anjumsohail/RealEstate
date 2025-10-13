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
        <button wire:click="search" type="button" class="btn btn-primary mt-2 rounded">Search</button>


        <div class="mt-2 d-flex align-items-center flex-wrap gap-3">
            <div class="form-check form-switch">
                <label class="form-check-label fw-bold">Properties by Geographic Level:</label>
            </div>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="switchCity" wire:model="filterCity">
                <label class="form-check-label" for="switchCity">City</label>
            </div>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="switchTown" wire:model="filterTown">
                <label class="form-check-label" for="switchTown">Town</label>
            </div>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="switchSector" wire:model="filterSector">
                <label class="form-check-label" for="switchSector">Sector</label>
            </div>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="switchBlock" wire:model="filterBlock">
                <label class="form-check-label" for="switchBlock">Block</label>
            </div>

            <div class="form-check form-switch">
                <input class="form-check-input" type="checkbox" id="switchProperty" wire:model="filterProperty">
                <label class="form-check-label" for="switchProperty">Only Properties</label>
            </div>
            <div class="mt-2 d-flex">
                <p> Select the geographic levels (e.g., city, town, sector) to include properties from within the drawn
                    area. </p>
            </div>
        </div>



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

        @if ($searched)
            <div class="boxes" style="display: flex; flex-wrap: wrap; gap: 10px;">

                @if ($geoCount > 0)
                    @foreach ($geoData as $row)
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

        {{-- Old Code
            @if ($geoCount > 0)
            @livewire('property-list', [
                'senderComponent' => $senderComponent,
                'searched' => $searched,
                'filterCity' => $filterCity,
                'filterTown' => $filterTown,
                'filterSector' => $filterSector,
                'filterBlock' => $filterBlock,
                'filterProperty' => $filterProperty,
                'latitude' => $latitude,
                'longitude' => $longitude,
                'radius' => $radius,
            ])
        @endif
        --}}

        @if ($geoCount > 0)
            @livewire('property-list', [
                'senderComponent' => $senderComponent,
                'searched' => $searched,
                'listData' => $listData,
            ])
        @endif

    </div>
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            const mapDiv = document.getElementById('map');
            if (!mapDiv) return;

            // Default coordinates if nothing drawn
            let lat = parseFloat(document.getElementById('latitude').value) || 24.9480;
            let lng = parseFloat(document.getElementById('longitude').value) || 67.1541;

            // 🔹 Initialize Leaflet map
            const map = L.map('map').setView([lat, lng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // 🔹 Layers for shapes & markers
            const drawnItems = new L.FeatureGroup().addTo(map);
            const markerLayer = new L.LayerGroup().addTo(map);

            // 🔹 Draw controls (circle only)
            const drawControl = new L.Control.Draw({
                draw: {
                    polygon: false,
                    rectangle: false,
                    polyline: false,
                    marker: false,
                    circle: true,
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

            // 🔹 Circle creation and edit
            map.on(L.Draw.Event.CREATED, function(e) {
                drawnItems.clearLayers();
                const layer = e.layer;
                drawnItems.addLayer(layer);
                const center = layer.getLatLng();
                const radiusKm = (layer.getRadius() / 1000).toFixed(2);
                updateInputs(center.lat, center.lng, radiusKm);
            });

            map.on(L.Draw.Event.EDITED, function(e) {
                e.layers.eachLayer(layer => {
                    const center = layer.getLatLng();
                    const radiusKm = (layer.getRadius() / 1000).toFixed(2);
                    updateInputs(center.lat, center.lng, radiusKm);
                });
            });

            // 🔹 Reset
            document.getElementById('resetCircle').addEventListener('click', function() {
                drawnItems.clearLayers();
                markerLayer.clearLayers();
                const component = Livewire.find(mapDiv.closest('[wire\\:id]').getAttribute('wire:id'));
                component.set('latitude', null);
                component.set('longitude', null);
                component.set('radius', null);
            });

            // ✅ Listen for backend dispatch event
            Livewire.on('mapDataUpdated', (data) => {
                console.log('mapDataUpdated received:', data);

                // If data is [[...]], unwrap the inner array
                const points = Array.isArray(data[0]) ? data[0] : data;

                if (!Array.isArray(points) || points.length === 0) {
                    console.warn('No valid map data received.');
                    return;
                }

                markerLayer.clearLayers();

                points.forEach(item => {
                    const lat = parseFloat(item.latitude);
                    const lng = parseFloat(item.longitude);
                    if (isNaN(lat) || isNaN(lng)) {
                        console.warn('Skipping invalid marker:', item);
                        return;
                    }

                    const marker = L.marker([lat, lng]).addTo(markerLayer);
                    marker.bindPopup(`
            <div style="width:200px;">
                <strong>${item.title}</strong><br>
                Purpose: ${item.purpose}<br>
                Type: ${item.proptype}<br>
                <a href="/property-advertisements/view/${item.id}" target="_blank" class="btn btn-sm btn-primary mt-1">View Details</a>
            </div>
        `);
                });

                const bounds = L.latLngBounds(points.map(p => [parseFloat(p.latitude), parseFloat(p
                    .longitude)]));
                map.fitBounds(bounds);
            });

            // End Livewire On Event



        });
    </script>
@endpush
