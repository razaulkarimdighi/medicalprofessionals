@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">{{ get_page_meta('title', true) }}</h4>

                    <form action="{{ route('admin.assign_anesthesiologists.store') }}" method="post">
                        @csrf
                        <div class="row mb-2">
                            <div class="col-md-4">
                                <label class="form-label">Select Anesthesiologist <span class="error">*</span></label>

                                <input type="hidden" name="practicioner_id" value="{{ $practicioner_id }}">
                                <select class="form-control" data-placeholder="Choose ..." id="anesthesiologist_id"
                                    name="anesthesiologist_id">
                                    @foreach ($anesthesiologists as $anesthesiologist)
                                        <option value="{{ $anesthesiologist->id }}" class="text-capitalize">
                                            {{ $anesthesiologist->first_name }} {{ $anesthesiologist->last_name }}</option>
                                    @endforeach
                                </select>
                                @error('anesthesiologist_id')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>



                            <div class="col-md-4">
                                <label class="form-label">Schedule<span class="error">*</span></label>
                                <select class="custom-select form-control mr-sm-2 @error('schedule') is-invalid @enderror"
                                    id="schedule" name="schedule">
                                </select>

                                @error('schedule')
                                    <p class="error">{{ $message }}</p>
                                @enderror
                            </div>


                        </div>
                        <div class="row">
                            <div class="mb-3 offset-md-6 col-md-6">
                                <div class="text-end">
                                    <button class="btn btn-primary waves-effect waves-lightml-2 me-2" type="submit">
                                        <i class="fa fa-save"></i> Save
                                    </button>

                                    <a class="btn btn-secondary waves-effect"
                                        href="{{ route('admin.medical_practitioners.index') }}">
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
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(document).ready(function() {
            var schedule = $('#schedule');
            $(document).on('change', '#anesthesiologist_id', function() {
                let anesthesiologist = $(this).val();
                $.ajax({
                    method: 'get',
                    url: "{{ route('admin.get.all.schedule.by.user.type') }}",
                    data: {
                        anesthesiologist: anesthesiologist
                    },
                    success: function(response) {
                        console.log(response)

                        var select =
                            '<option selected disabled>--Select Sub-Category--</option>';

                            response.schedules.forEach(function(row) {
                            select += '<option value="' + row.id + '">' + row.start + ' to ' + row.end + ']</option>';
                        });
                        schedule.html(select);

                    }

                })

            });

        });
    </script>

    <script type="text/javascript"></script>
@endpush
