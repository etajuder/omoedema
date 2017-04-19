<div class="col-md-10" id="content-wrapper">
    <div class="row">
        <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Admin Users Lists</h2>
                    <a href="<?=App::route('admin', 'addadmin')?>" class="btn btn-primary pull-right" >
			<i class="fa fa-plus-circle fa-lg"></i> Add Admin
		</a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <ul class="notes">
                        <?php foreach($adml as $dp): ?>
                           <li>
                            <div>
                                <small><?=$dp['id']?></small>
                                <h4><?=$dp['fullname']?></h4>
                                <p>Username: <?=$dp['username']?></p>
                
                            </div>
                        </li>
                        <?php endforeach; ?>
                       
                        
                    </ul>
                </div>
            </div>
        </div>
     
</div>