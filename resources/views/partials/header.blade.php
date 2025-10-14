    <div class="container-xxl bg-white p-0">
        <!-- Spinner Start -->
        <div id="spinner"
            class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->
        <!-- Navbar Start -->
        <div class="container-fluid nav-bar bg-transparent sticky-top">
            <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
                <a href="{{ route('dashboard') }}" class="navbar-brand d-flex align-items-center text-center">
                    <div class="icon p-2 me-2">
                        <img class="img-fluid" src="{{ asset('img/icon-deal.png') }}" alt="Icon"
                            style="width: 30px; height: 30px;">
                    </div>
                    <h1 class="m-0 text-primary">Makaan</h1>
                </a>
                <button type="button" class="navbar-toggler" data-bs-toggle="collapse"
                    data-bs-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <div class="navbar-nav ms-auto">
                        <a href="{{ route('dashboard') }}" class="nav-item nav-link active">Home</a>
                        <a href="about.html" class="nav-item nav-link">About</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Property</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="property-list.html" class="dropdown-item">Property List</a>
                                <a href="property-type.html" class="dropdown-item">Property Type</a>
                                <a href="property-agent.html" class="dropdown-item">Property Agent</a>
                            </div>
                        </div>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                                <a href="404.html" class="dropdown-item">404 Error</a>
                            </div>
                        </div>
                        <a href="contact.html" class="nav-item nav-link">Contact</a>
                    </div>
                    @auth
                        <a href="{{ route('property.add') }}" class="btn btn-primary px-3 d-none d-lg-flex">Add Property</a>
                    @endauth
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a class="dropdown-toggle" data-bs-toggle="dropdown" href="#"> &nbsp;<i
                                    class="fa fa-user"></i>
                                @auth
                                    {{ Auth::user()->name }} <!-- Show user's name if logged in -->
                                @else
                                    SIGN IN <!-- Show "SIGN IN" if guest -->
                                @endauth

                                <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li>
                                    <div class="user-menu">
                                        <div class="text-center">
                                            <div class="user-image"><img class="img-responsive img-circle img-thumbnail"
                                                    src="{{ asset('img/avatar.png') }}"></div>
                                            <strong>
                                                @auth
                                                    {{ Auth::user()->name }} <!-- Logged-in user's name -->
                                                @else
                                                    Your Name? <!-- Default text for guests -->
                                                @endauth
                                            </strong>

                                            @auth

                                                <div>
                                                    <span><a href="{{ route('profile.view') }}"
                                                            class="btn-system border-btn btn-mini btn-purple">
                                                            {{ __('Profile') }}</a></span>
                                                    <p>Welcome back! Manage your <strong>Properties</strong>.</p>
                                                </div>
                                                <a href="{{ route('logout') }}" class="btn btn-danger btn-sm mb-2"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    Logout
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                    style="display: none;">
                                                    @csrf
                                                </form>
                                            @else
                                                <p>Sign In to post your <strong>Property</strong>.</p>
                                                <span><a href="{{ route('login') }}"
                                                        class="btn-system border-btn btn-mini btn-green"> Sign In</a></span>
                                                <div class="divider"></div>
                                                <p>Don't have an Account, Register (Sign Up) to create your
                                                    <strong>Account</strong> &amp; <strong>Post Your Property!</strong>.
                                                </p>
                                                <span><a href="{{ route('register') }}"
                                                        class="btn-system border-btn btn-mini btn-purple">
                                                        Register</a></span>

                                            @endauth

                                            <div class="hr1 margin-5"></div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- Navbar End -->
