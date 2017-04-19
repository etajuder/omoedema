<div class="row">
<div class="col-lg-12">
<div class="main-box">
<header class="main-box-header clearfix">
<h2>Add News</h2>
</header>
<div class="main-box-body clearfix">
    <?=@$form["message"]?>
    <form role="form" action="" method="post" enctype="multipart/form-data">
<div class="form-group">
<label for="exampleInputEmail1">News Title <span class="label label-danger">*</span></label>
<input class="form-control" id="exampleInputEmail1" name="title" required="" value="<?=$news_item["title"]?>" placeholder="Enter title" type="title">
</div>
<div class="form-group">
<label>News Category <span class="label label-danger">*</span></label>
<select class="form-control" required="" name="category">
   <?php foreach ($site["categories"] as $cate):?>
    <option value="<?=$cate["id"]?>" <?php if($cate["name"] == $news_item["name"]):?> selected="" <?php endif;?>><?=$cate["name"]?></option>
    <?php endforeach;?>
</select>
</div>
<div class="form-group">
    <label for="exampleTextarea">News Body <span class="label label-danger">*</span></label>
  <?=$this->ckeditor->editor("body",$news_item["body"])?>
</div>

  <div class="form-group">
<label>Download Resources <span class="label label-danger">*</span></label>
<select class="form-control" required="" name="file_access">
    <option value="0" <?php if($news_item["user_id"] == 0):?> selected="" <?php endif;?>>Free</option>
    <option value="1"  <?php if($news_item["user_id"] == 1):?> selected="" <?php endif;?>>Paid</option>
</select>
</div>
 <div class="form-group">
<label for="exampleInputEmail1">News Title <span class="label label-danger">*</span></label>
<input class="form-control" id="exampleInputEmail1" name="price" required="" value="<?=$news_item["price"]?>" placeholder="Enter Price" type="text">
</div>
    <button type="submit" class="btn btn-success">Add News</button>  
</form>
</div>
</div>
</div>

</div>
