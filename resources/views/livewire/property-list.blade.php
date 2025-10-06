<div id="PropertiesList" class="container-xxl">
    <div style="display: none;">
    @if($propertyCount > 0)
     @foreach($properties as $property)
     <p>{{$property->title}},</p>
      @endforeach

    @endif
    </div>


    <div class="container">
        <div class="row g-0 gx-5 align-items-end">
            <div class="col-lg-6">
                <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s"
                    style="visibility: visible; animation-delay: 0.1s; animation-name: slideInLeft;">
                    <h1 class="mb-3">Property Listing</h1>
                    <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum sit
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
                   <livewire:property-item prop-type="1" />
                    <livewire:property-item prop-type="2" />
                    <!-- Browse More Button -->
                    <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                        <a class="btn btn-primary py-3 px-5" href="">Browse More Property</a>
                    </div>
                </div>
            </div>

            <div id="tab-2" class="tab-pane fade show p-0 ">
                <div class="row g-4">
                    <!-- Single Image Property Card Begin -->
                    <div class="col-lg-4 col-md-6 d-flex boxes">
                        <div class="property-item rounded overflow-hidden d-flex flex-column w-100">
                            <div class="position-relative overflow-hidden">
                                <a href="">
                                    <img class="img-fluid w-100" src="../img/property-1.jpg" alt="">
                                </a>
                                <div
                                    class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                    For Rent
                                </div>
                                <div
                                    class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                    Shop
                                </div>
                            </div>
                            <div class="p-4 pb-0 mt-auto">
                                <h5 class="text-primary mb-3">$12,345</h5>
                                <a class="d-block h5 mb-2" href="">Urban House For Sell</a>
                                <p><i class="fa fa-map-marker-alt text-primary me-2"></i>456 Street, New York, USA</p>
                            </div>
                            <div class="d-flex border-top mt-auto">
                                <small class="flex-fill text-center border-end py-2"><i
                                        class="fa fa-ruler-combined text-primary me-2"></i>500 Sqft</small>
                                <small class="flex-fill text-center border-end py-2"><i
                                        class="fa fa-bed text-primary me-2"></i>4 Bed</small>
                                <small class="flex-fill text-center py-2"><i
                                        class="fa fa-bath text-primary me-2"></i>2
                                    Bath</small>
                            </div>
                        </div>
                    </div>
                    <!-- Single Image Property Card End -->

                    <!-- Carousel Property Card Begin -->
                    <div class="col-lg-4 col-md-6 d-flex boxes">
                        <div class="property-item rounded overflow-hidden d-flex flex-column w-100">
                            <div class="position-relative overflow-hidden">
                                <!-- Bootstrap Ratio wrapper makes it responsive -->
                                <div class="ratio ratio-16x9">
                                    <div id="carouselProperty1" class="carousel slide" data-bs-ride="carousel">
                                        <!-- Indicators -->
                                        <div class="carousel-indicators">
                                            <button type="button" data-bs-target="#carouselProperty1"
                                                data-bs-slide-to="0" class="active" aria-current="true"></button>
                                            <button type="button" data-bs-target="#carouselProperty1"
                                                data-bs-slide-to="1"></button>
                                            <button type="button" data-bs-target="#carouselProperty1"
                                                data-bs-slide-to="2"></button>
                                        </div>
                                        <!-- Slides -->
                                        <div class="carousel-inner h-100">
                                            <div class="carousel-item h-100 active">
                                                <div
                                                    class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                                    For Rent
                                                </div>
                                                <img src="../img/carousel-2.jpg" class="d-block w-100 h-100"
                                                    style="object-fit: cover;" alt="...">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h5>Main Entrance</h5>
                                                </div>
                                            </div>
                                            <div class="carousel-item h-100">
                                                <div
                                                    class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                                    For Rent
                                                </div>
                                                <img src="../img/property-5.jpg" class="d-block w-100 h-100"
                                                    style="object-fit: cover;" alt="...">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h5>Bedroom</h5>
                                                </div>
                                            </div>
                                            <div class="carousel-item h-100">
                                                <div
                                                    class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                                    For Rent
                                                </div>
                                                <img src="../img/property-4.jpg" class="d-block w-100 h-100"
                                                    style="object-fit: cover;" alt="...">
                                                <div class="carousel-caption d-none d-md-block">
                                                    <h5>Kitchen</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Controls -->
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselProperty1" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon"></span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselProperty1" data-bs-slide="next">
                                            <span class="carousel-control-next-icon"></span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="p-4 pb-0 mt-auto">
                                <h5 class="text-primary mb-3">$12,345</h5>
                                <a class="d-block h5 mb-2" href="">Golden  House For Sell</a>
                                <p><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA</p>
                            </div>
                            <div class="d-flex border-top mt-auto">
                                <small class="flex-fill text-center border-end py-2"><i
                                        class="fa fa-ruler-combined text-primary me-2"></i>1000 Sqft</small>
                                <small class="flex-fill text-center border-end py-2"><i
                                        class="fa fa-bed text-primary me-2"></i>3 Bed</small>
                                <small class="flex-fill text-center py-2"><i
                                        class="fa fa-bath text-primary me-2"></i>2 Bath</small>
                            </div>
                        </div>
                    </div>
                    <!-- Carousel Property Card End -->

                    <!-- Browse More Button -->
                    <div class="col-12 text-center wow fadeInUp" data-wow-delay="0.1s">
                        <a class="btn btn-primary py-3 px-5" href="">Browse More Property</a>
                    </div>
                </div>
            </div>

            <div id="tab-3" class="tab-pane fade show p-0">
                <div class="row g-4">

                    <div class="col-lg-4 col-md-6">
                        <div class="property-item rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <a href=""><img class="img-fluid" src="../img/property-6.jpg"
                                        alt=""></a>
                                <div
                                    class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                    For Rent</div>
                                <div
                                    class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                    Shop</div>
                            </div>
                            <div class="p-4 pb-0">
                                <h5 class="text-primary mb-3">$12,345</h5>
                                <a class="d-block h5 mb-2" href="">Golden Urban House For Sell</a>
                                <p><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA</p>
                            </div>
                            <div class="d-flex border-top">
                                <small class="flex-fill text-center border-end py-2"><i
                                        class="fa fa-ruler-combined text-primary me-2"></i>1000 Sqft</small>
                                <small class="flex-fill text-center border-end py-2"><i
                                        class="fa fa-bed text-primary me-2"></i>3 Bed</small>
                                <small class="flex-fill text-center py-2"><i
                                        class="fa fa-bath text-primary me-2"></i>2 Bath</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 text-center">
                        <a class="btn btn-primary py-3 px-5" href="">Browse More Property</a>
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
</div>
