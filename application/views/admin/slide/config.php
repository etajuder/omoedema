<div class="col-md-10" id="content-wrapper">
				<div style="opacity: 1; transform: translateY(0px);" class="row">
					<div class="col-lg-12">
					
						<h1>Edit Configuration</h1>
					
						<div class="row">
							<div class="col-lg-6">
								<div class="main-box">
									<h2>Fill Form</h2>
                                                                        <?=@$this->session->flashdata('item')?>
                                                                        <form role="form" method="post" action="<?=App::route(modules::admin_route(), 'configs')?>" enctype="multipart/form-data">
                                                                                
										<div class="form-group">
                                                                                    
											<label for="exampleInputEmail1">Site Name</label>
                                                                                        <input class="form-control"  name="stname" id="exampleInputEmail1" value="<?=$this->adminmd->getConfig()['site_name']?>" type="text">
										</div>
										
										<div class="form-group">
											<label for="exampleTextarea">Site Description</label>
                                                                                        <textarea class="form-control" id="exampleTextarea" rows="3" name="desc"><?=$this->adminmd->getConfig()['site_description']?></textarea>
										</div>
                                                                                 <div class="form-group">
											<label for="exampleTextarea">About Site</label>
                                                                                        <textarea class="form-control" id="exampleTextarea" rows="3" name="keyw"><?=$this->adminmd->getConfig()['site_keywords']?></textarea>
										</div>
										
										<div class="form-group">
											<label for="exampleTooltip">Hot Line</label>
                                                                                        <input name="fbp" value="<?=$this->adminmd->getConfig()['facebk_page']?>" data-original-title="very nice tooltip about this field" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="" type="text">
										</div>
                                                                            <div class="form-group">
											<label for="exampleInputPassword1">Email</label>
                                                                                        <input class="form-control"  name="twp" value="<?=$this->adminmd->getConfig()['tweet_page']?>" id="exampleInputPassword1" placeholder="Details" type="text">
									   </div>
                                                                            <div class="form-group">
											<label for="exampleInputPassword1">Sykup Page</label>
                                                                                        <input class="form-control"  name="syk" value="<?=$this->adminmd->getConfig()['Sykup_page']?>" id="exampleInputPassword1" placeholder="Details" type="text">
									   </div>
                                                                             <div class="form-group">
											<label for="exampleInputPassword1">Admin Email</label>
                                                                                        <input class="form-control"  name="bkn" value="<?=$this->adminmd->getConfig()['enable_breaking_news']?>" id="exampleInputPassword1" placeholder="Details" type="text">
									   </div>
                                                                            <div class="form-group">
											<label for="exampleTooltip">Maintainance mode</label>
                                                                                        <input class="form-control" type="text" value="<?=$this->adminmd->getConfig()['maintainance_mode']?>" name="maintain">
									    </div>
										                                 <div class="form-group">
											<label for="exampleTooltip">Word Limit</label>
                                                                                        <input class="form-control" type="text" value="<?=$this->adminmd->getConfig()['word_limit']?>" name="limit">
									                        </div>
                                                                                         <div class="form-group">
											<label for="exampleTooltip">Admin Route</label>
                                                                                        <input class="form-control" type="text" value="<?=$this->adminmd->getConfig()['admin_route']?>" name="admin_route">
									                        </div>
                                                                            
                                                                             <button type="submit" class="btn btn-success">UPDATES</button>
	
									</form>
								</div>
							</div>
								
						</div>
					
							
						</div>
					
						
					</div>
				</div>
			