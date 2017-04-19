<div class="row">
    
    
    
    <div class="col-lg-12">
<div class="main-box">
<header class="main-box-header clearfix">
<h2>Page Design</h2>
</header>
<div class="main-box-body clearfix">
    <form class="" role="form" action="<?=App::route("requests/updateviews")?>" method="post">
             <div class="form-group">
<label class="" for="exampleInputEmail2">Standard Download Price</label>
<input class="form-control" id="exampleInputEmail2" value="<?=$site["misc"]["price"]?>" placeholder="Download prices" required="" type="text" name="price">
</div>
<div class="form-group">
<label  for="exampleInputEmail2">About Site</label>
<?=$this->ckeditor->editor("about",$site["misc"]["about"])?>
</div>
<div class="form-group">
<label  for="exampleInputEmail2">Terms</label>
<?=$this->ckeditor->editor("terms",$site["misc"]["terms"])?>
</div>
  <div class="form-group">
<label  for="exampleInputEmail2">Privacy</label>
<?=$this->ckeditor->editor("privacy",$site["misc"]["privacy"])?>
</div>
    <div class="form-group">
<label  for="exampleInputEmail2">Business Inquiries</label>
<?=$this->ckeditor->editor("business",$site["misc"]["business_inc"])?>
</div>
<button type="submit" class="btn btn-success">Update Views</button>
</form>
</div>
</div>
</div>
     
</div>