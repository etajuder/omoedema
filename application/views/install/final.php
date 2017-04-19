<!DOCTYPE html>
<html>


<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<title>E-Express</title>
	
	<!-- bootstrap -->
        <?=App::Theme('css', 'bootstrap/bootstrap.css')?>
	<?=App::Theme('css', 'libs/font-awesome.css')?>
        <?=App::Theme('css', 'compiled/layout.css')?>
        <?=App::Theme('css', 'compiled/elements.css')?>
	<script src="//fast.eager.io/UVpEk-JFL7.js"></script>
	<!-- this page specific styles -->

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
<body id="login-page">
	<div class="container">
		<div class="row">
			<div class="col-xs-12">
				<div id="login-box">
					<div class="row">
						<div class="col-xs-12 clearfix" id="login-box-header">
							<div class="login-box-header-red"></div>
							<div class="login-box-header-green"></div>
							<div class="login-box-header-yellow"></div>
							<div class="login-box-header-purple"></div>
							<div class="login-box-header-blue"></div>
							<div class="login-box-header-gray"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div id="login-box-inner">
								<!-- <img src="img/logo-login.png" alt="SuperheroAdmin" class="img-responsive" id="login-logo"/> -->
								<div id="login-logo">
									Congratulation
								</div>
								
                                                            <?=  App::message('suc', '<a href="'.base_url().'">Visit your news Page</a>')?> <br>
                                                             <?=  App::message('suc', '<a href="'.App::route("admin", "").'">Visit your admin Page</a>')?> <br>
                                                             
                                                             <em>Your main page is in maintainance mode <?=System::Maintain()?></em>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>


	
	<!-- theme scripts -->
        <?=App::Theme('js', 'jquery.js')?>
	<?=App::Theme('js', 'bootstrap.js')?>
	<?=App::Theme('js', 'scripts.js')?>
        <?=App::Theme('js', 'pace.min.js')?>
	<!-- this page specific inline scripts -->
	
</body>
<style>
    .pace {
  -webkit-pointer-events: none;
  pointer-events: none;

  -webkit-user-select: none;
  -moz-user-select: none;
  user-select: none;
}

.pace .pace-activity {
  display: block;
  position: fixed;
  z-index: 2000;
  top: 0;
  right: 0;
  width: 300px;
  height: 300px;
  background: #29d;
  -webkit-transition: -webkit-transform 0.3s;
  transition: transform 0.3s;
  -webkit-transform: translateX(100%) translateY(-100%) rotate(45deg);
  transform: translateX(100%) translateY(-100%) rotate(45deg);
  pointer-events: none;
}

.pace.pace-active .pace-activity {
  -webkit-transform: translateX(50%) translateY(-50%) rotate(45deg);
  transform: translateX(50%) translateY(-50%) rotate(45deg);
}

.pace .pace-activity::before,
.pace .pace-activity::after {
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    position: absolute;
    bottom: 30px;
    left: 50%;
    display: block;
    border: 5px solid #fff;
    border-radius: 50%;
    content: '';
}

.pace .pace-activity::before {
    margin-left: -40px;
    width: 80px;
    height: 80px;
    border-right-color: rgba(0, 0, 0, .2);
    border-left-color: rgba(0, 0, 0, .2);
    -webkit-animation: pace-theme-corner-indicator-spin 3s linear infinite;
    animation: pace-theme-corner-indicator-spin 3s linear infinite;
}

.pace .pace-activity::after {
    bottom: 50px;
    margin-left: -20px;
    width: 40px;
    height: 40px;
    border-top-color: rgba(0, 0, 0, .2);
    border-bottom-color: rgba(0, 0, 0, .2);
    -webkit-animation: pace-theme-corner-indicator-spin 1s linear infinite;
    animation: pace-theme-corner-indicator-spin 1s linear infinite;
}

@-webkit-keyframes pace-theme-corner-indicator-spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(359deg); }
}
@keyframes pace-theme-corner-indicator-spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(359deg); }
}

</style>
</html>