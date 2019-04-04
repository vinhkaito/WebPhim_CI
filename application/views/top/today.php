<div class="col-lg-12">
	<?php foreach($anime as $item):
		if ($item->total_episodes == 0) $item->total_episodes = '?'; 
		if ($item->lastEpisode == 0) $item->lastEpisode = 'Preview'; 
		$item->url = base_url("anime/$item->id/".url_title("$item->name", "-", true)); ?>
		<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 anime-item">
			<div class="btn-group-vertical">
				<div class="anime-thumbnail">
					<a class="faded" href="<?php echo $item->url ?>"><i class="fa fa-play"></i></a>
					<img class="mThumbnail" src="<?=$item->thumbnail?>" alt="<?=$item->name?>">
				</div>
				<a href="<?php echo $item->url ?>" role="button" class="btn btn-default btn-xs mCaption">
					<?php echo $item->name ?>
				</a>
				<span class="label label-primary label-type"><?php echo strtoupper($item->type);?></span>
				<!-- 					<span class="label label-success label-episodes"><i class="fa fa-eye"></i> <?php echo $item->today_views ?></span> -->
				<span class="label label-info label-episodes-right">EP <?php echo "$item->lastEpisode/$item->total_episodes"?></span>
				<?php if($item->bluray) echo '<a href="#"><span class="label label-danger label-bd">BD</span></a>'; ?>
			</div>
			<div class="anime-info hidden">
				<div class="anime-name"><strong><?php echo $item->name ?></strong></div>
				<div class="anime-genres">Thể loại : <?php echo implode(', ', $item->genres); ?></div>
				<div class="anime-total_views"><strong>Tổng lượt xem : <?php echo $item->total_views ?></strong></div>
				<div class="anime-today_views"><strong>Lượt xem trong ngày : <?php echo $item->today_views ?></strong></div>
				<div class="anime-total_episodes"><strong>Số tập : <?php echo $item->total_episodes ?></strong></div>
				<div class="anime-duration"><strong>Độ dài : <?php echo $item->duration ?></strong></div>
				<div class="anime-studios"><strong>Studio : <?php echo $item->studios ?></strong></div>
				<div class="anime-season"><strong>Mùa : <?php echo $item->season ?></strong></div>
				<div class="anime-description"><?php echo $item->descriptions ?></div>
			</div>
		</div>
	<?php endforeach; ?>
</div>