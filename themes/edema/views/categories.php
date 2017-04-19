<section class="block-inner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h1><?=$category_name?> News</h1>
                    <div class="breadcrumbs">
                        <ul>
                            <li><i class="pe-7s-home"></i> <a href="<?=  base_url()?>" title="<?=App::getConfig("site_name")?>">Home</a></li>
                            <li><a href="#" title="<?=$category_name?>"><?=$category_name?></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
<div class="" style="margin: 10px;">
        <div class="row">
            <aside class="col-sm-3 left-padding">
                
               
                <!-- social icon -->
                
                <!-- /.social icon -->
                 <div class="banner-add">
                    <!-- add -->
                    <span class="add-title">- Advertisement -</span>
                    <a href="#"><img src="<?=App::Assets()->getAsset("")?>images/ad-banner.jpg" class="img-responsive center-block" alt=""></a>
                </div>
                <div class="tab-inner">
                    <ul class="tabs">
                        <li><a href="#">HOT TRENDS</a></li>
                        <li><a href="#">MOST VIEWED</a></li>
                    </ul>
                    <hr>
                    <!-- tabs -->
                    <div class="tab_content">
                        <div class="tab-item-inner">
                            <?php foreach ($site["news"]["hot_news"] as $pop_news):?>
                            <div class="box-item wow fadeIn" data-wow-duration="1s">
                                <div class="img-thumb">
                                    <a href="<?=$pop_news["link"]?>" rel="bookmark"><img class="entry-thumb" src="<?=$pop_news["picture"]?>" alt="" height="80" width="90"></a>
                                </div>
                                <div class="item-details">
                                    <h6 class="sub-category-title bg-color-1">
                                        <a href="<?=App::route(url_title($pop_news["title"]))?>"><?=$pop_news["name"]?></a>
                                        </h6>
                                    <h3 class="td-module-title"><a href="<?=$pop_news["link"]?>"><?=$pop_news["title"]?></a></h3>
                                    <div class="post-editor-date">
                                        <!-- post date -->
                                        <div class="post-date">
                                            <i class="pe-7s-clock"></i> <?=$pop_news["created_at"]?>
                                        </div>
                                        <!-- post comment -->
                                        <div class="post-author-comment"><i class="pe-7s-comment"></i> 0 </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                        <!-- / tab item -->
                        <div class="tab-item-inner">
                            <?php foreach ($site["news"]["most_viewed"] as $most_view):?>
                            <div class="box-item">
                                <div class="img-thumb">
                                    <a href="<?=$most_view["link"]?>" rel="bookmark">
                                        <img class="entry-thumb" src="<?=$most_view["picture"]?>" alt="" height="80" width="90"></a>
                                </div>
                                <div class="item-details">
                                    <h6 class="sub-category-title bg-color-5">
                                        <a href="<?=App::route(url_title($most_view["name"]))?>"><?=$most_view["name"]?></a>
                                        </h6>
                                    <h3 class="td-module-title"><a href="<?=$most_view["link"]?>"><?=$most_view["title"]?></a></h3>
                                    <div class="post-editor-date">
                                        <!-- post date -->
                                        <div class="post-date">
                                            <i class="pe-7s-clock"></i> <?=$most_view["created_at"]?>
                                        </div>
                                        <!-- post comment -->
                                        <div class="post-author-comment"><i class="pe-7s-comment"></i> 0 </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                        <!-- / tab item -->
                    </div>
                    <!-- / tab_content -->
                </div>
                <div class="banner-add">
                    <!-- add -->
                    <span class="add-title">- Advertisement -</span>
                    <a href="#"><img src="<?=App::Assets()->getAsset("")?>images/ad-banner.jpg" class="img-responsive center-block" alt=""></a>
                </div>
                
            </aside>
            <div class="col-sm-6">
               <?php foreach ($category_news as $news_item):?>
                <!--Post list-->
                <div class="post-style2 wow fadeIn" data-wow-duration="1s">
                    <a href="<?=$news_item["link"]?>"><img src="<?=$news_item["picture"]?>" alt="<?=$news_item["title"]?>" style="width: 250px; height: 205px;"></a>
                    <div class="post-style2-detail">
                        <h3><a href="<?=$news_item["link"]?>" title=""><?=$news_item["title"]?></a></h3>
                        <div class="date">
                            <ul>
                                <li><a title="" href="#"><?=$news_item["created_at"]?></a> --</li>
                                <li><a title="" href="#"><span>0 Comments</span></a></li>
                            </ul>
                        </div>
                        <p><?=$news_item["body_short_desc"]?></p>
                        <a href="<?=$news_item["link"]?>" type="button" class="btn btn-style">Read more..</a>
                    </div>
                </div>
               <?php endforeach;?>
                <!-- pagination -->
        <?php if($pagin_value >= 1):?>
            
                <div class="col-sm-12">
                    <ul class="pagination">
                         <?php if($page > 1 ):?>
                        <li>
                            <a href="<?=  App::route(url_title($category_name)."?page=").($page -1)?>" class="prev">
                                <i class="pe-7s-angle-left"></i>
                            </a>
                        </li>
                        <?php endif;?>
                        <?php for($i=1; $i<= $pagin_value; $i++):?>
                       
                        <li class="<?php if($page == $i):?>active <?php endif;?>"> <a href="<?=  App::route(url_title($category_name)."?page=").$i?>"><?=$i?></a></li>
                        <?php endfor;?>
                        <?php if($pagin_value > $page):?>
                        <li>
                            <a href="<?=  App::route(url_title($category_name)."?page=").($page+ 1)?>" class="next"> <i class="pe-7s-angle-right"></i></a>
                        </li>
                        <?php endif;?>
                    </ul>
                </div>
                <div class="col-sm-12">
                    <div class="banner">
                        <img src="<?=App::Assets()->getAsset("")?>images/top-bannner2.jpg" class="img-responsive center-block" alt="">
                    </div>
                </div>
            
        
        <?php endif;?>
            </div>
            
            <aside class="col-sm-3 left-padding">
                
                <div class="col-md-12">
                <div class="fb-page" data-href="https://www.facebook.com/facebook" data-tabs="timeline" data-width="300" data-height="200" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div>
                </div>
               
                <!-- /.social icon -->
                 <div class="banner-add">
                    <!-- add -->
                    <span class="add-title">- Advertisement -</span>
                    <a href="#"><img src="<?=App::Assets()->getAsset("")?>images/ad-banner.jpg" class="img-responsive center-block" alt=""></a>
                </div>
                <div class="tab-inner">
                    <ul class="tabs">
                        <li><a href="#">POPULAR</a></li>
                        <li><a href="#">MOST VIEWED</a></li>
                    </ul>
                    <hr>
                    <!-- tabs -->
                    <div class="tab_content">
                        <div class="tab-item-inner">
                            <?php foreach ($site["news"]["popular"] as $pop_news):?>
                            <div class="box-item wow fadeIn" data-wow-duration="1s">
                                <div class="img-thumb">
                                    <a href="<?=$pop_news["link"]?>" rel="bookmark"><img class="entry-thumb" src="<?=$pop_news["picture"]?>" alt="" height="80" width="90"></a>
                                </div>
                                <div class="item-details">
                                    <h6 class="sub-category-title bg-color-1">
                                        <a href="<?=App::route(url_title($pop_news["title"]))?>"><?=$pop_news["name"]?></a>
                                        </h6>
                                    <h3 class="td-module-title"><a href="<?=$pop_news["link"]?>"><?=$pop_news["title"]?></a></h3>
                                    <div class="post-editor-date">
                                        <!-- post date -->
                                        <div class="post-date">
                                            <i class="pe-7s-clock"></i> <?=$pop_news["created_at"]?>
                                        </div>
                                        <!-- post comment -->
                                        <div class="post-author-comment"><i class="pe-7s-comment"></i> 0 </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                        <!-- / tab item -->
                        <div class="tab-item-inner">
                            <?php foreach ($site["news"]["most_viewed"] as $most_view):?>
                            <div class="box-item">
                                <div class="img-thumb">
                                    <a href="<?=$most_view["link"]?>" rel="bookmark">
                                        <img class="entry-thumb" src="<?=$most_view["picture"]?>" alt="" height="80" width="90"></a>
                                </div>
                                <div class="item-details">
                                    <h6 class="sub-category-title bg-color-5">
                                        <a href="<?=App::route(url_title($most_view["name"]))?>"><?=$most_view["name"]?></a>
                                        </h6>
                                    <h3 class="td-module-title"><a href="<?=$most_view["link"]?>"><?=$most_view["title"]?></a></h3>
                                    <div class="post-editor-date">
                                        <!-- post date -->
                                        <div class="post-date">
                                            <i class="pe-7s-clock"></i> <?=$most_view["created_at"]?>
                                        </div>
                                        <!-- post comment -->
                                        <div class="post-author-comment"><i class="pe-7s-comment"></i> 0 </div>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach;?>
                        </div>
                        <!-- / tab item -->
                    </div>
                    <!-- / tab_content -->
                </div>
                <div class="banner-add">
                    <!-- add -->
                    <span class="add-title">- Advertisement -</span>
                    <a href="#"><img src="<?=App::Assets()->getAsset("")?>images/ad-banner.jpg" class="img-responsive center-block" alt=""></a>
                </div>
                
            </aside>
        </div>
        
    </div>