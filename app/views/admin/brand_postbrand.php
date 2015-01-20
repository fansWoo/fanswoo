<?=$temp['header_up']?>
<script>
$(function(){
   $(document).on('click', '.addClassidSelect', function(){
       $('.pClassid:last').clone().css('display','block').insertAfter('.pClassid:last');
   });
});
</script>
<?=$temp['admin_header_down']?>
<h2>品牌管理 - 新增品牌</h2>
<div class="contentBox allWidth">
	<h3>新增品牌</h3>
	<h4>請填寫欲新增之品牌資訊</h4>
	<?php echo form_open('admin/note/postnote/post') ?>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                品牌名稱
            </div>
            <div class="spanLineLeft width500">
                <input type="text" class="text" name="title" placeholder="請輸入品牌名稱" value="<?if(isset($note['title'])):?><?=$note['title']?><?endif?>">
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                品牌分類標籤
            </div>
            <div class="spanLineLeft width300">
                <?if(isset($note['classid_array'])):?>
                <?foreach($note['classid_array'] as $key => $value):?>
                <p class="pClassid">
                    <select name="classid_array[]">
                        <option value="0">沒有分類標籤</option>
                        <?foreach($class_list_array as $key2 => $value2):?>
                        <option value="<?=$value2['classid']?>"<?if($value == $value2['classid']):?> selected<?endif?>><?=$value2['classname']?></option>
                        <?endforeach?>
                    </select>
                </p>
                <?endforeach?>
                <?else:?>
                <p class="pClassid">
                    <select name="classid_array[]">
                        <option value="0">沒有分類標籤</option>
                        <?foreach($class_list_array as $key2 => $value2):?>
                        <option value="<?=$value2['classid']?>"><?=$value2['classname']?></option>
                        <?endforeach?>
                    </select>
                </p>
                <?endif?>
                <p class="pClassid" style="display:none;">
                    <select name="classid_array[]">
                        <option value="0">沒有分類標籤</option>
                        <?foreach($class_list_array as $key2 => $value2):?>
                        <option value="<?=$value2['classid']?>"><?=$value2['classname']?></option>
                        <?endforeach?>
                    </select>
                </p>
                <p><span class="ahref addClassidSelect">新增分類標籤</span> | <a href="admin/note/classlist">管理分類標籤</a></p>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                品牌簡介
            </div>
            <div class="spanLineRight">
                <textarea cols="80" id="content" name="content" rows="10">
                <?if(isset($note['content'])):?><?=$note['content']?><?endif?>
                </textarea>
		    </div>
		</div>
	</div>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                優先排序指數
            </div>
            <div class="spanLineLeft">
                <input type="number" class="text width100" name="prioritynum" value="<?if(isset($note['prioritynum'])):?><?=$note['prioritynum']?><?endif?>">
            </div>
		</div>
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray">目前品牌排序方式為???，若需變更文章排序方式，請於「品牌設置」後台變更</p>
            </div>
		</div>
	</div>
	<div class="spanLine spanSubmit">
	    <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(isset($note['noteid'])):?><input type="hidden" name="noteid" value="<?=$note['noteid']?>"><?endif?>
                <input type="submit" class="submit" value="<?if(isset($note['noteid'])):?>儲存變更<?else:?>新增品牌<?endif?>">
                <?if( empty($note['noteid']) === FALSE ):?><span class="submit gray" onClick="check_action('確定要刪除這個品牌？', 'admin/note/delete_note/<?=$note['noteid']?>/<?=$this->security->get_csrf_hash()?>');">刪除品牌</span><?endif?>
            </div>
        </div>
	</div>
	</form>
</div>
<?=$temp['admin_footer']?>