<div class="row">
  <div class="col-md-9 col-lg-12" style="padding-top: 51px;">
    <div id="carousel-id" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        <?php foreach ($poster as $key => $value):?>
          <li data-target="#carousel-id" data-slide-to="<?php echo $key ?>" class="<?php if($key == 0) echo "active" ?>"></li>
        <?php endforeach; ?>
      </ol>
      <div class="carousel-inner">
        <?php foreach ($poster as $key => $value):?>
        <div class="item <?php if($key == 0) echo "active" ?>">
          <div style="background: url(<?php echo $value->poster ?>) center center; background-size: cover; height: 1000px;" class="poster-img"></div>
          <div class="container">
            <div class="carousel-caption">
			  <a href="<?php echo base_url("anime/$value->id/".url_title($value->name, "-", true)) ?>"><h1><?php echo $value->name ?></h1></a>
			  <p><?php echo $value->descriptions ?></p>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
      </div>
      <a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div>

	<h4 class="block-title <?php echo $TopSeriesViewedToday ?>"><span><i class="fa fa-play"></i><font color="red"> <b>TOP Anime Xem Nhiều Nhất Trong Ngày </b> </color><?php ?></span><small class="pull-right view-more"><a href="<?php $title = explode(' ', $TopSeriesViewedToday); echo base_url("anime-".strtolower($title[0])."-$title[1].html") ?>">Xem thêm</a></small></h4>
    <div class="row">
      <?php foreach($TopSeriesViewedToday as $item): $item->url = base_url("anime/$item->id/".url_title("$item->name", "-", true)); ?>
		<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 anime-item">
			<div class="btn-group-vertical">
				<div class="anime-thumbnail">
					<div class="faded">
						<a href="<?php echo $item->url ?>">
							<i class="fa fa-play"></i>
						</a>
					</div>
					<img class="mThumbnail" src="<?=$item->thumbnail?>" alt="<?=$item->name?>">
				</div>
				<a href="<?php echo $item->url ?>" role="button" class="btn btn-default btn-xs mCaption">
					<?php echo $item->name ?>
				</a>
				<span class="label label-primary label-type"><?php echo strtoupper($item->type);?></span>
				<span class="label label-success label-episodes"><i class="fa fa-eye"></i> <?php echo $item->today_views ?></span>
            <span class="label label-primary label-type"><?php echo strtoupper($series->type);?></span>
				<?php if($item->bluray) echo '<a href="#"><span class="label label-danger label-bd">BD</span></a>'; ?>
			</div>
			
		</div>
	<?php endforeach; ?>
    </div>
	
    <h4 class="block-title aqua"><span><i class="fa fa-play"></i> Mới cập nhật</span></h4>
    <div class="row">
    <?php foreach ($data as $series) { $series->url = base_url("anime/$series->id/".url_title("$series->name", "-", true)); ?>
      <div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 anime-item">
        <div class="btn-group-vertical">
          <div class="anime-thumbnail">
            <div class="faded"><a href="<?php echo $series->url ?>"><i class="fa fa-play"></i></a></div>
            <img class="mThumbnail" src="<?=$series->thumbnail?>" alt="<?=$series->name?>" data-toggle="modal" data-target="#<?=$series->id?>">
          </div>
          <a href="<?php echo $series->url ?>" role="button" class="btn btn-default btn-xs mCaption"><?=$series->name?></a>
            <span class="label label-success label-episodes">EP <?php echo "$series->lastEpisode/$series->total_episodes"?></span>
            <span class="label label-primary label-type"><?php echo strtoupper($series->type);?></span>
            <?php if($series->bluray) echo '<a href="#"><span class="label label-danger label-bd">BD</span></a>'; ?>
          </div>
          <div class="anime-info hidden">
            <div class="anime-name"><strong><?php echo $series->name ?></strong></div>
            <div class="anime-genres"><?php echo implode(', ', $series->genres); ?></div>
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
            <div class="faded"><a href="<?php echo $series->url ?>"><i class="fa fa-play"></i></a></div>
            <img class="mThumbnail" src="<?=$series->thumbnail?>" alt="<?=$series->name?>" data-toggle="modal" data-target="#<?=$series->id?>">
          </div>
          <a href="<?php echo $series->url ?>" role="button" class="btn btn-default btn-xs mCaption"><?=$series->name?></a>
            <span class="label label-primary label-type"><?php echo strtoupper($series->type);?></span>
            <span class="label label-success label-episodes">EP <?php echo "$series->lastEpisode/$series->total_episodes"?></span>
            <?php if($series->bluray) echo '<a href="#"><span class="label label-danger label-bd">BD</span></a>'; ?>
          </div>
          <div class="anime-info hidden">
            <div class="anime-name"><strong><?php echo $series->name ?></strong></div>
            <div class="anime-genres"><?php echo implode(", ", $series->genres) ?></div>
            <div class="anime-description"><?php echo $series->descriptions ?></div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

	<h4 class="block-title <?php echo explode(' ', $previousSeasonal)[0]; ?>"><span><i class="fa fa-play"></i> Anime <?php echo $previousSeasonal; ?></span><small class="pull-right view-more"><a href="<?php $title = explode(' ', $previousSeasonal); echo base_url("anime-".strtolower($title[0])."-$title[1].html") ?>">Xem thêm</a></small></h4>
	<div class="row">
		<?php foreach ($animePreviousSeasonal as $series) { $series->url = base_url("anime/$series->id/".url_title("$series->name", "-", true)); ?>
		<div class="col-xs-6 col-sm-4 col-md-3 col-lg-2 anime-item">
			<div class="btn-group-vertical">
				<div class="anime-thumbnail">
					<div class="faded"><a href="<?php echo $series->url ?>"><i class="fa fa-play"></i></a></div>
					<img class="mThumbnail" src="<?=$series->thumbnail?>" alt="<?=$series->name?>" data-toggle="modal" data-target="#<?=$series->id?>"></div>
					<a href="<?php echo $series->url ?>" role="button" class="btn btn-default btn-xs mCaption"><?=$series->name?></a>
					<span class="label label-primary label-type"><?php echo strtoupper($series->type);?></span>
					<?php if($series->bluray) echo '<a href="#"><span class="label label-danger label-bd">BD</span></a>'; ?>
				</div>
				<div class="anime-info hidden">
					<div class="anime-name"><strong><?php echo $series->name ?></strong></div>
					<div class="anime-genres"><?php echo implode(', ', $series->genres); ?></div>
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
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.7&appId=195795387472981";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>