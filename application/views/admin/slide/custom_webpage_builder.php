<div class="col-md-10" id="content-wrapper">
				<div style="opacity: 1; transform: translateY(0px);" class="row">
					<div class="col-lg-12">
					
						<h1><?=$page["title"]?></h1>
					
						<div class="row">
							<div class="col-lg-6">
								<div class="main-box">
									<h2><?=$page["title_description"]?></h2>
                                                                        <?php
                                                                        $page["is_edit"] = in_array("edit", $page);
                                                                         if($page["is_edit"]){
                                                                             
                                                                             model($page["model"]);
                                                                             $adapter = model_request($page["model"], $page["adapter"]);
                                                                             if(is_object($adapter)){
                                                                                 
                                                                             }
                                                                             
                                                                         }      
                                                                          ?>
                                                                        <?=@$this->session->flashdata('item')?>
                                                                        
                                                                        <form role="form" method="<?=$page["form"]["method"]?>" action="<?=$page["form"]["action"]?><?=$page["is_edit"]?"?id=".  get("action"):""?>" enctype="multipart/form-data">
										
                                                                               <?php foreach ($page["form"]["elements"] as $input => $value): ?>
                                                                                  <?php if($value["type"] == "text") :?>
                                                                                   
                                                                                <div class="form-group">
                                                                                        
											<label for="exampleInputEmail1"><?=$value["label"]?></label>
                                                                                        <input class="form-control" name="<?=$input?>" <?php foreach ($value as $attr => $val): ?> <?=$attr!="value"?$attr."='$val'":""?> <?php endforeach;?> <?=$page["is_edit"]?" value =' ".$adapter->$value["read"]."'":""?>  >
										</div>
                                                                            <?php elseif($value["type"] == "dropdown"):?>
                                                                              <div class="form-group">
                                                                                <label for="exampleTooltip"><?=$value["description"]?></label>
									           <select class="form-control m-b" name="<?=$input?>">
                                                                                       <?php if(@$value["source"] == null):?>
                                                                                       
                                                                                       <?php foreach($value["options"] as $sch => $vald): ?>
                                                                                       <option value="<?=$sch?>"><?=$vald?></option>
                                                                                       
                                                                                       <?php endforeach; ?>
                                                                                       <?php else:?>
                                                                                       
                                                                                       <?php foreach (model_request($value["model"], $value["source"]) as $batch):?>
                                                                                       <option value="<?=$batch[array_keys($value["showcase"])[0]]?>"><?=$batch[$value["showcase"][array_keys($value["showcase"])[0]]]?></option>
                                                                                       <?php endforeach;?>
                                                                                       <?php endif;?>
                                                                                    </select>	
                                                                            </div>
                                                                            <?php elseif($value["type"] == "textarea"):?>
                                                                                    <div class="form-group">
                                                                   
											<label for="exampleInputEmail1"><?=$value["label"]?></label>
                                                                                        <textarea class="form-control" name="<?=$input?>"  <?php foreach ($value as $attr => $val): ?> <?=$attr."='$val'"?> <?php endforeach;?>></textarea>
                                                                                       
										</div>
                                                                            <?php elseif($value["type"] == "cke"):?>
                                                                            <?php echo $this->ckeditor->editor($input,$page["is_edit"]?$adapter->$value["read"]:"");?>
                                                                            <?php elseif($value["type"] == "hidden"):?>
                                                                            <input  name="<?=$input?>" <?php foreach ($value as $attr => $val): ?> <?=$attr."='$val'"?> <?php endforeach;?> >
                                                                            <?php else:?>
                                                                                 <div class="form-group">
                                                                   
											<label for="exampleInputEmail1"><?=$value["label"]?></label>
                                                                                        <input class="form-control" name="<?=$input?>" <?php foreach ($value as $attr => $val): ?> <?=$attr."='$val'"?> <?php endforeach;?>>
										</div>
                                                                            <?php endif; ?>
                                                                            
                                                                            <?php endforeach; ?>
                                                                          
                                                                            <button type="submit" class="btn btn-success"><?=$page["form"]["submit"]?></button>
	
									</form>
								</div>
							</div>
								
						</div>
					
							
						</div>
					
						
					</div>
				</div>
			