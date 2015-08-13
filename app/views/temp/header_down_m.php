	<link rel="stylesheet" type="text/css" href="app/css/style.css"></link>
	<?if(isset($global['style'])):?>
	<?foreach($global['style'] as $value):?>
	<link rel="stylesheet" type="text/css" href="app/css/<?=$value?>.css"></link>
	<?endforeach?>
	<?endif?>
	<script>(function() {
	var _fbq = window._fbq || (window._fbq = []);
	if (!_fbq.loaded) {
	var fbds = document.createElement('script');
	fbds.async = true;
	fbds.src = '//connect.facebook.net/en_US/fbds.js';
	var s = document.getElementsByTagName('script')[0];
	s.parentNode.insertBefore(fbds, s);
	_fbq.loaded = true;
	}
	_fbq.push(['addPixelId', '694153537333853']);
	})();
	window._fbq = window._fbq || [];
	window._fbq.push(['track', 'PixelInitialized', {}]);
	</script>
	<noscript style="display:none;"><img height="1" width="1" alt="" style="display:none" src="https://www.facebook.com/tr?id=694153537333853&amp;ev=PixelInitialized" /></noscript>
</head>
<body>
	<div class="header">
	  <div class="logoarea">
		<a href="page/index"><img src="app/img/logoBig.png"  class="logo"></a>
	  </div> 
	  <div class="nav">
		   <div class="in_nav">
			<a href="page/about"><div>About</div></a>
			<a href="note"><div>News</div></a>
			<a href="page/portfolio"><div>Portfolio</div></a>
			<a href="contact"><div>Contact</div></a>
		   </div> 
	  </div>   
	</div>