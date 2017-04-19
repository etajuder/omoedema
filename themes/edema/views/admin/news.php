<div class="row">
<div class="col-lg-">
<div class="main-box no-header clearfix">
<div class="main-box-body clearfix">
<div class="table-responsive">
<table class="table user-list table-hover">
<thead>
<tr>
<th><span>Cover</span></th>
<th><span>Title</span></th>
<th><span>Created</span></th>
<th class="text-center"><span>Category</span></th>

<th>&nbsp;</th>
</tr>
</thead>
<tbody>
    <?php foreach ($site["news"] as $news):?>
<tr>
<td>
<img src="<?=$news["picture"]?>" alt="">
</td>
<td>
    <a href="<?=$news["link"]?>" target="_blank"><?=$news["title"]?></a>
</td>
<td class="text-center">
<?=$news["created_at"]?>
</td>
<td>
<?=$news["name"]?>
</td>
<td style="width: 20%;">
    <a href="<?=App::route("superuser/news/".$news["id"])?>" class="table-link">
<span class="fa-stack">
<i class="fa fa-square fa-stack-2x"></i>
<i class="fa fa-pencil fa-stack-1x fa-inverse"></i>
</span>
</a>
    <a href="<?=App::route("requests", "deletenews?action=".$news["id"])?>" class="table-link danger">
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
</div>