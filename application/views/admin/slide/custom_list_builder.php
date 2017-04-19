<div class="col-md-10" id="content-wrapper">
				<div class="row">
					<div class="col-lg-12">
						
						
					
						
						<div class="row">
							<div class="col-lg-12">
								<div class="main-box clearfix">
									<div class="clearfix"><?=@$this->session->flashdata('item')?>
										<h2 class="pull-left"><?=$page["title"]?></h2>
                                                                                
										
										<div class="filter-block pull-right">
											<div class="form-group pull-left">
												<input type="text" class="form-control" placeholder="Search...">
												<i class="fa fa-search search-icon"></i>
											</div>
											
											
										</div>
									</div>
									 
									<div class="table-responsive clearfix">
										<table class="table table-hover">
											<thead>
												<tr>
                                                                                                    <?php foreach ($page["showcase"] as $li => $value): ?>
                                                                                                    <th>
                                                                                                        <a href="#">
                                                                                                            <span><?=$li?></span>
                                                                                                        </a>
                                                                                                    </th>
                                                                                                    <?php endforeach; ?>
												
													<th>&nbsp;</th>
												</tr>
											</thead>
											<tbody>
                                                                                                 <?php foreach ($this->$page["model"]->$page["adapter"]() as $action):  ?>
												<tr>
                                                                                                   
													 <?php foreach ($page["showcase"] as $li => $value): ?>
													<td>
                                                                                                            <?php if(!is_array($value)):?>
                                                                                                            <?=$action->$value?>
                                                                                                            <?php else:?>
                                                                                                            <?php foreach ($value as $act => $rout):?>
                                                                                                            <?php if($rout["type"] == "post"){
                                                                                                                $link = App::route($rout["base_url"],$action->$rout["value"]);
                                                                                                            }else{
                                                                                                               $link = App::route($rout["base_url"]."?action=".$action->$rout["value"]); 
                                                                                                            }
                                                                                                                
                                                                                                                
                                                                                                                ?>
                                                                                                            
                                                                                                             <a href="<?=$link?>" class="table-link">
															<span class="btn btn-default">
																<?=$act?>
															</span>
														</a>
                                                                                                            <?php endforeach;?>
                                                                                                            
                                                                                                            <?php endif; ?>
													</td>
													<?php endforeach; ?>
                                                                                                        
												
                                                                                                      
												</tr>
												 <?php endforeach; ?>
											</tbody>
										</table>
									</div>
									
								</div>
							</div>
						</div>
						
						
						
						
						
					</div>
				</div>
			</div>