<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<div class="contentBox contentTablelist allWidth">
    <h3><?=$child3_title?> > <?=$child4_title?></h3>
    <h4>請選擇欲查看之<?=$child3_title?></h4>
    <div class="spanLineTable">
        <div class="spanLineTableContent">
            <div class="spanLine tablelist tableTitle">
                <div class="spanLineLeft text width200">
                    標題
                </div>
                <div class="spanLineLeft text width200">
                    留言內容
                </div>
                <div class="spanLineLeft text width150">
                    留言分類標籤
                </div>
                <div class="spanLineLeft text width150">
                    擁有人
                </div>
                <div class="spanLineLeft text width100">
                    編輯操作
                </div>
            </div>
            <div class="spanLine tablelist">
                <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
                    <div class="spanLineLeft text width200">
                        留言項目
                    </div>
                    <div class="spanLineLeft text width200">
                        <input type="text" class="text" style="margin-left:-6px;" value="<?=!empty($search_content)?$search_content:''?>" name="search_content" placeholder="請填寫留言內容">
                    </div>
                    <div class="spanLineLeft text width150">
                        <select name="search_class_slug" style="margin-left:-6px;">
                            <option value="">不透過分類篩選</option>
                            <option value="pic"<?if($search_class_slug == 'pic'):?> selected<?endif?>>圖片</option>
                            <option value="note"<?if($search_class_slug == 'note'):?> selected<?endif?>>文章</option>
                        </select>
                    </div>
                    <div class="spanLineLeft text width150">
                    <?if($usergroupid_UserGroup >= 100):?>
                        會員名稱
                    <?else:?>
                        <input type="text" class="text" value="<?=!empty($search_uid)?$search_uid:''?>" name="search_uid" placeholder="請填寫會員ID">
                    <?endif?>
                    </div>
                    <div class="spanLineLeft text width100">
                        <input type="submit" class="button filter" value="篩選">
                    </div>
                </form>
            </div>
            <?if(!empty($CommentList->obj_arr)):?>
            <?foreach($CommentList->obj_arr as $key => $value_Comment):?>
                <?php
                    $data['Pic'] = new PicObj([
                        'db_where_arr' => [
                            'picid' => $value_Comment->id
                        ]
                    ]);
                                
                    $data['Note'] = new Note([
                        'db_where_arr' => [
                            'noteid' => $value_Comment->id
                        ]
                    ]);
                ?>
                <div class="spanLine tablelist">
                    <div class="spanLineLeft text width200" style="text-overflow:ellipsis;white-space:nowrap;">
                        <?if(($value_Comment->typename) == 'pic'):?>
                        <?=$data['Pic']->title?>
                        <?elseif(($value_Comment->typename) == 'note'):?>
                        <?=$data['Note']->title?>
                        <?endif?>
                    </div>
                    <div class="spanLineLeft text width200" style="text-overflow:ellipsis;white-space:nowrap;color:#027de5;">
                        <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?commentid=<?=$value_Comment->commentid?>">
                            <?=$value_Comment->content_Html?>
                        </a>
                    </div>
                    <div class="spanLineLeft text width150">
                        <?if(!empty($value_Comment->typename)):?>
                            <?if(($value_Comment->typename) == 'pic'):?>圖片
                            <?elseif(($value_Comment->typename) == 'note'):?>文章
                            <?endif?>
                        <?else:?><span class="gray">沒有分類標籤</span>
                        <?endif?>
                    </div>
                    <div class="spanLineLeft text width150">
                        <?=$value_Comment->uid_User->username?>
                    </div>
                    <div class="spanLineLeft width100 tablelistMenu">
                        <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?commentid=<?=$value_Comment->commentid?>">查看</a>
                        <span class="ahref" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?commentid=<?=$value_Comment->commentid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除</span>
                    </div>
                </div>
                <?endforeach?>
                <?else:?>
                <div class="spanLine">
                    <div class="spanLineLeft text width500">
                        這個篩選條件沒有搜尋到結果，請選擇其它篩選條件
                    </div>
                </div>
                <?endif?>
            </div>
        </div>
    <div class="pageLink"><?=$page_link?></div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>