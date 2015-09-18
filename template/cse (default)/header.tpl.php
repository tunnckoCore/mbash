<!DOCTYPE html>
<html lang="bg">
<head>
	<meta charset="utf-8" />
	<title><?# TITLE ?></title>
	<meta name="description" content="<?# DESC ?>" />
	<meta name="keywords" content="<?# KEYWORDS ?>" />
	
	<link rel="canonical" href="<?# CANONICAL ?>" />
	<link rel="icon" href="http://razorjack.net/quicksand/content/images/network-utility.png" type="image/x-icon"/>
	<link rel="shortcut icon" href="http://razorjack.net/quicksand/content/images/network-utility.png" type="image/x-icon"/>
	
	<meta property="og:site_name" content="<?# OG_SITE_NAME ?>" />
	<meta property="og:type" content="<?# OG_TYPE ?>" />
	<meta property="og:title" content="<?# OG_TITLE ?>" />
	<meta property="og:url" content="<?# CANONICAL ?>"/>
	<meta property="og:description" content="<?# DESC ?>" />
	<?# MORE_OPG ?>
	<meta name="robots" content="<?# ROBOTS ?>" />
	<meta name="author" content="tunnckoCore" />
	<meta name="revisit-after" content="2 Days" />
		
	<!-- css files -->
	<link rel="stylesheet" href="<?# BASE_PATH ?>/css/opensans.css"/>
	<link rel="stylesheet" href="<?# BASE_PATH ?>/css/gridsys_noup.css"/>
	<link rel="stylesheet" href="<?# BASE_PATH ?>/css/slider/jquery.slider.css" />
	
	<!-- jQuery -->
	<script src="http://code.jquery.com/jquery-latest.js"></script>
	<script src="<?# BASE_PATH ?>/js/body.js"></script>
	<script src="<?# BASE_PATH ?>/js/jquery.js"></script>
	<script src="<?# BASE_PATH ?>/js/swfobject.js"></script>
	<script src="<?# BASE_PATH ?>/js/jquery-ui-1.8.13.core-pack.min.js"></script>
	<script src="<?# BASE_PATH ?>/js/slider/jquery.slider.min.js"></script>
	<script src="<?# BASE_PATH ?>/js/less-stable.js"></script>
	<script src="<?# BASE_PATH ?>/js/slider/jquery.slider.ui.custom.js"></script>
		<!-- PNG FIX FOR IE6 -->
		<script src="<?# BASE_PATH ?>/js/iepngfix_tilebg.js"></script>
		<!-- END FIX -->
	<script type="text/javascript">
		  jQuery(document).ready(function($) {
			$(".slider").slideshow({
			
			  width      : 900,
			  height     : 254,
			  transition	: 'fade',
			  navigation	: false,
			  timer			: false,
			  control		: false,
			  loop			: true,
			  columns		: 1
			});
			
			$(".hideRegisterForm").hide();
		
			$(".register").click(function() {
				$(".hideRegisterForm").fadeToggle("fast");
			});
			
			$(".hideLoginForm").hide();
			$(".login").click(function() {
				$(".hideLoginForm").fadeToggle("fast");
			});
		  });
		</script>
	<!-- // jQuery -->
		<script type="text/javascript">
			var gOverride = {
			  urlBase: 'https://github.com/peol/960gridder/blob/master/releases/latest/960.gridder.js',
			  gColor: '#EEEEEE',
			  gColumns: 12,
			  gOpacity: 0.35,
			  gWidth: 10,
			  pColor: '#C0C0C0',
			  pHeight: 15,
			  pOffset: 0,
			  pOpacity: 0.55,
			  center: true,
			  gEnabled: true,
			  pEnabled: true,
			  setupEnabled: true,
			  fixFlash: true,
			  size: 960
			};
		</script>

<script type="text/javascript">
// Insert optional override object before the function

createGridder = function() {
  document.body.appendChild(
    document.createElement('script'))
    .src='hhttps://github.com/peol/960gridder/blob/master/releases/latest/960.gridder.js';
}
</script>
</head>
<body onload="createGridder()">
	
	<section id="wrapper" class="mb_20">
		<header class="header width_956 auto textcenter pt_5">
			<a href="<?# MAIN_PATH ?>" title="<?# DESC ?>"><img src="<?# BASE_PATH ?>/images/martonbash.png" alt="banner advert nomer#1"/></a>
		</header>
		<div class="cleaner"></div>
		<div id="main_wrapper" class="grid_0 width_956 auto pt_10 radius_10_top pall_10">
			<section id="menu_wrapper" class="auto">
				<nav class="menudark pall_10 radius_10_all ">
					<ul>
						<li><a href="<?# MAIN_PATH ?>"><span>Начало</span></a></li>
						<li><a href="<?# MAIN_PATH ?>"><span>Начало</span></a></li>
						<li><a href="<?# MAIN_PATH ?>"><span>Начало</span></a></li>
						<li><a href="<?# MAIN_PATH ?>"><span>Начало</span></a></li>
						<li><a href="<?# MAIN_PATH ?>user/index"><span>Потребители</span></a></li>
						<?# CSE_MENU_LINKS ?>
						
					</ul>
				</nav>
			</section>
			<section id="content_wrapper" class="clearfix pt_30 auto">
				<aside id="asidebar" class="left mr_10 width_300">
					<div class="grid_1 mb_10 radius_5_all">
						<?# CSE_SIDELOGIN_BOX ?>
					</div>
					<div class="grid_2 mb_10 radius_5_all">
						<div class="grid_up hr dark bold500 radius_5_top textcenter">Our Servers</div>
						<div class="grid_bottom pall_20">
							<p>On.S7R!Ke Gam!nG # Italy2 DM</p>
							<p><?# VISITS_UNIQUE ?></p>
							<p><?# VISITS_ALL ?></p>
							<p>75.121.35.139:27002</p>
							<p>cs3.onstrike-gaming.com</p>
						</div>
					</div>
					<div class="grid_3 mb_10 radius_5_all">
						<div class="grid_up hr dark bold500 radius_5_top textcenter">Latest Poll</div>
						<div class="grid_bottom pall_20">
							<p>How are you today?</p>
							<p>- fine 30%</p>
							<p>- sick 8%</p>
							<p>- angry 20%</p>
							<p>- smile 42%</p>
						</div>
					</div>
					<div class="grid_4 mb_10 radius_5_all">
						<div class="grid_up hr dark bold500 radius_5_top textcenter">Lorem Ipsum Title</div>
						<div class="grid_bottom pall_20">
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris vel porta erat. Quisque sit amet risus at odio pellentesque sollicitudin. Proin suscipit molestie facilisis. Aenean vel massa magna. Proin nec lacinia augue. Mauris venenatis libero nec odio viverra consequat.</p>
						</div>
					</div>
				</aside>
				<section id="rightside" class="right ml_10 width_636">