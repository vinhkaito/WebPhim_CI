<div class="row">
<div class="col-lg-12">
	<div class="panel panel-info">
		<div class="panel-heading"><?php echo "Anime $season" ?></div>
		<div class="panel-body">
		  <div class="row">
			<?php foreach($data as $anime): ?>
			<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2 anime-item">
        		<div class="btn-group-vertical">
         			<div class="anime-thumbnail">
            			<a href="<?php echo base_url("anime/$anime->slug.html") ?>"><img class="mThumbnail" src="<?php echo $anime->thumbnail ?>" alt="<?php echo $anime->name ?>" data-toggle="modal" data-target="#218"></a>
          			</div>
          			<a href="<?php echo base_url("anime/$anime->slug.html") ?>" type="button" role="button" class="btn btn-default btn-xs 	mCaption"><?php echo $anime->name ?></a>
            		<span class="label label-primary label-type"><?php echo $anime->type ?></span>
            	</div>
       			<div class="anime-info hidden">
        			<div class="anime-name"><b><?php echo $anime->name ?></b></div>
        			<div class="anime-genres"><?php echo implode(', ', $anime->genres) ?></div>
        			<div class="anime-description"><?php echo $anime->descriptions ?></div>
        		</div>
        	</div>
			<?php endforeach; ?>
		  </div>
      <center><?php echo $pagination; ?></center>
		</div><!-- END panel-body -->
	</div>
</div>
</div>