<div>
    <!--

    <div style="position: fixed; top: 10px; right: 10px; background: red; color: white; padding: 10px; z-index: 9999;">
        Modal State: {{ $showModal ? 'SHOWING' : 'HIDDEN' }} | Property: {{ $property ? $property->id : 'NULL' }}
    </div>
Debug info - remove after testing -->
    <!-- Overlay Backdrop -->
    @if ($showModal)
        <div style="position: fixed;
                   top: 0;
                   left: 0;
                   width: 100vw;
                   height: 100vh;
                   background: rgba(0,0,0,0.5);
                   z-index: 10000;"
            wire:click="closePropertyDetail" x-data x-init="document.body.style.overflow = 'hidden'">
        </div>
    @endif

    <!-- Modal Content -->
    @if ($showModal && $property)
        <div
            style="position: fixed;
                   top: 50%;
                   left: 50%;
                   transform: translate(-50%, -50%);
                   width: 95%;
                   max-width: 1200px;
                   max-height: 90vh;
                   background: white;
                   border-radius: 8px;
                   z-index: 10001;
                   box-shadow: 0 10px 30px rgba(0,0,0,0.3);
                   display: flex;
                   flex-direction: column;">

            <!-- Header - Fixed at top -->
            <div
                style="display: flex; justify-content: space-between; align-items: center; padding: 20px; border-bottom: 1px solid #eee; background: white; border-radius: 8px 8px 0 0; flex-shrink: 0;">
                <button wire:click="closePropertyDetail"
                    style="background: #4f46e5; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">
                    ← Back to search
                </button>
                <button wire:click="closePropertyDetail"
                    style="background: #ef4444; color: white; border: none; border-radius: 50%; width: 30px; height: 30px; cursor: pointer; font-size: 16px; display: flex; align-items: center; justify-content: center;">
                    ×
                </button>
            </div>

            <!-- Scrollable Content Area -->
            <div style="overflow-y: auto; padding: 0 20px; flex-grow: 1;">
                <!-- Property Details -->
                <!-- Property Header -->
                <div class="property-header">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="price">{{ $property->demand_price }}</div>
                                <h1 class="address">{{ $property->title }}</h1>
                            </div>
                            <div class="col-md-4 text-md-end">
                                <button class="btn btn-primary me-2"><i class="bi bi-heart"></i> Save</button>
                                <button class="btn btn-outline-primary"><i class="bi bi-share"></i> Share</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Property Facts -->
                <div class="property-facts">
                    <div class="container">
                        <div class="row">
                            <div class="col-4 col-md-2 fact-item">
                                <div class="fact-value">{{ $property->bedrooms }}</div>
                                <div class="fact-label">Beds</div>
                            </div>
                            <div class="col-4 col-md-2 fact-item">
                                <div class="fact-value">{{ $property->bedrooms }}</div>
                                <div class="fact-label">Baths</div>
                            </div>
                            <div class="col-4 col-md-2 fact-item">
                                <div class="fact-value">{{ $property->area_size }}</div>
                                <div class="fact-label">{{ $property->size_unit }}</div>
                            </div>
                            <div class="col-4 col-md-2 fact-item">
                                <div class="fact-value">{{ $property->proptype }}</div>
                                <div class="fact-label">{{ $property->category }}</div>
                            </div>
                            <div class="col-4 col-md-2 fact-item">
                                <div class="fact-value">{{ $property->purpose }}</div>
                                <div class="fact-label">For</div>
                            </div>
                            <div class="col-4 col-md-2 fact-item">
                                <div class="fact-value">{{ $property->pricetype }}</div>
                                <div class="fact-label">Price Type</div>
                            </div>

                        </div>
                    </div>
                </div>

                <!-- Main Content -->
                <div class="container my-4">
                    <div class="row">
                        <!-- Left Column - Main Content -->
                        <div class="col-lg-8">
                            <!-- Property Description -->
                            <div class="card">
                                <div class="card-header">Property Description</div>
                                <div class="card-body">
                                    <p>{{ $property->description }}</p>
                                    <p>Complete Address: {{ $property->address }}</p>

                                    <button class="btn btn-link p-0">Show more <i
                                            class="bi bi-chevron-down"></i></button>
                                </div>
                            </div>

                            <!-- Facts & Features -->
                            <div class="card">
                                <div class="card-header">Facts & Features</div>
                                <div class="card-body">
                                    <ul class="nav nav-tabs mb-3" id="factsTabs" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="location-tab" data-bs-toggle="tab"
                                                data-bs-target="#location" type="button"
                                                role="tab">Location</button>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="construction-tab" data-bs-toggle="tab"
                                                data-bs-target="#construction" type="button"
                                                role="tab">Construction</button>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="factsTabsContent">
                                        <div class="tab-pane fade show active" id="location" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6>Location Features</h6>
                                                    <ul class="feature-list">
                                                        <li>Position : {{ $property->positioning }}</li>
                                                        <li>Front Facing : {{ $property->front_facing }}</li>
                                                        <li>Back Facing : {{ $property->back_site }}</li>
                                                    </ul>
                                                </div>
                                                <div class="col-md-6">

                                                    <ul class="feature-list">
                                                        <li>City : {{ $property->city?->name ?? 'No City Assigned' }}
                                                        </li>
                                                        <li>Town : {{ $property->town?->name ?? 'No Town Assigned' }}
                                                        </li>
                                                        <li>Sector :
                                                            {{ $property->sector?->name ?? 'No Sector Assigned' }}</li>
                                                        <li>Block :{{ $property->block?->name ?? 'No Block Assigned' }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="construction" role="tabpanel">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <h6>Condition</h6>
                                                    <ul class="feature-list">
                                                        <li>Condition: {{ $property->conscond }}</li>
                                                        <li>Construction Type: {{ $property->consage }}</li>
                                                        <li>House Type: {{ $property->housetype }}</li>
                                                        <li>Floor: {{ $property->floor }}</li>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-link p-0">Show more <i
                                            class="bi bi-chevron-down"></i></button>
                                </div>
                            </div>

                            <!-- Estimated Market Value -->
                            <div class="card">
                                <div class="card-header">Estimated Market Value</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 text-center mb-3">
                                            <div class="zestimate-value">$420,200</div>
                                            <div>Zestimate<sup>®</sup></div>
                                        </div>
                                        <div class="col-md-4 text-center mb-3">
                                            <div class="zestimate-value">$399,000 - $441,000</div>
                                            <div>Estimated sales range</div>
                                        </div>
                                        <div class="col-md-4 text-center mb-3">
                                            <div class="zestimate-value">$1,597/mo</div>
                                            <div>Rent Zestimate<sup>®</sup></div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <p><strong>+70% in last 10 years</strong></p>
                                        <div class="progress" style="height: 10px;">
                                            <div class="progress-bar bg-success" role="progressbar"
                                                style="width: 70%"></div>
                                        </div>
                                    </div>
                                    <button class="btn btn-link p-0 mt-2">Show more <i
                                            class="bi bi-chevron-down"></i></button>
                                </div>
                            </div>

                            <!-- Nearby Homes -->
                            <div class="card">
                                <div class="card-header">Nearby Homes</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <div class="card nearby-home h-100">
                                                <img src="{{ asset('img/property-1.jpg') }}" class="card-img-top"
                                                    alt="Nearby home">
                                                <div class="card-body">
                                                    <div class="price"> 483,300</div>
                                                    <div class="mb-2">3 bd | 3 ba | 1.9k sqft</div>
                                                    <div>Scheme 33, Main Safoora </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card nearby-home h-100">
                                                <img src="{{ asset('img/property-2.jpg') }}" class="card-img-top"
                                                    alt="Nearby home">
                                                <div class="card-body">
                                                    <div class="price"> 281,500</div>
                                                    <div class="mb-2">-- bd | -- ba | 2.6k sqft</div>
                                                    <div>Block 7 Gulistan e Johar </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="card nearby-home h-100">
                                                <img src="{{ asset('img/property-3.jpg') }}" class="card-img-top"
                                                    alt="Nearby home">
                                                <div class="card-body">
                                                    <div class="price">345,300</div>
                                                    <div class="mb-2">2 bd | 1 ba | 2k sqft</div>
                                                    <div>Gulzar e Hijri Scheme 33</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column - Sidebar -->
                        <div class="col-lg-4">
                            <div class="sidebar-sticky">
                                <!-- Contact Form -->
                                <div class="card mb-4">
                                    <div class="card-header">Contact a Buyer's Agent</div>
                                    <div class="card-body contact-form">
                                        <p class="mb-3">Connect with a local buyer's agent who advertises with us
                                        </p>
                                        <form>
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="phone" class="form-label">Phone</label>
                                                <input type="tel" class="form-control" id="phone" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="message" class="form-label">Message</label>
                                                <textarea class="form-control" id="message" rows="3">I am interested in 106 Chestnut Street, Albany, NY 12210.</textarea>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" type="checkbox" id="financing"
                                                    checked>
                                                <label class="form-check-label" for="financing">
                                                    I want financing information
                                                </label>
                                            </div>
                                            <button type="submit" class="btn btn-primary w-100">Contact an
                                                Agent</button>
                                        </form>
                                    </div>
                                </div>

                                <!-- Map -->
                                <!-- Map -->
                                <div class="card mb-4">
                                    <div class="card-header">Location</div>
                                    <div class="card-body p-0">
                                        <div class="map-container" id="propertyMap"></div>
                                    </div>
                                </div>

                                <!-- Request Tour -->
                                <div class="card">
                                    <div class="card-body text-center">
                                        <button class="btn btn-primary w-100 mb-2">Request a Tour</button>
                                        <small class="text-muted">as early as today at 11:00 am</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Images Section -->
                <div style="margin-bottom: 20px;">
                    <h3 style="font-weight: bold; margin-bottom: 15px; font-size: 18px;">Property Images</h3>

                    @forelse ($property->pictures as $index => $picture)
                        @php
                            $imageExists = Storage::disk('public')->exists($picture->image_path);
                        @endphp
                        <div
                            style="margin-bottom: 20px; border: 1px solid #eee; border-radius: 8px; overflow: hidden;">
                            <img style="width: 100%; height: 300px; object-fit: cover; display: block;"
                                src="{{ $imageExists ? asset('storage/' . $picture->image_path) : asset('img/NoImage.jpg') }}"
                                alt="Property Image {{ $index + 1 }}">

                            @if ($picture->title)
                                <div style="padding: 10px; background: #f8f9fa; border-top: 1px solid #eee;">
                                    <h5 style="margin: 0; font-size: 14px; color: #666; text-align: center;">
                                        {{ $picture->title }}</h5>
                                </div>
                            @endif
                        </div>
                    @empty
                        <div
                            style="text-align: center; padding: 40px; color: #666; border: 1px dashed #ddd; border-radius: 8px;">
                            <img style="width: 100%; max-width: 200px; height: auto; margin: 0 auto 20px; display: block;"
                                src="{{ asset('img/NoImage.jpg') }}" alt="No image available">
                            <p style="margin: 0;">No images available for this property</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    @endif
</div>

@push('scripts')
    <script>
        document.addEventListener('livewire:init', () => {
            let map;
            let marker;
            let circle;

            // Initialize map when modal opens with payload data
            Livewire.on('modal-opened', (data) => {

                setTimeout(() => {
                    // Access the data correctly - it's an array with MapData object at index 0
                    if (data && data[0] && data[0].MapData) {
                        initMap(data[0].MapData);
                    } else {
                        console.log('Invalid data structure:', data);
                        initMap(null); // Fallback
                    }
                }, 100);
            });

            // Clean up when modal closes
            Livewire.on('modal-closed', () => {
                if (map) {
                    map.remove();
                    map = null;
                    marker = null;
                    circle = null;
                }
            });

            function initMap(propertyData) {
                let lat, lng, radius, title;


                if (propertyData && propertyData.lat && propertyData.long) {
                    lat = parseFloat(propertyData.lat);
                    lng = parseFloat(propertyData.long);
                    radius = propertyData.radius || 0;
                    title = propertyData.title || 'Property Location';

                } else {
                    // Fallback coordinates
                    lat = 24.936451896228;
                    lng = 67.169637680054;
                    radius = 0;
                    title = 'Property Location';
                    console.log('Using fallback coordinates - no payload data');
                }

                // Check if map container exists
                const mapContainer = document.getElementById('propertyMap');
                if (!mapContainer) {
                    console.log('Map container not found');
                    return;
                }

                // Remove any existing map instance
                if (map) {
                    map.remove();
                }

                // Initialize map
                map = L.map('propertyMap', {
                    zoomControl: true,
                    scrollWheelZoom: true,
                    wheelPxPerZoomLevel: 60
                }).setView([lat, lng], 13);

                // Enable Ctrl+scroll zoom
                map.scrollWheelZoom.enable();

                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© OpenStreetMap contributors',
                    maxZoom: 19
                }).addTo(map);

                // Add marker
                marker = L.marker([lat, lng]).addTo(map)
                    .bindPopup(`<b>${title}</b>`)
                    .openPopup();

                // Add circle if radius is greater than 0
                if (radius > 0) {
                    circle = L.circle([lat, lng], {
                        radius: radius,
                        color: 'blue',
                        fillColor: '#3388ff',
                        fillOpacity: 0.2,
                        weight: 2
                    }).addTo(map);

                    // Fit map to show both marker and circle
                    const bounds = circle.getBounds();
                    map.fitBounds(bounds.pad(0.1));
                }

                // Add zoom control for better UX
                L.control.zoom({
                    position: 'topright'
                }).addTo(map);
            }
        });
    </script>
@endpush
