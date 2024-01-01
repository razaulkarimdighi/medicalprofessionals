<!DOCTYPE html>
<html lang="en">

<head>
    @include('frontend.partials._head')
</head>


<body>


    @include('frontend.partials._spinner')


    {{-- @include('frontend.partials._topbar') --}}


    @include('frontend.partials._navbar')


    @yield('content')


    @include('frontend.partials._footer')

    <!-- Back to Top -->
    {{-- <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a> --}}

    <!-- JavaScript Libraries -->
    @include('frontend.partials._footer_script')
    @stack('script')
</body>

</html>
