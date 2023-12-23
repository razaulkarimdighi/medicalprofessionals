@extends('frontend.master')

@section( 'banner')

<style>
    .hero_image{
        background-size: cover;
        background-position: center;
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
<div class="container-fluid p-0 m-0">
    <div class="hero_image" style="background-image: url({{ asset('frontend/img/doctor.jpg') }})" >
        <div class="color_overlay d-flex justify-content-center align-items-center">
            <div class="card w-50">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
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

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Send Password Reset Link') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
            </div>
</div>
@endsection
