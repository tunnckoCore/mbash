<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" xml:lang="bg" lang="bg" xmlns:fb="http://www.facebook.com/2008/fbml" xmlns:og="http://opengraphprotocol.org/schema/">

<head>

	<title><?# TITLE ?></title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta name="description" content="<?# DESC ?>" />
	<meta name="keywords" content="<?# KEYWORDS ?>" />
	
	<link rel="canonical" href="<?# CANONICAL ?>" />
	
	<meta property="og:site_name" content="<?# OG_SITE_NAME ?>" />
	<meta property="og:type" content="<?# OG_TYPE ?>" />
	<meta property="og:title" content="<?# OG_TITLE ?>" />
	<meta property="og:url" content="<?# CANONICAL ?>"/>
	<meta property="og:description" content="<?# DESC ?>" />
	<?# MORE_OPG ?>
	<meta name="robots" content="<?# ROBOTS ?>" />
	<meta name="author" content="tunnckoCore" />
	<meta name="copyright" content="<?# COPYRIGHT ?>" />
	<meta name="googlebot" content="<?# GOOGLEBOT ?>" />
	<meta name="revisit-after" content="1 day" />
	
	<meta http-equiv="expires" content="now" />
	<meta http-equiv="pragma" content="no-cache" />
	<meta http-equiv="content-language" content="bg" />
		
	<!-- css files -->
	<link rel="stylesheet" type="text/css" href="<?# BASE_PATH ?>/css/liababy.css" />
	<link rel="stylesheet" type="text/css" href="<?# BASE_PATH ?>/css/slider/jquery.slider.css" />
	<link rel="stylesheet" type="text/css" href="<?# BASE_PATH ?>/css/opensans.css"  />
	
	<link rel="icon" href="http://razorjack.net/quicksand/content/images/network-utility.png" type="image/x-icon"/>
	<link rel="shortcut icon" href="http://razorjack.net/quicksand/content/images/network-utility.png" type="image/x-icon"/>
	
	<!-- jQuery -->
	<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
	<script type="text/javascript" src="<?# BASE_PATH ?>/js/jquery.js"></script>
	<script type="text/javascript" src="<?# BASE_PATH ?>/js/swfobject.js"></script>
	<script type="text/javascript" src="<?# BASE_PATH ?>/js/jquery-ui-1.8.13.core-pack.min.js"></script>
	<script type="text/javascript" src="<?# BASE_PATH ?>/js/slider/jquery.slider.min.js"></script>
	<script type="text/javascript" src="<?# BASE_PATH ?>/js/less-stable.js"></script>
	<script type="text/javascript" src="<?# BASE_PATH ?>/js/slider/jquery.slider.ui.custom.js"></script>
		<!-- PNG FIX FOR IE6 -->
		<script language="JavaScript1.1" type="text/javascript" src="<?# BASE_PATH ?>/js/iepngfix_tilebg.js"></script>
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
	
</head>
<body>
	
<!-- DATA START  -->

	<div class="main_wrapper">
		<div class="wrapper">
		<div class="masterPositionContainer">
		<section id="mastergroup_1" class="cw_48 header-wrap mastergroup">
			<div class="inside_mastergroup">
				<div id="group_1" class="group cw_47 inside">
					<div id="box_10020624d1477" class="box cw_46 header">
						<header class="header">
							<div id="homepage">
								<ul>
	<li><h1><a href="<?# MAIN_PATH ?>index" title="<?# OG_SITE_NAME ?>" subtitle="дистрибуция в софия">LiaBaby</a></h1></li>
								</ul>
							</div>
							<nav id="main-nav">
								<ul>
	<li class="one"><a href="<?# MAIN_PATH ?>index" title="" subtitle="liababy.com">Начало</a></li>
	<li><a href="<?# MAIN_PATH ?>products" title="" subtitle="Каталог продукти">Продукти</a></li>
	<li><a href="<?# MAIN_PATH ?>shops" title="" subtitle="Поръчки на стока">Магазини</a></li>
	<?# LIA_MENU_LINKS ?>
								</ul>
							</nav><!-- end #main-nav -->	
						</header><!-- end #header -->
					</div>
				</div>
			</div>
		</section>
		
		<section id="mastergroup_2" class="cw_48 unique">
			<div class="inside_mastergroup">
				<?# MIDDLE ?>
			</div>
		</section>
		
		<div id="mastergroup_2" class="cw_48 content mastergroup">
			<div class="inside_mastergroup">
				<section id="group_2" class="group cw_32 article_wrapper">
					<div id="box_10020540d1474" class="box cw_31 arti">
					<!-- //END indexheader.php file-->