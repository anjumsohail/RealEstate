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
        (function initMap(retryCount = 0) {
            const mapDiv = document.getElementById("map");
            const latInput = document.getElementById('latitude');
            const lngInput = document.getElementById('longitude');

            if (!mapDiv || !latInput || !lngInput) {
                // Retry if DOM not ready
                if (retryCount < 20) setTimeout(() => initMap(retryCount + 1), 200);
                return;
            }

            let lat = parseFloat(latInput.value);
            let lng = parseFloat(lngInput.value);

            // 🕐 Wait until Livewire sets valid lat/lng (avoid defaults)
            if ((isNaN(lat) || isNaN(lng)) ||
                (lat === 24.9480 && lng === 67.1541 && retryCount < 20)) {
                setTimeout(() => initMap(retryCount + 1), 300);
                return;
            }

            console.log("✅ Initializing map at:", lat, lng);

            const map = L.map('map').setView([lat, lng], 13);

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(map);

            let marker = L.marker([lat, lng], {
                draggable: true
            }).addTo(map);

            function updateInputs(newLat, newLng) {
                latInput.value = newLat;
                lngInput.value = newLng;
                try {
                    const compId = mapDiv.closest('[wire\\:id]')?.getAttribute('wire:id');
                    const component = Livewire.find(compId);
                    component?.set('latitude', newLat);
                    component?.set('longitude', newLng);
                } catch (e) {}
            }

            marker.on('dragend', function(e) {
                const pos = marker.getLatLng();
                updateInputs(pos.lat, pos.lng);
            });

            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                updateInputs(e.latlng.lat, e.latlng.lng);
                try {
                    const compId = mapDiv.closest('[wire\\:id]')?.getAttribute('wire:id');
                    Livewire.find(compId)?.call('setCoordinates', e.latlng.lat, e.latlng.lng);
                } catch (err) {}
            });

            // React to Livewire updates
            function attachLivewireHook() {
                if (!window.Livewire || !Livewire.hook) return;
                Livewire.hook('message.processed', () => {
                    const newLat = parseFloat(latInput.value) || lat;
                    const newLng = parseFloat(lngInput.value) || lng;
                    if (newLat !== lat || newLng !== lng) {
                        lat = newLat;
                        lng = newLng;
                        marker.setLatLng([lat, lng]);
                        map.setView([lat, lng]);
                    }
                });
            }
            if (window.Livewire && Livewire.hook) attachLivewireHook();
            else window.addEventListener('livewire:load', attachLivewireHook, {
                once: true
            });
        })();
    </script>
@endpush
