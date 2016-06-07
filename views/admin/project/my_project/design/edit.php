<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - 設計項目</h2>
<div class="contentBox allWidth">
    <h3>設計項目 > 查看</h3>
    <h4>請查看設計項目之詳細資訊</h4>
	<div class="spanLine">
	    <div class="spanStage">
            <div class="spanLineLeft">
                設計項目名稱
            </div>
            <div class="spanLineLeft width300">
                <?=$Design->title?>
            </div>
		</div>
	</div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                設計項目報價 (NT$)
            </div>
            <div class="spanLineLeft">
                <?=$Design->price?>
            </div>
        </div>
    </div>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                設計項目簡介
            </div>
            <div class="spanLineLeft width300">
                <?if(!empty($Design->synopsis)):?><?=$Design->synopsis?><?else:?>未填寫詳細內容<?endif?>
            </div>
        </div>
    </div>
    <?if(!empty($Design->designid)):?>
    <div class="spanLine">
        <div class="spanStage">
            <div class="spanLineLeft">
                更新日期
            </div>
            <div class="spanLineLeft">
                <?=$Design->updatetime_DateTime->datetime?>
            </div>
        </div>
    </div>
    <?endif?>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>