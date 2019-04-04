<?php if($showForm): ?>
	<div class="panel">
		<div class="panel-body">
			<form class="search-form">
				<div class="col-xs-12 col-lg-12">
					<?php foreach($genres as $key => $genre) { ?>
						<div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
							<div class="checkbox">
								<input type="checkbox" id="flat-checkbox-<?=$key?>" name="genres[]" value="<?=$genre->id?>">
								<label for="flat-checkbox-<?=$key?>"><?=$genre->name?></label>
							</div>
						</div>
					<?php } ?>
				</div>
				<div class="col-lg-12">
					<div class="row">
						<div class="form-inline">
							<select class="form-control" name="season">
								<option value="">Mùa</option>
								<option value="winter">Winter</option>
								<option value="spring">Spring</option>
								<option value="summer">Summer</option>
								<option value="fall">Fall</option>
							</select>
							
							<select class="form-control" name="year">
								<option value="">Năm sản xuất</option>
								<?php for($i = date("Y"); $i > 1999; $i--) echo '<option value="'.$i.'">'.$i.'</option>'.PHP_EOL;?>
							</select>
							<input class="form-control" name="keyword" placeholder="Từ khóa">
							<button class="btn btn-primary search-btn">Tìm kiếm</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
<?php endif; ?>
<?php if(isset($customHTML) && $customHTML) echo $customHTML; ?>
<div class="panel">
	<div class="panel-body">
		<div class="row">
			<?php foreach($searchResult as $anime):
				if ($anime->total_episodes == 0) $anime->total_episodes = '?'; 
				if ($anime->lastEpisode == 0) $anime->lastEpisode = 'Preview'; 
				$anime->url = base_url("anime/$anime->id/".url_title("$anime->name", "-", true)); ?>
				<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2 anime-item">
					<div class="btn-group-vertical">
						<div class="anime-thumbnail">
							<a href="<?php echo $anime->url ?>"><img class="mThumbnail" src="<?php echo $anime->thumbnail ?>" alt="<?php echo $anime->name ?>"></a>
						</div>
						<a href="<?php echo base_url("anime/$anime->slug.html") ?>" role="button" class="btn btn-default btn-xs mCaption"><?php echo $anime->name ?></a>
						<span class="label label-primary label-type"><?php echo strtoupper($anime->type);?></span>
						<!-- 				<span class="label label-success label-episodes"><i class="fa fa-eye"></i> <?php echo $anime->today_views ?></span> -->
						<span class="label label-info label-episodes-right">EP <?php echo "$anime->lastEpisode/$anime->total_episodes"?></span>
						<?php if($anime->bluray) echo '<a href="#"><span class="label label-danger label-bd">BD</span></a>'; ?>
					</div>
					<div class="anime-info hidden">
						<div class="anime-name"><strong><?php echo $anime->name ?></strong></div>
						<div class="anime-genres">Thể loại : <?php echo implode(', ', $anime->genres); ?></div>
						<div class="anime-total_views"><strong>Tổng lượt xem : <?php echo $anime->total_views ?></strong></div>
						<div class="anime-today_views"><strong>Lượt xem trong ngày : <?php echo $anime->today_views ?></strong></div>
						<div class="anime-total_episodes"><strong>Số tập : <?php echo $anime->total_episodes ?></strong></div>
						<div class="anime-duration"><strong>Độ dài : <?php echo $anime->duration ?></strong></div>
						<div class="anime-studios"><strong>Studio : <?php echo $anime->studios ?></strong></div>
						<div class="anime-season"><strong>Mùa : <?php echo $anime->season ?></strong></div>
						<div class="anime-description"><?php echo $anime->descriptions ?></div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="center"><?php echo $pagination ?></div>
	</div>
</div>