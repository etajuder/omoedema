<div class="col-md-10" id="content-wrapper">
    <div class="row">
        <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Breaking news Management</h2>
                    <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">
			<i class="fa fa-plus-circle fa-lg"></i> Add Breaking news
		</a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <ul class="notes">
                        <?php foreach($this->adminmd->getBreakingNews() as $dpa): ?>
                           <li>
                            <div>
                                <small><?=$dpa['time']?></small>
                                <h4><?=$dpa['title']?></h4>
                                <a href="<?=App::route('admin', 'delete_news?id='.$dpa['id'])?>"><i class="fa fa-trash-o "></i></a>
                            </div>
                        </li>
                        <?php endforeach; ?>
                       
                        
                    </ul>
                </div>
            </div>
        </div>
     <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content animated bounceInRight">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                            <i class="fa fa-laptop modal-icon"></i>
                                            <h4 class="modal-title">Add breaking news</h4>
                                        </div>
                                    <form action="<?=App::route('admin', 'breaking_news')?>" method="POST">
                                        <div class="modal-body">
                                          
                                                    <div class="form-group">
                                                        <label>Sample Input</label>
                                                        <br>
                                                        <input type="text" class="form-control" name="title" placeholder="Breaking news" required=""> 
                                                    </div>
                                        </div>
                                        <div class="modal-footer">
                                            
                                            <button type="submit"  class="btn btn-primary">Add News</button>
                                            
                                        </div>
                                     </form>
                                    </div>
                                </div>
                            </div>
</div>