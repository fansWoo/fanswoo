<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title?> > 查看</h3>
    <h4>請查看<?=$child3_title?>之詳細資訊</h4>
    <?php
        $data['Pic'] = new PicObj([
            'db_where_arr' => [
                'picid' => $Comment->id
            ]
        ]);
        
        $data['Note'] = new Note([
            'db_where_arr' => [
                'noteid' => $Comment->id
            ]
        ]);
    ?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                <?if(($Comment->typename) == 'pic'):?>
                    圖片ID
                <?elseif(($Comment->typename) == 'note'):?>
                    文章ID
                <?endif?>
            </div>
            <div class="spanLineLeft width500">
                <?if(($Comment->typename) == 'pic'):?>
                    <?=$data['Pic']->picid?>
                <?elseif(($Comment->typename) == 'note'):?>
                    <?=$data['Note']->noteid?>
                <?endif?>
            </div>
        </div>
    </div>
    <?if($Comment->typename !== 'newsfeed'):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                <?if(($Comment->typename) == 'pic'):?>
                圖片標題
                <?elseif(($Comment->typename) == 'note'):?>
                文章標題
                <?endif?>
            </div>
            <div class="spanLineLeft width500">
                <?if(($Comment->typename) == 'pic'):?>
                    <?=$data['Pic']->title?>
                <?elseif(($Comment->typename) == 'note'):?>
                    <?=$data['Note']->title?>
                <?endif?>
            </div>
        </div>
    </div>
    <?endif?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                留言內容
            </div>
            <div class="spanLineLeft width500">
                <?=$Comment->content_Html?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                留言日期
            </div>
            <div class="spanLineLeft width200">
                <?=$Comment->updatetime_DateTime->datetime?>
            </div>
        </div>
    </div>
    <div class="spanLine spanSubmit">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <?if(!empty($Comment->commentid)):?><span class="submit gray" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?commentid=<?=$Comment->commentid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title?></span><?endif?>
            </div>
        </div>
    </div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>