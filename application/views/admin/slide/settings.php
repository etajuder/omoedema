<div class="col-md-10" id="content-wrapper">
				<div style="opacity: 1; transform: translateY(0px);" class="row">
					<div class="col-lg-12">
					
						<h1><?=$this->uri->segment(2)?> Settings</h1>
					
						<div class="row">
							<div class="col-lg-6">
								<div class="main-box">
									<h2><?=$keys["title"]?></h2>
                                                                        <?=@$this->session->flashdata('item')?>
                                                                        
                                                                        <form role="form" method="<?=$keys["form"]["method"]?>" action="<?=$keys["form"]["action"]?>">
										
                                                                               <?php foreach ($keys["form"]["elements"] as $input => $value): ?>
                                                                                  <?php if($value["type"] == "text") :?>
                                                                                   
                                                                                <div class="form-group">
                                                                   
											<label for="exampleInputEmail1"><?=$value["description"]?></label>
                                                                                        <input class="form-control" name="<?=$input?>" <?php foreach ($value as $attr => $val): ?> <?=$attr."='$val'"?> <?php endforeach;?>>
										</div>
                                                                            <?php elseif($value["type"] == "dropdown"):?>
                                                                             <div class="form-group">
                                                                                <label for="exampleTooltip"><?=$value["description"]?></label>
									           <select class="form-control m-b" name="school">
                                                                                       
                                                                                       <?php foreach($value["options"] as $sch => $vald): ?>
                                                                                       <option value="<?=$sch?>"><?=$vald?></option>
                                                                                       <?php endforeach; ?>
                                                                                    </select>	
                                                                            </div>
                                                                            <?php endif; ?>
                                                                            <?php endforeach; ?>
                                                                          
                                                                            <button type="submit" class="btn btn-success"><?=$keys["form"]["submit"]?></button>
	
									</form>
								</div>
							</div>
								
						</div>
					
							
						</div>
					
						
					</div>
				</div>
			