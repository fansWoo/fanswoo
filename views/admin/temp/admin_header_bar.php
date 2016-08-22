<div class="admin_header">
    <a href="" class="logo"></a>
    <div class="logStatus">
        <?if( !empty($User->uid) ):?>
        <span class="username"><?=$User->username?><a href="admin/project/worktask/worktask/tablelist/?pemission_uid=<?=$User->uid?>&work_status=A0">(<?=$job_count?>)</a></span>
        <a href="user/logout">登出</a>
        <?else:?>
        <a href="user">您尚未登入會員，請點此登入或註冊會員</a>
        <?endif?>
    </div>
</div>
<div class="admin_header_bar_mobile">
<a href="" class="logo"></a>
    <div class="menu">
        <img src="img/menu.png">
    </div>
</div>
<div class="admin_header_bar_mobile_content">
    <div class="scrollbar">
        <a class="li" href="<?=base_url()?>">首頁</a>
        <?foreach($admin_sidebox as $key => $child1):?>
        <?foreach($child1['child2'] as $key2 => $child2):?>
        <div class="admin_header_father_area">
            <p><?=$child2['title']?></p>
            <div class="child_area">
            <?foreach($child2['child3'] as $key3 => $child3):?>
                <?if(!empty($child3['child4'])):?>
                    <?foreach($child3['child4'] as $key4 => $child4):?>
                        <?if( $child4['sidebar_hidden'] !== TRUE ):?>
                        <a href="admin/<?=$key?>/<?=$key2?>/<?=$key3?>/<?=$key4?>" class="acHrefSmall<?if(!empty($child4['selected'])):?> selected hover<?endif?><?if(!empty($child4['display'])):?> hidden<?endif?>">
                                <?=$child3['title']?> > <?=$child4['title']?>
                        </a>
                        <?endif?>
                    <?endforeach?>
                <?endif?>
            <?endforeach?>
            </div>
        </div>
        <?endforeach?>
        <?endforeach?>
        <?if( !empty($User->uid) ):?>
        <a class="li" href="user/logout">登出</a>
        <?else:?>
        <a class="li" href="user">登入或註冊會員</a>
        <?endif?>
    </div>
</div>
<div class="sidebar">
    <?foreach( (array) $admin_sidebox as $key => $child1):?>
    <div class="sidebox<?if(!empty($child1['selected']) && $child1['selected'] === TRUE):?> hover<?endif?>">
        <h2><?=$child1['title']?></h2>
        <?if(!empty($child1['child2'])):?>
        <?foreach($child1['child2'] as $key2 => $child2):?>
        <div class="acHref<?if(!empty($child2['selected']) && $child2['selected'] === TRUE):?> selected hover<?endif?><?if(!empty($child2['display']) && $child2['display'] === TRUE):?> hidden<?endif?>">
            <div class="acHrefBig">
                <?=$child2['title']?>
            </div>
            <div class="acHrefSmallBar">
            <?if(!empty($child2['child3'])):?>
            <?foreach($child2['child3'] as $key3 => $child3):?>
                <?if(!empty($child3['child4'])):?>
                <?foreach($child3['child4'] as $key4 => $child4):?>
                    <?if( $child4['sidebar_hidden'] !== TRUE ):?>
                    <a href="admin/<?=$key?>/<?=$key2?>/<?=$key3?>/<?=$key4?>" class="acHrefSmall<?if(!empty($child4['selected'])):?> selected hover<?endif?><?if(!empty($child4['display'])):?> hidden<?endif?>">
                        <?=$child3['title']?> > <?=$child4['title']?>
                    </a>
                    <?endif?>
                <?endforeach?>
                <?endif?>
            <?endforeach?>
            <?endif?>
            </div>
        </div>
        <?endforeach?>
        <?endif?>
    </div>
    <?endforeach?>
</div>
<div class="body" fs-temp-body style="display: none;">
    <div class="wrap_shadow"></div>
    <div class="wrap">
        <div class="sidebar_bg"></div>
        <div class="content">