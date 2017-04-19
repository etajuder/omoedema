<div class="col-md-10" id="content-wrapper">
				<div style="opacity: 1; transform: translateY(0px);" class="row">
					<div class="col-lg-12">
					
						<div class="clearfix">
							<h1 class="pull-left">Modules</h1>
							
							<div class="pull-right top-page-ui">
                                                            <a href="<?=App::route(modules::admin_route(), 'module')?>" class="btn btn-primary pull-right">
									<i class="fa fa-plus-circle fa-lg"></i> Add Module
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
													<th><span>Created</span></th>
													<th class="text-center"><span>Status</span></th>
													
													<th>&nbsp;</th>
												</tr>
											</thead>
											<tbody>
                                        <?php foreach(modules::AvailModules() as $module):?>
                                                  <tr>
                                                                                                          <td>
                                                                                                                  
                                                                                                                  <a href="#" class="user-link"><?=$module['name']?></a>
                                                                                                                  
                                                                                                          </td>
                                                                                                          <td>
                                                                                                                  2013/08/08
                                                                                                          </td>
                                                                                                          <td class="text-center">
                                                                                                              <?php if($this->adminmd->moduleactivated($module['name'])):?>
                                                                                                              <span class="label label-success">Active</span>    
                                                                                                             
                                                                                                              <?php else: ?>
                                                                                                                  <span class="label label-default">Inactive</span>
                                                                                                              <?php endif; ?>
                                                                                                          </td>
                                                                                                          
                                                                                                          <td style="width: 20%;">
                                                                                                                  
                                                                                                              <a href="<?=App::route(modules::admin_route(), "installmodules/".$module['name'])?>" class="table-link" title="install">
                                                                                                                          <span class="fa-stack">
                                                                                                                              <i class="fa fa-square fa-stack-2x"></i>
                                                                                                                                  <i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
                                                                                                                          </span>
                                                                                                                  </a>
                                                                                                              <a href="<?=App::route(modules::admin_route(), "uninstallmodule/".$module['name'])?>" class="table-link danger" title="uninstall">
                                                                                                                          <span class="fa-stack">
                                                                                                                                  <i class="fa fa-square fa-stack-2x"></i>
                                                                                                                                  <i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
                                                                                                                          </span>
                                                                                                                  </a>
                                                                                                              <?php if(modules::isFullModule($module["name"])): ?>
                                                                                                               <?php if(App::getConfig('active_module')==$module['name']): ?>
                                                                                                              <a href="<?=App::route(modules::admin_route(), "setactivecontroller/".$module['name'])?>" class="table-link success" title="uninstall">
                                                                                                                          <span class="fa-stack">
                                                                                                                                  <i class="fa fa-square fa-stack-2x"></i>
                                                                                                                                  <i class="fa fa-certificate fa-stack-1x fa-inverse"></i>
                                                                                                                          </span>
                                                                                                                  </a>
                                                                                                              <?php else :?> 
                                                                                                               <a href="<?=App::route(modules::admin_route(), "setactivecontroller/".$module['name'])?>" class="table-link danger" title="uninstall">
                                                                                                                          <span class="fa-stack">
                                                                                                                                  <i class="fa fa-square fa-stack-2x"></i>
                                                                                                                                  <i class="fa fa-certificate fa-stack-1x fa-inverse"></i>
                                                                                                                          </span>
                                                                                                                  </a>
                                                                                                              
                                                                                                              <?php endif; ?>
                                                                                                                <?php else:?>
                                                                                                              
                                                                                                              <?php if(modules::hasManage($module["name"])):?>
                                                                                                              <?php if($this->adminmd->moduleactivated($module['name'])):?>
                                                                                                              <a href="<?=modules::manage_url($module["name"])?>" class="table-link success" title="Edit">
                                                                                                                          <span class="fa-stack">
                                                                                                                                  <i class="fa fa-square fa-stack-2x"></i>
                                                                                                                                  <i class="fa fa-gears fa-stack-1x fa-inverse"></i>
                                                                                                                          </span>
                                                                                                                  </a>
                                                                                                              <?php endif;?>
                                                                                                              <?php endif;?>
                                                                                                              <?php endif; ?>
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