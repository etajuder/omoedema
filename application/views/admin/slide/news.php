<div class="col-md-10" id="content-wrapper">
				<div class="row">
					<div class="col-lg-12">
						
				
						<div class="row">
							<div class="col-lg-12">
								<div class="main-box clearfix">
									<div class="clearfix">
                                                                            <h2 class="pull-left">News lists</h2><br><br>
                                                                             <?php if($this->input->get('category')!=null): ?>
                                                                            <span class="label label-success"><?=$this->input->get('category')?> <span class="label label-danger"><?=$this->adminmd->getcatnews($this->input->get('category'))->total?></span></span>
                                                                                
                                                                                <?php endif; ?>
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
													<th><a href="#" class="desc"><span>Title</span></a></th>
													<th><a href="#" class="asc"><span>Body</span></a></th>
													<th class="text-center"><span>Category</span></th>
                                                                                                        <th class="text-center"><span>Picture</span></th>
                                                                                                        <th class="text-center"><span>Video</span></th>
                                                                                                        <th class="text-center"><span>Audio</span></th>
                                                                                                        <th class="text-center"><span>Viewed</span></th>
                                                                                                        <th class="text-center"><span>Popular</span></th>
                                                                                                        <th class="text-center"><span>Hot</span></th>
                                                                                                        <th class="text-center"><span>Edit</span></th>
								
													<th>&nbsp;</th>
												</tr>
											</thead>
											<tbody>
                                                                                            <?php foreach ($newslist as $cats):  ?>
												<tr>
													<td>
														<a href="#"><?=$cats['id']?></a>
													</td>
													<td>
														<a href="#"><?=$cats['title']?></a>
													</td>
													<td>
														<?=  strip_tags(word_limiter($cats['body'],10))?>
													</td>
													<td>
													<?=$cats['category']?>
													</td>
													<td>
													
                                                                                                           <?php if($cats['picture'] !="" && $cats['picture'] !=NULL):?>
                                                                                                            <img src="<?=App::Assets()->getUploads()->getImage($cats['id'], $cats['picture'])?>" width="100" height="100">
                                                                                                            <?php endif; ?>
													</td>
                                                                                                        <td>
													<?=$cats['video']?>
													</td>
                                                                                                        <td>
													<?=$cats['audio']?>
													</td>
                                                                                                        <td>
													<?=$cats['viewed']?>
													</td>
                                                                                                        <td>
													<?=$cats['popular']?>
													</td>
                                                                                                        <td>
													<?=$cats['hotnews']?>
													</td>
													<td class="text-center" style="width: 15%;">
                                                                                                            <a href="<?=App::route('admin', 'edit/?id='.$cats['id'])?>" class="table-link">
															<span class="fa-stack">
																<i class="fa fa-square fa-stack-2x"></i>
																<i class="fa fa-edit fa-stack-1x fa-inverse"></i>
															</span>
														</a>
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