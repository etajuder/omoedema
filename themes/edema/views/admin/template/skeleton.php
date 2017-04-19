<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<title>Admin-<?=App::getConfig("site_name")?></title>
 
<script type="text/javascript">
//<![CDATA[
try{if (!window.CloudFlare) {var CloudFlare=[{verbose:0,p:0,byc:0,owlid:"cf",bag2:1,mirage2:0,oracle:0,paths:{cloudflare:"/cdn-cgi/nexp/dok3v=1613a3a185/"},atok:"a4d304dcba736bfcf61703ccc2843a2f",petok:"c525c3a420c2296313fd056660a6c6b60681a479-1437447294-1800",betok:"dd7d4a3e593112a46bb63756874eaa89c270e95a-1437447294-120",zone:"adbee.technology",rocket:"0",apps:{"ga_key":{"ua":"UA-49262924-2","ga_bs":"2"}}}];!function(a,b){a=document.createElement("script"),b=document.getElementsByTagName("script")[0],a.async=!0,a.src="../ajax.cloudflare.com/cdn-cgi/nexp/dok3v%3d7e13c32551/cloudflare.min.js",b.parentNode.insertBefore(a,b)}()}}catch(e){};
//]]>
</script>
<link rel="stylesheet" type="text/css" href="<?=App::Assets()->getAsset("admin/css/bootstrap/bootstrap.min.css")?>"/>
 
<script src="<?=App::Assets()->getAsset("admin/js/demo-rtl.js")?>"></script>
 
 
<link rel="stylesheet" type="text/css" href="<?=App::Assets()->getAsset("admin/css/libs/font-awesome.css")?>"/>
<link rel="stylesheet" type="text/css" href="<?=App::Assets()->getAsset("admin/css/libs/nanoscroller.css")?>"/>
 
<link rel="stylesheet" type="text/css" href="<?=App::Assets()->getAsset("admin/css/compiled/theme_styles.css")?>"/>
 
<link rel="stylesheet" href="<?=App::Assets()->getAsset("admin/css/libs/daterangepicker.css")?>" type="text/css"/>
<link rel="stylesheet" href="<?=App::Assets()->getAsset("admin/css/libs/jquery-jvectormap-1.2.2.css")?>" type="text/css"/>
<link rel="stylesheet" href="<?=App::Assets()->getAsset("admin/css/libs/weather-icons.css")?>" type="text/css"/>
 
<link type="image/x-icon" href="favicon.png" rel="shortcut icon"/>
 
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300' rel='stylesheet' type='text/css'>
<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>
	<![endif]-->
<script type="text/javascript">
/* <![CDATA[ */
var _gaq = _gaq || [];
_gaq.push(['_setAccount', 'UA-49262924-2']);
_gaq.push(['_trackPageview']);

(function() {
var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
})();

(function(b){(function(a){"__CF"in b&&"DJS"in b.__CF?b.__CF.DJS.push(a):"addEventListener"in b?b.addEventListener("load",a,!1):b.attachEvent("onload",a)})(function(){"FB"in b&&"Event"in FB&&"subscribe"in FB.Event&&(FB.Event.subscribe("edge.create",function(a){_gaq.push(["_trackSocial","facebook","like",a])}),FB.Event.subscribe("edge.remove",function(a){_gaq.push(["_trackSocial","facebook","unlike",a])}),FB.Event.subscribe("message.send",function(a){_gaq.push(["_trackSocial","facebook","send",a])}));"twttr"in b&&"events"in twttr&&"bind"in twttr.events&&twttr.events.bind("tweet",function(a){if(a){var b;if(a.target&&a.target.nodeName=="IFRAME")a:{if(a=a.target.src){a=a.split("#")[0].match(/[^?=&]+=([^&]*)?/g);b=0;for(var c;c=a[b];++b)if(c.indexOf("url")===0){b=unescape(c.split("=")[1]);break a}}b=void 0}_gaq.push(["_trackSocial","twitter","tweet",b])}})})})(window);
/* ]]> */
</script>
</head>
<body>
<div id="theme-wrapper">
<header class="navbar" id="header-navbar">
<div class="container">
    <a href="<?=App::route("superuser")?>" id="logo" class="navbar-brand">
<?=App::getConfig("site_name")?>
</a>
<div class="clearfix">
<button class="navbar-toggle" data-target=".navbar-ex1-collapse" data-toggle="collapse" type="button">
<span class="sr-only">Toggle navigation</span>
<span class="fa fa-bars"></span>
</button>
<div class="nav-no-collapse navbar-left pull-left hidden-sm hidden-xs">
<ul class="nav navbar-nav pull-left">
<li>
<a class="btn" id="make-small-nav">
<i class="fa fa-bars"></i>
</a>
</li>


</ul>
</div>
<div class="nav-no-collapse pull-right" id="header-nav">
<ul class="nav navbar-nav pull-right">

<li class="dropdown profile-dropdown">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<span class="hidden-xs"><?=$user["username"]?></span> <b class="caret"></b>
</a>
<ul class="dropdown-menu dropdown-menu-right">
<li><a href="<?=App::route("superuser/logout")?>"><i class="fa fa-power-off"></i>Logout</a></li>
</ul>
</li>
<li class="hidden-xxs">
<a class="btn" href="<?=App::route("superuser/logout")?>">
<i class="fa fa-power-off"></i>
</a>
</li>
</ul>
</div>
</div>
</div>
</header>
<div id="page-wrapper" class="container">
<div class="row">
<div id="nav-col">
<section id="col-left" class="col-left-nano">
<div id="col-left-inner" class="col-left-nano-content">
<div id="user-left-box" class="clearfix hidden-sm hidden-xs dropdown profile2-dropdown">
    
<div class="user-box">
<span class="name">
<a href="#" class="dropdown-toggle" data-toggle="dropdown">
<?=$user["username"]?>
<i class="fa fa-angle-down"></i>
</a>
<ul class="dropdown-menu">
<li><a href="user-profile.html"><i class="fa fa-user"></i>Profile</a></li>
<li><a href="#"><i class="fa fa-cog"></i>Settings</a></li>
<li><a href="#"><i class="fa fa-envelope-o"></i>Messages</a></li>
<li><a href="<?=App::route("superuser/logout")?>"><i class="fa fa-power-off"></i>Logout</a></li>
</ul>
</span>
<span class="status">
<i class="fa fa-circle"></i> Online
</span>
</div>
</div>
<div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav">
<ul class="nav nav-pills nav-stacked">
<li class="nav-header nav-header-first hidden-sm hidden-xs">
Navigation
</li>
<li class="active">
    <a href="<?=App::route("superuser")?>">
<i class="fa fa-dashboard"></i>
<span>Dashboard</span>

</a>
</li>
<li>
    <a href="<?=App::route("superuser/categories")?>">
<i class="fa fa-edit"></i>
<span>Categories</span>
</a>
</li>
<li>
    <a href="<?=App::route("superuser/settings")?>">
<i class="fa fa-gear"></i>
<span>Settings</span>
</a>
</li>

<li>
    <a href="<?=App::route("superuser/add_news")?>">
<i class="fa fa-gear"></i>
<span>Add News</span>
</a>
</li>
<li>
    <a href="<?=App::route("superuser/news")?>">
<i class="fa fa-gear"></i>
<span>Manage News</span>
</a>
</li>


<li>
    <a href="<?=App::route("superuser/users")?>">
<i class="fa fa-gear"></i>
<span>Manage Users</span>
</a>
</li>

<li>
    <a href="<?=App::route("superuser/ads")?>">
<i class="fa fa-gear"></i>
<span>Manage Ads</span>
</a>
</li>
<li>
    <a href="<?=App::route("superuser/design")?>">
<i class="fa fa-gear"></i>
<span>Page Design</span>
</a>
</li>
</ul>
</div>
</div>
</section>
<div id="nav-col-submenu"></div>
</div>
<div id="content-wrapper">
<div class="row">
<div class="col-lg-12">
<div class="row">
<div class="col-lg-12">
<div id="content-header" class="clearfix">
<div class="pull-left">
<ol class="breadcrumb">
    <li><a href="<?=App::route("superuser")?>">Home</a></li>
<li class="active"><span><?=$page["name"]?></span></li>
</ol>
<h1><?=$page["name"]?></h1>
</div>

</div>
</div>
</div>
   <!-- //Inject View -->
    
<?php Theme::Section($theme["inject"])?>


<!--End Inject View-->


</div>
</div>
<footer id="footer-bar" class="row">
<p id="footer-copyright" class="col-xs-12">
    Site by <?=App::getConfig("site_name")?>.
</p>
</footer>
</div>
</div>
</div>
</div>
 
    <script src="<?=App::Assets()->getAsset("admin/js/demo-skin-changer.js")?>"></script>  
    <script src="<?=App::Assets()->getAsset("admin/js/jquery.js")?>"></script>
    <script src="<?=App::Assets()->getAsset("admin/js/bootstrap.js")?>"></script>
    <script src="<?=App::Assets()->getAsset("admin/js/jquery.nanoscroller.min.js")?>"></script>
    <script src="<?=App::Assets()->getAsset("admin/js/demo.js")?>"></script>  
    <script src="<?=App::Assets()->getAsset("admin/js/jquery.form.js")?>"></script>  
   <script src="<?=App::Assets()->getAsset("admin/js/jquery.slimscroll.min.js")?>"></script>
    <script src="<?=App::Assets()->getAsset("admin/js/moment.min.js")?>"></script>
    <script src="<?=App::Assets()->getAsset("admin/js/jquery-jvectormap-1.2.2.min.js")?>"></script>
    <script src="<?=App::Assets()->getAsset("admin/js/jquery-jvectormap-world-merc-en.js")?>"></script>
    <script src="<?=App::Assets()->getAsset("admin/js/gdp-data.js")?>"></script>
   <script src="<?=App::Assets()->getAsset("admin/js/skycons.js")?>"></script>
 
    <script src="<?=App::Assets()->getAsset("admin/js/scripts.js")?>"></script>
    <script src="<?=App::Assets()->getAsset("admin/js/pace.min.js")?>"></script>
    
 
<script>
    var base_path = '<?=  base_url()?>';
	
	</script>
</body>

<!-- Mirrored from cube.adbee.technology/ by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Jul 2015 02:54:57 GMT -->
</html>