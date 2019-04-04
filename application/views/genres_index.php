<div class="panel panel-default">
  <div class="panel-body">
<?php foreach($data as $genre) { 
	$slug = strtolower(implode('-', explode(' ', $genre->name)));
	$genre->slug = "the-loai/$slug-$genre->id.html";
	?>
<div class="col-lg-2 col-md-3 col-sm-4 col-xs-4">
  <a href="<?php echo "$genre->slug";?>"><?php echo $genre->name?></a>
</div>
<?php } ?>
  </div>
</div>