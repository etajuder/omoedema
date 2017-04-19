<div class="col-md-10" id="content-wrapper">
				<div style="opacity: 1; transform: translateY(0px);" class="row">
					<div class="col-lg-12">
					
						<div class="clearfix">
							<h1 class="pull-left">Students</h1>
							
							<div class="pull-right top-page-ui">
                                                            <a href="<?=App::route('admin', 'addstudent')?>" class="btn btn-primary pull-right">
									<i class="fa fa-plus-circle fa-lg"></i> Add Student
								</a>
							</div>
						</div>
						
						<div class="row">
							<div class="col-lg-12">
								<div class="main-box clearfix">
									<div class="table-responsive">
										<table class="table user-list">
											<thead>
												<tr>
													<th><span>Name</span></th>
													<th><span>School</span></th>
													<th class="text-center"><span>Class OF</span></th>
													
													<th>&nbsp;</th>
												</tr>
											</thead>
											<tbody>
                                        <?php foreach($students as $student):?>
                                                  <tr>
                                                                                                          <td>
                                                                                                              <img  class="img-circle" src="<?=App::Assets()->getUploads()->getImage($student->image)?>" alt="">
														<a href="#" class="user-link"><?=$student->name?></a>
														<span class="user-subhead"><?=$student->department?></span>
													</td>
                                                                                                          <td>
                                                                                                                  <?=$student->school?>
                                                                                                          </td>
                                                                                                          <td class="text-center">
                                                                                                             
                                                                                                              <span class="label label-success"><?=$student->class?></span>    
                                                                                                              
                                                                                                          </td>
                                                                                                          
                                                                                                     
                                                                                                  </tr>
                                        <?php endforeach; ?>	
											</tbody>
										</table>
									</div>
									<ul class="pagination pull-right">
										<li><a href="#"><i class="fa fa-chevron-left"></i></a></li>
										<li><a href="#">1</a></li>
										<li><a href="#">2</a></li>
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