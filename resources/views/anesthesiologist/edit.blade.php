@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">{{get_page_meta('title', true)}}</h4>

                    <form action="{{ route('admin.schedules.update', $schedule->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            <div class="mb-3 col-md-6">
                                <label class="form-label">Edit Schedule <span class="error">*</span></label>
                                <input type="text" name="available_date" class="form-control" required="" placeholder="First Name"
                                       value="{{ $schedule->available_date }}">
                                @error('available_date')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                        <div class="row">
                            <div class="mb-3 offset-md-6 col-md-6">
                                <div class="text-end">
                                    <button class="btn btn-primary waves-effect waves-lightml-2 me-2" type="submit">
                                        <i class="fa fa-save"></i> Save
                                    </button>

                                    <a class="btn btn-secondary waves-effect" href="{{ route('admin.users.index') }}">
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

