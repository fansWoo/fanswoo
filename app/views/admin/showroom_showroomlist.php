<?=$temp['header_up']?>
<?=$temp['admin_header_down']?>
<h2>展示藝廊 - 展示藝廊列表</h2>
<div class="contentBox allWidth">
	<h3>展示藝廊列表</h3>
	<h4>請填寫欲新增或更改之展示藝廊</h4>
	<div class="spanLine noneBg">
        <div class="spanLineLeft">
			<a href="admin/note/postnote" class="button">新增展示藝廊</a>
        </div>
        <div class="spanLineRight width300">
            <input type="text" class="floatright text" id="search" name="search" placeholder="請輸入想要搜尋的展示藝廊" style="display:none;">
        </div>
	</div>
	<div class="spanLine tableTitle">
        <div class="spanLineLeft text width100">
			展示藝廊ID
        </div>
        <div class="spanLineLeft text width500">
			展示藝廊標題
        </div>
	</div>
    <?foreach($note_list as $key => $value):?>
    <div class="spanLine">
        <div class="spanLineLeft text width100">
            <?=$value['noteid']?>
        </div>
        <div class="spanLineLeft text width500">
            <a href="admin/note/postnote/edit/<?=$value['noteid']?>"><?=$value['title']?></a>
        </div>
        <div class="spanLineLeft width300 hoverHidden">
            <a href="admin/note/postnote/edit/<?=$value['noteid']?>">編輯</a> | 
            <span class="ahref" onClick="check_action('確定要刪除這篇文章？', 'admin/note/delete_note/<?=$value['noteid']?>/<?=$this->security->get_csrf_hash()?>');">刪除</span>
        </div>
	</div>
    <?endforeach?>
</div>
<?=$temp['admin_footer']?>