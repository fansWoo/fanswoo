Temp.ready(function() {
    $('#calendar').fullCalendar({
        buttonText: {
            today: '回到今天',
            month: '以月檢視',
            week: '以週檢視',
            day: '以日檢視'
        },
        allDayText: "全天",
        timeFormat: {
            '': 'H:mm{-H:mm}'
        },
        // weekMode: "variable",
        columnFormat: {
            month: 'dddd',
            week: 'dddd M-d',
            day: 'dddd M-d'
        },
        titleFormat: {
            month: 'YYYY 年 MMMM 月',
            week: "[YYYY年] YYYY月d日 { '&#8212;' [YYYY年] MMMM月d日}",
            day: 'YYYY年 YYYY月d日 dddd'
        },
        monthNames: ["1", "2", "3", "4", "5", "6", "7", "8", "9", "10", "11", "12"],
        dayNames: ["星期天", "星期一", "星期二", "星期三", "星期四", "星期五", "星期六"],
        header: {
            left: 'prev,next',
            center: 'title',
            right: 'today,prevYear,nextYear'
        },
        customButtons: {
            prev: {
                icon: 'left-single-arrow',
                click: function(event) {
                    $( '#calendar' ).fullCalendar('prev');

                    change_event();
                }
            },
            next: {
                icon: 'right-single-arrow',
                click: function(event) {
                    $( '#calendar' ).fullCalendar('next');

                    change_event();
                }
            },
            prevYear: {
                icon: 'left-double-arrow',
                click: function(event) {
                    $( '#calendar' ).fullCalendar('prevYear');

                    change_event();
                }
            },
            nextYear: {
                icon: 'right-double-arrow',
                click: function(event) {
                    $( '#calendar' ).fullCalendar('nextYear');

                    change_event();
                }
            },
            today: {
                text: '回到今天',
                click: function(event) {
                    $( '#calendar' ).fullCalendar('today');

                    change_event();
                }
            }
        },
        firstDay: 1,
        selectable: true,
        selectHelper: true,
        select: function(start, end) {
            $clone = $('.fixed_window').clone();
            $('.fixed_window_close_bg').css('display', 'block');;
            $clone.insertBefore(".fixed_window").addClass('display').css('display', 'block');;

            $clone.find('#start_time').val( start._d.getFullYear() + '-' + (start._d.getMonth() + 1) + '-' + start._d.getDate() + ' 00:00:00' );
            $clone.find('#end_time').val( end._d.getFullYear() + '-' + (end._d.getMonth() + 1) + '-' + ( end._d.getDate() - 1) + ' 00:00:00' );
            $clone.find("#projectid > option[value='" + $("#search_projectid").val() + "']").prop('selected', true);
            $clone.find("#uid > option[value='" + $("#search_uid").val() + "']").prop('selected', true);
            

            CKEDITOR.replace( 'content', {
                toolbar: 'basic',
                height: '230px'
            });

            $('#start_time').datetimepicker({
                dateFormat: 'yy-mm-dd',
                timeFormat: 'HH:mm:ss'
            });
            $('#end_time').datetimepicker({
                dateFormat: 'yy-mm-dd',
                timeFormat: 'HH:mm:ss'
            });
        },
        eventClick: function(event) {
            // opens events in a popup window
            $clone = $('.fixed_window').clone();
            $('.fixed_window_close_bg').css('display', 'block');;
            $clone.insertBefore(".fixed_window").addClass('display').css('display', 'block');

            var start_time_Date = new Date( event.start._d.getFullYear() + '-' + (event.start._d.getMonth() + 1) + '-' + event.start._d.getDate() + ' 00:00:00' );
            // start_time_Date.setDate( start_time_Date.getDate() + 0 );
            var start_time_str = start_time_Date.getFullYear() + '-' + ( start_time_Date.getMonth() + 1) + '-' + start_time_Date.getDate() + ' 00:00:00';

            var end_time_Date = new Date( event.end._d.getFullYear() + '-' + (event.end._d.getMonth() + 1) + '-' + event.end._d.getDate()  + ' 00:00:00' );
            end_time_Date.setDate( end_time_Date.getDate() - 1 );
            var end_time_str = end_time_Date.getFullYear() + '-' + ( end_time_Date.getMonth() + 1) + '-' + end_time_Date.getDate() + ' 00:00:00';

            $clone.find('#worktaskid').val( event.worktaskid );
            $clone.find('#title').val( event.title );
            $clone.find('#content').val( event.content );
            $clone.find('#start_time').val( start_time_str );
            $clone.find('#end_time').val( end_time_str );
            $clone.find('#estimate_hour').val( event.estimate_hour );
            $clone.find('#use_hour').val( event.use_hour );
            $clone.find("#projectid > option[value='" + event.projectid + "']").prop('selected', true);
            $clone.find("#uid > option[value='" + event.uid + "']").prop('selected', true);
            $clone.find("#current_percent > option[value='" + event.current_percent + "']").prop('selected', true);
            $clone.find("#classids > option[value='" + event.classids + "']").prop('selected', true);
            $clone.find("#work_status > option[value='" + event.work_status + "']").prop('selected', true);
            $clone.find('.detail').attr( 'href', $('base').attr('href') + 'admin/project/worktask/worktask/edit/?worktaskid=' + event.worktaskid );

            CKEDITOR.replace( 'content', {
                toolbar: 'basic',
                height: '230px'
            });

            $('#start_time').datetimepicker({
                dateFormat: 'yy-mm-dd',
                timeFormat: 'HH:mm:ss'
            });
            $('#end_time').datetimepicker({
                dateFormat: 'yy-mm-dd',
                timeFormat: 'HH:mm:ss'
            });

            return false;
        },
        eventDrop: function( event, delta, revertFunc, jsEvent, ui, view ) {

            var start_time_Date = new Date( event.start._d.getFullYear() + '-' + (event.start._d.getMonth() + 1) + '-' + event.start._d.getDate() + ' 00:00:00' ); 
            // start_time_Date.setDate( start_time_Date.getDate() + 0 );
            var start_time_str = start_time_Date.getFullYear() + '-' + ( start_time_Date.getMonth() + 1) + '-' + start_time_Date.getDate() + ' 00:00:00';

            var end_time_Date = new Date( event.end._d.getFullYear() + '-' + (event.end._d.getMonth() + 1) + '-' + event.end._d.getDate() + ' 00:00:00' ); 
            end_time_Date.setDate( end_time_Date.getDate() - 1 );
            var end_time_str = end_time_Date.getFullYear() + '-' + ( end_time_Date.getMonth() + 1) + '-' + end_time_Date.getDate() + ' 00:00:00';

            var data = {
                worktaskid: event.worktaskid,
                content: event.content,
                projectid: event.projectid,
                uid: event.uid,
                classids: event.classids,
                title: event.title,
                use_hour: event.use_hour,
                estimate_hour: event.estimate_hour,
                current_percent:event.current_percent,
                start_time: start_time_str,
                end_time: end_time_str,
                work_status: event.work_status,
                post_from: 'calendar'
            };
            // console.log(data);
            $.ajax({
                url: $('base').attr('href') + 'admin/project/worktask/worktask/edit_post',
                data: data,
                type: 'POST'
            })
            .done(function(response){
                // console.log(response);
            })
        　　.fail(function(response){
                fanswoo.message_show(
                    'AJAX傳輸錯誤...',
                    2
                );
            });
        },
        eventResize: function(event, delta, revertFunc) {

            var start_time_Date = new Date( event.start._d.getFullYear() + '-' + (event.start._d.getMonth() + 1) + '-' + event.start._d.getDate() + ' 00:00:00' ); 
            // start_time_Date.setDate( start_time_Date.getDate() + 0 );
            var start_time_str = start_time_Date.getFullYear() + '-' + ( start_time_Date.getMonth() + 1) + '-' + start_time_Date.getDate() + ' 00:00:00';

            var end_time_Date = new Date( event.end._d.getFullYear() + '-' + (event.end._d.getMonth() + 1) + '-' + event.end._d.getDate() + ' 00:00:00' ); 
            end_time_Date.setDate( end_time_Date.getDate() - 1 );
            var end_time_str = end_time_Date.getFullYear() + '-' + ( end_time_Date.getMonth() + 1) + '-' + end_time_Date.getDate() + ' 00:00:00';

            var data = {
                worktaskid: event.worktaskid,
                content: event.content,
                projectid: event.projectid,
                uid: event.uid,
                classids: event.classids,
                title: event.title,
                current_percent:event.current_percent,
                use_hour: event.use_hour,                
                estimate_hour: event.estimate_hour,
                start_time: start_time_str,
                end_time: end_time_str,
                work_status: event.work_status,
                post_from: 'calendar'
            };
            // console.log(data);
            $.ajax({
                url: $('base').attr('href') + 'admin/project/worktask/worktask/edit_post',
                data: data,
                type: 'POST'
            })
            .done(function(response){
                // console.log(response);
            })
        　　.fail(function(response){
                fanswoo.message_show(
                    'AJAX傳輸錯誤...',
                    2
                );
            });
        },
        editable: true
    });

    $(document).on('click', '[fanswoo-window_close]', function(){
        $('.fixed_window_close_bg').css('display', 'none');
        $('.fixed_window.display').css('display', 'none');
        setTimeout(function(){
            $('.fixed_window.display').remove();
        }, 100);
    });

    $(document).on('click', '[fanswoo-worktask_delete]', function(){
        var worktaskid = $(this).parents(".fixed_window").find("#worktaskid").val();

        var answer = confirm('確定要刪除嗎？');
        if (answer){

            $.ajax({
                url: $('base').attr('href') + 'admin/project/worktask/worktask/delete/?dont_change_page=1&worktaskid=' + worktaskid,
                type: 'GET'
            })
            .done(function(response){
                fanswoo.message_show(
                    '刪除成功',
                    2
                );
                $('#calendar').fullCalendar('removeEvents', worktaskid);
                $fixed_window = $('.fixed_window.worktask_form :submit').parents('.fixed_window');
                $fixed_window.find('[fanswoo-window_close]').click();
            })
        　　.fail(function(response){
                fanswoo.message_show(
                    'AJAX傳輸錯誤...',
                    2
                );
            });

        }
    });

    $('.fixed_window.worktask_form :submit').ajax_submit({
        ajax_before_function: function(){
            $fixed_window = $('.fixed_window.worktask_form :submit').parents('.fixed_window');

            var start_time_Date = new Date( $fixed_window.find('#start_time').val() );
            // start_time_Date.setDate( start_time_Date.getDate() + 0 );
            $fixed_window.find('#start_time').val( start_time_Date.getFullYear() + '-' + ( start_time_Date.getMonth() + 1) + '-' + start_time_Date.getDate() + ' 00:00:00' );

            var end_time_Date = new Date( $fixed_window.find('#end_time').val() );
            // end_time_Date.setDate( end_time_Date.getDate() + 0 );
            $fixed_window.find('#end_time').val( end_time_Date.getFullYear() + '-' + ( end_time_Date.getMonth() + 1 ) + '-' + end_time_Date.getDate() + ' 00:00:00' );
        },
        ajax_response_function: function(response){
            $fixed_window = $('.fixed_window.worktask_form :submit').parents('.fixed_window');
            $fixed_window.find('[fanswoo-window_close]').click();
            change_event();
        }
    });

    $(document).on('change', '#search_projectid, #search_uid', function(){
    	change_event();
    });

    function change_event()
    {
        var datetime_Date = new Date( $('#calendar').fullCalendar( 'getDate' ) );
        datetime_Date.setDate( datetime_Date.getDate() + 1 );
        var datetime_str = datetime_Date.toISOString();

        var data = {
            datetime: datetime_str,
            projectid: $('#search_projectid').val(),
            uid: $('#search_uid').val()
        };

        console.log(data);

        $.ajax({
            url: $('base').attr('href') + 'admin/project/worktask/worktask/worktask_list_json',
            data: data,
            type: 'GET'
        })
        .done(function(response){
            var events_data = $.parseJSON(response);

            console.log(events_data);

            $('#calendar').fullCalendar('removeEvents');

            for( var i = 0; i < events_data.length; i ++)
            {
                $('#calendar').fullCalendar('renderEvent', events_data[i], true); // stick? = true
            }
        })
    　　.fail(function(response){
            fanswoo.message_show(
                'AJAX傳輸錯誤...',
                2
            );
        });

    }

    change_event();

});