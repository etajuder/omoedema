<div class="col-md-10" id="content-wrapper">
				<div style="opacity: 1; transform: translateY(0px);" class="row">
					<div class="col-lg-12">
					
						<h1>Add Department</h1>
					
						<div class="row">
							<div class="col-lg-6">
								<div class="main-box">
									<h2>Add Department</h2>
                                                                        <?=@$this->session->flashdata('item')?>
                                                                        <form role="form" method="post" action="<?=App::route('admin', 'adddept')?>">
										<div class="form-group">
											<label for="exampleInputEmail1">Department Short Name</label>
											<input class="form-control" name="short_name" id="exampleInputEmail1" placeholder="Like ARC" type="text">
										</div>
                                                                            <div class="form-group">
											<label for="exampleInputEmail1">Department Full Name</label>
											<input class="form-control" name="fullname" id="exampleInputEmail1" placeholder="Architecture" type="text">
									   </div>
                                                                             <div class="form-group">
                                                                                <label for="exampleTooltip">School</label>
									           <select class="form-control m-b" name="school">
                                                                                       
                                                                                       <?php foreach($schools as $sch): ?>
                                                                                       <option value="<?=$sch->short_name?>"><?=$sch->short_name?></option>
                                                                                       <?php endforeach; ?>
                                                                                    </select>	
                                                                            </div>
                                                                            <button type="submit" class="btn btn-success">Add Department</button>
	
									</form>
								</div>
							</div>
								
						</div>
					
							
						</div>
					
						
					</div>
				</div>
			