<?=$temp['header_up']?>
<?=$temp['header_down']?>
<?=$temp['admin_header_bar']?>
<h2><?=$child2_title?> - 專案列表</h2>
<div class="contentBox contentTablelist allWidth">
	<h3>專案列表</h3>
	<h4>請填寫欲新增或更改之專案</h4>
	<div class="spanLineTable">
        <div class="spanLineTableContent">
            <div class="spanLine tablelist tableTitle">
                <div class="spanLineLeft text width100">
                    專案ID
                </div>
                <div class="spanLineLeft text width200">
                    專案名稱
                </div>
                <div class="spanLineLeft text width100">
                    會員ID
                </div>
                <div class="spanLineLeft text width100">
                    款項支付狀態
                </div>
                <div class="spanLineLeft text width100">
        			款項確認狀態
                </div>
                <div class="spanLineLeft text width100">
        			專案進行狀態
                </div>
                <div class="spanLineLeft text width150">
                    專案開始時間
                </div>
                <div class="spanLineLeft text width150">
                    編輯操作
                </div>
        	</div>
            <?foreach($ProjectList->obj_arr as $key => $value_Project):?>
            <div class="spanLine tablelist">
                <div class="spanLineLeft text width100">
                    <?=$value_Project->projectid?></a>
                </div>
                <div class="spanLineLeft text width200">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?projectid=<?=$value_Project->projectid?>">
                        <?=$value_Project->name?>
                    </a>
                </div>
                <div class="spanLineLeft text width100">
                    <?=$value_Project->uid?></a>
                </div>
                <div class="spanLineLeft text width100">
                    <?if($value_Project->pay_status == 1):?>
                    <span class="green">會員已填單</span>
                    <?elseif($value_Project->pay_status == 0):?>
                    <span class="red">會員未填單</span>
                    <?endif?>
                </div>
                <div class="spanLineLeft text width100">
                    <?if($value_Project->paycheck_status == 1):?>
                    <span class="green">款項已確認</span>
                    <?elseif($value_Project->paycheck_status == 0):?>
                    <span class="red">款項未確認</span>
                    <?endif?>
                </div>
                <div class="spanLineLeft text width100" style="color:#027de5">
                    <?if($value_Project->project_status == 1):?>
                    <span>估價中</span>
                    <?elseif($value_Project->project_status == 2):?>
                    <span>開發中</span>
                    <?elseif($value_Project->project_status == 3):?>
                    <span>維護</span>
                    <?elseif($value_Project->project_status == 4):?>
                    <span>結案</span>
                    <?endif?>
                </div>
                <div class="spanLineLeft text width150">
                    <?=$value_Project->setuptime_DateTimeObj->datetime?>
                </div>
                <div class="spanLineLeft width100 hoverHidden">
                    <a href="admin/<?=$child1_name?>/<?=$child2_name?>/<?=$child3_name?>/edit/?projectid=<?=$value_Project->projectid?>">編輯</a>
                </div>
        	</div>
            <?endforeach?>
        </div>
    </div>
    <div class="pageLink"><?=$page_links?></div>
</div>
<?=$temp['admin_footer_bar']?>
<?=$temp['body_end']?>