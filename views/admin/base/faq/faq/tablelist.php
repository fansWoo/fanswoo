<?=$temp['header_up']?>
<script>
Temp.ready(function(){
    $(document).on('click', ':button#delete', function(event){
        if( confirm('刪除後將進入回收空間，確定要刪除嗎？') )
        {
            $(':submit#delete').click();
        }
    });
});
</script>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<div class="contentBox contentTablelist allWidth">
    <h3><?=$child3_title?> > <?=$child4_title?></h3>
    <h4>請選擇欲修改之<?=$child3_title?></h4>
    <div class="spanLine noneBg">
        <div class="spanLineLeft">
            <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit" class="button">新增<?=$child3_title?></a>
        </div>
    </div>
    <div class="spanLineTable">
        <div class="spanLineTableContent">
            <div class="spanLine tablelist tableTitle">
                <?if(!empty($FaqList->obj_arr)):?>
                <div class="spanLineLeft checkbox"></div>
                <?endif?>
                <div class="spanLineLeft text width100">
                    常見問題 ID
                </div>
                <div class="spanLineLeft text width500">
                    問題標題
                </div>
                <div class="spanLineLeft text width150">
                    分類標籤
                </div>
                <div class="spanLineLeft text width150">
                    編輯操作
                </div>
            </div>
            <div class="spanLine tablelist">
                <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
                    <?if(!empty($FaqList->obj_arr)):?>
                    <div class="spanLineLeft checkbox">
                        <input type="checkbox" id="check_all">
                    </div>
                    <?endif?>
                    <div class="spanLineLeft text width100">
                        <input type="number" class="text" style="margin-left:-6px;" value="<?=!empty($search_faqid)?$search_faqid:''?>" name="search_faqid" placeholder="請填寫ID">
                    </div>
                    <div class="spanLineLeft text width500">
                        <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_title)?$search_title:''?>" name="search_title" placeholder="請填寫問題標題">
                    </div>
                    <div class="spanLineLeft text width150">
                        <select name="search_class_slug" style="margin-left:-6px;">
                            <option value="">不透過分類標籤篩選</option>
                            <?foreach($FaqClassMetaList->obj_arr as $key => $value_ClassMeta):?>
                            <option value="<?=$value_ClassMeta->slug?>"<?if(!empty($search_class_slug) && $search_class_slug == $value_ClassMeta->slug) echo ' selected'?>><?=$value_ClassMeta->classname?></option>
                            <?endforeach?>
                        </select>
                    </div>
                    <div class="spanLineLeft text width150">
                        <input type="submit" class="button" style="height: 30px;" value="篩選">
                    </div>
                </form>
            </div>
            <?if(!empty($FaqList->obj_arr)):?>
            <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/delete_batch_post/") ?>
            <?foreach($FaqList->obj_arr as $key => $value_Faq):?>
            <div class="spanLine tablelist">
                <div class="spanLineLeft checkbox">
                    <input type="checkbox" name="faqid_arr[]" value="<?=$value_Faq->faqid?>" class="check">
                </div>
                <div class="spanLineLeft text width100">
                    <?=$value_Faq->faqid?>
                </div>
                <div class="spanLineLeft text width500">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?faqid=<?=$value_Faq->faqid?>"><?=$value_Faq->title?></a>
                </div>
                <div class="spanLineLeft text width150">
                    <?if(!empty($value_Faq->class_ClassMetaList->obj_arr)):?>
                    <?foreach($value_Faq->class_ClassMetaList->obj_arr as $key => $value_ClassMeta):?>
                        <?if($key !== 0):?>,<?endif?><?=$value_ClassMeta->classname?>
                    <?endforeach?>
                    <?else:?>
                    <span class="gray">沒有分類標籤</span>
                    <?endif?>
                </div>
                <div class="spanLineLeft width150 tablelistMenu">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?faqid=<?=$value_Faq->faqid?>">編輯</a>
                    <span class="ahref" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?faqid=<?=$value_Faq->faqid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除</span>
                </div>
            </div>
            <?endforeach?>
            <input type="submit" id="delete" class="button" style="display:none;">
            </form>
            <?else:?>
            <div class="spanLine">
                <div class="spanLineLeft text width500">
                    這個篩選條件沒有搜尋到結果，請選擇其它篩選條件
                </div>
            </div>
            <?endif?>
        </div>
    </div>
    <?if(!empty($FaqList->obj_arr[0]->faqid)):?>
    <div class="batch_deletion">
        <input type="button" class="button" id="delete" style="height: 32px;" value="批量刪除">
    </div>
    <?endif?>
    <div class="pageLink"><?=$page_link?></div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>