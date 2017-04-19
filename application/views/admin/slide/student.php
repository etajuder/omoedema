<div class="col-md-10" id="content-wrapper">
				<div style="opacity: 1; transform: translateY(0px);" class="row">
					<div class="col-lg-12">
					
						<h1>Add Students</h1>
					
						<div class="row">
							<div class="col-lg-12">
								<div class="main-box">
									<h2>Fill Form</h2>
                                                                        <?=@$this->session->flashdata('item')?>
                                                                        <form role="form" method="post" action="<?=App::route('admin', 'addstudent')?>" enctype="multipart/form-data">
										<div class="form-group">
											<label for="exampleInputEmail1">Name</label>
                                                                                        <input class="form-control" name="name" id="exampleInputEmail1" placeholder="" type="text">
										</div>
                                                                            <div class="form-group">
											<label for="exampleInputEmail1">Nick</label>
                                                                                        <input class="form-control" name="nick" id="exampleInputEmail1" placeholder="" type="text">
										</div>
                                                                            <div class="form-group">
											<label for="exampleInputEmail1">Phone Number</label>
                                                                                        <input class="form-control" name="phone" id="exampleInputEmail1" placeholder="" type="text">
								            </div>
                                                                            <div class="form-group">
											<label for="exampleInputEmail1">Date of Birth</label>
                                                                                        <input class="form-control" name="dob" id="exampleInputEmail1" placeholder="dd-mm-yyyy" type="text">
								            </div>
										<div class="form-group">
											<label for="exampleTooltip">Activities/ Post Held</label>
                                                                                        <input name="activities" data-original-title="very nice tooltip about this field" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="" type="text">
										</div>
                                                                            <div class="form-group">
											<label for="exampleInputPassword1">Skills Acquired</label>
                                                                                        <input class="form-control" name="skills" id="exampleInputPassword1" placeholder="" type="text">
									   </div>
                                                                             <div class="form-group">
											<label for="exampleInputPassword1">Nationality</label>
                                                                                        <input class="form-control" name="nation" value="Nigeria" id="exampleInputPassword1" placeholder="" type="text">
									   </div>
                                                                            <div class="form-group">
											<label for="exampleInputPassword1">IT FIRM</label>
                                                                                        <input class="form-control" name="itfirm" id="exampleInputPassword1" placeholder="" type="text">
									   </div>
                                                                             <div class="form-group">
											<label for="exampleInputPassword1">State Of Origin </label>
                                                                                        <input class="form-control" name="state" id="exampleInputPassword1" placeholder="" type="text">
									   </div>
                                                                            <div class="form-group">
											<label for="exampleInputPassword1">Email</label>
                                                                                        <input class="form-control" name="email" id="exampleInputPassword1" placeholder="" type="text">
									   </div>
                                                                            <div class="form-group">
											<label for="exampleInputPassword1">Facebook Account</label>
                                                                                        <input class="form-control" name="facebook_account" id="exampleInputPassword1" placeholder="" type="text">
									   </div>
                                                                            <div class="form-group">
											<label for="exampleInputPassword1">Company Of Choice</label>
                                                                                        <input class="form-control" name="company" id="exampleInputPassword1" placeholder="" type="text">
									   </div>
                                                                            <div class="form-group">
											<label for="exampleInputPassword1">Project Topics</label>
                                                                                        <input class="form-control" name="project_topic" id="exampleInputPassword1" placeholder="" type="text">
									   </div>
                                                                             <div class="form-group">
											<label for="exampleInputPassword1">Hobbies</label>
                                                                                        <input class="form-control" name="hobbies" id="exampleInputPassword1" placeholder="separated with comma(,)" type="text">
									   </div>
                                                                            <div class="form-group">
											<label for="exampleTextarea">Five Years In Review</label>
                                                                                        <textarea class="form-control" name="review"></textarea>  
										</div>
                                                                             <div class="form-group">
                                                                                <label for="exampleTooltip">School</label>
									           <select class="form-control m-b" name="school">
                                                                                       
                                                                                       <?php foreach($schools as $sch): ?>
                                                                                       <option value="<?=$sch->short_name?>"><?=$sch->short_name?></option>
                                                                                       <?php endforeach; ?>
                                                                                    </select>	
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label for="exampleTooltip">Department</label>
									           <select class="form-control m-b" name="department">
                                                                                       
                                                                                       <?php foreach($deptlist as $val): ?>
                                                                                       <option value="<?=$val->short_name?>"><?=$val->short_name?></option>
                                                                                       <?php endforeach; ?>
                                                                                    </select>	
                                                                            </div>
										
                                                                              <div class="form-group">
                                                                                <label for="exampleTooltip">Class Of</label>
									           <select class="form-control m-b" name="class">
                                                                                       
                                                                                       <?php foreach($classes as $class): ?>
                                                                                       <option value="<?=$class->name?>"><?=$class->name?></option>
                                                                                       <?php endforeach; ?>
                                                                                    </select>	
                                                                            </div>
									
                                                                            <div class="form-group">
											<label for="exampleTooltip">Picture</label>
                                                                                        <input name="userfile" data-original-title="very nice tooltip about this field" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="" type="file">
										</div>
                                                                            <div class="form-group">
											<label for="exampleTooltip">Choose two other Picture</label>
                                                                                        <input name="files[]" data-original-title="very nice tooltip about this field" class="form-control" id="exampleTooltip" data-toggle="tooltip" data-placement="bottom" title="" type="file" multiple="">
										</div>
                                                                           
                                                                             <button type="submit" class="btn btn-success">Add Student</button>
	
									</form>
								</div>
							</div>
								
						</div>
					
							
						</div>
					
						
					</div>
				</div>
			