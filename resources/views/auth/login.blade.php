@extends('frontend.master')

@section( 'content')
@push('style')
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
    .hero_image .color_overlay a{
        color: #fff;
    }
    .hero_image .btn{
        background: #0463FA;
    }
</style>
@endpush
<div class="container-fluid p-0 m-0">
    <div class="hero_image" style="background-image: url({{ asset('frontend/img/doctor.jpg') }})" >
        <div class="color_overlay d-flex justify-content-center align-items-center">
            <div class="card w-50">

                <div class="p-3">{{ __('Login') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                {{-- @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            </div>
</div>
@endsection
