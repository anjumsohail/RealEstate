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


        @livewire('property-list', [
            'senderComponent' => $senderComponent,
            'searched' => $searched,
            'listData' => $listData,
        ])


    </div>
</div>
@assets
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>
@endassets

@script
    <script>
        let map, drawnItems, markerLayer;

        // Initialize when component is ready
        Alpine.nextTick(() => {
            console.log('Initializing map with Alpine...');

            // Default coordinates
            const lat = $wire.latitude || 24.9480;
            const lng = $wire.longitude || 67.1541;

            // Initialize Leaflet map
            map = L.map('map').setView([lat, lng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            // Layers for shapes & markers
            drawnItems = new L.FeatureGroup().addTo(map);
            markerLayer = new L.LayerGroup().addTo(map);

            // Draw controls (circle only)
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

            // Circle creation event
            map.on(L.Draw.Event.CREATED, function(e) {
                drawnItems.clearLayers();
                const layer = e.layer;
                drawnItems.addLayer(layer);
                const center = layer.getLatLng();
                const radiusKm = (layer.getRadius() / 1000).toFixed(2);

                // Update Livewire properties
                $wire.set('latitude', center.lat);
                $wire.set('longitude', center.lng);
                $wire.set('radius', radiusKm);
            });

            // Circle edit event
            map.on(L.Draw.Event.EDITED, function(e) {
                e.layers.eachLayer(layer => {
                    const center = layer.getLatLng();
                    const radiusKm = (layer.getRadius() / 1000).toFixed(2);

                    $wire.set('latitude', center.lat);
                    $wire.set('longitude', center.lng);
                    $wire.set('radius', radiusKm);
                });
            });

            // Listen for reset button click
            const resetBtn = document.getElementById('resetCircle');
            if (resetBtn) {
                resetBtn.addEventListener('click', function() {
                    drawnItems.clearLayers();
                    markerLayer.clearLayers();
                    $wire.set('latitude', null);
                    $wire.set('longitude', null);
                    $wire.set('radius', null);
                });
            }

            // Listen for backend data updates
            $wire.on('mapDataUpdated', (data) => {
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
                        <a href="javascript:void(0)" onclick="window.showPropertyDetail(${item.id})"
                            class="btn btn-sm btn-primary mt-1">View Details</a>
                    </div>
                `);
                });

                const bounds = L.latLngBounds(points.map(p => [parseFloat(p.latitude), parseFloat(p
                    .longitude)]));
                map.fitBounds(bounds);
            });
        });

        // Global function for property details
        window.showPropertyDetail = function(propertyId) {
            $wire.dispatch('showPropertyDetail', {
                propertyId: propertyId
            });
        };
    </script>
@endscript
