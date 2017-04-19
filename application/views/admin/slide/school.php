<div class="col-md-10" id="content-wrapper">
				<div style="opacity: 1; transform: translateY(0px);" class="row">
					<div class="col-lg-12">
					
						<h1>Add School</h1>
					
						<div class="row">
							<div class="col-lg-6">
								<div class="main-box">
									<h2>Add School</h2>
                                                                        <?=@$this->session->flashdata('item')?>
                                                                        <form role="form" method="post" action="<?=App::route('admin', 'addsch')?>">
										<div class="form-group">
											<label for="exampleInputEmail1">School Short Name</label>
											<input class="form-control" name="short_name" id="exampleInputEmail1" placeholder="Like SOS" type="text">
										</div>
                                                                            <div class="form-group">
											<label for="exampleInputEmail1">School Full Name</label>
											<input class="form-control" name="fullname" id="exampleInputEmail1" placeholder="Ex School of science" type="text">
										</div>
                                                                            <button type="submit" class="btn btn-success">Add School</button>
	
									</form>
								</div>
							</div>
								
						</div>
					
							
						</div>
					
						
					</div>
				</div>
			