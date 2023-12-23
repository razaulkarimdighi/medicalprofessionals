@extends('frontend.master')

@section( 'banner')

<style>
    .hero_image{
        background-size: cover;
        background-position: top;
        position: relative;
        height: 100vh;

    }
    .hero_image h1{
        color: white;
        text-shadow: 2px 2px 2px rgba(0,0,0,.2);
        font-size: 50px;

    }
    .hero_image .color_overlay{
        position: absolute;
        width: 100%;
        height: 100%;
        background-color: rgb(0%, 0%, 100%, 0.2)


    }
    .hero_image .btn{
        background: #0463FA;
    }
</style>
<div class="container-fluid p-0 m-0">
    <div class="hero_image" style="background-image: url({{ asset('frontend/img/doctor.jpg') }})" >
        <div class="color_overlay d-flex justify-content-center align-items-center flex-column">
            <h1>Register with us</h1>
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Register</a>
        </div>
            </div>
</div>
@endsection
