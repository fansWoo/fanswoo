<div fanswoo-message_show_clone style="display: none;">
	<span class='delete'><img src='img/admin/delete15x15.png'></span>
	<span class='message_content'></span>
</div>
<?if(!empty($global['message_show']['content'])):?>
<script>
Temp.ready(function(){
		fanswoo.message_show("<?=$global['message_show']['content']?>", <?=$global['message_show']['second']?>);
});
</script>
<?endif?>