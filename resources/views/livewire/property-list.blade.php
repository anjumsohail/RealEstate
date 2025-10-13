<div id="PropertiesList" class="container-xxl">

    @if ($searched)

        <div class="container">
            <div class="row g-0 gx-5 align-items-end">
                <div class="col-lg-6">
                    <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s"
                        style="visibility: visible; animation-delay: 0.1s; animation-name: slideInLeft;">
                        <h1 class="mb-3">Property Listing</h1>
                        <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum
                            sit
                            eirmod sit diam justo sed rebum.</p>
                    </div>
                </div>
                <div class="col-lg-6 text-start text-lg-end wow slideInRight" data-wow-delay="0.1s"
                    style="visibility: visible; animation-delay: 0.1s; animation-name: slideInRight;">
                    <ul class="nav nav-pills d-inline-flex justify-content-end mb-5">
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary active" data-bs-toggle="pill" href="#tab-1">Featured</a>
                        </li>
                        <li class="nav-item me-2">
                            <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-2">For Sell</a>
                        </li>
                        <li class="nav-item me-0">
                            <a class="btn btn-outline-primary" data-bs-toggle="pill" href="#tab-3">For Rent</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="tab-content">

                <div id="tab-1" class="tab-pane fade show p-0 active">
                    <div class="row g-4">
                        @foreach ($properties as $property)
                            @if ($property->featured)
                                <livewire:property-item :propertyid="$property->id" :key="$property->id" />
                            @endif
                        @endforeach
                        <!-- Browse More Button -->
                        <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                            {{ $properties->links('vendor.livewire.bootstrap') }}
                        </div>
                    </div>
                </div>

                <div id="tab-2" class="tab-pane fade show p-0 ">
                    <div class="row g-4">
                        @foreach ($properties as $property)
                            @if ($property->purpose === 'Sale')
                                <livewire:property-item :propertyid="$property->id" :key="$property->id" />
                            @endif
                        @endforeach
                        <!-- Browse More Button -->
                        <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                            {{ $properties->links('vendor.livewire.bootstrap') }}
                        </div>
                    </div>

                </div>

                <div id="tab-3" class="tab-pane fade show p-0">
                    <div class="row g-4">
                        @foreach ($properties as $property)
                            @if ($property->purpose === 'Rent')
                                <livewire:property-item :propertyid="$property->id" :key="$property->id" />
                            @endif
                        @endforeach
                        <!-- Browse More Button -->
                        <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                            {{ $properties->links('vendor.livewire.bootstrap') }}
                        </div>
                    </div>

                </div>

            </div>

        </div>
</div>
</div>
@push('scripts')
    <script>
        document.querySelectorAll('a[data-bs-toggle="pill"]').forEach(tab => {
            tab.addEventListener('shown.bs.tab', event => {
                const targetPaneSelector = tab.getAttribute('href');
                const targetPane = document.querySelector(targetPaneSelector);
                if (!targetPane) return;

                const carouselEl = targetPane.querySelector('.carousel');
                const element = document.getElementById("PropertiesList");
                element.scrollIntoView();


                if (carouselEl) {

                    console.log("Carosel");
                    let carousel = bootstrap.Carousel.getInstance(carouselEl);
                    if (!carousel) {
                        carousel = new bootstrap.Carousel(carouselEl, {
                            ride: 'carousel'
                        });
                    }
                    carousel.to(0); // reset first slide
                    carousel.cycle(); // start auto-sliding
                }
            });
        });
    </script>
@endpush
@endif
</div>
