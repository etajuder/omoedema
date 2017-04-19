<div class="col-md-10" id="content-wrapper">
				<div style="opacity: 1; transform: translateY(0px);" class="row">
					<div class="col-lg-12">
					
						<h1>Add Theme</h1>
					
						<div class="row">
							<div class="col-lg-6">
								<div class="main-box">
									<h2>Install Theme</h2>
                                                                        <?=@$this->session->flashdata('item')?>
                                                                        <form role="form" method="post" action="<?=App::route(modules::admin_route(), 'installtheme')?>" enctype="multipart/form-data">
										  <div class="form-group">
											<label for="exampleTooltip">Choose Theme</label>
                                                                                        <input name="file" data-original-title="very nice tooltip about this field" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="" type="file">
										</div>
                                                                            <button type="submit" class="btn btn-success">Upload</button>
	
									</form>
								</div>
							</div>
								
						</div>
					
							
						</div>
					
						
					</div>
				</div>
			