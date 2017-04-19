<div class="col-md-10" id="content-wrapper">
				<div style="opacity: 1; transform: translateY(0px);" class="row">
					<div class="col-lg-12">
					
						<h1>Edit News</h1>
					
						<div class="row">
							<div class="col-lg-6">
								<div class="main-box">
									<h2>Fill Form</h2>
                                                                        <?=@$this->session->flashdata('item')?>
                                                                        <form role="form" method="post" action="<?=App::route('admin', 'update')?>" enctype="multipart/form-data">
                                                                                
										<div class="form-group">
                                                                                    <input type="hidden" name="id" value="<?=$news['id']?>" >
											<label for="exampleInputEmail1">News Title</label>
                                                                                        <input class="form-control" name="title" id="exampleInputEmail1" value="<?=$news['title']?>" type="text">
										</div>
										
										<div class="form-group">
											<label for="exampleTextarea">Body</label>
                                                                                        <textarea class="form-control" id="exampleTextarea" rows="3" name="body"><?=$news['body']?></textarea>
										</div>
										
										<div class="form-group">
											<label for="exampleTooltip">Video Link</label>
                                                                                        <input name="video" value="<?=$news['video']?>" data-original-title="very nice tooltip about this field" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="" type="text">
										</div>
                                                                            <div class="form-group">
											<label for="exampleInputPassword1">Audio</label>
                                                                                        <input class="form-control" value="<?=$news['audio']?>" name="detail" id="exampleInputPassword1" placeholder="Details" type="text">
									   </div>
                                                                            <div class="form-group">
											<label for="exampleTooltip">Picture Link</label>
                                                                                        <input type="hidden" value="<?=$news['picture']?>" name="picture">
                                                                                        <br>
                                                                                        <?php if($news['picture'] !="" && $news['picture'] !=NULL): ?>
                                                                                        <img src="<?=App::Assets()->getUploads()->getImage($news['id'], $news['picture'])?>" width="100" height="100">
                                                                                        <?php endif; ?>
                                                                                        <input type="file" name="userfile" >
									    </div>
                                                                            <div class="form-group">
                                                                                <label for="exampleTooltip">Category</label>
									           <select class="form-control m-b" name="category">
                                                                                       <option value="<?=$news['category']?>"><?=$news['category']?></option>
                                                                                       <?php foreach($cat as $val): ?>
                                                                                       <option value="<?=$val['name']?>"><?=$val['name']?></option>
                                                                                       <?php endforeach; ?>
                                                                                    </select>	
                                                                            </div>
                                                                            <div class="form-group">
											<label for="exampleTooltip">Popular</label>
                                                                                        <input name="popular" value="<?=$news['popular']?>"data-original-title="very nice tooltip about this field" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="" type="text">
									    </div>
                                                                            <div class="form-group">
											<label for="exampleTooltip">Hot News</label>
                                                                                        <input name="hotnews" value="<?=$news['hotnews']?>" data-original-title="very nice tooltip about this field" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="" type="text">
									    </div>
                                                                            
                                                                            
                                                                             <button type="submit" class="btn btn-success">UPDATES</button>
	
									</form>
								</div>
							</div>
								
						</div>
					
							
						</div>
					
						
					</div>
				</div>
			