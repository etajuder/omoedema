<div class="row">
    <div class="col-lg-6">
<div class="main-box clearfix">
<header class="main-box-header clearfix">
<h2 class="pull-left">Admin Lists</h2>

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
    <?php foreach ($site["admins"] as $admin):?>
     <tr>
<td>
<?=$admin["username"]?>
</td>

<td style="width: 15%;">
    <a href="<?=App::route("requests/deleteadmin?action=".$admin["id"])?>" class="table-link">
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
<h2>New Admin</h2>
</header>
<div class="main-box-body clearfix">
    <form class="" role="form" action="<?=App::route("requests/addadmin")?>" method="post">
        <div class="form-group">
<label class="" for="exampleInputEmail2">Admin Fullname</label>
<input class="form-control" id="exampleInputEmail2" placeholder="Admin Fullname" required="" type="text" name="fullname">
</div>
<div class="form-group">
<label class="" for="exampleInputEmail2">Admin Username</label>
<input class="form-control" id="exampleInputEmail2" placeholder="Admin Username" required="" type="text" name="username">
</div>
        <div class="form-group">
<label class="" for="exampleInputEmail2">Admin Password</label>
<input class="form-control" id="exampleInputEmail2" placeholder="Admin Password" required="" type="password" name="password">
</div>
<button type="submit" class="btn btn-success">Add Admin</button>
</form>
</div>
</div>
</div>
     
</div>