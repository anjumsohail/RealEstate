<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Makaan - Real Estate')</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href={{ asset('img/favicon.ico') }} rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <!-- Leaflet JS -->
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/leaflet.draw/1.0.4/leaflet.draw.js"></script>

    <style>
        #map {
            height: 500px;
        }

        .leaflet-draw-toolbar {
            z-index: 10000 !important;
        }
    </style>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body>
    @include('partials.header')
    <!-- PropertyDetail overlay component (always in DOM) -->

    @yield('content')
    @include('partials.footer')

    <!-- PropertyDetail overlay component - OUTSIDE normal flow -->
    <livewire:property-detail />




    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('js/main.js') }}"></script>

    @livewireScripts
    <!-- JavaScript for URL handling -->
    <script>
        document.addEventListener('livewire:initialized', () => {
            // Function to enable scrolling
            function enableBodyScroll() {
                document.body.style.overflow = '';
                document.body.style.overflowX = '';
                document.body.style.overflowY = '';
                document.body.style.height = '';
                document.body.style.position = '';
                document.body.classList.remove('modal-open');

                // Also reset html element
                document.documentElement.style.overflow = '';
                document.documentElement.style.overflowX = '';
                document.documentElement.style.overflowY = '';
            }

            // Function to disable scrolling
            function disableBodyScroll() {
                document.body.style.overflow = 'hidden';
                document.body.style.height = '100vh';
                document.body.classList.add('modal-open');
            }

            // Listen for modal events
            Livewire.on('modal-opened', () => {

                disableBodyScroll();
            });

            Livewire.on('modal-closed', () => {

                enableBodyScroll();
            });

            // Handle escape key - directly call the component method
            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') {
                    const propertyDetailComponent = Object.values(Livewire.components.components()).find(
                        component =>
                        component.name.includes('PropertyDetail')
                    );
                    if (propertyDetailComponent) {
                        propertyDetailComponent.$wire.closePropertyDetail();
                    }
                }
            });

            // Handle browser back button
            window.addEventListener('popstate', function(event) {
                enableBodyScroll();
                const propertyDetailComponent = Object.values(Livewire.components.components()).find(
                    component =>
                    component.name.includes('PropertyDetail')
                );
                if (propertyDetailComponent && propertyDetailComponent.$wire.showModal) {
                    propertyDetailComponent.$wire.closePropertyDetail();
                }
            });

            // Always enable scroll on page load
            enableBodyScroll();
        });

        // Emergency scroll fix - call this in console if needed
        window.fixScroll = function() {
            document.body.style.overflow = 'auto';
            document.body.style.height = 'auto';
            document.body.classList.remove('modal-open');
        };
    </script>

    @stack('scripts')

</body>

</html>
