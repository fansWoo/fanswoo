<?=$temp['header_up']?>
<script>
    $(function(){
        
    });
    function check_action(message, url){
        var message;
        var url;
        var answer = confirm(message);
        if (answer){
            location.href = url;
        }
    }
</script>
<?=$temp['admin_header_down']?>
<h2>展示藝廊 - 分類標籤</h2>
<div class="contentBox allWidth">
	<h3>分類標籤列表</h3>
	<h4>請填寫欲新增或更改之分類標籤</h4>
	<div class="spanLine noneBg">
        <div class="spanLineLeft">
			<a href="admin/note/postclass/add" class="button">新增標籤</a>
        </div>
        <div class="spanLineRight width300">
            <input type="text" class="floatright text" id="search" name="search" placeholder="請輸入想要搜尋的標籤名稱" style="display:none;">
        </div>
	</div>
	<div class="spanLine tableTitle">
        <div class="spanLineLeft text width300">
			標籤名稱
        </div>
        <div class="spanLineLeft text">
			標籤代號
        </div>
        <div class="spanLineLeft text width100 aligncenter">
			標籤總數
        </div>
	</div>
    <?foreach($class_list as $key => $value):?>
    <div class="spanLine">
        <div class="spanLineLeft text width300">
            <?=$value['classname']?>
        </div>
        <div class="spanLineLeft text">
            <?=$value['slug']?>
        </div>
        <div class="spanLineLeft text width100 aligncenter">
            0
        </div>
        <div class="spanLineLeft width300 hoverHidden">
            <a href="admin/note/notelist/classid/<?=$value['classid']?>">查看</a> | 
            <a href="admin/note/postclass/edit/<?=$value['classid']?>">編輯</a> | 
            <span class="ahref" onClick="check_action('確定要刪除這個標籤？', 'admin/note/delete_class/<?=$value['classid']?>/<?=$this->security->get_csrf_hash()?>');">刪除</span>
        </div>
	</div>
    <?endforeach?>
</div>
<?=$temp['admin_footer']?>