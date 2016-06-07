Temp.ready({
    repeat: 'repeat',
    func: function(){

    $( ".stock_area" ).sortable({
        handle: ".move"
    });
    $('.stock_line_clone').clone().removeClass('stock_line_clone').css('display', 'block').disableSelection().insertAfter('.stock_area .selectLine:last');
    $(document).on('change', '.stock_area .stock_class1', function(){
        $(this).attr('data-value', $(this).val());
        if( $(".stock_area > .selectLine > .stock_class1[data-value='']").size() === 0 )
        {
            $('.stock_line_clone').clone().removeClass('stock_line_clone').css('display', 'block').disableSelection().insertAfter('.stock_area .selectLine:last');
        }
    });
    $('.stock_area .copy').disableSelection();
    $(document).on('click', '.stock_area .copy', function(){
        $clone = $(this).parents('.selectLine').clone().insertAfter( $(this).parents('.selectLine') );
        $clone.children('.stockid').val('');
        $clone.children('.stock_class1').removeAttr('readonly');
        $clone.children('.stock_class2').removeAttr('readonly');
        $clone.children('.stock_class1_disabled').remove();
        $clone.children('.stock_class2_disabled').remove();
    });
    $('.stock_area .delete').disableSelection();
    $(document).on('click', '.stock_area .delete', function(){
        var answer = confirm('確定要刪除嗎？');
        if ( ! answer){
            return false;
        }
        var stockid = $(this).parents('.selectLine').children('.stockid').val();
        $.ajax({
            url: 'api/product/delete_stock/?stockid=' + stockid,
            error: function(xhr){},
            success: function(response){
            }
        });
        if( $(".stock_area > .selectLine").size() > 1 )
        {
            $(this).parent('.selectLine').remove();
        }
        else
        {
            $(this).parent('.selectLine').children(':input').val('');
            $(this).parent('.selectLine').children(':input').attr('data-value', '');
        }
    });

}});