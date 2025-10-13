<div class="col-lg-4 col-md-6 d-flex boxes">
    @if ($PicturesCount < 2)
        <!-- Single Image Property Card Begin -->
        <div class="property-item rounded overflow-hidden d-flex flex-column w-100">

            <!-- ✅ Fixed Ratio Wrapper -->
            <div class="position-relative overflow-hidden" style="aspect-ratio: 16 / 9;">

                <div wire:click="showDetail" class="cursor-pointer hover:shadow-lg transition">
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
                <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                    {{ $property->purpose }}
                </div>
                <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                    {{ $property->proptype }}
                </div>
            </div>

            <div class="p-4 pb-0 mt-auto">
                <h5 class="text-primary mb-3">PKR-{{ $property->demand_price }}</h5>
                <a class="d-block h5 mb-2"
                    href="{{ route('property-advertisements.view', ['id' => $property->id]) }}">{{ $property->title }}</a>
                <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $property->address }}</p>
            </div>

            <div class="d-flex border-top mt-auto">
                <small class="flex-fill text-center border-end py-2">
                    <i
                        class="fa fa-ruler-combined text-primary me-2"></i>{{ $property->area_size }}-{{ $property->size_unit }}
                </small>
                <small class="flex-fill text-center border-end py-2">
                    <i class="fa fa-bed text-primary me-2"></i>
                    @if ($property->bedrooms)
                        <li><strong>Bedrooms:</strong> {{ $property->bedrooms }}</li>
                    @endif
                </small>
                <small class="flex-fill text-center py-2">
                    <i class="fa fa-bath text-primary me-2"></i>
                    @if ($property->positioning)
                        <li><strong>Location :</strong> {{ $property->positioning }}</li>
                    @endif
                </small>
            </div>
        </div>

        <!-- Single Image Property Card End -->
    @elseif ($PicturesCount > 1)
        <!-- Carousel Property Card Begin -->


        <div class="property-item rounded overflow-hidden d-flex flex-column w-100">
            <div class="position-relative overflow-hidden">
                <!-- Bootstrap Ratio wrapper makes it responsive -->
                <div class="ratio ratio-16x9">

                    <a href="{{ route('property-advertisements.view', ['id' => $property->id]) }}">

                        <div id="carouselProperty{{ $property->id }}" class="carousel slide" data-bs-ride="carousel">
                            <!-- Indicators -->
                            <div class="carousel-indicators">
                                @foreach ($property->pictures as $index => $picture)
                                    <button type="button" data-bs-target="#carouselProperty{{ $property->id }}"
                                        data-bs-slide-to="{{ $index }}"
                                        class="{{ $loop->first ? 'active' : '' }}"
                                        aria-current="{{ $loop->first ? 'true' : 'false' }}"
                                        aria-label="Slide {{ $index + 1 }}"></button>
                                @endforeach
                            </div>

                            <!-- Slides -->
                            <div class="carousel-inner h-100">
                                @foreach ($property->pictures as $picture)
                                    <div class="carousel-item h-100 {{ $loop->first ? 'active' : '' }}">
                                        <div
                                            class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                            {{ $property->purpose }}
                                        </div>
                                        @php
                                            $imageExists = Storage::disk('public')->exists($picture->image_path);
                                        @endphp
                                        <img class="d-block w-100 h-100" style="object-fit: cover;"
                                            src="{{ $imageExists ? asset('storage/' . $picture->image_path) : asset('img/NoImage.jpg') }}"
                                            alt="Property Image">

                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>{{ $picture->title }}</h5>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Controls -->
                            <button class="carousel-control-prev" type="button"
                                data-bs-target="#carouselProperty{{ $property->id }}" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon"></span>
                            </button>
                            <button class="carousel-control-next" type="button"
                                data-bs-target="#carouselProperty{{ $property->id }}" data-bs-slide="next">
                                <span class="carousel-control-next-icon"></span>
                            </button>
                        </div>




                    </a>
                </div>
            </div>
            <div class="p-4 pb-0 mt-auto">
                <h5 class="text-primary mb-3">PKR-{{ $property->demand_price }}</h5>
                <a class="d-block h5 mb-2"
                    href="{{ route('property-advertisements.view', ['id' => $property->id]) }}">{{ $property->title }}</a>
                <p><i class="fa fa-map-marker-alt text-primary me-2"></i>{{ $property->address }}</p>
            </div>

            <div class="d-flex border-top mt-auto">
                <small class="flex-fill text-center border-end py-2">
                    <i
                        class="fa fa-ruler-combined text-primary me-2"></i>{{ $property->area_size }}-{{ $property->size_unit }}
                </small>
                <small class="flex-fill text-center border-end py-2">
                    <i class="fa fa-bed text-primary me-2"></i>
                    @if ($property->bedrooms)
                        <li><strong>Bedrooms:</strong> {{ $property->bedrooms }}</li>
                    @endif
                </small>
                <small class="flex-fill text-center py-2">
                    <i class="fa fa-bath text-primary me-2"></i>
                    @if ($property->positioning)
                        <li><strong>Location :</strong> {{ $property->positioning }}</li>
                    @endif
                </small>
            </div>
        </div>

        <!-- Carousel Property Card End -->
    @endif
</div>
