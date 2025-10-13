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
            wire:click="closePropertyDetail">
        </div>
    @endif

    <!-- Modal Content -->
    @if ($showModal && $property)
        <div
            style="position: fixed;
                   top: 50%;
                   left: 50%;
                   transform: translate(-50%, -50%);
                   width: 90%;
                   max-width: 600px;
                   background: white;
                   border-radius: 8px;
                   padding: 20px;
                   z-index: 10001;
                   box-shadow: 0 10px 30px rgba(0,0,0,0.3);">

            <!-- Header -->
            <div
                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; border-bottom: 1px solid #eee; padding-bottom: 10px;">
                <button wire:click="closePropertyDetail"
                    style="background: #4f46e5; color: white; padding: 8px 16px; border: none; border-radius: 4px; cursor: pointer;">
                    ← Back to search
                </button>
                <button wire:click="closePropertyDetail"
                    style="background: #ef4444; color: white; border: none; border-radius: 50%; width: 30px; height: 30px; cursor: pointer;">
                    ×
                </button>
            </div>

            <!-- Property Content -->
            <div>
                <h1 style="font-size: 24px; font-weight: bold; margin-bottom: 10px;">{{ $property->address }}</h1>
                <p style="font-size: 20px; color: #059669; margin-bottom: 20px;">${{ number_format($property->price) }}
                </p>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 20px;">
                    <div><strong>Bedrooms:</strong> {{ $property->bedrooms }}</div>
                    <div><strong>Bathrooms:</strong> {{ $property->bathrooms }}</div>
                    <div><strong>Square Feet:</strong> {{ number_format($property->square_feet) }}</div>
                </div>

                @if ($property->description)
                    <div>
                        <h3 style="font-weight: bold; margin-bottom: 10px;">Description</h3>
                        <p style="color: #666;">{{ $property->description }}</p>
                    </div>
                @endif

                @forelse ($property->pictures as $picture)
                    @php
                        $imageExists = Storage::disk('public')->exists($picture->image_path);
                    @endphp
                    <img class="d-block w-100 h-100" style="object-fit: cover;"
                        src="{{ $imageExists ? asset('storage/' . $picture->image_path) : asset('img/NoImage.jpg') }}"
                        alt="Property Image">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>{{ $picture->title }}</h5>
                    </div>


                @empty
                    <img class="d-block w-100 h-100" style="object-fit: cover;" src="{{ asset('img/NoImage.jpg') }}"
                        alt="No image available">
                @endforelse
            </div>
        </div>
    @endif
</div>
