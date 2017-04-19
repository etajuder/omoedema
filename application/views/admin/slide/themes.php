<div class="col-md-10" id="content-wrapper">
    <div class="row">
        <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Available Themes</h2>
                    
                </div>
            </div>
            
        </div>
    <?php foreach ($this->themeprovider->read_theme() as $list): ?>
     <?php $detail = $this->themeprovider->read_details($list['name'])?>
    <div class="col-md-5">
								<div class="main-box">
									<div class="clearfix">
										<h2 class="pull-left"> <?=$detail['name']?> </h2>
										
  										<div id="reportrange" class="pull-right daterange-filter">
											<i class="icon-calendar"></i>
                                                                                        <span></span> <?php if(App::getConfig('theme')==$detail['name']):?><span href="#" class="btn btn-success">
												<i class="fa fa-check"></i>
                                                                                        </span>  
                                                                                        <?php else: ?>
                                                                                        <a href="<?=App::route(modules::admin_route(), 'activatetheme?theme='.$detail['name'])?>" class="btn btn-default">
												<i class="fa fa-check"></i>
                                                                                        </a>  
                                                                                        <?php endif; ?>
                                                                                       
										</div>
  									</div>
  									
  									<div class="row">
  										<div class="col-md-12">
											<div id="graph-line" style="max-height: 290px;"></div>
										</div>
									</div>
                                                                    <div id="hero-donut" style="padding: 0; margin: 0;">
                                                                        <img src="<?=$detail['image']?>" style="width: 100%;" height="200" />
                                                                        <br><br><br>
                                                                        <p><b>Created By:</b> <?=$detail['Author']?></p>
                                                                        <p><b>Description:</b> <?=$detail['description']?></p>
                                                                    </div>
									
								</div>
        </div>
						
    <?php endforeach;?>
</div>