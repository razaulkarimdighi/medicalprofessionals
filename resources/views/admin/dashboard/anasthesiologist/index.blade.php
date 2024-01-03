@extends('layouts.master')


@section('content')
    <div class="mb-5">
        <div class="row">
            <div class="col-xl-4 col-md-6">
                <div class="card mini-stat bg-white text-dark">
                    <div class="card-body">
                        <div class="mb-4">
                            <h5 class="font-size-16 text-uppercase ">
                                <i class="fa fa-calendar" aria-hidden="true">
                                </i> Schedules
                            </h5>
                            <h2 class="text-uppercase ">{{ $user_schedules }}</h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6">
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
            <div class="col-xl-4 col-md-6">
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
                }
            });
        });
    </script>
@endpush
