<!DOCTYPE html>
<html lang="en">
@include('frontend.partials._head')
<body>


    @include('frontend.partials._spinner')


    {{-- @include('frontend.partials._topbar') --}}


    @include('frontend.partials._navbar')


   @yield('banner')
 

    @include('frontend.partials._footer')

    <!-- Back to Top -->
    {{-- <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a> --}}

    <!-- JavaScript Libraries -->
 @include('frontend.partials._footer_script')
</body>
</html>
