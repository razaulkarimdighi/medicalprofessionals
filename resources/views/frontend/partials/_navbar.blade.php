<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 wow fadeIn" data-wow-delay="0.1s">
    <a href="" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <img src="{{ asset('frontend/img/LogoNarkoseWien.png') }}" class="img-fluid" width="75px">
        <h1 class="m-0 text-primary p-2">Narkose-Wien</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav  p-4 p-lg-0">
            <a href="" class="nav-item nav-link active">Home</a>
            <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
            <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
            {{-- <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Pages</a>
                <div class="dropdown-menu rounded-0 rounded-bottom m-0">
                    <a href="feature.html" class="dropdown-item">Feature</a>
                    <a href="team.html" class="dropdown-item">Our Doctor</a>
                    <a href="appointment.html" class="dropdown-item">Appointment</a>
                    <a href="testimonial.html" class="dropdown-item">Testimonial</a>
                    <a href="404.html" class="dropdown-item">404 Page</a>
                </div>
            </div> --}}
            {{-- <a href="contact.html" class="nav-item nav-link">Contact</a> --}}
        </div>
        {{-- <a href="" class="btn btn-primary rounded-0 py-4 px-lg-5 d-none d-lg-block">Appointment<i class="fa fa-arrow-right ms-3"></i></a> --}}
    </div>
</nav>
<!-- Navbar End -->
