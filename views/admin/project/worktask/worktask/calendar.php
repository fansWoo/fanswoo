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
            $clone = $('.fixed_window').clone();
            $('.fixed_window_close_bg').css('display', 'block');;
            $clone.insertBefore(".fixed_window").addClass('display').css('display', 'block');;

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
        },
        eventClick: function(event) {
            // opens events in a popup window
            $clone = $('.fixed_window').clone();
            $('.fixed_window_close_bg').css('display', 'block');;
            $clone.insertBefore(".fixed_window").addClass('display').css('display', 'block');;

            $clone.find('#worktaskid').val( event.worktaskid );
            $clone.find('#title').val( event.title );
            $clone.find('#content').val( event.content );
            $clone.find('#start_time').val( event.start._d.getFullYear() + '-' + (event.start._d.getMonth() + 1) + '-' + ( event.start._d.getDate() ) + ' 00:00:00' );
            $clone.find('#end_time').val( event.end._d.getFullYear() + '-' + (event.end._d.getMonth() + 1) + '-' + ( event.end._d.getDate() - 1) + ' 00:00:00' );
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
            console.log('event:drag //這時候利用 AJAX 修改開始日期');
        },
        eventResizeStop: function( event, jsEvent, ui, view ) {
            console.log('event:resize //這時候利用 AJAX 修改結束日期');
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
                url: $('base').attr('href') + 'admin/project/worktask/worktask/delete/?dont_change_page=1&worktaskid=' + worktaskid + '&hash=<?=$this->security->get_csrf_hash()?>',
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
            $fixed_window.find('#start_time').val( start_time_Date.getFullYear() + '-' + (start_time_Date.getMonth() + 1) + '-' + start_time_Date.getDate() + ' 00:00:00' );

            var end_time_Date = new Date( $fixed_window.find('#end_time').val() );
            $fixed_window.find('#end_time').val( end_time_Date.getFullYear() + '-' + (end_time_Date.getMonth() + 1) + '-' + ( end_time_Date.getDate() + 1) + ' 00:00:00' );
            // console.log( $fixed_window.find('#start_time').val() );
            // console.log( $fixed_window.find('#end_time').val() );
        },
        ajax_response_function: function(response){
            $fixed_window = $('.fixed_window.worktask_form :submit').parents('.fixed_window');
            $fixed_window.find('[fanswoo-window_close]').click();

            var worktaskid = response.worktaskid;
            var title = $fixed_window.find('#title').val();
            var work_status = $fixed_window.find('#work_status').val();

            var start_time_Date = new Date( $fixed_window.find('#start_time').val() );
            start_time_Date = new Date(start_time_Date.getFullYear() + '-' + (start_time_Date.getMonth() + 1) + '-' + (start_time_Date.getDate() + 1) + ' 00:00:00' );

            var end_time_Date = new Date( $fixed_window.find('#end_time').val() );
            end_time_Date = new Date( end_time_Date.getFullYear() + '-' + (end_time_Date.getMonth() + 1) + '-' + ( end_time_Date.getDate() + 1) + ' 00:00:00' );

            var start = start_time_Date.toISOString();
            var end = end_time_Date.toISOString();

            if( work_status == 0)
            {
                var color = '#F691B2';
                var textColor = 'black';
            }
            else if( work_status == 1)
            {
                var color = '#dcf1db';
                var textColor = 'black';
            }
            else if( work_status == 2)
            {
                var color = '#F5F5F5';
                var textColor = '#AAA';
            }

            var event_data = {
                id: worktaskid,
                worktaskid: worktaskid,
                title: title,
                start: start,
                end: end,
                allDay: true,
                color: color,
                textColor: textColor
            };
            $('#calendar').fullCalendar('renderEvent', event_data, true); // stick? = true
            $('#calendar').fullCalendar('unselect');
        }
    });

});
</script>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child4_title?></h2>
<div class="fixed_window_close_bg"></div>
<div class="fixed_window worktask_form">
    <?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/edit_post/") ?>
    <div class="fixed_window_title">任務設置</div>
    <div class="fixed_window_end">
        <span class="gray" fanswoo-window_close>取消</span>
        <a class="gray" href="">詳細資訊</a>
        <span class="red" fanswoo-worktask_delete>刪除任務</span>
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
                    執行狀態
                </div>
                <div class="spanLineRight">
                    <select id="work_status" name="work_status">
                        <option value="0">任務未完成</option>
                        <option value="1">任務完成，主管檢核中</option>
                        <option value="2">任務完成，主管審核通過</option>
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
    <div style="margin-bottom: 10px;">
        <select>
            <option>尚未選擇任務被分派人</option>
            <option value="528501">楊翊（ yi@fanswoo.com ）</option>
            <option value="528501">楊翊（ yi@fanswoo.com ）</option>
        </select>
        <select>
            <option>尚未選擇專案</option>
            <option value="528501">Alchema</option>
            <option value="528501">Alchema</option>
        </select>
    </div>
	<div class="calendarContent">
        <div id='calendar'></div>
    </div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>