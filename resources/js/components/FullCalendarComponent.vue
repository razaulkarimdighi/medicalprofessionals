<template>
    <div class="container">
        <FullCalendar :options='calendarOptions' />
    </div>
</template>

    <script>
        import FullCalendar from '@fullcalendar/vue'
        import dayGridPlugin from '@fullcalendar/daygrid'
import axios from 'axios'
var moment = require('moment');
        export default{
            components: {
                FullCalendar // make the <FullCalendar> tag available
            },
            data() {
                return {
                    calendarOptions: {
                        plugins: [dayGridPlugin],
                        initialView: 'dayGridMonth',
                        weekends: false,
                        events: [
                            { title: 'Start Time', start: new Date() },
                        ]
                    }
                }
            },
            methods:{
                async loadAllEvents(){
                    await axios.get('/admin/assign_anesthesiologist/all/assignment')
                    .then((response)=>{
                        console.log(response);
                        // if(response.data.status == 200){
                        //     this.calendarOptions.events = response.data.events;
                        // }
                    })
                    .catch((error)=>{
                        console.log(error);
                    });
                }
            },
            created(){
                this.loadAllEvents();
            }
        }
    </script>
