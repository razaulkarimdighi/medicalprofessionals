@extends('frontend.master')

@section('content')
    <div class="container-fluid p-0 m-0">
        <div class="hero_image img-fluid" style="background-image: url({{ asset('frontend/img/doctor.jpg') }})">
            <div class="color_overlay d-flex justify-content-center align-items-center flex-column">
                <div class="card w-50">
                    <div class="p-3">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="row mb-2">
                                <label for="first_name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('First Name') }}</label>

                                <div class="col-md-6">
                                    <input id="first_name" type="text"
                                        class="form-control @error('first_name') is-invalid @enderror" name="first_name"
                                        value="{{ old('first_name') }}" autocomplete="first_name" autofocus>

                                    @error('first_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="last_name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Last Name') }}</label>

                                <div class="col-md-6">
                                    <input id="last_name" type="text"
                                        class="form-control @error('last_name') is-invalid @enderror" name="last_name"
                                        value="{{ old('last_name') }}" autocomplete="last_name" autofocus>

                                    @error('last_name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="Phone"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Phone') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="text"
                                        class="form-control @error('phone') is-invalid @enderror" name="phone"
                                        value="{{ old('phone') }}" autocomplete="phone" autofocus>

                                    @error('phone')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email') }}" autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="location"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Location') }}</label>

                                <div class="col-md-6">
                                    <input id="location" type="text"
                                        class="form-control @error('location') is-invalid @enderror" name="location"
                                        value="{{ old('location') }}" autocomplete="location">

                                    @error('location')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mb-2">
                                <label for="user_type"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Join As') }}</label>

                                <div class="col-md-6">
                                    <select class="form-select" name="user_type" aria-label="Default select example"
                                        id="user_type">
                                        <option selected disabled>Select One</option>
                                        <option class="text-capitalize"
                                            value="{{ App\Models\User::USER_TYPE_MEDICAL_PRACTICES }}">
                                            Medical Practitioner</option>

                                        <option class="text-capitalize"
                                            value="{{ App\Models\User::USER_TYPE_ANESTHEIOLOGISTS }}">
                                            Anesthesiologist</option>

                                    </select>
                                    @error('user_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="row mb-2" id="anesthesiologist_type">
                                <label for="anesthesiologist_type"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Anesthesiologist Type') }}</label>

                                <div class="col-md-6">
                                    <input id="anesthesiologist_type" type="text"
                                        class="form-control @error('anesthesiologist_type') is-invalid @enderror"
                                        name="anesthesiologist_type" value="{{ old('anesthesiologist_type') }}"
                                        autocomplete="anesthesiologist_type">

                                    @error('anesthesiologist_type')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>

                            </div>

                            <div class="row mb-2">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password"
                                        class="form-control @error('password') is-invalid @enderror" name="password"
                                        autocomplete="new-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-2">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" autocomplete="new-password">
                                </div>
                            </div>

                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register') }}
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
@push('style')
    <style>
        .hero_image {
            background-size: cover;
            background-position: top;
            position: relative;
            height: 100vh;

        }
        .hero_image h1 {
            color: white;
            text-shadow: 2px 2px 2px rgba(0, 0, 0, .2);
            font-size: 50px;

        }
        .hero_image .color_overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background-color: rgb(0%, 0%, 100%, 0.2)
        }

        .hero_image .btn {
            background: #0463FA;
        }

        input#honorary_note.form-control {
            background: none;
        }
    </style>
@endpush
@push('script')
    <script>
        $(document).ready(function() {
            $("#anesthesiologist_type").hide();
            $("#user_type").on("change", function() {
                var user_type = $(this).val();

                if (user_type == "anesthesiologists") {
                    $("#anesthesiologist_type").show(200);
                } else {
                    $("#anesthesiologist_type").hide(200);
                }

            });

        });
    </script>
@endpush
