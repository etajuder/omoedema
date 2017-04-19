<!DOCTYPE html>
<html>


<head>
       <meta name="robots" content="noindex, nofollow">
    <meta name="googlebot" content="noindex, nofollow">

	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title id="title">Admin Area</title>
	
 
	<!-- bootstrap -->
        <?=App::Theme('css','bootstrap/bootstrap.css')?>
        <?=App::Theme('css','libs/font-awesome.css')?>
	<?=App::Theme('css','compiled/layout.css')?>
        <?=App::Theme('css','compiled/elements.css')?>
       
        
        <?=App::Theme('css','basic.css')?>
         <?=App::Theme('css','dropzone.css')?>
       
        <?=App::Theme('css','animate.css')?>
         <?=App::Theme('css','libs/morris.css')?>
         <?=App::Theme('css','libs/jquery-jvectormap-1.2.2.css')?>
        <?=App::Theme("css", "compiled/calendar.css")?>
        <?=App::Theme("css", "libs/fullcalendar.css")?>
        <?=App::Theme("css", "ns-style-theme.css","ondocrime")?>
        <?=App::Theme("css", "ns-style-other.css", "ondocrime")?>
        

    <?=App::Theme("css", "libs/fullcalendar.print.css")?>
    
	<!-- Favicon -->
	<link type="image/x-icon" href="favicon.png" rel="shortcut icon"/>
        <meta name="base" content="<?= base_url()?>" id="base" />
	<!-- google font libraries -->
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700,300|Titillium+Web:200,300,400' rel='stylesheet' type='text/css'>

	<!--[if lt IE 9]>
		<script src="js/html5shiv.js"></script>
		<script src="js/respond.min.js"></script>
	<![endif]-->
	<!--[if lt IE 8]>
		<link href="css/libs/font-awesome-ie7.css" type="text/css" rel="stylesheet" />
	<![endif]-->
	
</head>
<body>
	<header class="navbar" id="header-navbar">
		<div class="container">
			<a href="" id="logo" class="navbar-brand col-md-3 col-sm-3 col-xs-12">
			<span>My Admin Area</span>
			</a>
			
			<button class="navbar-toggle" data-target=".navbar-ex1-collapse" data-toggle="collapse" type="button">
				<span class="sr-only">Toggle navigation</span>
				<span class="fa fa-bars"></span>
			</button>
			
			<div class="nav-no-collapse pull-right" id="header-nav">
				<ul class="nav navbar-nav pull-right">
                                     
                                         
						
					
					<li class="mobile-search">
						<a class="btn">
							<i class="fa fa-search"></i>
						</a>
						
						
						
					</li>
					
					
					<li class="hidden-xs">
                                            <a class="btn" href="<?=  base_url()?>" target="_blank">
							<i class="fa fa-eye"></i>
						</a>
					</li>
					
					<li class="hidden-xxs">
                                            <a class="btn" href="<?=App::route('admin/logout')?>">
							<i class="fa fa-power-off"></i>
						</a>
					</li>
                                       
				</ul>
			</div>
		</div>
	</header>