<div class="col-md-10" id="content-wrapper">
				<div style="opacity: 1; transform: translateY(0px);" class="row">
					<div class="col-lg-12">
					
						<h1>Add Advert</h1>
					
						<div class="row">
							<div class="col-lg-12">
								<div class="main-box">
									<h2>Fill Form</h2>
                                                                        <?=@$this->session->flashdata('item')?>
                                                                        <form role="form" method="post" action="<?=App::route('admin', 'addnews')?>" enctype="multipart/form-data">
										<div class="form-group">
											<label for="exampleInputEmail1">Adds by</label>
                                                                                        <input class="form-control" name="by" id="exampleInputEmail1" placeholder="Title" type="text">
										</div>
										
										<div class="form-group">
											<label for="exampleTextarea">Content</label>
                                                                                        <textarea name="content"  ></textarea>
										</div>
										
										
                                                                             <button type="submit" class="btn btn-success">Add Advert</button>
	
									</form>
								</div>
							</div>
								
						</div>
					
							
						</div>
					
						
					</div>
				</div>
			