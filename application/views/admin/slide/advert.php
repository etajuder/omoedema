<div class="col-md-10" id="content-wrapper">
				<div style="opacity: 1; transform: translateY(0px);" class="row">
					<div class="col-lg-12">
					
						<h1>Add Advert</h1>
					
						<div class="row">
							<div class="col-lg-12">
								<div class="main-box">
									<h2>Fill Form</h2>
                                                                        <?=@$this->session->flashdata('item')?>
                                                                        <form role="form" method="post" action="<?=App::route('admin', 'advertadd')?>" enctype="multipart/form-data">
										<div class="form-group">
                                                                                <label for="exampleTooltip">Type</label>
									           <select class="form-control m-b" name="type">
                                                                                       <option value="wide">Wide</option>
                                                                                       <option value="box">Box</option>
                                                                                    </select>	
                                                                            </div>
										<div class="form-group">
											<label for="exampleTextarea">Script</label>
                                                                                        <textarea class="form-control" id="exampleTextarea" rows="3" name="script"></textarea>
										</div>
										
										
                                                                            <div class="form-group">
											<label for="exampleTooltip">Image</label>
                                                                                        <input name="userfile" data-original-title="very nice tooltip about this field" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="" type="file">
										</div>
                                                                            <div class="form-group">
                                                                                <label for="exampleTooltip">Image Link</label>
                                                                                <input name="imglink" data-original-title="very nice tooltip about this field" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="" type="text">
                                                                            </div>
                                                                             <button type="submit" class="btn btn-success">Add Top Advert</button>
	
									</form>
								</div>
							</div>
								
						</div>
					
							
						</div>
					
						
					</div>
				</div>
			