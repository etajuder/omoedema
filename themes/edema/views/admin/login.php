<!DOCTYPE html>
<html>

<head>
<meta charset="UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
<title>Admin Login</title>
 
<script type="text/javascript">
//<![CDATA[
try{if (!window.CloudFlare) {var CloudFlare=[{verbose:0,p:0,byc:0,owlid:"cf",bag2:1,mirage2:0,oracle:0,paths:{cloudflare:"/cdn-cgi/nexp/dok3v=1613a3a185/"},atok:"a4d304dcba736bfcf61703ccc2843a2f",petok:"38e6e561760fffee1a5516279af40c3c254cda32-1437447325-1800",betok:"d359205a0db4450702bea27200399616f7c7fd24-1437447325-120",zone:"adbee.technology",rocket:"0",apps:{"ga_key":{"ua":"UA-49262924-2","ga_bs":"2"}}}];!function(a,b){a=document.createElement("script"),b=document.getElementsByTagName("script")[0],a.async=!0,a.src="../ajax.cloudflare.com/cdn-cgi/nexp/dok3v%3d7e13c32551/cloudflare.min.js",b.parentNode.insertBefore(a,b)}()}}catch(e){};
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
 
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300|Titillium+Web:200,300,400' rel='stylesheet' type='text/css'>
 
<link type="image/x-icon" href="favicon.png" rel="shortcut icon"/>
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
<body id="login-page">
<div class="container">
<div class="row">
<div class="col-xs-12">
<div id="login-box">
<div id="login-box-holder">
<div class="row">
<div class="col-xs-12">
<header id="login-header">
<div id="login-logo">
<img src="img/logo.png" alt=""/>
</div>
</header>
<div id="login-box-inner">
    <form role="form" action="" method="post">
<div class="input-group">
<span class="input-group-addon"><i class="fa fa-user"></i></span>
<input class="form-control" type="text" placeholder="username" name="username">
</div>
<div class="input-group">
<span class="input-group-addon"><i class="fa fa-key"></i></span>
<input type="password" class="form-control" name="password" placeholder="Password">
</div>
<div id="remember-me-wrapper">
<div class="row">
<div class="col-xs-6">
<div class="checkbox-nice">
<input type="checkbox" id="remember-me" checked="checked"/>
<label for="remember-me">
Remember me
</label>
</div>
</div>

</div>
</div>
<div class="row">
<div class="col-xs-12">
<button type="submit" class="btn btn-success col-xs-12">Login</button>
</div>
</div>

</form>
</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>

  <script src="<?=App::Assets()->getAsset("admin/js/demo-skin-changer.js")?>"></script>  
    <script src="<?=App::Assets()->getAsset("admin/js/jquery.js")?>"></script>
    <script src="<?=App::Assets()->getAsset("admin/js/bootstrap.js")?>"></script>
   

<script src="<?=App::Assets()->getAsset("admin/js/jquery.nanoscroller.min.js")?>"></script>
    <script src="<?=App::Assets()->getAsset("admin/js/demo.js")?>"></script>  
   <script src="<?=App::Assets()->getAsset("admin/js/scripts.js")?>"></script>
   
 
</body>

<!-- Mirrored from cube.adbee.technology/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 21 Jul 2015 03:02:42 GMT -->
</html>