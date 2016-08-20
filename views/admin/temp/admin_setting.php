<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - <?=$child3_title?></h2>
<?foreach($setting_arr as $key => $value_arr):?>
<div class="contentBox allWidth">
    <h3><?=$value_arr['title']?></h3>
    <h4><?=$value_arr['subtitle']?></h4>
    <?php echo form_open_multipart($global['form_open']) ?>
    <?foreach($value_arr['child'] as $key2 => $value2_arr):?>
	<div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                <?=$value2_arr['title']?>
            </div>
            <?if(
                $value2_arr['type'] == 'html'
            ):?>
            <div class="spanLineRight">
            <?else:?>
            <div class="spanLineLeft" style="<?=$value2_arr['style']?>">
            <?endif?>
                <?if(
                    $value2_arr['type'] == 'text' ||
                    $value2_arr['type'] == 'number' ||
                    $value2_arr['type'] == 'password'
                ):?>

                <?if($value2_arr['type'] == 'password'):?>
                <input type="password" name="password" style="position: absolute; margin:0 0 0 -99999px; padding:0; width:0; height:0; overflow: hidden;">
                <?endif?>
                    <input
                        <?if($value2_arr['type'] == 'text'):?> type="text"
                        <?elseif($value2_arr['type'] == 'number'):?> type="number"
                        <?elseif($value2_arr['type'] == 'password'):?> type="password"
                        <?endif?>
                        class="text"
                        autocomplete="off"
                        name="<?=$value2_arr['name']?>"
                        placeholder="<?=$value2_arr['placeholder']?>"
                        value="<?=$SettingList->obj_arr[$value2_arr['name']]->value?>"
                        <?if(
                            is_string($value2_arr['set_rules']) &&
                            stristr($value2_arr['set_rules'], 'required') ||
                            !empty($value2_arr['set_rules']['required'])
                        ):?>
                         required
                        <?endif?>
                        <?if(isset($value2_arr['min'])):?> min="<?=$value2_arr['min']?>"<?endif?>
                        <?if(isset($value2_arr['max'])):?> max="<?=$value2_arr['max']?>"<?endif?>
                    >
                <?elseif($value2_arr['type'] == 'checkbox'):?>
                    <?foreach($value2_arr['child'] as $key3 => $value3_arr):?>
                    <label>
                        <input type="checkbox" class="checkbox" name="<?=$value3_arr['name']?>"
                        <?if(
                            $SettingList->obj_arr[$value3_arr['name']]->value == 1 ||
                            !isset($SettingList->obj_arr[$value3_arr['name']]->value) &&
                            $value3_arr['default_value'] == 1
                        ):?>
                        checked="checked"
                        <?endif?>
                        >
                        <?=$value3_arr['title']?>
                    </label>
                    <?endforeach?>
                <?elseif($value2_arr['type'] == 'radio'):?>
                    <?foreach($value2_arr['child'] as $key3 => $value3_arr):?>
                    <label>
                        <input type="radio" class="radio" name="<?=$value2_arr['name']?>" value="<?=$value3_arr['value']?>"
                        <?if(
                            $SettingList->obj_arr[$value2_arr['name']]->value == $value3_arr['value'] ||
                            $value2_arr['default_value'] == $value3_arr['value'] &&
                            !isset($SettingList->obj_arr[$value2_arr['name']]->value)
                        ):?>
                        checked="checked"
                        <?endif?>
                        >
                        <?=$value3_arr['title']?>
                    </label>
                    <?endforeach?>
                <?elseif($value2_arr['type'] == 'select'):?>
                    <select name="<?=$value2_arr['name']?>">
                        <?foreach($value2_arr['child'] as $key3 => $value3_arr):?>
                        <option
                            value="<?=$value3_arr['value']?>" 
                            <?if(
                                $SettingList->obj_arr[$value2_arr['name']]->value == $value3_arr['value'] ||
                                $value2_arr['default_value'] == $value3_arr['value'] &&
                                !isset($SettingList->obj_arr[$value2_arr['name']]->value)
                            ):?>
                            selected="selected"
                            <?endif?>
                        >
                            <?=$value3_arr['title']?>
                        </option>
                        <?endforeach?>
                    </select>
                <?elseif($value2_arr['type'] == 'textarea'):?>
                    <textarea name="<?=$value2_arr['name']?>" placeholder="<?=$value2_arr['placeholder']?>"><?=$SettingList->obj_arr[$value2_arr['name']]->value?></textarea>
                <?elseif($value2_arr['type'] == 'html'):?>
                <div fanswoo-pic_upload_ajax fanswoo-upload_status="unclassified">上傳更多圖片</div>
                <div class="picidUploadList" fanswoo-piclist>
                    <div fanswoo-picid class="picidUploadLi" fanswoo-clone>
                        <div class="pic"><img src="" fanswoo-picid_img></div>
                        <div class="other">
                            <div class="pic_copy"><input type="text" fanswoo-picid_path_input fanswoo-input_copy readonly /></div>
                            <div fanswoo-pic_delete class="pic_delete">刪除圖片</div>
                        </div>
                    </div>
                </div>
                <textarea cols="80" id="<?=$value2_arr['name']?>" name="<?=$value2_arr['name']?>" rows="10" ><?=$SettingList->obj_arr[$value2_arr['name']]->value?></textarea>
                <script src="js/tool/ckeditor/ckeditor.js"></script>
                <script>
                    CKEDITOR.replace( '<?=$value2_arr['name']?>', {
                        toolbar: 'html'
                    });
                </script>
                <?elseif($value2_arr['type'] == 'group'):?>
                <?endif?>
            </div>
        </div>
        <?if(!empty($value2_arr['explanation'])):?>
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <p class="gray"><?=$value2_arr['explanation']?></p>
            </div>
        </div>
        <?endif?>
	</div>
    <?endforeach?>
	<div class="spanLine spanSubmit">
        <div class="spanStage">
            <div class="spanLineLeft">
            </div>
            <div class="spanLineRight">
                <input type="hidden" style="display: hidden;" name="setting_group" value="<?=$key?>">
                <input type="submit" fanswoo-ajax_submit class="submit" value="儲存設置">
            </div>
        </div>
	</div>
	</form>
</div>
<?endforeach?>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>