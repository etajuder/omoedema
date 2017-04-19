<div class="col-md-10" id="content-wrapper">
    <div class="row">
        <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Advertisement management</h2>
                    <a href="#" class="btn btn-primary pull-right" data-toggle="modal" data-target="#myModal">
			<i class="fa fa-plus-circle fa-lg"></i> Add Advertisement
		</a>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <ul class="notes">
                        <?php foreach($this->adminmd->getAdverts() as $advert): ?>
                           <li>
                            <div>
                                <small><?=$advert['website']?></small>
                                <h4></h4>
                                <a href=""><i class="fa fa-trash-o "></i></a>
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
                                            <h4 class="modal-title">Adverts</h4>
                                        </div>
                                    <form action="<?=App::route('admin', 'advert_add')?>" method="POST">
                                        <div class="modal-body">
                                          
                                                    <div class="form-group">
                                                        <label>Sample Input</label>
                                                        <br>
                                                        <input type="text" name="website" id="website" class="form-control" placeholder="Enter valid website">
                                                    </div>
                                            <div class="col-md-6">
                                            <div class="ibox-content" style="background: #3E5E79;">
                                                <h6 id="link-title" style="color: white;"></h6>
                                                                <div class="m-b-sm">
                                                                    <img id="img-link">
                                                                </div>
                                                <p class="font-bold" id="desc" style="color: white;"></p>
                                                                <div class="">
                                                                    <em id="link" style="color: white;"><a id="link"></a></em>
                                                                </div>
                                                            </div>
                                            </div>
                                            <div  class="btn btn-primary" id="preview" data-url="<?=  App::route('admin', 'previewAds')?>">Preview</div>
                                        </div>
                                        <div class="modal-footer">
                                            
                                            <button type="submit"  class="btn btn-primary">Add News</button>
                                            
                                        </div>
                                     </form>
                                    </div>
                                </div>
                            </div>
</div>