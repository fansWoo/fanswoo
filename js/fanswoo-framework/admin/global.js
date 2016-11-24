//這邊的事件會每次重載
Temp.ready(function(){

    //取得檔案上傳限制
    function get_upload_max_size()
    {
        var Deferred = $.Deferred();

        $.ajax('api/global/get_upload_max_size')
    　　.done(function(response){
            if( fanswoo.is_json(response) )
            {
                var response_Json = $.parseJSON(response);
                upload_max_size = response_Json;
            }
            else
            {
                upload_max_size = response;
            }
            Deferred.resolve();
        })
    　　.fail(function(response){
            Deferred.reject();
        });

        return Deferred.promise();
    }
    function get_upload_max_size2()
    {
        var Deferred = $.Deferred();

        $.ajax('api/global/get_upload_max_size')
    　　.done(function(response){
            if( fanswoo.is_json(response) )
            {
                var response_Json = $.parseJSON(response);
                upload_max_size = response_Json;
            }
            else
            {
                upload_max_size = response;
            }
            Deferred.resolve();
        })
    　　.fail(function(response){
            Deferred.reject();
        });

        return Deferred.promise();
    }

    //圖片管理多選刪除
    $(".spanLineTable .pic_block .hover_box").each(function(key, value){
        $(".spanLineTable .pic_block .hover_box").eq(key).click(function() {
            if($('.spanLineTable .pic_block').eq(key).hasClass('border') == true)
            {
                $(".spanLineTable .pic_block .pic_check").eq(key).prop("checked",false);
                $(".spanLineTable .pic_block .pic_check").eq(key).attr("checked",false);
                $('.spanLineTable .pic_block').eq(key).removeClass('border');
            }
            else
            {
                $(".spanLineTable .pic_block .pic_check").eq(key).prop("checked",true);
                $(".spanLineTable .pic_block .pic_check").eq(key).attr("checked",true);
                $('.spanLineTable .pic_block').eq(key).addClass('border');
            }
        });
    });

    //列表批量刪除 - 全選checkbox
    $(document).on('click', '#check_all', function() {
       if($(this).prop("checked"))
       {
         $(".spanLineLeft.checkbox .check").each(function() {
             $(this).prop("checked", true);
         });
       }
       else
       {
         $(".spanLineLeft.checkbox .check").each(function() {
             $(this).prop("checked", false);
         });
       }

    });

    $(document).on('click', ".spanLineLeft.checkbox .check", function() {
        if($(this).prop("checked"))
        {
            $("#check_all").prop("checked", false);
        }
        else
        {
            $("#check_all").prop("checked", false);
        }
    });

    $(document).on('click', '.sidebox h2', function () {
        if ($(this).parent('.sidebox').hasClass('hover')) {
            $(this).parent('.sidebox').removeClass('hover');
        } else {
            $(this).parent('.sidebox').addClass('hover');
        }
    });

    $(document).on('click', '.acHref', function () {
        if ($(this).hasClass('hover') === false) {
            $('.acHref').removeClass('hover');
            $(this).addClass('hover');
        }
    });

    $(document).on('mouseleave', '.sidebar', function () {
        $('.acHref').removeClass('hover');
        $('.sidebox.selected').addClass('hover');
        $('.acHref.selected').addClass('hover');
        $('.acHref acHrefSmall.selected').addClass('hover');
    });

    //多圖片上傳自動新增上傳按鈕
    $(document).on('change', '[fanswoo-fileMultiple]', function(){
        if($(this).find(":file").val() !== '')
        {
            if($(this).parent('.spanLineLeft').find("[fanswoo-fileMultiple] :file[value='']").size() === 0)
            {
                $(this).clone().val('').insertAfter(this).parent('.spanLineLeft').find('[fanswoo-fileMultiple]:last');
            }
        }
        else
        {
            $(this).remove();
        }
    });

    //圖片AJAX上傳系統
    $( "[fanswoo-piclist]" ).sortable();
    $( "[fanswoo-piclist]" ).disableSelection();
    $("[fanswoo-pic_upload_ajax]").each(function(key, value){
        var text = $("[fanswoo-pic_upload_ajax]:eq(" + key + ")").text();
        $("[fanswoo-pic_upload_ajax]:eq(" + key + ")").html("<div fanswoo-pic_upload_ajax_btn><span>" + text + "</span><input name='picids_FilesArr[]' fanswoo-pic_upload_ajax_input type='file' accept='image/*' multiple/></div><span fanswoo-pic_upload_ajax_message></span>");

        $.when( get_upload_max_size() ).done(function(){
            $("[fanswoo-pic_upload_ajax_message]").text("點選CTRL可一次複選多張圖片，最大同時上傳限制" + parseInt(upload_max_size.post_max_size / 1024 / 1024 ) + "M");
            $(document).on('change', "[fanswoo-pic_upload_ajax]:eq(" + key + ") [fanswoo-pic_upload_ajax_input]", function(){

                var size_total = 0;
                for(var i = 0; i < this.files.length; i++)
                {
                    size_total = size_total + this.files[i].size;
                }
                if(
                    size_total > parseInt(upload_max_size.post_max_size) ||
                    size_total > parseInt(upload_max_size.upload_max_filesize)
                )
                {
                    $("[fanswoo-pic_upload_ajax_message]").text("點選CTRL可一次複選多張圖片，最大同時上傳限制" + parseInt(upload_max_size.post_max_size / 1024 / 1024 ) + "M");
                    $(this).val('');
                    alert('最大同時上傳限制超過' + parseInt(upload_max_size.post_max_size / 1024 / 1024 ) + "M");
                    return false;
                }

                $("html").append("<form fanswoo-pic_upload_form method='post' enctype='multipart/form-data' style='display: none;'></form>");
                $("[fanswoo-pic_upload_ajax]:eq(" + key + ") [fanswoo-pic_upload_ajax_input]").appendTo("[fanswoo-pic_upload_form]");

                var upload_status = $("[fanswoo-pic_upload_ajax]:eq(" + key + ")").attr('fanswoo-upload_status');
                $("[fanswoo-pic_upload_form]").ajaxSubmit({
                    type:'post',
                    url: $("base").attr("href") + "api/pic/upload_pic/?upload_status=" + upload_status,    
                    beforeSubmit: function(){
                        $("[fanswoo-pic_upload_ajax]:eq(" + key + ") [fanswoo-pic_upload_ajax_message]").text("圖片上傳中...");
                    },
                    success: function(response){

                        if( fanswoo.is_json(response) )
                        {
                            var response_Json = $.parseJSON(response);
                            var message = response_Json.error_message;

                            if(response_Json.status === 'true')
                            {

                                for(var i = 0; i < response_Json.pic_arr.length; i++)
                                {
                                    $clone = $("[fanswoo-piclist]:eq(" + key + ") [fanswoo-picid][fanswoo-clone]").clone();
                                    $clone.removeAttr("fanswoo-clone").prependTo("[fanswoo-piclist]:eq(" + key + ")");
                                    $clone.attr('fanswoo-picid', response_Json.pic_arr[i].picid );
                                    $clone.find("[fanswoo-picid_img]").attr('src', response_Json.pic_arr[i].path_arr.w50h50 );
                                    $clone.find("[fanswoo-input_copy]").val( response_Json.pic_arr[i].path_arr.w0h0 );
                                    $clone.find("[fanswoo-picid_input_hidden_picid]").val( response_Json.pic_arr[i].picid );
                                }
                            }
                        }
                        else
                        {
                            var message = '系統回傳值非JSON格式或沒有message訊息';
                            console.log(response);
                        }

                        $("[fanswoo-pic_upload_form]").remove();
                        $("[fanswoo-pic_upload_ajax]:eq(" + key + ") [fanswoo-pic_upload_ajax_btn]").append("<input name='picids_FilesArr[]' fanswoo-pic_upload_ajax_input type='file' accept='image/*' multiple/>");

                        $("[fanswoo-pic_upload_ajax]:eq(" + key + ") [fanswoo-pic_upload_ajax_message]").text(message);
                    },
                    resetForm: false,
                    clearForm: false
                });
            });
        });

    });

    //刪除圖片
    $(document).on('click', '[fanswoo-picid] [fanswoo-pic_delete]', function(){
        var picid = $(this).parents('[fanswoo-picid]').attr('fanswoo-picid');
        $.ajax({
            url: $("base").attr("href") + 'api/pic/delete_pic/picid/' + picid,
            error: function(xhr){},
            success: function(response){
                $('[fanswoo-picid=' + picid + ']').remove();
                alert('刪除成功');
            }
        });
    });

    $(document).on('click', '[fanswoo-input_copy]', function(){
        $(this).select();
    });

    //檔案AJAX上傳系統
    //檔案類型參考→http://webdesign.about.com/od/multimedia/a/mime-types-by-content-type.htm
    $( "[fanswoo-filelist]" ).sortable();
    $( "[fanswoo-filelist]" ).disableSelection();
    $("[fanswoo-file_upload_ajax]").each(function(key, value){
        var text = $("[fanswoo-file_upload_ajax]:eq(" + key + ")").text();
        $("[fanswoo-file_upload_ajax]:eq(" + key + ")").html("<div fanswoo-file_upload_ajax_btn><span>" + text + "</span><input name='fileids_FilesArr[]' fanswoo-file_upload_ajax_input type='file' accept='file/*' multiple/></div><span fanswoo-file_upload_ajax_message></span>");

        $.when( get_upload_max_size() )
            .done(function(){
                $("[fanswoo-file_upload_ajax_message]").text("點選CTRL可一次複選多個檔案，最大同時上傳限制" + parseInt(upload_max_size.post_max_size / 1024 / 1024 ) + "M");
                $(document).on('change', "[fanswoo-file_upload_ajax]:eq(" + key + ") [fanswoo-file_upload_ajax_input]", function(){

                    var size_total = 0;
                    for(var i = 0; i < this.files.length; i++)
                    {
                        size_total = size_total + this.files[i].size;
                    }
                    if(
                        size_total > parseInt(upload_max_size.post_max_size) ||
                        size_total > parseInt(upload_max_size.upload_max_filesize)
                    )
                    {
                        $("[fanswoo-file_upload_ajax_message]").text("點選CTRL可一次複選多個檔案，最大同時上傳限制" + parseInt(upload_max_size.post_max_size / 1024 / 1024 ) + "M");
                        $(this).val('');
                        alert('最大同時上傳限制超過' + parseInt(upload_max_size.post_max_size / 1024 / 1024 ) + "M");
                        return false;
                    }

                    $("html").append("<form fanswoo-file_upload_form method='post' enctype='multipart/form-data' style='display: none;'></form>");
                    $("[fanswoo-file_upload_ajax]:eq(" + key + ") [fanswoo-file_upload_ajax_input]").appendTo("[fanswoo-file_upload_form]");
                    $("[fanswoo-file_upload_form]").ajaxSubmit({
                        type:'post',
                        url: $("base").attr("href") + "api/file/upload_file",    
                        beforeSubmit: function(){
                            $("[fanswoo-file_upload_ajax]:eq(" + key + ") [fanswoo-file_upload_ajax_message]").text("檔案上傳中...");
                        },
                        success: function(response){

                            if( fanswoo.is_json(response) )
                            {
                                var response_Json = $.parseJSON(response);
                                var message = response_Json.error_message;

                                if( response_Json.status === 'true')
                                {
                                    for(var i = 0; i < response_Json.file_arr.length; i++)
                                    {
                                        console.log(response_Json.file_arr[i]);
                                        $clone = $("[fanswoo-filelist]:eq(" + key + ") [fanswoo-fileid][fanswoo-clone]").clone();
                                        $clone.removeAttr("fanswoo-clone").prependTo("[fanswoo-filelist]:eq(" + key + ")");
                                        $clone.attr('fanswoo-fileid', response_Json.file_arr[i].fileid );
                                        $clone.find("[fanswoo-input_copy]").val( response_Json.file_arr[i].download_file_path );
                                        $clone.find("[fanswoo-fileid_input_hidden_fileid]").val( response_Json.file_arr[i].fileid );
                                    }
                                }
                            }
                            else
                            {
                                var message = '系統回傳值非JSON格式或沒有message訊息';
                                console.log(response);
                            }

                            $("[fanswoo-file_upload_form]").remove();
                            $("[fanswoo-file_upload_ajax]:eq(" + key + ") [fanswoo-file_upload_ajax_btn]").append("<input name='fileids_FilesArr[]' fanswoo-file_upload_ajax_input type='file' accept='file/*' multiple/>");

                            $("[fanswoo-file_upload_ajax]:eq(" + key + ") [fanswoo-file_upload_ajax_message]").text(message);
                        },
                        resetForm: false,
                        clearForm: false
                    });
                });
            })
            .fail(function(){
            }
        );
    });

    //刪除檔案
    $(document).on('click', '[fanswoo-fileid] [fanswoo-file_delete]', function(){
        var fileid = $(this).parents('[fanswoo-fileid]').attr('fanswoo-fileid');
        $.ajax({
            url: $("base").attr("href") + 'api/file/delete_file/fileid/' + fileid,
            error: function(xhr){},
            success: function(response){
                $('[fanswoo-fileid=' + fileid + ']').remove();
                alert('刪除成功');
            }
        });
    });

    $(document).on('click', '[fanswoo-input_copy]', function(){
        $(this).select();
    });

    //admin開啟AJAX視窗
    $(document).on('click', '[fanswoo-ajax_window_href]', function(){
        if( is_mobile)
        {
            $.ajax({
                url: $(this).attr('[fanswoo-ajax_window_href]'),
                error: function(xhr){},
                success: function(response){
                    var window_height = $(window).height();
                    window_height * 80 / 100;
                    // $('.div').css('display', 'block');
                    // $(response).insert('.div');
                }
            });
        }
        else
        {
            location.href = url;
        }
    });

    //admin關閉AJAX視窗
    $(document).on('click', '[fanswoo-ajax_window_close]', function(){
        // $('.div').css('display', 'none');
    });

    var phone_scrollbar_height = $(window).height() - 80 ;
    var width_scrollbar = $('.admin_header_bar_mobile_content ').css(' width ', '200px' );
    $('.admin_header_bar_mobile_content .scrollbar').mCustomScrollbar({

        theme:"dark", // 設定捲軸樣式
        setWidth: width_scrollbar , // 設定寬度
        setHeight: phone_scrollbar_height ,  // 設定高度    
    });

    $(document).on('click', "a[href^='#']", function(){
        var speed = 500;
        var href = $(this).attr("href");
        var target = $(href == "#" || href == "" ? 'html' : href);
        var position = target.offset().top;
        $("html, body").animate({scrollTop: position}, speed, "swing");
            return false;
    });
    $(".child_area").hide();

    $(document).on('click', ".admin_header_bar_mobile_content .admin_header_father_area", function(){
        $(this).toggleClass("active");
        $(this).children(".child_area").slideToggle();
    });

    $(document).on('click', '.wrap_shadow, .admin_header_bar_mobile > .menu', function(event){
        if($('.admin_header_bar_mobile').hasClass('clicked'))
        {
            $('.admin_header_bar_mobile').removeClass('clicked');
            $('.footer_bar_mobile').removeClass('clicked');
            $('.admin_header_bar_mobile_content').css('margin-left', '-200px');
            $('.admin_header_bar_mobile_content').animate({ marginLeft: 0 }, {
                step: function(now,fx) {
                  $(this).css('transform','matrix(1, 0, 0, 1, ' + now + ', 0)');
                },
                duration : 300
            },'linear');

            $('.wrap_shadow').animate({ opacity: 0 }, {
                duration : 300
            },'linear');

            setTimeout(function(){
                $('.wrap_shadow').css('display', 'none');
            }, 300);
        }
        else
        {
            $('.admin_header_bar_mobile').addClass('clicked');
            $('.footer_bar_mobile').addClass('clicked');
            $('.admin_header_bar_mobile_content').css('margin-left', '0px');
            $('.admin_header_bar_mobile_content').animate({ marginLeft: -200 }, {
                step: function(now,fx) {
                    $(this).css('transform','matrix(1, 0, 0, 1, ' + now + ', 0)');
                },
                duration : 300
            },'linear');

            $('.wrap_shadow').css('display', 'block');
            $('.wrap_shadow').animate({ opacity: 1 }, {
                duration : 300
            },'linear');
            
            $(".child_area").hide();
        }
    });

    $(document).on('click', '.acHref .acHrefSmall', function(){
        $('.acHref .acHrefSmall').removeClass('selected hover');
        $(this).addClass('selected hover');
    });

    var base = $('base').attr('href');
    $(document).on('change', '.footer .language select', function(){
        location.href = base + $(this).val();
    });

});