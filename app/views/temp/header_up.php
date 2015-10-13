<!DOCTYPE html>
<html lang="zh-Hant-TW" class="<?=$global['browser_agent']['browser']?><?if(!empty($global['browser_agent']['browser_ie'])){echo ' '.$global['browser_agent']['browser_ie'];}?>">
<head>
	<meta charset="utf-8">
	<title><?=$global['website_title_name']?><?if($global['website_title_introduction']):?> - <?=$global['website_title_introduction']?><?endif?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <?foreach( $global['website_metatag_Arr'] as $key => $value_Str ):?>
    <meta name="keywords" content="<?=$value_Str?>" />
    <?endforeach?>
	<?if(isset($global['website_metatag_array'])):?>
	<?foreach($global['website_metatag_array'] as $value):?>
	<meta name="keywords" content="<?=$value?>">
	<?endforeach?>
	<?endif?>
	<base href="<?=prep_url($_SERVER['HTTP_HOST'].base_url())?>" />
	<script src="app/js/jquery-1.7.1.min.js"></script>
	<script src="app/js/jquery-ui-1.8.23.custom.min.js"></script>
	<script src="app/js/fanScript-1.3.0.js"></script>
	<!--<script src="app/js/script_common.js"></script>-->
    <!--<script src="fanswoo-framework/js/jquery-1.11.1.min.js"></script>-->
	<script src="fanswoo-framework/js/jquery.mobile.custom.js"></script>
	<script src="fanswoo-framework/js/jquery-ui-1.11.4.custom/jquery-ui.js"></script>
	<link rel="stylesheet" type="text/css" href="fanswoo-framework/js/jquery-ui-1.11.4.custom/jquery-ui.css"></link>
	<script src="fanswoo-framework/js/fanswoo-1.3.1.js"></script>
	<script src="app/js/global.js"></script>
	<?foreach( (array) $global['js'] as $value):?>
	<script src="<?=$value?>"></script>
	<?endforeach?>
	<?if(!empty($global['website_script_plugin_ga'])):?><?=$global['website_script_plugin_ga']?><?endif?>
	<?if(!empty($global['website_script_plugin_fb'])):?><?=$global['website_script_plugin_fb']?><?endif?>
	<?if(!empty($global['website_script_plugin_custom'])):?><?=$global['website_script_plugin_custom']?><?endif?>
	<link rel="shortcut icon" href="app/img/favicon.ico"></link>
	<!--<link rel="stylesheet" type="text/css" href="app/css/reset.css"></link>-->
	<link rel="stylesheet" type="text/css" href="fanswoo-framework/style/fanswoo-framework.css"></link>