<div class="col-md-10" id="content-wrapper">
				<div style="opacity: 1; transform: translateY(0px);" class="row">
					<div class="col-lg-12">
					
						<h1>Add An Invite Code(s)</h1>
					
						<div class="row">
							<div class="col-lg-6">
								<div class="main-box">
									<h2>Fill Invite Code</h2>
                                                                        <?=@$this->session->flashdata('item')?>
                                                                        <form role="form" method="post" action="<?=App::route('admin', 'addinvite')?>">
										<div class="form-group">
											<label for="exampleInputEmail1">Add An Invite code</label>
											<input class="form-control" name="code" id="invitecode" placeholder="Enter Your invite code" type="text">
                                                                                        <div class="btn btn-danger generate" data-url="<?=App::route('admin', 'rand')?>">Generate</div>
										</div>
                                                                            <button type="submit" class="btn btn-success">Add Invite Code</button>
	
									</form>
								</div>
							</div>
								
						</div>
					
							
						</div>
					
						
					</div>
				</div>
			