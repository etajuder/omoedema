<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" href="images/fev-icon.png" />
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title><?=$site["title"]?></title>
    <!-- google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i|Ubuntu:300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="<?=App::Assets()->getAsset("")?>css/bootstrap.min.css">
    <!-- Scrollbar css -->
    <link rel="stylesheet" type="text/css" href="<?=App::Assets()->getAsset("")?>css/jquery.mCustomScrollbar.css" />
    <!-- Owl Carousel css -->
    <link rel="stylesheet" type="text/css" href="<?=App::Assets()->getAsset("")?>owl-carousel/owl.carousel.css" />
    <link rel="stylesheet" type="text/css" href="<?=App::Assets()->getAsset("")?>owl-carousel/owl.theme.css" />
    <link rel="stylesheet" type="text/css" href="<?=App::Assets()->getAsset("")?>owl-carousel/owl.transitions.css" />
    <!-- youtube css -->
    <link rel="stylesheet" type="text/css" href="<?=App::Assets()->getAsset("")?>css/RYPP.css" />
    <!-- jquery-ui css -->
    <link rel="stylesheet" href="<?=App::Assets()->getAsset("")?>css/jquery-ui.css">
    <!-- animate -->
    <link rel="stylesheet" href="<?=App::Assets()->getAsset("")?>css/animate.min.css">
    <!-- fonts css -->
    <link rel="stylesheet" href="<?=App::Assets()->getAsset("")?>font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="<?=App::Assets()->getAsset("")?>css/Pe-icon-7-stroke.css" />
    <link rel="stylesheet" type="text/css" href="<?=App::Assets()->getAsset("")?>css/flaticon.css" />
    <!-- custom css -->
    <link rel="stylesheet" href="<?=App::Assets()->getAsset("")?>css/style.css">
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.8&appId=1477660995577793";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>


<meta property="og:locale" content="en_US" />
<meta property="og:type" content="website" />
<meta property="og:title" content="<?=$site["title"]?>" />
<meta property="og:description" content="<?=$site["desc"]?>" />
<meta property="og:url" content="<?=App::route("")?>" />
<meta property="og:site_name" content="<?=App::getConfig("site_name")?>" />
<meta property="fb:app_id" content="1281965775160257" />
<meta property="og:image" content="<?=$site["logo"]?>" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:description" content="<?=$site["desc"]?>" />
<meta name="twitter:title" content="Home - <?=App::getConfig("site_name")?> News" />
<meta name="twitter:site" content="@<?=App::getConfig("site_name")?>" />
<meta name="twitter:image" content="<?=$site["logo"]?>" />
<meta name="twitter:creator" content="@wapjude" />

</head>

<body>
    <div class="se-pre-con"></div>
    <header>
        <!-- Mobile Menu Start -->
        <div class="mobile-menu-area navbar-fixed-top hidden-sm hidden-md hidden-lg">
            <nav class="mobile-menu" id="mobile-menu">
                <div class="sidebar-nav">
                    <ul class="nav side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                        <button class="btn mobile-menu-btn" type="button">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li><a href="<?=  base_url()?>">Home</a></li>
                        <li>
                            <a href="#">All pages<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="#">Home <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li><a href="home-style-one.html">Home style one</a> </li>
                                        <li><a href="home-style-two.html">Home style two</a></li>
                                        <li><a href="home-style-three.html">Home style three</a></li>
                                        <li><a href="home-style-four.html">Home style four</a></li>
                                        <li><a href="home-style-five.html">Home style five</a></li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                                <li>
                                    <a href="#">Categories <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li><a href="category-style-one.html">Category style one</a> </li>
                                        <li><a href="category-style-two.html">Category style two</a></li>
                                        <li><a href="category-style-three.html">Category style three</a></li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                                <li>
                                    <a href="#">Archive <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li><a href="archive-one.html">Archive style one</a> </li>
                                        <li><a href="archive-two.html">Archive style two</a></li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                                <li>
                                    <a href="#">News <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li><a href="details-style-one.html">News post one</a> </li>
                                        <li><a href="details-style-two.html">News post two</a></li>
                                        <li><a href="details-style-three.html">News post three</a></li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                                <li>
                                    <a href="#">Contact <span class="fa arrow"></span></a>
                                    <ul class="nav nav-third-level">
                                        <li><a href="contact-style-one.html">Contact style one</a> </li>
                                        <li><a href="contact-style-two.html">Contact style two</a></li>
                                    </ul>
                                    <!-- /.nav-third-level -->
                                </li>
                                <li><a href="login%26registration.html">Login & Registration</a></li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li><a href="#">International</a></li>
                        <li><a href="#">Fashion</a></li>
                        <li><a href="#">Travel</a></li>
                        <li><a href="#">Food</a></li>
                        <li><a href="#">Technology</a></li>
                        <li><a href="#">Lifestyle</a></li>
                        <li>
                            <a href="#">Contact<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="contact-style-one.html">Contact style one</a> </li>
                                <li><a href="contact-style-two.html">Contact style two</a></li>
                            </ul>
                        </li>
                        <!-- social icon -->
                        <li>
                            <div class="social">
                                <ul>
                                    <li><a href="#" class="facebook"><i class="fa  fa-facebook"></i> </a></li>
                                    <li><a href="#" class="twitter"><i class="fa  fa-twitter"></i></a></li>
                                    <li><a href="#" class="google"><i class="fa  fa-google-plus"></i></a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="container">
                <div class="top_header_icon">
                    <span class="top_header_icon_wrap">
                            <a target="_blank" href="#" title="Twitter"><i class="fa fa-twitter"></i></a>
                        </span>
                    <span class="top_header_icon_wrap">
                            <a target="_blank" href="#" title="Facebook"><i class="fa fa-facebook"></i></a>
                        </span>
                    <span class="top_header_icon_wrap">
                            <a target="_blank" href="#" title="Google"><i class="fa fa-google-plus"></i></a>
                        </span>
                    <span class="top_header_icon_wrap">
                            <a target="_blank" href="#" title="Vimeo"><i class="fa fa-vimeo"></i></a>
                        </span>
                    <span class="top_header_icon_wrap">
                            <a target="_blank" href="#" title="Pintereset"><i class="fa fa-pinterest-p"></i></a>
                        </span>
                </div>
                <div id="showLeft" class="nav-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
        <!-- Mobile Menu End -->
        <!-- top header -->
        <div class="top_header hidden-xs">
            <div class="container">
                <div class="row">
                    
                    <!--breaking news-->
                    <div class="col-sm-8 col-md-6">
                        <div class="newsticker-inner">
                            <ul class="newstickerd">
                                <li><span class="color-1 "></span><a href="#" style="color: #fff; font-style: italic;"> <marquee scrollamount="10" scrolldelay="1" direction="left"> <span style="margin-right: 15px;">Omo Edema</span>  ...bringing back sanity to the world through sincere informative presentation</marquee> </a></li>
                                
                            </ul>
                          
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-2">
                        <div class="top_header_icon">
                            <span class="top_header_icon_wrap">
                                    <a target="_blank" href="#" title="Twitter"><i class="fa fa-twitter"></i></a>
                                </span>
                            <span class="top_header_icon_wrap">
                                    <a target="_blank" href="#" title="Facebook"><i class="fa fa-facebook"></i></a>
                                </span>
                            <span class="top_header_icon_wrap">
                                    <a target="_blank" href="#" title="Google"><i class="fa fa-google-plus"></i></a>
                                </span>
                           
                        </div>
                    </div>
                   
                    <div class="col-md-4">
                         <form method="get" action="<?=App::route("search")?>">
                        <div class="input-group search-area" style="margin-top: 5px;">
                    <!-- search area -->
                   
                    <input class="form-control" placeholder="Search articles here ..." name="q" type="text">
                    <div class="input-group-btn">
                        <button class="btn btn-search" type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                    </div>
                   
                </div>
                              </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="top_banner_wrap">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 col-md-4 col-sm-4">
                        <div class="header-logo">
                            <!-- logo -->
                            <a href="<?=App::route("")?>">
                                <img class="td-retina-data img-responsive" src="<?=App::Assets()->getAsset("")?>images/logo.png" alt="">
                            </a>
                        </div>
                    </div>
                    <div class="col-xs-8 col-md-8 col-sm-8 hidden-xs">
                        <div class="header-banner">
                            <a href="#"><img class="td-retina img-responsive" src="<?=App::Assets()->getAsset("")?>images/top-bannner.jpg" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- navber -->
        <div class="container hidden-xs">
            <nav class="navbar">
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="<?=App::route("")?>" class="category01">Home</a></li>
                        <?php foreach ($site["categories"] as $cate):?>
                        <li><a href="<?=App::route(url_title($cate["name"]))?>" class="category01"><?=$cate["name"]?></a></li>
                        <?php endforeach;?>
                        <li><a href="<?=App::route("downloads")?>" class="category01">Download Content</a></li>
                        <li><a href="<?=App::route("about-us")?>" class="category01">About Us</a></li>
                        <li><a href="<?=App::route("contact-us")?>" class="category01">Contact Us</a></li>
                        
                    </ul>
                </div>
                <!-- navbar-collapse -->
            </nav>
        </div>
    </header>
      <?php Theme::Section($theme["inject"]) ?>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="footer-box footer-logo-address col-md-4">
                        <!-- address  -->
                        <img src="<?=App::Assets()->getAsset("")?>images/logo-footer.png" class="img-responsive" alt="">
                        <address>
                            14L.E Goulburn St, Sydney 2000NSW
                             Tell: 01922296392
                            Email: <a class="__cf_email__" href="http://news365.bdtask.com/cdn-cgi/l/email-protection" data-cfemail="abc9cfdfcad8c0ebccc6cac2c785c8c4c6">[email&#160;protected]</a><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script>
                        </address>
                    </div>
                    <div class="col-md-4">
                        <h3 class="category-headding">POPULAR TAGS</h3>
                        <div class="headding-border"></div>
                        <?php foreach ($site["categories"] as $cate):?>
                        <a class="tag" href="<?=App::route(url_title($cate["name"]))?>" title=""><?=$cate["name"]?></a>
                        <?php endforeach; ?>
                    </div>
                        <div class="newsletter-inner col-md-4">
                            <!-- newsletter -->
                            <h3 class="category-headding ">NEWSLETTER</h3>
                            <div class="headding-border"></div>
                            <p>Enter your email address for our mailing list!</p>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                            <button type="button" class="btn btn-style">Subscribe</button>
                        </div>
                        <!-- /.newsletter -->
                    <!-- /.address  -->
                </div>
               
            </div>
        </div>
    </footer>
    <div class="sub-footer">
        <!-- sub footer -->
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <p><a href="<?=App::route("")?>" class="color-1"><?=App::getConfig("site_name")?></a> | All right Reserved <?=  date("Y")?></p>
                    <div class="social">
                        <ul>
                            <li><a href="#" class="facebook"><i class="fa  fa-facebook"></i> </a></li>
                            <li><a href="#" class="twitter"><i class="fa  fa-twitter"></i></a></li>
                            <li><a href="#" class="google"><i class="fa  fa-google-plus"></i></a></li>
                            <li><a href="#" class="flickr"><i class="fa fa-flickr"></i></a></li>
                           
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.sub footer -->
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script type="text/javascript" src="<?=App::Assets()->getAsset("")?>js/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script type="text/javascript" src="<?=App::Assets()->getAsset("")?>js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script type="text/javascript" src="<?=App::Assets()->getAsset("")?>js/metisMenu.min.js"></script>
    <!-- Scrollbar js -->
    <script type="text/javascript" src="<?=App::Assets()->getAsset("")?>js/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- animate js -->
    <script type="text/javascript" src="<?=App::Assets()->getAsset("")?>js/wow.min.js"></script>
    <!-- Newstricker js -->
    <script type="text/javascript" src="<?=App::Assets()->getAsset("")?>js/jquery.newsTicker.js"></script>
    <!--  classify JavaScript -->
    <script type="text/javascript" src="<?=App::Assets()->getAsset("")?>js/classie.js"></script>
    <!-- owl carousel js -->
    <script type="text/javascript" src="<?=App::Assets()->getAsset("")?>owl-carousel/owl.carousel.js"></script>
    <!-- youtube js -->
    <script type="text/javascript" src="<?=App::Assets()->getAsset("")?>js/RYPP.js"></script>
    <!-- jquery ui js -->
    <script type="text/javascript" src="<?=App::Assets()->getAsset("")?>js/jquery-ui.js"></script>
    <!-- form -->
    <script type="text/javascript" src="<?=App::Assets()->getAsset("")?>js/form-classie.js"></script>
    <!-- custom js -->
    <script type="text/javascript" src="<?=App::Assets()->getAsset("")?>js/custom.js"></script>
    <script id="dsq-count-scr" src="//omodema.disqus.com/count.js" async></script>
</body>


<!-- Mirrored from news365.bdtask.com/Demo/DemoNews365/home-style-one.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 23 Jan 2017 17:16:34 GMT -->
</html>
