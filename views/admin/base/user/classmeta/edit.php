<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title?> > <?if(!empty($UserGroup->groupid)):?>編輯<?else:?>新增<?endif?></h3>
    <h4>請填寫<?=$child3_title?>之詳細資訊</h4>
    <?php echo form_open("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_post/") ?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                會員群組名稱
            </div>
            <div class="spanLineLeft">
                <input type="text" class="text" name="groupname" placeholder="會員群組名稱" value="<?=$UserGroup->groupname?>" required>
            </div>
        </div>
    </div>
    <div class="spanLine spanSubmit">
        <div class="spanLineLeft">
        </div>
        <div class="spanLineRight">
            <?if(!empty($UserGroup->groupid)):?><input type="hidden" name="groupid" value="<?=$UserGroup->groupid?>"><?endif?>
            <input type="submit" class="submit" value="<?if(!empty($UserGroup->groupid)):?>儲存變更<?else:?>新增會員群組<?endif?>">
            <?if(!empty($UserGroup->groupid)):?><span class="submit gray" onClick="fanswoo.check_href_action('確定要刪除嗎？', 'admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/delete/?groupid=<?=$UserGroup->groupid?>&hash=<?=$this->security->get_csrf_hash()?>');">刪除<?=$child3_title?></span><?endif?>
        </div>
    </div>
    </form>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>