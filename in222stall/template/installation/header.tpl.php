<!DOCTYPE html>
<html lang="bg">
<head>
	<meta charset="utf-8" />
	<title><?# TITLE ?></title>
	<meta name="description" content="<?# DESC ?>" />
	<link rel="icon" href="http://razorjack.net/quicksand/content/images/network-utility.png" type="image/x-icon"/>
	<link rel="shortcut icon" href="http://razorjack.net/quicksand/content/images/network-utility.png" type="image/x-icon"/>
	
		
	<!-- css files -->
	<style>
	.stage-1					{ height:300px; position:relative; z-index:10; background:url(e107_files/install/images/1.png) no-repeat 100% 0; }
	.stage-2					{ height:300px; position:relative; z-index:10; background:url(e107_files/install/images/2.png) no-repeat 100% 0; }
	.stage-3					{ height:300px; position:relative; z-index:10; background:url(e107_files/install/images/3.png) no-repeat 100% 0; }
	.stage-4					{ height:300px; position:relative; z-index:10; background:url(e107_files/install/images/4.png) no-repeat 100% 0; }
	.stage-5					{ height:300px; position:relative; z-index:10; background:url(e107_files/install/images/5.png) no-repeat 100% 0; }
	.stage-6					{ height:300px; position:relative; z-index:10; background:url(e107_files/install/images/6.png) no-repeat 100% 0; }
	.stage-7					{ height:300px; position:relative; z-index:10; background:url(e107_files/install/images/7.png) no-repeat 100% 0; }
	.stage-7-finished			{ height:300px; position:relative; z-index:10; background:url(e107_files/install/images/8.png) no-repeat 100% 0; }
	.hint						{ background-color:#FFFFD5; border:1px solid #FFCC00; font-size:14px; padding:7px; margin-top:5px; -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; }
	.info						{ font-size:14px; padding:10px 25px 15px 25px; }
	.orange						{ font-size:22px; color:#ED7700; font-style:italic; }
	.tinytext					{ font-size:12px; margin-top:10px; padding:0px 35px; }
	.smalltext					{ font-size:14px; }
	.headerbg h1 				{ padding-left:0px;  font-style:italic; font-weight:bold; font-size: 20px }
	.stage-title				{ margin:30px 35px 0px 40px; font-size:22px;}
	.main-container				{ background:#FFFFFF url(e107_files/install/images/contentbg.png) repeat-x 0 0; margin:0 auto ; width:100%; margin:10px 0; padding:20px 0px; }
	.main-content				{ padding:0 0px 10px; }
	.main-content table			{ width:100%; margin:0 auto ; }
	.top-content				{ margin:0 20px 30px 20px; background-color:#FFFFFF; padding:20px 20px; display:block; }
	.top-content-title			{ font-size:16px; font-weight:bold; padding-bottom:10px; margin-bottom:10px; text-shadow:2px 2px 2px #CCCCCC; background:url(e107_files/install/images/rightbox_title_bg.png) repeat-x 0 100%; }
	.stage						{ padding:10px 5px 10px; text-align:left; background-color:transparent; border-bottom:1px solid #CCCCCC; }
	.tbox						{ margin:5px 5px; padding:5px 10px; font-size:14px; font-weight:normal; color:#111111; background-color:#FFFFFF; border:1px solid #CCCCCC; border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px; }
	.tboxfocus					{ border:1px solid #CCCCCC; background-color:#EEEEEE; }
	.button, .button:focus		{ margin:5px 0; padding:5px 10px; text-align:center; font-weight:bold; cursor:pointer; background-color:#FFFFFF; border:1px #CCCCCC solid; border-radius:3px; -moz-border-radius:3px; -webkit-border-radius:3px; }
	.button:hover				{ color:#3399CC; border:1px #EEEEEE solid; }
	.error						{ color:#FF5C5C; background-color:#FFCECE; border:1px solid #FF5C5C; padding:10px 20px; -webkit-border-radius:5px; -moz-border-radius:5px; border-radius:5px; }
	.warning					{ color:#FF9900 }
	.rfield						{ color:#FF9900; font-weight: bolder !important; }
	.success					{ color:green; }
	.required					{ border:1px solid #FF5C5C; }
	.error-text					{ color:#FF5C5C; }
	.navigation					{ padding:8px 3px; font-weight:bold; text-align:center; vertical-align:middle; border:1px solid #CCCCCC; border-top:0px none; background-color:#F9F9F9; z-index:10; }
	.navigation-top				{ width:100%; height:1px; background-color:#CCCCCC; }
	select.tbox, option.tbox	{ padding:3px; margin: 3px 5px }
	checkbox, label				{ margin:0 5px; }
	
	
	 /**
 * @author MartonBash Development
 * @copyright Common Development and Distribution License - http://opensource.org/licenses/CDDL-1.0
 */
* , body {
	margin: 0;
	padding: 0;
}

	body { font-size: 1em; background: #222;}
	* html .clearfix {
		height: 1%;
	}
	h1 {
		font-weight: normal;
	}
	::-moz-selection {
		/* color: #adcc33; */
		color: #fff;
		background: #2B60DE;
	}

	::selection {
		color: #fff;
		background: #2B60DE;
	}

	.clearfix:before, .clearfix:after {
		content: ".";
		display: block;
		clear: both;
		visibility: hidden;
		line-height: 0;
		height: 0;
	}

	.cleaner { clear: both; }
	.left { float: left; }
	.right { float: right; }
	.auto { margin: 0 auto; }
	
	/* Font/Text Classes */
	.boldtext { font-weight: bold; }
	.it { font-style: italic; }
	.uline { text-decoration: underline; }
	.decorenone {text-decoration: none;}
	.none { text-decoration: none; color: #333;}
	.adm {text-decoration: none; color: blue; }
	.bold300 { font-weight: 300; }
	.bold500 { font-weight: 500; }
	.red { color: red; }
	.normal { font-weight: normal;}
	.textleft { text-align: left; }
	.textcenter { text-align: center; }
	.hr{ border-bottom: 2px solid #ccc; }
	.fontSize14 { font-size: 14px; }
	.fontSize15 { font-size: 15px; }
	
	/* Fourside paddings and margins */
	.pall_20 { padding: 20px; }
	.mall_20 { margin: 20px; }
	.pall_10 { padding: 10px; }
	.mall_10 { margin: 10px; }
	.pall_5 { padding: 5px; }
	.mall_5 { margin: 5px; }
	
	/* Padding & Margin Bottom */
	.pb_20 { padding-bottom: 20px; }
	.mb_20 { margin-bottom: 20px; }
	.pb_10 { padding-bottom: 10px; }
	.mb_10 { margin-bottom: 10px; }
	.pb_5{ padding-bottom: 5px; }
	.mb_5 { margin-bottom: 5px; }

	/* Padding & Margin Top + 30*/
	.pt_30 { padding-top: 30px; }
	.mt_30 { margin-top: 30px; }
	
	.pt_20 { padding-top: 20px; }
	.mt_20 { margin-top: 20px; }
	.pt_10 { padding-top: 10px; }
	.mt_10 { margin-top: 10px; }
	.pt_5{ padding-top: 5px; }
	.mt_5 { margin-top: 5px; }	
	
	/* Padding & Margin Right + 30 */
	.pr_30 { padding-right: 30px; }
	.mr_30 { margin-right: 30px; }
	.pr_20 { padding-right: 20px; }
	.mr_20 { margin-right: 20px; }
	.pr_10 { padding-right: 10px; }
	.mr_10 { margin-right: 10px; }
	.pr_5{ padding-right: 5px; }
	.mr_5 { margin-right: 5px; }
	
	/* Padding & Margin Left + 15 / +30 */
	.pl_30 { padding-left: 30px; }
	.ml_30 { margin-left: 30px; }
	.pl_20 { padding-left: 20px; }
	.ml_20 { margin-left: 20px; }
	.pl_15 { padding-left: 13px; }
	.ml_15 { margin-left: 13px; }
	.pl_10 { padding-left: 10px; }
	.ml_10 { margin-left: 10px; }
	.ml_5{ padding-left: 5px; }
	.pl_5 { margin-left: 5px; }
	
	
	/*
		Main Grids
	*/
	
		/* Width & Heights */
		.width_956 { width: 940px; }
		.width_976 { width: 960px; }
		.width_300 { width: 280px; }
		.width_400 { width: 400px; }
		.width_480 { width: 480px; }
		.width_636 { width: 640px; }
		
		/* Box Title */
		.grid_up {
			color: #fff;
			font-size: 1em;
			font-variant: small-caps;
			font-family: 'Open Sans', san-serif;
			text-decoration: none;
			letter-spacing: 0.3ex;
			padding: 6px 0;
		}
		.grid_up a {
			color: #fff;
			text-decoration: none;
		}
		/* Box Content */
		.grid_bottom p {
			font-size: 1em;
			color: #333;
		}
		.grid_bottom p img {
			margin-left: 80px;
		}
		.grid_footer p {
			font-size: .9em;
			color: #f9f9f9;
			letter-spacing: 0.2ex;
		}
		.grid_footer p a {
			color: #f9f9f9;
			text-decoration: underline;
		}
		.news p {
			font-size: 1.1em;
			letter-spacing: 0.3ex;
			word-spacing: 0.1em;
		}
		.info {
			letter-spacing: 0.2ex;
			background: #f9f9f9;
		}
		.item {
			-webkit-border-radius: 3px;
			-moz-border-radius: 3px;
			border-radius: 3px;
			letter-spacing: 0.2ex;
			background: #f9f9f9;
			margin-bottom: 3px;
		}
		.item a {
			color: #19c0db;
			text-decoration: none;
		}
			/* 
				Mozilla LINE-SPACING HACK
			*/
			@-moz-document url-prefix() {
				body {letter-spacing: 0;}
				.grid_up {
					letter-spacing: 0.11ex;
					font-size: 15px;
					font-weight: 600;
					font-variant: small-caps;
				}
				.grid_footer p {
					letter-spacing: 0.14ex;
				}
				.news p {
					letter-spacing: 0.22ex;
				}
				.info {
					letter-spacing: 0.14ex;
				}
				.menudark ul li a {
					letter-spacing: -0.10ex;
					font-family: Verdana;
				}
			}
		
		/* Light and Dark options */
		.menudark {
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#888', endColorstr='#333'); /* IE 7 & 8 */
			background-image: -webkit-gradient(linear, left top, left bottom, from(#888), to(#333)); /* Safari 4+, Chrome 1-9 */
			background-image: -webkit-linear-gradient(top, #888, #333);  /* Safari 5.1+, Mobile Safari, Chrome 10+ */
			background-image: -moz-linear-gradient(top,  #888,  #333); /* Firefox 3.6+ */
			background-image: -ms-linear-gradient(top, #888, #333); /* IE 10+ */
			background-image: -o-linear-gradient(top, #888, #333); /* Opera 11.10+ */
		}
		.dark {
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#555', endColorstr='#333'); /* IE 7 & 8 */
			background-image: -webkit-gradient(linear, left top, left bottom, from(#555), to(#333)); /* Safari 4+, Chrome 1-9 */
			background-image: -webkit-linear-gradient(top, #555, #333);  /* Safari 5.1+, Mobile Safari, Chrome 10+ */
			background-image: -moz-linear-gradient(top,  #555,  #333); /* Firefox 3.6+ */
			background-image: -ms-linear-gradient(top, #555, #333); /* IE 10+ */
			background-image: -o-linear-gradient(top, #555, #333); /* Opera 11.10+ */
		}
		.light {
			filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#1589FF', endColorstr='#2B60DE'); /* IE 7 & 8 */
			background-image: -webkit-gradient(linear, left top, left bottom, from(#1589FF), to(#2B60DE)); /* Safari 4+, Chrome 1-9 */
			background-image: -webkit-linear-gradient(top, #1589FF, #2B60DE);  /* Safari 5.1+, Mobile Safari, Chrome 10+ */
			background-image: -moz-linear-gradient(top,  #1589FF,  #2B60DE); /* Firefox 3.6+ */
			background-image: -ms-linear-gradient(top, #1589FF, #2B60DE); /* IE 10+ */
			background-image: -o-linear-gradient(top, #1589FF, #2B60DE); /* Opera 11.10+ */
		}
		
	/* 
	  Border Grids
	*/
		/* Box Border & Color grids */
		.grid_0, .grid_1, .grid_2, .grid_3, .grid_4, .grid_5, .grid_6, .grid_7, .grid_8, .grid_9 {
			border: 2px solid #ccc;
		}
		.border1 {
			border: 1px solid #e9e9e9;
		}
		.bnt {
			border-top: 0;
		}
		
		/* Box Border Radiuses */
		.radius_5_all {
			-webkit-border-radius: 5px;
			-moz-border-radius: 5px;
			border-radius: 5px;
		}
		.radius_10_all {
			-webkit-border-radius: 10px;
			-moz-border-radius: 10px;
			border-radius: 10px;
		}
		.radius_10_top {
			-webkit-border-top-left-radius: 10px;
			-webkit-border-top-right-radius: 10px;
			-moz-border-radius-topleft: 10px;
			-moz-border-radius-topright: 10px;
			border-top-left-radius: 10px;
			border-top-right-radius: 10px;
		}
		.radius_10_bottom {
			-webkit-border-bottom-left-radius: 10px;
			-webkit-border-bottom-right-radius: 10px;
			-moz-border-radius-bottomleft: 10px;
			-moz-border-radius-bottomright: 10px;
			border-bottom-left-radius: 10px;
			border-bottom-right-radius: 10px;
		}
		.radius_5_top {
			-webkit-border-top-left-radius: 5px;
			-webkit-border-top-right-radius: 5px;
			-moz-border-radius-topleft: 5px;
			-moz-border-radius-topright: 5px;
			border-top-left-radius: 5px;
			border-top-right-radius: 5px;
		}
		.radius_5_bottom {
			-webkit-border-bottom-left-radius: 5px;
			-webkit-border-bottom-right-radius: 5px;
			-moz-border-radius-bottomleft: 5px;
			-moz-border-radius-bottomright: 5px;
			border-bottom-left-radius: 5px;
			border-bottom-right-radius: 5px;
		}
		
		
/* ===================================== */
	


.logoPlace {
	/* background: #fff; */
	background: transparent;
	height: 184px;
}
.advertPlace {
	background: url('assets/images/headeradd.png') center no-repeat;
	height: 82px;
	margin: 50px auto;
}
#main_wrapper  {
	background: #fff;
	border-top: 1px solid #333;
}
#menu_wrapper {
	background: transparent;
}

.menudark ul {
	padding-left: 0;
}
.menudark ul li {
	display: inline;
	padding: 10px 0;
	background: url('assets/images/lenta.png') right no-repeat;
}
.menudark ul li a {
	font-size: 1em;
	color: #fff;
	font-variant: small-caps;
	font-family: 'Open Sans';
	text-decoration: none;
	text-transform: capitalize;
}
.menudark ul li a span {
	padding-top: 15px;
	padding-bottom: 12px;
	padding-left: 10px;
	padding-right: 18px;
	display: inline;
}
.menudark ul li a:hover span {
	background: url('assets/images/strelka.png') top center no-repeat;
}
/* .menudark ul li a.active span {
	background: url('assets/images/strelka.png') top center no-repeat;
} */

#asidebar {
	background: transparent;
}

/* 
	User Login Panel
 */
.user, .pass {
	width: 88%;
	font-size: 1em;
	background: #fafafa;
	border: 1px solid #ccc;
	color: #777;
	height: 35px;
	padding-left: 8px;
}
.loginButton {
	width: 32%;
	font-size: 1em;
	background: #1589FF; /* za vsichki */
	filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#5CB3FF', endColorstr='#1589FF'); /* IE 7 & 8 */
	background-image: -webkit-gradient(linear, left top, left bottom, from(#5CB3FF), to(#1589FF)); /* Safari 4+, Chrome 1-9 */
	background-image: -webkit-linear-gradient(top, #5CB3FF, #1589FF);  /* Safari 5.1+, Mobile Safari, Chrome 10+ */
	background-image: -moz-linear-gradient(top,  #5CB3FF,  #1589FF); /* Firefox 3.6+ */
	background-image: -ms-linear-gradient(top, #5CB3FF, #1589FF); /* IE 10+ */
	background-image: -o-linear-gradient(top, #5CB3FF, #1589FF); /* Opera 11.10+ */
	color: #fff;
	border: 2px solid #1589FF;
	cursor: pointer;
	height: 35px;
}
.registerButton {
	font-size: 1em;
	cursor: pointer;
	font-weight: bold;
	font-family: 'Open Sans', san-serif;
	text-decoration: none;
}

input[type=text], input[type=submit], 
input[type=text]:hover,
input[type=text]:focus,
input[type=password],
input[type=password]:hover,
input[type=password]:focus  {
	outline: none;
}


@font-face {
  font-family: 'Open Sans';
  font-style: normal;
  font-weight: 700;
  src: local('Open Sans Bold'), local('OpenSans-Bold'), url(http://themes.googleusercontent.com/static/fonts/opensans/v6/k3k702ZOKiLJc3WVjuplzJ1r3JsPcQLi8jytr04NNhU.woff) format('woff');
}
@font-face {
  font-family: 'Open Sans';
  font-style: normal;
  font-weight: 300;
  src: local('Open Sans Light'), local('OpenSans-Light'), url(http://themes.googleusercontent.com/static/fonts/opensans/v6/DXI1ORHCpsQm3Vp6mXoaTZ1r3JsPcQLi8jytr04NNhU.woff) format('woff');
}
@font-face {
  font-family: 'Open Sans';
  font-style: normal;
  font-weight: 400;
  src: local('Open Sans'), local('OpenSans'), url(http://themes.googleusercontent.com/static/fonts/opensans/v6/K88pR3goAWT7BTt32Z01mz8E0i7KZn-EPnyo3HZu7kw.woff) format('woff');
}
.pagination {
    text-align: center;
    font-family: Arial;
	margin-bottom: 5px;
}

.pagination a.active, .pagination .inactive, .pagination .current {
    padding: 2px 7px;
    margin: 0 2px;
	
    border-radius: 4px;
}

.pagination a.active:hover, .pagination .current {
    background: #565656;
    color: #fff;
}

.pagination .inactive {
    color: #808080;
}
	</style>
	
</head>
<body onload="createGridder()">
	
	<section id="wrapper" class="mb_20">
		<header class="header width_956 auto textcenter pt_5">
			<a href="<?# LOGOLINK ?>" title="<?# DESC ?>"><img src="../martonbash.png" alt="banner advert nomer#1"/></a>
		</header>
		<div class="cleaner"></div>
		<div id="main_wrapper" class="grid_0 width_956 auto pt_10 radius_10_top pall_10">
			<section id="content_wrapper" class="clearfix auto">
				<section id="rightside" class="left width_956">