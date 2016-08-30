<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<div class="contentBox allWidth">
    <h3><?=$child3_title?> > 設置</h3>
    <h4>本設置可銷毀所有刪除的聯繫單或復原所有刪除的聯繫單</h4>
    <div class="spanLine spanSubmit" style="padding:0 0 0 10px;">
    <?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_destroy_post/") ?>
        <input type="submit" class="submit" value="銷毀聯繫單">
    </form>
    <?php echo form_open_multipart("admin/$child1_name/$child2_name/$child3_name/{$child4_name}_recovery_post/") ?>
        <input type="submit" class="submit" value="復原聯繫單">
    </form>
    </div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>