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

            const map = L.map('map').setView([lat, lng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            let marker = L.marker([lat, lng], {
                draggable: true
            }).addTo(map);

            // 🔄 Sync with Livewire
            function updateInputs(lat, lng) {
                document.getElementById('latitude').value = lat;
                document.getElementById('longitude').value = lng;

                // ✅ trigger Livewire sync
                const component = Livewire.find(mapDiv.closest('[wire\\:id]').getAttribute('wire:id'));
                component.set('latitude', lat);
                component.set('longitude', lng);
            }

            marker.on('dragend', function(e) {
                let pos = marker.getLatLng();
                updateInputs(pos.lat, pos.lng);
            });

            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                updateInputs(e.latlng.lat, e.latlng.lng);
                Livewire.find(mapDiv.closest('[wire\\:id]').getAttribute('wire:id'))
                    .call('setCoordinates', e.latlng.lat, e.latlng.lng);
            });
        })();
    </script>
@endpush
