@extends('layouts.master')


@section('content')
<div class="modal fade" id="scheduleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                    <button type="button" class="close close_btn" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Anesthesiologist Name</th>
                                <th scope="col">Practitioner Name</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Email</th>
                                <th scope="col">Location</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td id="anesthesiologist_name"></td>
                                <td id="practitioner_name"></td>
                                <td id="phone"></td>
                                <td id="email"></td>
                                <td id="location"></td>

                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close_btn" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="mb-5">
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card mini-stat bg-white text-dark">
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="font-size-16 text-uppercase ">
                                <i class="fa fa-user icon" aria-hidden="true">
                                </i> Users
                            </h5>
                            <h2 class="text-uppercase ">{{ $totalUser }}</h2>
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
                            <h2 class="text-uppercase ">{{ $totalSchedule }}</h2>
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
                            <h2 class="text-uppercase ">{{ $notAssignedSchedule }}</h2>
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
                            <h2 class="text-uppercase ">{{ $assignedSchedule }}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

        .fc-event,
        .fc-event-dot {
            background-color: #448cff;
            padding: 2px;
            font-size: 14px;
            color: #ffffff;
        }

        .fc-event .fc-bg{
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
        .fc-day-grid-event .fc-time{
            font-weight: 400;
        }

        body {
            background-color: #f8f8fa;
        }
    </style>
@endpush

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
                defaultView: 'agendaDay',
                slotDuration: '00:15:00', // Each slot represents 15 minutes
                slotLabelInterval: '01:00:00', // Show time labels every hour
                aspectRatio: 1.5,
                editable: false,
                selectable: true,
                selectHelper: true,
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
                     $('#anesthesiologist_name').text(calEvent.anesthesiologist_name);
                     $('#practitioner_name').text(calEvent.practitioner_name);
                     $('#phone').text(calEvent.phone);
                     $('#email').text(calEvent.email);
                     $('#location').text(calEvent.location);

                    $('#scheduleModal2').modal('toggle')

                }

            });
            $(".close_btn").click(function() {
                $('#scheduleModal2').modal('toggle')
            });
        });
    </script>
@endpush
