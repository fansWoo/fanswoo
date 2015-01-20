	<?if(isset($global['style'])):?>
	<?foreach($global['style'] as $value):?>
	<link rel="stylesheet" type="text/css" href="app/css/<?=$value?>.css"></link>
	<?endforeach?>
	<?endif?>
</head>
<body>
<div class="body">
	<div class="logoStart"></div>
	<div class="picLoadingList">
		<img src="app/img/logoBig.png">
		<img src="app/img/bg5.jpg">
        <?if( isset($page) ):?>
		<?if($page == 'index'):?>
		<img src="app/img/bg1.png">
		<img src="app/img/bg1Black.png">
		<img src="app/img/boxBg.png">
		<?elseif($page == 'news'):?>
		<img src="app/img/bg1.png">
		<img src="app/img/bg1Black.png">
		<?elseif($page == 'about'):?>
		<img src="app/img/line.png">
		<img src="app/img/bulb.png">
		<img src="app/img/bulb2.png">
		<img src="app/img/inhale.png">
		<img src="app/img/brush.png">
		<img src="app/img/bg6.jpg">
		<img src="app/img/bg7.jpg">
		<img src="app/img/bg8.jpg">
		<img src="app/img/bg13.jpg">
		<img src="app/img/bg18.jpg">
		<?elseif($page == 'portfolio'):?>
		<img src="app/img/bg10.jpg">
		<img src="app/img/bg13.jpg">
		<img src="app/img/bg14.jpg">
		<?elseif($page == 'contact'):?>
		<img src="app/img/bg3p1color.png">
		<img src="app/img/bg3p1.png">
		<img src="app/img/bg3p2_1.png">
		<img src="app/img/plane.png">
		<?endif?>
		<?endif?>
	</div>
	<div class="picLoading"></div>
	<div class="wrap">
		<span data-hrefto="" class="logoFixed"></span>
		<div data-hrefto="contact" class="contactFormHover">
			線<br>上<br>諮<br>詢<br>/<br>索<br>取<br>報<br>價
		</div>