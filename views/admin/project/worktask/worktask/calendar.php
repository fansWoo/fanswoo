<?=$temp['header_up']?>
<link href='js/tool/fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='js/tool/fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
<script>
Temp.ready(function() {
    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,basicWeek'
        },
        firstDay: 1,
        selectable: true,
        selectHelper: true,
        select: function(start, end) {
            console.log(start);
            console.log(end);
            $clone = $('.fixed_window').clone();
            $('.fixed_window_close_bg').fadeIn(100);
            $clone.insertBefore(".fixed_window").addClass('display').fadeIn(100);

            $clone.find('#start_time').val( start._d.getFullYear() + '-' + (start._d.getMonth() + 1) + '-' + start._d.getDate() + ' 00:00:00' );
            $clone.find('#end_time').val( end._d.getFullYear() + '-' + (end._d.getMonth() + 1) + '-' + ( end._d.getDate() - 1) + ' 00:00:00' );

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
            // var title = prompt('Event Title:');
            // var eventData;
            // if (title) {
            //     eventData = {
            //         title: title,
            //         start: start,
            //         end: end
            //     };
            //     $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
            // }
            // $('#calendar').fullCalendar('unselect');
        },
        eventClick: function(event) {
            // opens events in a popup window
            console.log(event);
            $clone = $('.fixed_window').clone();
            $('.fixed_window_close_bg').fadeIn(100);
            $clone.insertBefore(".fixed_window").addClass('display').fadeIn(100);


            $clone.find('#worktaskid').val( event.worktaskid );
            $clone.find('#title').val( event.title );
            $clone.find('#content').val( event.content );
            $clone.find('#start_time').val( event.start_time );
            $clone.find('#end_time').val( event.end_time );
            $clone.find('#estimate_hour').val( event.estimate_hour );
            $clone.find('#use_hour').val( event.use_hour );
            $clone.find("#projectid > option[value='" + event.projectid + "']").prop('selected', true);
            $clone.find("#classids > option[value='" + event.classids + "']").prop('selected', true);
            $clone.find("#work_status > option[value='" + event.work_status + "']").prop('selected', true);

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
        eventDragStop: function( event, jsEvent, ui, view ) {
            alert('event:drag //這時候利用 AJAX 修改開始日期');
        },
        eventResizeStop: function( event, jsEvent, ui, view ) {
            alert('event:resize //這時候利用 AJAX 修改結束日期');
        },
        editable: true,
        <?if( !empty($worktask_json) ):?>
        events: <?=$worktask_json?>
        <?endif?>
        // loading: function(bool) {
        //     $('#loading').toggle(bool);
        // },
        // defaultDate: '2016-01-12',
        // eventLimit: true, // allow "more" link when too many events
        // events: [
        //     {
        //         title: 'All Day Event',
        //         start: '2016-01-01',
        //         color: 'yellow',
        //         textColor: 'black',
        //         id: 123
        //     },
        //     {
        //         title: 'All Day Event2',
        //         start: '2016-01-02',
        //         color: 'yellow',
        //         textColor: 'black',
        //         id: 124
        //     }
        // ],
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

    $(document).on('click', '[fanswoo-window_close]', function(){
        $('.fixed_window_close_bg').fadeOut(100);
        $('.fixed_window.display').fadeOut(100);
        setTimeout(function(){
            $('.fixed_window.display').remove();
        }, 100);
    });

});
</script>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child4_title?></h2>
<div class="fixed_window_close_bg"></div>
<div class="fixed_window">
    <?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/edit_post/") ?>
    <div class="fixed_window_title">任務設置</div>
    <div class="fixed_window_end">
        <span class="gray" fanswoo-window_close>取消</span>
        <a class="gray" href="">詳細資訊</a>
        <input type="submit" value="儲存任務">
    </div>
    <div class="fixed_window_content">
        <div class="spanLine">
            <div class="spanStage">
                <div class="spanLineLeft">
                    任務名稱
                </div>
                <div class="spanLineRight">
                    <input type="text" class="text" id="title" name="title" placeholder="請輸入問題標題" required>
                </div>
            </div>
        </div>
        <div class="spanLine">
            <div class="spanStage">
                <div class="spanLineLeft">
                    任務內容
                </div>
                <div class="spanLineRight">
                    <textarea id="content" name="content"></textarea>
                </div>
            </div>
        </div>
        <div class="spanLine">
            <div class="spanStage">
                <div class="spanLineLeft">
                    開始時間
                </div>
                <div class="spanLineRight">
                    <input type="text" class="text" id="start_time" name="start_time" placeholder="請輸入問題標題" value="<?=$Worktask->title?>" required>
                </div>
            </div>
        </div>
        <div class="spanLine">
            <div class="spanStage">
                <div class="spanLineLeft">
                    結束時間
                </div>
                <div class="spanLineRight">
                    <input type="text" class="text" id="end_time" name="end_time" placeholder="請輸入問題標題" value="<?=$Worktask->title?>" required>
                </div>
            </div>
        </div>
        <div class="spanLine">
            <div class="spanStage">
                <div class="spanLineLeft">
                    專案名稱
                </div>
                <div class="spanLineRight">
                    <select id="projectid" name="projectid">
                        <option value="">尚未選擇專案</option>
                        <?foreach( (array) $ProjectList->obj_arr as $key => $value_Project):?>
                        <option value="<?=$value_Project->projectid?>"><?=$value_Project->name?></option>
                        <?endforeach?>
                    </select>
                </div>
            </div>
        </div>
        <div class="spanLine">
            <div class="spanStage">
                <div class="spanLineLeft">
                    任務分類
                </div>
                <div class="spanLineRight">
                    <select id="classids" name="classids">
                        <option value="">尚未選擇任務分類</option>
                        <?foreach( (array) $WorktaskClassMetaList->obj_arr as $key => $value_ClassMeta):?>
                        <option value="<?=$value_ClassMeta->classid?>"><?=$value_ClassMeta->classname?></option>
                        <?endforeach?>
                    </select>
                </div>
            </div>
        </div>
        <div class="spanLine">
            <div class="spanStage">
                <div class="spanLineLeft">
                    預估時數
                </div>
                <div class="spanLineRight">
                    <input type="text" class="text" id="estimate_hour" name="estimate_hour" placeholder="請輸入問題標題" required>
                </div>
            </div>
        </div>
        <div class="spanLine">
            <div class="spanStage">
                <div class="spanLineLeft">
                    耗用時數
                </div>
                <div class="spanLineRight">
                    <input type="text" class="text" id="use_hour" name="use_hour" placeholder="請輸入問題標題" required>
                </div>
            </div>
        </div>
        <div class="spanLine">
            <div class="spanStage">
                <div class="spanLineLeft">
                    耗用時數
                </div>
                <div class="spanLineRight">
                    <select id="work_status" name="work_status">
                        <option value="0">未完成</option>
                        <option value="1">已完成</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" id="worktaskid" name="worktaskid">
    <input type="hidden" name="post_from" value="calendar">
    </form>
</div>
<div class="contentBox contentTablelist allWidth">
	<div class="calendarContent">
        <div id='calendar'></div>
    </div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>