<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light sticky-top p-0 wow fadeIn" data-wow-delay="0.1s">
    <a href="home" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
        <img src="{{ asset('frontend/img/LogoNarkoseWien.png') }}" class="img-fluid" width="75px">
        <h1 class="m-0 text-primary p-2">Narkose-Wien</h1>
    </a>
    <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav  p-4 p-lg-0">
            <a href="{{ route('home') }}" class="nav-item nav-link active">Home</a>
            <a href="{{ route('register') }}" class="nav-item nav-link">Register</a>
            <a href="{{ route('login') }}" class="nav-item nav-link">Login</a>
        </div>
    </div>
</nav>
<!-- Navbar End -->
<style>
    @media (max-width: 575.98px) {
        .navbar-light .navbar-toggler {
            margin-top: 10px;
            margin-bottom: 10px;
            margin-left: 10px;
        }
        .hero_image .card{
            width: 80% !important;
        }
        .navbar-brand{
            align-items: center;
        }
    }
</style>
