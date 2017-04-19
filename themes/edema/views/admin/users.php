<div class="row">
<div class="col-lg-12">
<div class="main-box no-header clearfix">
<div class="main-box-body clearfix">
<div class="table-responsive">
<table class="table user-list table-hover">
<thead>
<tr>
<th><span>Fullname</span></th>
<th><span>Created</span></th>
<th><span>Email</span></th>
<th>&nbsp;</th>
</tr>
</thead>
<tbody>
    <?php foreach ($site["users"] as $us):?>
<tr>
<td>
<a  class="user-link"><?=$us["fullname"]?></a>
</td>
<td>
<?=$us["date"]?>
</td>
<td>
<a href="#"><?=$us["email"]?><script cf-hash="f9e31" type="text/javascript">
/* <![CDATA[ */!function(){try{var t="currentScript"in document?document.currentScript:function(){for(var t=document.getElementsByTagName("script"),e=t.length;e--;)if(t[e].getAttribute("cf-hash"))return t[e]}();if(t&&t.previousSibling){var e,r,n,i,c=t.previousSibling,a=c.getAttribute("data-cfemail");if(a){for(e="",r=parseInt(a.substr(0,2),16),n=2;a.length-n;n+=2)i=parseInt(a.substr(n,2),16)^r,e+=String.fromCharCode(i);e=document.createTextNode(e),c.parentNode.replaceChild(e,c)}}}catch(u){}}();/* ]]> */</script></a>
</td>
<td style="width: 20%;">
    <a href="<?=App::route("requests", "delete_user?action=".$us["id"])?>" class="table-link danger">
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