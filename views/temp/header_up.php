<!DOCTYPE html>
<html lang="<?=$global['locale']?>" class="<?=$global['browser_agent']['browser']?><?if(!empty($global['browser_agent']['browser_ie'])){echo ' '.$global['browser_agent']['browser_ie'];}?>">
<head>
<title><?=$global['website_title_name']?><?if($global['website_title_introduction']):?> - <?=$global['website_title_introduction']?><?endif?></title>
<meta charset="utf-8">
<meta httpstate="200">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
<?foreach( (array) $global['website_metatag_arr'] as $key => $value ):?>
<meta name="keywords" content="<?=$value?>" />
<?endforeach?>
<?if(isset($global['website_metatag_array'])):?>
<?foreach($global['website_metatag_array'] as $value):?>
<meta name="keywords" content="<?=$value?>">
<?endforeach?>
<?endif?>
<base href="//<?=$_SERVER['HTTP_HOST'].base_url()?>" />
<?foreach( (array) $global['js'] as $value):?>
<script src="<?=base_url(APPURL.'js/'.$value)?>"></script>
<?endforeach?>
<?if(!empty($global['website_script_plugin_ga'])):?><?=$global['website_script_plugin_ga']?><?endif?>
<?if(!empty($global['website_script_plugin_fb'])):?><?=$global['website_script_plugin_fb']?><?endif?>
<?if(!empty($global['website_script_plugin_custom'])):?><?=$global['website_script_plugin_custom']?><?endif?>
<link rel="shortcut icon" href="<?=base_url(APPURL.'img/favicon.ico')?>"></link>
<script>
Temp.before(function(){
<?
foreach( (array) $js_obj_arr as $key => $js_obj)
{
	echo js_obj_construct([
		'obj_var' => $key,
		'Obj' => $js_obj
	]);
}
?>
});
</script>