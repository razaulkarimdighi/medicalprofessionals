@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">{{get_page_meta('title', true)}}</h4>

                    <form action="{{  route('admin.medical_practitioners.update', $medical_practitioner->id) }} }}" method="post">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">First Name <span class="error">*</span></label>
                                <input type="text" name="first_name" class="form-control" placeholder="First Name"
                                       value="{{ $medical_practitioner->first_name }}">
                                @error('first_name')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Last Name <span class="error">*</span></label>
                                <input type="text" name="last_name" class="form-control" placeholder="Last Name"
                                       value="{{ $medical_practitioner->last_name }}">
                                @error('last_name')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Phone <span class="error">*</span></label>
                                <input type="tel" name="phone" class="form-control" placeholder="Phone"
                                       value="{{ $medical_practitioner->phone }}">
                                @error('phone')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Address </label>
                                <input type="text" name="address" class="form-control" placeholder="Title"
                                       value="{{ $medical_practitioner->address }}">
                                @error('address')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-6">
                                <label class="form-label">Permission</label>
                                    <select class="form-select" aria-label="Default select example" name="permission">
                                    <option selected disabled>Select One</option>
                                    <option value="accepted">Accepted</option>
                                    <option value="rejected">Rejected</option>
                                  </select>
                                @error('permission')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                        <div class="row">
                            <div class="mb-3 offset-md-6 col-md-6">
                                <div class="text-end">
                                    <button class="btn btn-primary waves-effect waves-lightml-2 me-2" type="submit">
                                        <i class="fa fa-save"></i> Save
                                    </button>

                                    <a class="btn btn-secondary waves-effect" href="{{ route('admin.medical_practitioners.index') }}">
                                        <i class="fa fa-times"></i> Cancel
                                    </a>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('script')
    <script src="{{ asset('/admin/js/passwordCheck.js') }}"></script>
@endpush

