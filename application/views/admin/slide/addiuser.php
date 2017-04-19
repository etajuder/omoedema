<div class="col-md-10" id="content-wrapper">
				<div style="opacity: 1; transform: translateY(0px);" class="row">
					<div class="col-lg-12">
					
						<h1>Add A New Invite User</h1>
					
						<div class="row">
							<div class="col-lg-12">
								<div class="main-box">
									<h2>Fill Form</h2>
                                                                        <?=@$this->session->flashdata('item')?>
                                                                        <form role="form" method="post" action="<?=App::route('admin', 'addinuser')?>" enctype="multipart/form-data">
										<div class="form-group">
											<label for="exampleInputEmail1">Full Name</label>
                                                                                        <input class="form-control" name="fullname" id="exampleInputEmail1" placeholder="Title" type="text">
										</div>
										
										
										<div class="form-group">
											<label for="exampleTooltip">Contact</label>
                                                                                        <input name="about" data-original-title="very nice tooltip about this field" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="" type="text">
										</div>
                                                                            <div class="form-group">
											<label for="exampleInputPassword1">Picture</label>
                                                                                        <input class="form-control" name="userfile" id="exampleInputPassword1" placeholder="Details" type="file">
									   </div>
                                                                             <button type="submit" class="btn btn-success">Add </button>
	
									</form>
								</div>
							</div>
								
						</div>
					
							
						</div>
					
						
					</div>
				</div>
			