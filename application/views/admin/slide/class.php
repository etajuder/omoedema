<div class="col-md-10" id="content-wrapper">
				<div style="opacity: 1; transform: translateY(0px);" class="row">
					<div class="col-lg-12">
					
						<h1>Add A Class</h1>
					
						<div class="row">
							<div class="col-lg-6">
								<div class="main-box">
									<h2>Add A Class</h2>
                                                                        <?=@$this->session->flashdata('item')?>
                                                                        <form role="form" method="post" action="<?=App::route('admin', 'addclass')?>">
										<div class="form-group">
											<label for="exampleInputEmail1">Class  Name</label>
											<input class="form-control" name="name" id="exampleInputEmail1" placeholder="Like Class 13" type="text">
										</div>
                                                                            <div class="form-group">
											<label for="exampleInputEmail1">Slogan</label>
											<input class="form-control" name="slug" id="exampleInputEmail1" placeholder="Ex The Lion's Den" type="text">
										</div>
                                                                            <button type="submit" class="btn btn-success">Add Class</button>
	
									</form>
								</div>
							</div>
								
						</div>
					
							
						</div>
					
						
					</div>
				</div>
			