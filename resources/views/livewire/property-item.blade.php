        @if ($propType === '1')
            <!-- Single Image Property Card Begin -->
            <div class="col-lg-4 col-md-6 d-flex boxes">
                <div class="property-item rounded overflow-hidden d-flex flex-column w-100">

                    <!-- ✅ Fixed Ratio Wrapper -->
                    <div class="position-relative overflow-hidden" style="aspect-ratio: 16 / 9;">
                        <a href="">
                            <img class="w-100 h-100" style="object-fit: cover;" src="../img/property-6.jpg"
                                alt="Property Image">
                        </a>
                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                            For Rent
                        </div>
                        <div
                            class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                            Shop
                        </div>
                    </div>

                    <div class="p-4 pb-0 mt-auto">
                        <h5 class="text-primary mb-3">$12,345</h5>
                        <a class="d-block h5 mb-2" href="">Golden Urban House For Sell</a>
                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA</p>
                    </div>

                    <div class="d-flex border-top mt-auto">
                        <small class="flex-fill text-center border-end py-2">
                            <i class="fa fa-ruler-combined text-primary me-2"></i>1000 Sqft
                        </small>
                        <small class="flex-fill text-center border-end py-2">
                            <i class="fa fa-bed text-primary me-2"></i>3 Bed
                        </small>
                        <small class="flex-fill text-center py-2">
                            <i class="fa fa-bath text-primary me-2"></i>2 Bath
                        </small>
                    </div>
                </div>
            </div>
            <!-- Single Image Property Card End -->
        @elseif ($propType === '2')
            <!-- Carousel Property Card Begin -->
            <div class="col-lg-4 col-md-6 d-flex boxes">
                <div class="property-item rounded overflow-hidden d-flex flex-column w-100">
                    <div class="position-relative overflow-hidden">
                        <!-- Bootstrap Ratio wrapper makes it responsive -->
                        <div class="ratio ratio-16x9">
                            <div id="carouselProperty1" class="carousel slide" data-bs-ride="carousel">
                                <!-- Indicators -->
                                <div class="carousel-indicators">
                                    <button type="button" data-bs-target="#carouselProperty1" data-bs-slide-to="0"
                                        class="active" aria-current="true"></button>
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
                                        <img src="../img/carousel-1.jpg" class="d-block w-100 h-100"
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
                                        <img src="../img/carousel-2.jpg" class="d-block w-100 h-100"
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
                                        <img src="../img/property-3.jpg" class="d-block w-100 h-100"
                                            style="object-fit: cover;" alt="...">
                                        <div class="carousel-caption d-none d-md-block">
                                            <h5>Kitchen</h5>
                                        </div>
                                    </div>
                                </div>
                                <!-- Controls -->
                                <button class="carousel-control-prev" type="button" data-bs-target="#carouselProperty1"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#carouselProperty1"
                                    data-bs-slide="next">
                                    <span class="carousel-control-next-icon"></span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="p-4 pb-0 mt-auto">
                        <h5 class="text-primary mb-3">$12,345</h5>
                        <a class="d-block h5 mb-2" href="">Golden Urban House For Sell</a>
                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA</p>
                    </div>
                    <div class="d-flex border-top mt-auto">
                        <small class="flex-fill text-center border-end py-2"><i
                                class="fa fa-ruler-combined text-primary me-2"></i>1000 Sqft</small>
                        <small class="flex-fill text-center border-end py-2"><i
                                class="fa fa-bed text-primary me-2"></i>3
                            Bed</small>
                        <small class="flex-fill text-center py-2"><i class="fa fa-bath text-primary me-2"></i>2
                            Bath</small>
                    </div>
                </div>
            </div>
            <!-- Carousel Property Card End -->
        @else
            <div class="col-lg-4 col-md-6 d-flex boxes">
                <div class="property-item rounded overflow-hidden d-flex flex-column w-100">

                    <!-- ✅ Fixed Ratio Wrapper -->
                    <div class="position-relative overflow-hidden" style="aspect-ratio: 16 / 9;">
                        <a href="">
                            <img class="w-100 h-100" style="object-fit: cover;" src="../img/NoImage.jpg"
                                alt="Property Image">
                        </a>
                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                            For Rent
                        </div>
                        <div
                            class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                            Shop
                        </div>
                    </div>

                    <div class="p-4 pb-0 mt-auto">
                        <h5 class="text-primary mb-3">$12,345</h5>
                        <a class="d-block h5 mb-2" href="">Golden Urban House For Sell</a>
                        <p><i class="fa fa-map-marker-alt text-primary me-2"></i>123 Street, New York, USA</p>
                    </div>

                    <div class="d-flex border-top mt-auto">
                        <small class="flex-fill text-center border-end py-2">
                            <i class="fa fa-ruler-combined text-primary me-2"></i>1000 Sqft
                        </small>
                        <small class="flex-fill text-center border-end py-2">
                            <i class="fa fa-bed text-primary me-2"></i>3 Bed
                        </small>
                        <small class="flex-fill text-center py-2">
                            <i class="fa fa-bath text-primary me-2"></i>2 Bath
                        </small>
                    </div>
                </div>
            </div>
        @endif
