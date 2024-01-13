@extends('layouts.master')


@section('content')
    <div class="modal fade" id="scheduleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                    <button type="button" id="close_schedule" class="close close_btn" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">User Type</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Location</th>
                                <th scope="col">Type of Anesthesiology</th>
                                <th scope="col">Honorary Note</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="name"></td>
                                <td id="user_type"></td>
                                <td id="phone"></td>
                                <td id="email"></td>
                                <td id="location"></td>
                                <td id="type_of_nesthesiology"></td>
                                <td id="honor_note"></td>
                            </tr>
                        </tbody>
                    </table>
                    {{-- Show Honorary Note --}}
                    <div class="embed-responsive embed-responsive-16by9">
                        <iframe src=" " class="embed-responsive-item" id="honor_note" allowfullscreen>

                        </iframe>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="honorary_note" class="btn btn-secondary">Upload Honorary Note</button>
                    <button type="button" class="btn btn-secondary" id="close_btn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal For Upload Honorary Note --}}
    <div class="modal fade" id="honoraryModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-small" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                    <button type="button" class="close close_btn" id="close_times_honorary" data-dismiss="modal"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="submit_honorary" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Upload</label>
                            <input type="hidden" name="schedule_id" id="schedule_id" value="">
                            <input type="file" name="file" class="form-control" id="exampleInputEmail1"
                                aria-describedby="emailHelp" placeholder="Enter email">
                            <span class="error" id="error"></span>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" id="honoraryCloseBtn" class="btn btn-secondary"
                        data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Full Calendar --}}

    <div class="mb-5">
        {{-- <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stat bg-white text-dark">
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="font-size-16 text-uppercase ">
                                <i class="fa fa-user icon" aria-hidden="true">
                                </i> Users
                            </h5>
                            <h2 class="text-uppercase ">t</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stat bg-white text-dark">
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="font-size-16 text-uppercase ">
                                <i class="fa fa-calendar" aria-hidden="true">
                                </i> Schedules
                            </h5>
                            <h2 class="text-uppercase ">t</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stat bg-white text-dark">
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="font-size-16 text-uppercase ">
                                <i class="fa fa-calendar-times-o" aria-hidden="true">
                                </i> Not Assigned
                            </h5>
                            <h2 class="text-uppercase ">t</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stat bg-white text-dark">
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="font-size-16 text-uppercase ">
                                <i class="fa fa-calendar-check-o" aria-hidden="true">
                                </i> Assigned Schedule
                            </h5>
                            <h2 class="text-uppercase ">t</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div id="calendar">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('script')
    <!-- Chart JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    {{-- <script src="{{ asset('/admin/js/Chart.bundle.min.js') }}"></script>
    <script src="{{ asset('/admin/js/chartjs.init.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <script>
        $(document).ready(function() {
            var events = @json($events);
            $('#calendar').fullCalendar({
                plugins: ['interaction', 'dayGrid', 'timeGrid'],
                defaultView: 'basicWeek',
                slotDuration: '00:15:00', // Each slot represents 15 minutes
                slotLabelInterval: '01:00:00', // Show time labels every hour
                aspectRatio: 1.5,
                editable: false,
                //selectable: true,
                // selectHelper: true,
                header: {
                    left: 'agendaDay, basicWeek',
                    center: 'title',
                    right: 'prev,next today',

                },
                events: events,
                eventRender: function(event, element) {
                    var startTime = moment(event.start).format('LT'); // Format start time
                    var endTime = moment(event.end).format('LT'); // Format end time
                    var eventInfo = '<div class="fc-title">' + event.title + '</div>'; // Title
                    eventInfo += '<div class="fc-time">' + startTime + ' - ' + endTime +
                        '</div>'; // Start and end time
                    element.find('.fc-content').html(eventInfo); // Replace content with title and times
                },
                eventClick: function(calEvent, jsEvent, view) {
                    console.log(calEvent),
                        $('#name').text(calEvent.title);
                    $('#phone').text(calEvent.phone);
                    $('#email').text(calEvent.email);
                    $('#location').text(calEvent.location);
                    $('#type_of_nesthesiology').text(calEvent.type_of_nesthesiology);
                    $('#user_type').text(calEvent.user_type);
                    $('#honor_note').attr('src',  'https://www.youtube.com/results?search_query=how+to+show+video+in+iframe+source+with+jaquery+in+laravel');
                    $('#schedule_id').val(calEvent.schedule_id);
                    $('#scheduleModal2').modal('toggle')

                }

            });
            $("#close_btn").click(function() {
                $('#scheduleModal2').modal('toggle')
            });
            $("#close_schedule").click(function() {
                $('#scheduleModal2').modal('toggle')
            });
            $("#honorary_note").click(function() {
                $('#scheduleModal2').modal('toggle')
                $('#honoraryModal').modal('toggle')
            });

            $("#honoraryCloseBtn").click(function() {
                $('#honoraryModal').modal('toggle')
            });

            $("#close_times_honorary").click(function() {
                $('#honoraryModal').modal('toggle')
            });

            $('#submit_honorary').submit(function(e) {
                e.preventDefault();
                var schedule_id = $('#schedule_id').val();
                $('#error').text('');
                var formData = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: " {{ route('admin.update.honorary.note') }} ",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: (response) => {
                        console.log(response)
                        if (response.response == 403) {
                            $('#error').text(response.message);
                        } else {
                            alert('File Updated');
                            window.location.reload()
                        }
                    },
                    error: function(response) {
                        console.log(response);
                        //$('#error').text(response.responseJSON.message);
                    }

                });
            });



        });
    </script>
@endpush

@push('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        div.fc-title {
            color: #ffffff;
            font-size: 14px;
        }

        div.fc-time {
            color: #ffffff;
            font-size: 14px;
        }

        .fc-event {
            cursor: pointer;
        }

        .fc-event,
        .fc-event-dot {
            background-color: #448cff;
            padding: 2px;
            font-size: 14px;
            color: #ffffff;
        }

        .fc-event .fc-bg {
            opacity: 0;
        }

        .fc-unthemed td.fc-today {
            background: #f8f8f8;
        }

        .fc-time-grid-event {
            width: 150px;
            text-align: center;
        }

        .fc-content {
            /* position: absolute;
                                top: 50%;
                                left: 50%;
                                transform: translate(-50%, -50%); */
        }

        .fc-day-grid-event .fc-time {
            font-weight: 400;
        }

        body {
            background-color: #f8f8fa;
        }

        .modal-dialog {
            max-width: 80%;
        }

        .modal-small {
            width: 30%;
        }
    </style>
@endpush
