<?php
$anime_genres = array();
foreach ($series->genres as $genre) $anime_genres[] = anchor("genre/$genre->id/".url_title($genre->name, "-", true), $genre->name)."\n"; 
?>
<div class="row">
	<div class="col-sm-9">
		<div class="panel panel-info">
			<div class="panel-heading"><i class="glyphicon glyphicon-info-sign"></i> Thông tin</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-sm-3">
						<img class="img-responsive" itemprop="image" src="<?php echo $series->thumbnail?>">
						<button class="btn btn-primary btn-block bookmark-btn" data-animeid="<?php echo $series->id ?>">
							<i class="fa fa-bookmark"></i> Xem sau
						</button>
						<button class="btn btn-default btn-block bookmark-remove-btn" style="display: none;" data-animeid="<?php echo $series->id ?>">Xóa xem sau
						</button>
					</div>
					<div class="col-lg-9">
						<div class="anime-info">
							<li><span itemprop="name"><h5><?php echo $series->name ?></h5></span></li>
							<li><b>Loại:</b> <?php echo $series->type ?></li>
							<li><b>Số tập:</b> <?php echo $series->total_episodes?></li>
							<li><b>Thời lượng:</b> <?php echo $series->duration?></li>
							<li><b>Thể loại:</b> <?php echo implode(', ', $anime_genres)  ?></li>
							<li><b>Season:</b> <?php echo $series->season?></li>
							<li><b>Studio:</b> <?php echo $series->studios?></li>
							<li><b>Lượt xem:</b> <?php echo $series->total_views?></li>
						</div>
						<div class="col-lg-12">
							<div class="row"><hr><span itemprop="description"><?php echo $series->descriptions?></span></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-sm-9">
		<div class="panel panel-primary">
			<div class="panel-heading"><span class="glyphicon glyphicon-film"></span> Tập phim</div>
			<div class="panel-body">
				<div class="list-episodes-anime">
					<?php foreach ($series->list_episodes as $fansub): ?>
						<div class="fansub-name"><?php echo anchor($fansub->homepage, $fansub->name); ?></div>
						<div>
							<ul class="pagination episodes">
								<?php foreach ($fansub->episodes as $key => $ep): ?>
									<li <?php if($key == $ep->id) echo 'class="active"' ?>>
										<?php echo anchor("episode/$ep->id/".url_title("$series->name tap $ep->ep", "-", true), $ep->ep) ?>
									</li>
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>