<!DOCTYPE html>
<html>
 <head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>



  <style>
    div.fc-title{
        color : #ffffff;
        font-size: 14px;
        font-weight: bold;
    }
    div.fc-time{
        color : #ffffff;
        font-size: 12px;
        font-weight: bold;
    }
    .fc-event, .fc-event-dot {
    background-color: #0463FA;
    padding: 2px;
    font-size: 12px;
    color : #ffffff;
    }
</style>


<script>
    $(document).ready(function(){
        var events = @json($events);
        $('#calendar').fullCalendar({
            plugins: ['interaction', 'dayGrid', 'timeGrid'],
            defaultView: 'basicWeek',
            aspectRatio: 1.5,
            editable:false,
            header:{
            left:'',
            center:'title',
            right:'prev,next today',

    },
        events: events,
            eventRender: function(event, element) {
            var startTime = moment(event.start).format('LT'); // Format start time
            var endTime = moment(event.end).format('LT'); // Format end time
            var eventInfo = '<div class="fc-title">' + event.title + '</div>'; // Title
            eventInfo += '<div class="fc-time">' + startTime + ' - ' + endTime + '</div>'; // Start and end time
            element.find('.fc-content').html(eventInfo); // Replace content with title and times
            }
        });
    });
</script>
 </head>
 <body>
<div class="container">
    <div class="row">
        <div class="col-md-12">
           <div id="calendar">

           </div>

        </div>
    </div>
</div>
</body>
</html>






