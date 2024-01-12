@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">{{get_page_meta('title', true)}}</h4>

                    <form action="{{ route('admin.practitioners.store') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="row">
                            <div class="mb-3 col-md-4">
                                <label class="form-label"> Start Time <span class="error">*</span></label>
                                {{-- <input type="text" name="available_date" class="form-control" placeholder="Enter your available date" --}}
                                <input type="datetime-local" name="start" class="form-control" placeholder="Enter your start time"
                                       value="{{ old('start') }}">
                                @error('start')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 col-md-4">
                                <label class="form-label"> End <span class="error">*</span></label>
                                {{-- <input type="text" name="available_date" class="form-control" placeholder="Enter your available date" --}}
                                <input type="datetime-local" name="end" class="form-control" placeholder="Enter your end time"
                                       value="{{ old('end') }}">
                                @error('end')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="form-label">Type of Anaesthesiology<span class="error">*</span></label>
                                {{-- <input type="text" name="available_date" class="form-control" placeholder="Enter your available date" --}}
                                <input type="text" name="anesthesiology_type" class="form-control" placeholder="Enter Type of Anesthesiology"
                                       value="{{ old('anesthesiology_type') }}">
                                @error('anesthesiology_type')
                                <p class="error">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="mb-3 col-md-4">
                                <label class="form-label"> Honorary Note <span class="error">*</span></label>
                                <input type="file" name="honorary_note" class="form-control @error('honorary_note') is-invalid @enderror" autocomplete="honorary_note">

                                @error('honorary_note')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>



                        <div class="row">
                            <div class="mb-3 offset-md-6 col-md-6">
                                <div class="text-end">
                                    <button class="btn btn-primary waves-effect waves-lightml-2 me-2" type="submit">
                                        <i class="fa fa-save"></i> Save
                                    </button>

                                    <a class="btn btn-secondary waves-effect" href="{{ route('admin.schedules.index') }}">
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
    <script>
        var firstOpen = true;
        var time;

        $('#timePicker').datetimepicker({
            useCurrent: false,
            format: "hh:mm A"
        }).on('dp.show', function() {
            if(firstOpen) {
                time = moment().startOf('day');
                firstOpen = false;
            } else {
                time = "01:00 PM"
            }
            $(this).data('DateTimePicker').date(time);
        });
    </script>
@endpush

