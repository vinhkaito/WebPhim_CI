<?php //print_r($data); ?>
<div class="panel panel-primary">
  <div class="panel-heading">Các phim của nhóm <?php echo $data->name; ?></div>
  <div class="panel-body">
  <div class="well">Trang chủ nhóm <?php echo $data->name?>: <?php echo anchor($data->homepage) ?></div>
<?php foreach ($data->series as $seri){?>
    <div class="media">
      <div class="media-left"><a href="<?php echo base_url("anime/$seri->slug.html"); ?>"><img class="media-object" width="100px" src="<?php echo $seri->thumbnail;?>"></a></div>
      <div class="media-body">
        <div class="media-heading"><h4><?php echo $seri->name;?></h4></div>
        Thể loại: <?php foreach ($seri->genres as $genre) echo "<a href=\"".base_url("the-loai/$genre->slug.html")."\"><span class=\"label label-default\">$genre->name</span></a>\n";?>
      </div>
    </div>
<?php } ?>
  </div>
</div>