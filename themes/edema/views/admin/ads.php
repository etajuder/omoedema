<div class="row">
<div class="col-lg-7">
<div class="main-box no-header clearfix">
<div class="main-box-body clearfix">
<div class="table-responsive">
<table class="table user-list table-hover">
<thead>
<tr>
<th><span>Type</span></th>
<th><span>Image Link</span></th>
<th><span>Image</span></th>
<th class="text-center"><span>Script</span></th>

<th>&nbsp;</th>
</tr>
</thead>
<tbody>
    <?php foreach ($site["ads"] as $ads):?>
<tr>
<td>
<?=$ads["type"]?>
</td>
<td>
    <a href="#" target="_blank"><?=$ads["imagelink"]?></a>
</td>
<td class="text-center">
    <img src="<?=App::Assets()->getUploads()->getImage($ads["image"])?>" alt="">
</td>
<td>
<?=$ads["script"]?>
</td>
<td style="width: 20%;">
    <a href="<?=App::route("requests", "deleteads?action=".$ads["id"])?>" class="table-link danger">
<span class="fa-stack">
<i class="fa fa-square fa-stack-2x"></i>
<i class="fa fa-trash-o fa-stack-1x fa-inverse"></i>
</span>
</a>
</td>
</tr>
<?php endforeach;?>
</tbody>
</table>
</div>
</div>
</div>
</div>
    <div class="col-lg-5">
        <div class="row">
<div class="col-lg-12">
<div class="main-box">
<header class="main-box-header clearfix">
<h2>Add Advert</h2>
</header>
<div class="main-box-body clearfix">
    <?=$form["message"]?>
    <form role="form" action="" method="post" enctype="multipart/form-data">
<div class="form-group">
<label for="exampleInputEmail1">Advert Type <span class="label label-danger">*</span></label>
<select  class="form-control" name="type">
    <option value="box">Box (250 X 250)</option>
    <option value="wide">Wide (728 X 90)</option>
</select>
</div>

<div class="form-group">
    <label for="exampleTextarea">Ads Script </label>
    <textarea class="form-control" name="script"></textarea>
</div>
<div class="form-group">
<label for="exampleTooltip">Image Photo <span class="label label-danger">*</span></label>
<input class="form-control" type="file" name="image" >
</div>
 
      <div class="form-group">
<label for="exampleTooltip">Image Link </label>
<input class="form-control" type="text" placeholder="http://someerioer.com/some.jpg" name="imagelink">
</div>
    <button type="submit" class="btn btn-success">Add News</button>  
</form>
</div>
</div>
</div>

</div>

    </div>
</div>