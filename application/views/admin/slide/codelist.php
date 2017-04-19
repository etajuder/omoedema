<div class="col-md-10" id="content-wrapper">
    <div class="row">
        <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-lg-9">
                    <h2>Main Page Displayed News Categories</h2>
                    
                </div>
            </div>
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <ul class="notes">
                        <?php foreach($invl as $dp): ?>
                           <li>
                            <div>
                                <small><?=$dp['id']?></small>
                                <h4><?=$dp['code']?></h4>
                                <p>Usage: <?=$dp['usage']?></p>
                
                            </div>
                        </li>
                        <?php endforeach; ?>
                       
                        
                    </ul>
                </div>
            </div>
        </div>
     
</div>