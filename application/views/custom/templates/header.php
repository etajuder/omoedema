<header id="page-header">
                
            <div id="header-top" class="clearfix">

                <div class="wrapper">
                    <div class="row-fluid">
                        <div class="span12">
                        <?php if(App::getConfig('enable_breaking_news')==1):?>
                            <div class="kp-headline-wrapper clearfix">
                                <h6 class="kp-headline-title">Breaking News<span></span></h6>
                                <div class="kp-headline clearfix">                        
                                    <dl class="ticker-1 clearfix">
                                        <?php foreach($this->NewsProvider->getBreakingNews() as $break):?>
                                        <dt></dt>
                                        <dd><a><?=$break['title']?></a></dd>
                                        <?php endforeach; ?>
                                    </dl><!--ticker-1-->
                                </div><!--kp-headline-->
                            </div><!--kp-headline-wrapper-->
                         <?php endif; ?>
                            <div class="social-search-box">
                                                            
                                <ul class="social-links clearfix">
                                    <!-- facebook -->
                                    <li><a title="Facebook" href="http://facebook.com/<?=App::getConfig('facebk_page')?>" data-icon="&#xe1c3;"></a></li>
                                     <li><a title="Sykup" href="http://sykup.com/<?=App::getConfig('Sykup_page')?>" data-icon="&#xe1c11;"></a></li>                                  
                                    <!-- twitter -->
                                                                            <li><a title="Twitter" href="http://twitter.com/<?=App::getConfig('facebk_page')?>" data-icon="&#xe1c7;"></a></li>
                                                                        
                                                                    </ul><!--social-links-->
                                
                                <div class="sb-search-wrapper">
                                    <div id="sb-search" class="sb-search">
                                        <form method="get" >
                                            <input class="sb-search-input" placeholder="Enter your search term..." type="text" value="" name="s" id="search">
                                            <input class="sb-search-submit" type="submit" value="">
                                            <span class="sb-icon-search"></span>
                                        </form>
                                    </div><!--sb-search-->
                                </div><!--sb-search-wrapper-->
                                
                            </div><!--social-search-box-->                       
                        </div>
                    </div>
                </div>
                
            </div><!--header-top-->
            
            <div id="header-middle" class="clearfix">
                <div class="wrapper">
                    <div class="row-fluid">
                        <div class="span12">
                        
                            <div id="logo-image">
                                <a href="<?=base_url()?>"><img src="<?=App::Assets()->getImage('logo.png')?>" alt=""></a>
                                                            </div><!--logo-image-->
                            
                            <div class="top-banner">

                                <img src="<?=App::Assets()->getUploads()->getTestImage('468x60.gif')?>">
                                
                            </div><!--top-banner-->

                        </div>
                    </div>
                </div>
            </div><!--header-middle-->
            
            <div id="header-bottom">
                <div class="wrapper">
                    <nav id="main-nav">

                        <ul id="main-menu" class="menu clearfix">
                            <li class="menu-home-icon <?= Theme::CurrentPage("Home", "Home")?>"><a href="<?=base_url()?>">Home</a><span class="fa fa-home"></span></li>
                            <?php// foreach ($categories as $category): ?>
                           
                            <?php //endforeach; ?> 
                            </ul>
                        <div id="mobile-menu" class="menu-menu-container"><span>Menu</span>
                            <ul id="toggle-view-menu">
                                <li class="clearfix">
                                    <h3><a href="<?=base_url()?>">Home</a>
                                    </h3>
                                </li>
                         
                            <?php //foreach ($categories as $category): ?>

                            
                            <?php// endforeach; ?> 
</ul>
           </div>                        
                    </nav><!--main-nav-->
                </div>
           </div><!--header-bottom-->
        
        </header><!--page-header-->