<div class="container">
        <div class="row">
            <div class="col-sm-8">
                <article class="content">
                    <div class="post-thumb">
                        <?php if($news["has_video"]):?>
                            <?php if($news["is_youtube_video"]):?>
                        <iframe style="width: 100%;" height="315" src="https://www.youtube.com/embed/<?=$news["video"]?>" frameborder="0" allowfullscreen></iframe>
                           <?php else:?>
                        <?=$news["video"]?>
                        <?php endif;?>
                        <?php else:?>
                        <img src="<?=$news["picture"]?>" class="img-responsive post-image" alt="">
                        <?php endif;?>
                        <!-- /.social icon -->
                    </div>
                    <h1><?=$news["title"]?></h1>
                    <?=$news["body"]?>
                    
                    <?php if($news["has_audio"]):?>
                    <div class="audio_codec">
                        <img src="<?=App::Assets()->getImage("audio.jpg")?>" />
                        <?php if($is_logged_in):?>
                        <?php if($news["file_access"]):?>
                        
                        <form method='POST' action='https://voguepay.com/pay/'>

<input type='hidden' name='v_merchant_id' value='demo' />
<input type='hidden' name='merchant_ref' value='<?=  ENCRYPT::Encrypts($news["id"])?>' />
<input type='hidden' name='memo' value='Download of <?=$news["title"]?> Audio' />
<input type='hidden' name='success_url' value='<?=App::route("payment", "success")?>' />
<input type='hidden' name='fail_url' value='<?=App::route("payment", "failed")?>' />

<input type='hidden' name='developer_code' value='589343965b86e' />
<input type='hidden' name='method' value='Interswitch' />

<input type='hidden' name='cur' value='NGN' />

<input type='hidden' name='total' value='50' />

<input type='image' src='http://voguepay.com/images/buttons/buynow_blue.png' alt='Submit' /><br>
<a href="#" class="btn btn-success">₦50</a>
</form> 
    
    <?php else:?>
                        <a href="<?=App::route("download",  ENCRYPT::Encrypts($news["id"]))?>"> Download Audio</a>
                        <?php endif;?>
                        
                        
                        <?php else:?>
                         <a href="<?=App::route("register")?>">Register Download Audio(#<?=$news["price"]?>)</a>
                        <?php endif;?>
                          <?php if(!$news["file_access"]):?>
                        <div>
                        <audio controls="">
                            <source src="<?=$news["audio"]?>" >
                        </audio>
                        
                        </div> 
                       <?php endif;?>
                    </div>
                    <?php endif;?>
                    <div id="disqus_thread"></div>
<script>

/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/

var disqus_config = function () {
this.page.url = '<?=App::route($news["id"],  url_title($news["title"]))?>';  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = '<?="site-".$news["id"]?>'; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};

(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = '//omodema.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript">comments powered by Disqus.</a></noscript>
                    <!-- tags -->
                    <div class="related-news-inner">
                        <h3 class="category-headding ">RELATED NEWS</h3>
                        <div class="headding-border"></div>
                        <div class="row">
                            <div id="content-slide-5" class="owl-carousel owl-theme" style="opacity: 1; display: block;"><div class="owl-controls clickable"><div class="owl-buttons"><div class="owl-prev"><i class="fa pe-7s-angle-left"></i></div><div class="owl-next"><i class="fa pe-7s-angle-right"></i></div></div></div>
                                <!-- item-1 -->
                                <div class="owl-wrapper-outer">
                                    <div class="owl-wrapper">
                                        <div class="owl-item" style="width: 713px;">
                                            <div class="item">
                                     <div class="row rn_block">
                                         <?php foreach ($related_news as $news):?>
                                        <div class="col-xs-12 col-md-4 col-sm-4 padd">
                                            <div class="post-wrapper wow fadeIn" data-wow-duration="2s">
                                                <!-- image -->
                                                <div class="post-thumb">
                                                    <a href="<?=$news["link"]?>">
                                                        <img class="img-responsive" src="<?=$news["picture"]?>" alt="<?=$news["title"]?>">
                                                    </a>
                                                </div>
                                                <div class="post-info meta-info-rn">
                                                    <div class="slide">
                                                        <a target="_blank" href="<?=App::route(url_title($news["name"]))?>" class="post-badge"><?=$news["name"]?></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="post-title-author-details">
                                                <h4><a href="<?=$news["link"]?>"><?=$news["title"]?></a></h4>
                                                <div class="post-editor-date">
                                                    <div class="post-date">
                                                        <i class="pe-7s-clock"></i> <?=$news["created_at"]?>
                                                    </div>
                                                    <div class="post-author-comment"><i class="pe-7s-comment"></i> 0 </div>
                                                </div>
                                            </div>
                                        </div>
                                         <?php endforeach;?>
                                    </div>
                                            </div>
                                        </div>
                                       
                                    </div>
                                </div>
                                <!-- item-2 -->
                                
                            </div>
                        </div>
                    </div>
                    
                </article>
            </div>
            <div class="col-sm-4 left-padding">
                <aside class="sidebar">
                    <!-- /.search area -->
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
    </div>