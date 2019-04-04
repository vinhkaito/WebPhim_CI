<div class="panel panel-primary">
  <div class="panel-heading">Thể loại <?php echo $genre->name; ?></div>
  <div class="panel-body">
<?php foreach ($data as $seri){?>
  <div class="col-md-6 col-lg-6">
    <div class="row">
    <div class="media">
      <div class="media-left"><a href="<?php echo base_url("anime/$seri->slug.html"); ?>">
        <img class="media-object" width="100px" height="136px" src="<?php echo $seri->thumbnail;?>"></a></div>
      <div class="media-body">
        <div class="media-heading"><strong><?php echo $seri->name;?></strong></div>
        <div class="genres-type"><strong>Type:</strong> <?php echo strtoupper($seri->type);?></div>
        <div class="genres-season"><strong>Season:</strong> <?php echo $seri->season?></div>
      </div>
    </div>
    </div>
    <hr>
  </div>
<?php } ?>
  </div>
</div>