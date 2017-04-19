<div class="col-md-10" id="content-wrapper">
				<div class="row">
					<div class="col-lg-12">
						
						
					
						
						<div class="row">
							<div class="col-lg-12">
								<div class="main-box clearfix">
									<div class="clearfix">
										<h2 class="pull-left">List of Class</h2>
                                                                                
										
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
                                                                                                    <th><a href="#"><span> ID</span></a></th>
													<th><a href="#" class="desc"><span>Name</span></a></th>
													
													<th class="text-center"><span>Total Student</span></th>
								
													<th>&nbsp;</th>
												</tr>
											</thead>
											<tbody>
                                                                                            <?php foreach ($classes as $class):  ?>
												<tr>
													<td>
														<a href="#"><?=$class->id?></a>
													</td>
													<td>
                                                                                                            <a href="#"><?=$class->name?></a>
													</td>
													
													<td class="text-center">
														<span class="label label-success"><?=$this->adminmd->gettotal('class',$class->name)?></span>
													</td>
													
													
                                                                                                       <?php endforeach; ?>
												</tr>
												
											</tbody>
										</table>
									</div>
									<ul class="pagination pull-right">
										<li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
										<li><a href="#">1</a></li>
										<li class="active"><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a href="#">4</a></li>
										<li><a href="#">5</a></li>
										<li><a href="#"><i class="fa fa-chevron-right"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
						
						
						
						
						
					</div>
				</div>
			</div>