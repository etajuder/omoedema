<div class="row">
    <div class="col-lg-6">
<div class="main-box clearfix">
<header class="main-box-header clearfix">
<h2 class="pull-left">Categories</h2>

</header>
<div class="main-box-body clearfix">
<div class="table-responsive">
<table class="table">
<thead>
<tr>
<th><a href="#"><span>Name</span></a></th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody>
    <?php foreach ($site["categories"] as $cate):?>
     <tr>
<td>
<?=$cate["name"]?>
</td>

<td style="width: 15%;">
    <a href="<?=App::route("requests/deletecategory?action=".$cate["id"])?>" class="table-link">
<span class="fa-stack">
<i class="fa fa-square fa-stack-2x"></i>
<i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
</span>
</a>
</td>
</tr>        
        
    <?php endforeach; ?>


</tbody>
</table>
</div>

</div>
</div>
</div>
    
    
    <div class="col-lg-6">
<div class="main-box">
<header class="main-box-header clearfix">
<h2>New Category</h2>
</header>
<div class="main-box-body clearfix">
    <form class="" role="form" action="<?=App::route("requests/addcategory")?>" method="post">
<div class="form-group">
<label class="sr-only" for="exampleInputEmail2">Category Name</label>
<input class="form-control" id="exampleInputEmail2" placeholder="Category Name" required="" type="text" name="name">
</div>
<button type="submit" class="btn btn-success">Add Category</button>
</form>
</div>
</div>
</div>
     
</div>