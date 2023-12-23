@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title mb-3">{{get_page_meta('title', true)}}</h4>

                    <form action="{{ route('admin.assign_anesthesiologists.store') }}" method="post">
                        @csrf
                            <div class="row mb-2">
                                <div class="col-md-6">
                                    <label class="form-label">Select Anesthesiologist <span class="error">*</span></label>

                                    <input type="hidden" name="practicioner_id" value="{{ $practicioner_id }}">
                                    <select class="form-control"
                                            data-placeholder="Choose ..." id="anesthesiologist_id" name="anesthesiologist_id">
                                        @foreach($anesthesiologists as $anesthesiologist)
                                            <option value="{{$anesthesiologist->id}}" class="text-capitalize">{{$anesthesiologist->first_name}} {{ $anesthesiologist->last_name}}</option>
                                        @endforeach
                                    </select>
                                    @error('anesthesiologist_id')
                                    <p class="error">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Schedules<span class="error">*</span></label>


                                    <select id="schedule" class="form-control Programme" name="assignment_date">
                                        <option value="0" disabled>Select Schedule</option>
                                        @foreach ($schedules as $schedule)
                                        <option value="{{ $schedule->available_date }}">{{ $schedule->available_date }}</option>
                                        @endforeach
                                    </select>

                                    @error('assignment_date')
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

    <script type="text/javascript">



        // $("#anesthesiologist_id").change(function(){
        //     alert("The text has been changed.");
        // });
        // $(document).ready(function(){

        //     $('#clicked').click(function (e) {
        //         e.preventDefault();
        //         console.log('clicked')
        //     })

        //     $("#anesthesiologist_id").change(function(){
        //         alert("The text has been changed.");
        //     });

        //     $(document).on('change', '#anesthesiologist_id', function () {
        //         console.log('clicked')
        //         var vendor_type = $(this).val();
        //         console.log('Vendor Type - ' + vendor_type);
        //         if (vendor_type){
        //             loader.show();
        //             vendorId.attr('disabled','disabled');
        //             $.ajax({
        //                 type: 'get',
        //                 url: '/admin/payments/get/vendor',
        //                 data: {'vendor_type': vendor_type},
        //                 dataType: 'json',//return data will be json
        //                 success: function (data) {
        //                     console.log(data)
        //                     var select = '<option selected disabled>--Select Builder/Subcontractor--</option>';
        //                     console.log(data.length)
        //                     if (data.length > 0){
        //                         data.forEach(function (row){
        //                             select += '<option value="'+row.id+'">'+row.name+'</option>';
        //                         });
        //                     }else {
        //                         let oldText = $(".select2-selection__placeholder").text();
        //                         let newText = "No "+vendor_type+ " found";
        //                         console.log(newText)
        //                         $(".select2-selection__placeholder").text($(".select2-selection__placeholder").text().replace(oldText, newText));
        //                         // var text = $(".select2-selection__placeholder").text();
        //                         // text.replace('Please select','No builder found');
        //                         // console.log(text)
        //                     }
        //                     if (!$.trim(data)){
        //                         vendorId.attr('disabled','disabled');
        //                         loader.hide();
        //                     }
        //                     else{
        //                         vendorId.removeAttr('disabled');
        //                         vendorId.html(select);
        //                         loader.hide();
        //                     }
        //                 },
        //                 error: function () {
        //                 }
        //             });
        //         }
        //     });

        // });
        </script>
@endpush

