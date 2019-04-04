<div class="box box-primary">
<div class="box-body">
<table class="table table-bordered">
<tbody>
	<?php foreach ($data as $genre_id => $genre_name)
	echo "<tr><td>$genre_id</td><td>$genre_name</td><td><a href='".base_url("$controller/genres/edit/$genre_id")."'>Edit</a></td></tr>\n"; ?>
</tbody>
</table>
</div>
</div>