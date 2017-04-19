
	<div class="container">
		<div class="row">
			<div class="col-md-2" id="nav-col">
				<section id="col-left">
					<div class="collapse navbar-collapse navbar-ex1-collapse" id="sidebar-nav">	
						<ul class="nav nav-pills nav-stacked">
							<li class="active">
                                                            <a href="<?=  App::route(modules::admin_route(), '')?>">
									<i class="fa fa-dashboard"></i>
									<span>Dashboard</span>
								</a>
							</li>
							
                                                        <li>
								<a href="#" class="dropdown-toggle">
									<i class="fa fa-table"></i>
									<span>Page Design</span>
									<i class="fa fa-chevron-circle-down drop-icon"></i>
								</a>
								<ul class="submenu">
									
									<li>
                                                                          
                                                                            <a href="<?=App::route(modules::admin_route(), 'config')?>">
											Page Configuration
										</a>
									</li>
								</ul>
							</li>
							
					
							
                                                        	<li>
                                                           <a href="#" class="dropdown-toggle">
									<i class="fa fa-desktop"></i>
									<span>Theme Management</span>
									<i class="fa fa-chevron-circle-down drop-icon"></i>
								</a>
								<ul class="submenu">
                                                                        <li>
                                                                            <a href="<?=App::route(modules::admin_route(), 'themes')?>">
										Choose Theme
										</a>
									</li>
									<li>
                                                                            <a href="<?=App::route(modules::admin_route(), 'theme_uploads')?>">
										Theme Upload
										</a>
									</li>
								</ul>
							</li>
                                                        
                                                        <?php foreach (modules::isActive() as $mod): ?>
                                                        	   <?php foreach (modules::getAdminSideBar($mod->name) as $bar=> $value): ?> 
                                                                 
                                                        <li>

                                                                    <a href="#" class="dropdown-toggle">
									<i class="fa fa-desktop"></i>
									<span><?=$bar?></span>
									<i class="fa fa-chevron-circle-down drop-icon"></i>
								</a>
                                                            <ul class="submenu">
                                                               <?php foreach($value as $val => $va):?>
                                                                  <li>
                                                                      <a href="<?=  base_url($va)?>">
										<?=$val?>
							               </a>
									</li>
                                                                <?php endforeach; ?>
                                                            </ul>
                                                                  
                                                            </li>
                                                            <?php endforeach;?>
                                                        <?php endforeach; ?>
                                                         
                                                        <li>
                                                           <a href="#" class="dropdown-toggle">
									<i class="fa fa-desktop"></i>
									<span>Modules</span>
									<i class="fa fa-chevron-circle-down drop-icon"></i>
								</a>
								<ul class="submenu">
                                                                        <li>
                                                                            <a href="<?=App::route(modules::admin_route(), 'module')?>">
										Add Module
										</a>
									</li>
									<li>
                                                                            <a href="<?=App::route(modules::admin_route(), 'listmodule')?>">
										List Modules
										</a>
									</li>
								</ul>
							</li>
                                                       
                                                        <li>
                                                            <a href="<?=App::route(modules::admin_route(), 'backupdb')?>">
									<i class="fa fa-save"></i>
									<span>Backup database</span>
								</a>
							</li>
                                                         <li>
                                                            <a href="<?=App::route(modules::admin_route(), 'Uninstall')?>">
									<i class="fa fa-eraser"></i>
									<span>Uninstall</span>
								</a>
							</li>
							
						</ul>
					</div>
				</section>
			</div>
			
