<div class="col-md-10" id="content-wrapper">
				<div style="opacity: 1; transform: translateY(0px);" class="row">
					<div class="col-lg-12">
					
						<h1>Add Category</h1>
					
						<div class="row">
							<div class="col-lg-6">
								<div class="main-box">
									<h2>Fill Category</h2>
                                                                        <?=@$this->session->flashdata('item')?>
                                                                        <form role="form" method="post" action="<?=App::route('admin', 'addcategory')?>">
										<div class="form-group">
											<label for="exampleInputEmail1">Category Name</label>
											<input class="form-control" name="name" id="exampleInputEmail1" placeholder="Enter Category name" type="text">
										</div>
                                                                            <button type="submit" class="btn btn-success">Add Category</button>
	
									</form>
								</div>
							</div>
								
						</div>
					
							
						</div>
					
						
					</div>
				</div>
			