<div class="row">
	<div class="col-md-9 col-lg-12">
		<div id="carousel-id" class="carousel slide" data-ride="carousel">
			<ol class="carousel-indicators">
				<?php foreach ($poster as $key => $value):?>
					<li data-target="#carousel-id" data-slide-to="<?php echo $key ?>" class="<?php if($key == 0) echo "active" ?>"></li>
				<?php endforeach; ?>
			</ol>
			<div class="carousel-inner">
				<?php foreach ($poster as $key => $value): ?>
					<div class="poster-item item <?php if($key == 0) echo "active" ?>">
						<a href="<?php echo base_url("anime/$value->id/".url_title($value->name, "-", true)) ?>">
						<div style="background: url(<?php echo $value->poster ?>) center center; background-size: cover; height: 600px;" class="poster-img"></div>
						<div class="play-btn">
							<i class="fa fa-play"></i>
						</div>
						<div class="caption">
							<div class="blur"></div>
							<div class="caption-text">
								<h1><?php echo $value->name ?></h1>
								<p>Thể loại : <?php echo implode(', ', $value->genres); ?></p>
								<p><?php echo $value->descriptions ?></p>
								<p>Tổng số tập : <?php echo ($value->total_episodes) ? $value->total_episodes : '?' ?></p>
								<p>Tổng lượt xem : <?php echo ($value->total_views)?></p>
							</div>
						</div>
						</a>
					</div>
				<?php endforeach; ?>
			</div>
			<a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
			<a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
		</div>

		<h4 class="block-title aqua">
			<span><i class="fa fa-play"></i> TOP Anime Xem Nhiều Nhất</span>
			</span><small class="pull-right view-more">
			<a href="<?php $title = explode(' ', $TopSeriesViewedToday); echo base_url("top/".strtolower($title[0])."") ?>">Xem thêm</a></small></h4>
		</h4>
		<div class="row">
			<?php foreach($TopSeriesViewedToday as $item): 
			if ($item->total_episodes == 0) $item->total_episodes = '?'; 
			if ($item->lastEpisode == 0) $item->lastEpisode = 'Preview'; 
			$item->url = base_url("anime/$item->id/".url_title("$item->name", "-", true)); ?>
				<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 anime-item">
					<div class="btn-group-vertical">
						<div class="anime-thumbnail">
							<a class="faded" href="<?php echo $item->url ?>">
								<i class="fa fa-play"></i>
							</a>
						</div>
						<img class="mThumbnail" src="<?=$item->thumbnail?>" alt="<?=$item->name?>">
					<a href="<?php echo $item->url ?>" role="button" class="btn btn-default btn-xs mCaption">
						<?php echo $item->name ?>
					</a>
					<span class="label label-success label-episodes"><i class="fa fa-eye"></i> <?php echo $item->total_views ?></span>
					<span class="label label-primary label-type"><?php echo strtoupper($item->type);?></span>
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

	<h4 class="block-title aqua"><span><i class="fa fa-star"></i> Mới cập nhật</span></h4>
	<div class="row">
		<?php foreach ($data as $series) { $series->url = base_url("anime/$series->id/".url_title("$series->name", "-", true));
			if ($series->total_episodes == 0) $series->total_episodes = '?'; 
			if ($series->lastEpisode == 0) $series->lastEpisode = 'Preview'; 		?>
		<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 anime-item">
			<div class="btn-group-vertical">
				<div class="anime-thumbnail">
					<a class="faded" href="<?php echo $series->url ?>"><i class="fa fa-play"></i></a>
					<img class="mThumbnail" src="<?=$series->thumbnail?>" alt="<?=$series->name?>" data-toggle="modal" data-target="#<?=$series->id?>">
				</div>
				<a href="<?php echo $series->url ?>" role="button" class="btn btn-default btn-xs mCaption"><?=$series->name?></a>
				<span class="label label-success label-episodes">EP <?php echo "$series->lastEpisode/$series->total_episodes"?></span>
				<span class="label label-primary label-type"><?php echo strtoupper($series->type);?></span>
				<?php if($series->bluray) echo '<a href="#"><span class="label label-danger label-bd">BD</span></a>'; ?>
          </div>
			<div class="anime-info hidden">
            <div class="anime-name"><strong><?php echo $series->name ?></strong></div>
			<div class="anime-genres">Thể loại : <?php echo implode(', ', $series->genres); ?></div>
			<div class="anime-total_views"><strong>Tổng lượt xem : <?php echo $series->total_views ?></strong></div>
			<div class="anime-today_views"><strong>Lượt xem trong ngày : <?php echo $series->today_views ?></strong></div>
			<div class="anime-total_episodes"><strong>Số tập : <?php echo $series->total_episodes ?></strong></div>
			<div class="anime-duration"><strong>Độ dài : <?php echo $series->duration ?></strong></div>
			<div class="anime-studios"><strong>Studio : <?php echo $series->studios ?></strong></div>
			<div class="anime-season"><strong>Mùa : <?php echo $series->season ?></strong></div>
			<div class="anime-description"><?php echo $series->descriptions ?></div>
          </div>
		</div>
		<?php } ?>
	</div>

	<h4 class="block-title <?php echo $seasonal ?>"><span><i class="fa fa-star"></i> Anime <?php echo $seasonal ?></span><small class="pull-right view-more"><a href="<?php $title = explode(' ', $seasonal); echo base_url("anime-".strtolower($title[0])."-$title[1].html") ?>">Xem thêm</a></small></h4>
	<div class="row">
		<?php foreach($blockSeason as $series): $series->url = base_url("anime/$series->id/".url_title("$series->name", "-", true)); ?>
			<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 anime-item">
				<div class="btn-group-vertical">
					<div class="anime-thumbnail">
						<a class="faded" href="<?php echo $series->url ?>"><i class="fa fa-play"></i></a>
						<img class="mThumbnail" src="<?=$series->thumbnail?>" alt="<?=$series->name?>" data-toggle="modal" data-target="#<?=$series->id?>">
					</div>
					<a href="<?php echo $series->url ?>" role="button" class="btn btn-default btn-xs mCaption"><?=$series->name?></a>
					<span class="label label-primary label-type"><?php echo strtoupper($series->type);?></span>
					<span class="label label-success label-episodes">EP <?php echo "$series->lastEpisode/$series->total_episodes"?></span>
					<?php if($series->bluray) echo '<a href="#"><span class="label label-danger label-bd">BD</span></a>'; ?>
				</div>
				<div class="anime-info hidden">
					<div class="anime-name"><strong><?php echo $series->name ?></strong></div>
					<div class="anime-genres">Thể loại : <?php echo implode(', ', $series->genres); ?></div>
					<div class="anime-total_views"><strong>Tổng lượt xem : <?php echo $series->total_views ?></strong></div>
					<div class="anime-today_views"><strong>Lượt xem trong ngày : <?php echo $series->today_views ?></strong></div>
					<div class="anime-total_episodes"><strong>Số tập : <?php echo $series->total_episodes ?></strong></div>
					<div class="anime-duration"><strong>Độ dài : <?php echo $series->duration ?></strong></div>
					<div class="anime-studios"><strong>Studio : <?php echo $series->studios ?></strong></div>
					<div class="anime-season"><strong>Mùa : <?php echo $series->season ?></strong></div>
					<div class="anime-description"><?php echo $series->descriptions ?></div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>

	<h4 class="block-title <?php echo explode(' ', $previousSeasonal)[0]; ?>"><span><i class="fa fa-star"></i> Anime <?php echo $previousSeasonal; ?></span><small class="pull-right view-more"><a href="<?php $title = explode(' ', $previousSeasonal); echo base_url("anime-".strtolower($title[0])."-$title[1].html") ?>">Xem thêm</a></small></h4>
	<div class="row">
		<?php foreach ($animePreviousSeasonal as $series) { $series->url = base_url("anime/$series->id/".url_title("$series->name", "-", true)); ?>
		<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 anime-item">
			<div class="btn-group-vertical">
				<div class="anime-thumbnail">
					<a class="faded" href="<?php echo $series->url ?>"><i class="fa fa-play"></i></a>
					<img class="mThumbnail" src="<?=$series->thumbnail?>" alt="<?=$series->name?>" data-toggle="modal" data-target="#<?=$series->id?>"></div>
					<a href="<?php echo $series->url ?>" role="button" class="btn btn-default btn-xs mCaption"><?=$series->name?></a>
					<span class="label label-primary label-type"><?php echo strtoupper($series->type);?></span>
					<span class="label label-success label-episodes">EP <?php echo "$series->lastEpisode/$series->total_episodes"?></span>
					<?php if($series->bluray) echo '<a href="#"><span class="label label-danger label-bd">BD</span></a>'; ?>
				</div>
				<div class="anime-info hidden">
					<div class="anime-name"><strong><?php echo $series->name ?></strong></div>
					<div class="anime-genres">Thể loại : <?php echo implode(', ', $series->genres); ?></div>
					<div class="anime-total_views"><strong>Tổng lượt xem : <?php echo $series->total_views ?></strong></div>
					<div class="anime-today_views"><strong>Lượt xem trong ngày : <?php echo $series->today_views ?></strong></div>
					<div class="anime-total_episodes"><strong>Số tập : <?php echo $series->total_episodes ?></strong></div>
					<div class="anime-duration"><strong>Độ dài : <?php echo $series->duration ?></strong></div>
					<div class="anime-studios"><strong>Studio : <?php echo $series->studios ?></strong></div>
					<div class="anime-season"><strong>Mùa : <?php echo $series->season ?></strong></div>
					<div class="anime-description"><?php echo $series->descriptions ?></div>
				</div>
			</div>
			<?php } ?>
		</div>

	</div>


</div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
	var js, fjs = d.getElementsByTagName(s)[0];
	if (d.getElementById(id)) return;
	js = d.createElement(s); js.id = id;
	js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7";
	fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<button id="skinSwitch" class="btn btn-primary">Change Skin</button>