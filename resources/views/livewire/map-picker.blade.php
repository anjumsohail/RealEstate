<div>
    <div id="map" style="height: 400px;" wire:ignore></div>

    <!-- Livewire-bound hidden fields -->
    <input type="hidden" wire:model.live="latitude" id="latitude" name="latitude">
    <input type="hidden" wire:model.live="longitude" id="longitude" name="longitude">

    <div class="mt-2">
        <strong>Lat:</strong> {{ $latitude }},
        <strong>Lng:</strong> {{ $longitude }}
    </div>
</div>

@assets
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
@endassets

@script
    <script>
        // Simple initialization when component loads
        Alpine.nextTick(() => {
            const lat = $wire.latitude || 24.9480;
            const lng = $wire.longitude || 67.1541;
            console.log('1st step');

            const map = L.map('map').setView([lat, lng], 13);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png').addTo(map);

            const marker = L.marker([lat, lng], {
                draggable: true
            }).addTo(map);

            marker.on('dragend', (e) => {
                console.log('2nd step');
                const pos = marker.getLatLng();
                $wire.latitude = pos.lat;
                $wire.longitude = pos.lng;
            });

            map.on('click', (e) => {
                console.log('3rd step');
                marker.setLatLng(e.latlng);

                // Use $wire.set() instead of direct assignment $wire.latitude = e.latlng.lat;
                $wire.set('latitude', e.latlng.lat);
                $wire.set('longitude', e.latlng.lng);
            });
        });
    </script>
@endscript
