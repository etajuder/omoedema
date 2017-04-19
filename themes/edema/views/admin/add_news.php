<div class="row">
<div class="col-lg-12">
<div class="main-box">
<header class="main-box-header clearfix">
<h2>Add News</h2>
</header>
<div class="main-box-body clearfix">
    <?=$form["message"]?>
    <form role="form" action="" method="post" enctype="multipart/form-data">
<div class="form-group">
<label for="exampleInputEmail1">News Title <span class="label label-danger">*</span></label>
<input class="form-control" id="exampleInputEmail1" name="title" required="" placeholder="Enter title" type="title">
</div>
<div class="form-group">
<label>News Category <span class="label label-danger">*</span></label>
<select class="form-control" required="" name="category">
   <?php foreach ($site["categories"] as $cate):?>
    <option value="<?=$cate["id"]?>"><?=$cate["name"]?></option>
    <?php endforeach;?>
</select>
</div>
<div class="form-group">
    <label for="exampleTextarea">News Body <span class="label label-danger">*</span></label>
  <?=$this->ckeditor->editor("body","")?>
</div>
<div class="form-group">
<label for="exampleTooltip">Cover Photo <span class="label label-danger">*</span></label>
<input class="form-control" type="file" name="cover_photo" required="">
</div>
 <div class="form-group">
<label for="exampleTooltip">Youtube Video </label>
<input class="form-control" type="text" placeholder="https://www.youtube.com/watch?v=7wQsMy6c4cc" name="youtube">
</div>
  
<div class="form-group">
<label for="exampleTooltip">Upload Audio</label>
<input class="form-control" type="file" name="audio">
</div>
  <div class="form-group">
<label>Download Resources <span class="label label-danger">*</span></label>
<select class="form-control" required="" name="file_access">
    <option value="0">Free</option>
    <option value="1">Paid</option>
</select>
</div>
         <div class="form-group">
<label>Popular <span class="label label-danger">*</span></label>
<select class="form-control" required="" name="popular">
    <option value="0">No</option>
    <option value="1">Yes</option>
</select>
</div>
         <div class="form-group">
<label>Hot News<span class="label label-danger">*</span></label>
<select class="form-control" required="" name="hot">
    <option value="0">No</option>
    <option value="1">Yes</option>
</select>
</div>
      <div class="form-group">
<label for="exampleTooltip">Resource price </label>
<input class="form-control" type="text" placeholder="e.g 50" name="price">
</div>
    <button type="submit" class="btn btn-success">Add News</button>  
</form>
</div>
</div>
</div>

</div>
