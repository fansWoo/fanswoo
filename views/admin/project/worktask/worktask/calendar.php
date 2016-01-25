<?=$temp['header_up']?>
<link href='js/tool/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='js/tool/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script src='js/tool/fullcalendar/moment.min.js'></script>
<script src='js/tool/fullcalendar/fullcalendar.min.js'></script>
<script src='js/tool/fullcalendar/gcal.js'></script>
<script>
$(document).ready(function() {
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek'
        },
        selectable: true,
        selectHelper: true,
        select: function(start, end) {
            var title = prompt('Event Title:');
            var eventData;
            if (title) {
                eventData = {
                    title: title,
                    start: start,
                    end: end
                };
                $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
            }
            $('#calendar').fullCalendar('unselect');
        },
        eventClick: function(event) {
            // opens events in a popup window
            console.log(event);
            if( event.url == undefined )
            {
                alert(event.id);
            }
            else
            {
                window.open(event.url);
            }
            return false;
        },
        eventDragStop: function( event, jsEvent, ui, view ) {
            // alert('drag');
        },
        eventResizeStop: function( event, jsEvent, ui, view ) {
            // alert('resize');
        },
        loading: function(bool) {
            $('#loading').toggle(bool);
        },
        defaultDate: '2016-01-12',
        editable: true,
        // eventLimit: true, // allow "more" link when too many events
        events: [
            {
                title: 'All Day Event',
                start: '2016-01-01',
                color: 'yellow',
                textColor: 'black',
                id: 123
            },
            {
                title: 'All Day Event2',
                start: '2016-01-02',
                color: 'yellow',
                textColor: 'black',
                id: 124
            }
        ],
        //合併載入google行事曆
        // googleCalendarApiKey: 'AIzaSyAdJkMAiXkiMMuzV0Hy6d0VIEQDxr4U3pc',
        // eventSources: [
        //     {
        //         googleCalendarId: 'sacriley@gmail.com',
        //         color: '#dcfedb',
        //         textColor: '#808080'
        //     },
        //     {
        //         googleCalendarId: 'efgh5678@group.calendar.google.com',
        //         className: 'nice-event'
        //     }
        // ]
    });
});
</script>
<style>
        
    #loading {
        display: none;
        position: absolute;
        top: 10px;
        right: 10px;
    }

</style>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title_Str?> - <?=$child4_title_Str?></h2>
<div class="contentBox contentTablelist allWidth">
	<div class="calendarContent">
        <div id='loading'>loading...</div>
        <div id='calendar'></div>
    </div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>