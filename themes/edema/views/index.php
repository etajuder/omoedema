    <!-- newsfeed Area
        ============================================ -->
    <section class="news-feed">
        <div class="container">
            <div class="row row-margin">
                <?php foreach ($site["news"]["front_row"] as $front_news):?>
                <div class="col-sm-4 hidden-xs col-padding">
                    <div class="post-wrapper wow fadeIn" data-wow-duration="2s">
                        <div class="post-thumb img-zoom-in">
                            <a href="#">
                                <img class="entry-thumb" src="<?=$front_news["picture"]?>" alt="">
                            </a>
                        </div>
                        <div class="post-info">
                            <span class="color-1"><?=$front_news["name"]?> </span>
                            <h3 class="post-title post-title-size"><a href="<?=$front_news["link"]?>" rel="bookmark"><?=$front_news["title"]?> </a></h3>
                            <div class="post-editor-date">
                                <!-- post date -->
                                <div class="post-date">
                                    <i class="pe-7s-clock"></i> <?=$front_news["created_at"]?>
                                </div>
                                <!-- post comment -->
                                <div class="post-author-comment"><i class="pe-7s-comment"></i> 0 </div>
                                <!-- read more -->
                                <a class="readmore pull-right" href="<?=$front_news["link"]?>"><i class="pe-7s-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-8">
                <!-- left content inner -->
                <section class="recent_news_inner">
                    <h3 class="category-headding ">Hot Trends</h3>
                    <div class="headding-border"></div>
                    <div class="row">
                        <div id="hotnews-slide" class="owl-carousel">
                            <?php foreach ($site["news"]["hot_news"]  as $recent_news):?>
                            <!-- item-1 -->
                            <div class="item">
                                <div class="post-wrapper wow fadeIn" data-wow-duration="1s">
                                    <!-- image -->
                                    <h3><a href="<?=$recent_news["link"]?>"><?=  word_limiter($recent_news["title"],4)?></a></h3>
                                    <div class="post-thumb">
                                        <a href="#">
                                            <img class="img-responsive" src="<?=$recent_news["picture"]?>" alt="" style="width: 327px; height: 262.25px;">
                                        </a>
                                    </div>
                                    <div class="post-info meta-info-rn">
                                        <div class="slide">
                                            <a target="_blank" href="<?=App::route(url_title($recent_news["name"]))?>" class="post-badge btn btn-danger "><?=$recent_news["name"]?></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-title-author-details">
                                    <div class="post-editor-date">
                                        <div class="post-date">
                                            <i class="pe-7s-clock"></i> <?=$recent_news["created_at"]?>
                                        </div>
                                        <div class="post-author-comment"><i class="pe-7s-comment"></i> 0 </div>
                                    </div>
                                    <p><?=$recent_news["body_short_desc"]?> <a href="<?=$recent_news["link"]?>">Read more...</a></p>
                                </div>
                            </div>
                           <?php endforeach; ?> 
                        </div>
                    </div>
                    
                </section>
                <!-- Politics Area
                <!-- left content inner -->
                <section class="recent_news_inner">
                    <h3 class="category-headding ">Recent News</h3>
                    <div class="headding-border"></div>
                    <div class="row">
                        <div id="content-slide" class="owl-carousel">
                            <?php foreach ($site["news"]["recent_news"]  as $recent_news):?>
                            <!-- item-1 -->
                            <div class="item">
                                <div class="post-wrapper wow fadeIn" data-wow-duration="1s">
                                    <!-- image -->
                                    <h3><a href="<?=$recent_news["link"]?>"><?=  word_limiter($recent_news["title"],4)?></a></h3>
                                    <div class="post-thumb">
                                        <a href="#">
                                            <img class="img-responsive" src="<?=$recent_news["picture"]?>" alt="" style="width: 327px; height: 262.25px;">
                                        </a>
                                    </div>
                                    <div class="post-info meta-info-rn">
                                        <div class="slide">
                                            <a target="_blank" href="<?=App::route(url_title($recent_news["name"]))?>" class="post-badge btn btn-danger "><?=$recent_news["name"]?></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="post-title-author-details">
                                    <div class="post-editor-date">
                                        <div class="post-date">
                                            <i class="pe-7s-clock"></i> <?=$recent_news["created_at"]?>
                                        </div>
                                        <div class="post-author-comment"><i class="pe-7s-comment"></i> 0 </div>
                                    </div>
                                    <p><?=$recent_news["body_short_desc"]?> <a href="<?=$recent_news["link"]?>">Read more...</a></p>
                                </div>
                            </div>
                           <?php endforeach; ?> 
                        </div>
                    </div>
                    
                </section>
                <!-- Politics Area
                    ============================================ -->
                <?php foreach ($site["categories"] as $cate):?>
                <?php if(count($cate["news"])  > 0):?>
                <?php $count =0 ?>
                <section class="<?=$cate["name"]?>_wrapper">
                    <h3 class="category-headding "><?=$cate["name"]?></h3>
                    <div class="headding-border"></div>
                    <div class="row">
                        <div id="content-slide-<?=$count?>" class="owl-carouse">
                            <!-- item-1 -->
                            <div class="item">
                                <div class="row">
                                    <!-- main post -->
                                    <?php foreach ($cate["news"] as $news):?>
                                    <?php if($count == 0):?>
                                    
                                    <div class="col-sm-6 col-md-6">
                                        <div class="post-wrapper wow fadeIn" data-wow-duration="2s">
                                            <!-- post title -->
                                            <h3><a href="<?=$news["link"]?>"><?=$news["title"]?></a></h3>
                                            <!-- post image -->
                                            <div class="post-thumb">
                                                <a href="<?=$news["link"]?>">
                                                    <img src="<?=$news["picture"]?>" class="img-responsive" alt="">
                                                </a>
                                            </div>
                                        </div>
                                        
                                        <div class="post-title-author-details">
                                            <div class="post-editor-date">
                                                <!-- post date -->
                                                <div class="post-date">
                                                    <i class="pe-7s-clock"></i> <?=$news["created_at"]?>
                                                </div>
                                                <!-- post comment -->
                                                <div class="post-author-comment"><i class="pe-7s-comment"></i> 0 </div>
                                            </div>
                                            <p><?=$news["body_short_desc"]?> <a href="<?=$news["link"]?>">Read more...</a></p>
                                        </div>
                                    </div>
                                    <?php $count++;?>
                                    <?php endif;?>
                                    <?php endforeach; ?>
                                    <!-- right side post -->
                                    <div class="col-sm-6 col-md-6">
                                        <div class="row rn_block">
                                              <?php $ind_index = 0;?>
                                            <?php foreach ($cate["news"] as $news):?>
                                            <?php if($ind_index != 0):?>
                                            <div class="col-xs-6 col-md-6 col-sm-6 post-padding">
                                                <!-- post image -->
                                                <div class="post-thumb wow fadeIn" data-wow-duration="1s" data-wow-delay="0.1s">
                                                    <a href="<?=$news["link"]?>">
                                                        <img style="width: 161px; height: 111px;" src="<?=$news["picture"]?>" class="img-responsive" alt="">
                                                    </a>
                                                </div>
                                                <div class="post-title-author-details">
                                                    <!-- post image -->
                                                    <h5><a href="<?=$news["link"]?>"><?=$news["title"]?> </a></h5>
                                                    <div class="post-editor-date">
                                                        <!-- post date -->
                                                        <div class="post-date">
                                                            <i class="pe-7s-clock"></i><?=$news["created_at"]?>
                                                        </div>
                                                        <!-- post comment -->
                                                        <div class="post-author-comment"><i class="pe-7s-comment"></i> 0 </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php endif;?>
                                            <?php $ind_index+=1 ?>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- item-2 -->
                            
                        </div>
                    </div>
                    <!-- /.row -->
                </section>
                <?php $count+=1; ?>
                <?php endif;?>
                <?php endforeach; ?>
                <!-- /.Politics -->
                <div class="ads">
                    <a href="#"><img src="<?=App::Assets()->getAsset("")?>images/top-bannner2.jpg" class="img-responsive center-block" alt=""></a>
                </div>
            </div>
            <!-- /.left content inner -->
            <div class="col-md-4 col-sm-4 left-padding">
                <!-- right content wrapper -->
                
                <div class="col-md-12">
                <div class="fb-page" data-href="https://www.facebook.com/facebook" data-tabs="timeline" data-width="300" data-height="200" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div>
                </div>
                <!-- /.search area -->
                <!-- twitter feed -->
                
                <!-- /.twitter feed -->
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
                <!-- / tab -->
            </div>
            <!-- side content end -->
        </div>
        <!-- row end -->
    </div>
    <!-- container end -->
    <!-- Weekly News Area
        ============================================ -->
    <section class="weekly-news-inner">
        <div class="container">
            <div class="row row-margin">
                <h3 class="category-headding ">Best Videos</h3>
                <div class="headding-border bg-color-1"></div>
                <div id="content-slide-4" class="o">
                    <?php foreach ($site["news"]["video_news"] as $vid_news):?>
                    <div class="item">
                        <div class="post-wrapper wow fadeIn" data-wow-duration="1s">
                            <div class="post-thumb img-zoom-in">
                                <a href="#">
                                    <img class="entry-thumb" src="<?=$vid_news["picture"]?>" alt="<?=$vid_news["title"]?>">
                                </a>
                            </div>
                            <div class="post-info">
                                <span class="color-4"><?=$vid_news["name"]?> </span>
                                <h3 class="post-title"><a href="<?=$vid_news["link"]?>" rel="bookmark"> <?=$vid_news["title"]?></a></h3>
                                <div class="post-editor-date">
                                    <!-- post date -->
                                    <div class="post-date">
                                        <i class="pe-7s-clock"></i> <?=$vid_news["created-at"]?>
                                    </div>
                                    <!-- post comment -->
                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 0 </div>
                                    <!-- read more -->
                                    <a class="readmore pull-right" href="<?=$vid_news["link"]?>"><i class="pe-7s-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </section>
    <!-- second content -->
    
    <!-- second content end -->
    <div class="container">
        <!-- /.adds -->
        <div class="row">
            <div class="col-sm-12">
                <div class="ads">
                    <a href="#"><img src="<?=App::Assets()->getAsset("")?>images/top-bannner2.jpg" class="img-responsive center-block" alt=""></a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.adds-->
    <!-- all category  news Area
        ============================================ -->
    
    <!-- article section Area
        ============================================ -->
    
    <!-- footer Area
        ============================================ -->