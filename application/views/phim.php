<style type="text/css">
body > .row {
	padding-top: 67px;
	margin: 0;
}
</style>

<button id="skinSwitch" class="btn btn-primary">Change Skin</button>
<?php //if(isset($ep['url'])) { echo "<div class='alert alert-danger'>Lỗi: video không tồn tại!</div>"; } else { ?>
	<div class="row">

		<div class="col-md-9">
			<div class="embed-responsive embed-responsive-16by9">
				<div id="myElement">Đang Tải Player...</div>
			</div>
			<div class="btn-group-justified action-bar">
				<div class="btn-group">
					<a class="btn btn-info btn-flat dropdown-toggle" data-toggle="dropdown" >
						<span class="glyphicon glyphicon-download-alt"></span><span class="hidden-xs">Tải Anime <span class="caret"></span></span>
					</a>
					<ul class="dropdown-menu" id="download-menu"></ul>
				</div>
				<a class="btn btn-primary btn-flat light-off-btn">
					<span class="glyphicon glyphicon-flash"></span><span class="hidden-xs"> Tắt đèn</span>
				</a>
				<a class="btn btn-warning btn-flat" data-toggle="modal" data-target="#reportModal">
					<span class="glyphicon glyphicon-warning-sign"></span><span class="hidden-xs"> Báo lỗi</span>
				</a>
				<?php if(isset($episode->prev)) {?>
					<a class="btn btn-success btn-flat btnPrevEP" href="<?php echo base_url("episode/".$episode->prev->id.'/'.url_title("$series->name tap ".$episode->prev->ep, "-", true));?>" role="button">
						<span class="glyphicon glyphicon-chevron-left"></span><span class="hidden-xs"> Tập trước</span>
					</a>
				<?php } ?>
				<?php if(isset($episode->next)) {?>
					<a class="btn btn-success btn-flat btnNextEP" href="<?php echo base_url("episode/".$episode->next->id.'/'.url_title("$series->name tap ".$episode->next->ep, "-", true));?>" role="button">
						<span class="glyphicon glyphicon-chevron-right"></span><span class="hidden-xs"> Tập tiếp theo</span>
					</a>
				<?php } ?>
			</div>

			<div class="panel">
				<div class="fb-comments" data-href="<?php echo base_url("anime/$series->id/".url_title($series->name, "-", true)) ?>" data-width="100%" data-numposts="5"></div>
			</div>
		</div>
		<div class="col-md-3" style="padding-left: 8px;">
			<div class="list-episodes page-episodes">
				<?php foreach ($series->list_episodes as $fansub): ?>
					<div class="fansub-name"><?php echo ($fansub->homepage) ? anchor($fansub->homepage, $fansub->name) : $fansub->name; ?></div>
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



		<div class="modal fade" id="reportModal">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body" id="reportBox">
						Báo lỗi <strong><?php echo $series->name ?></strong>
						<input hidden id="episodeID" value="<?php echo $id ?>">
						<textarea class="form-control" id="report-content" style="height: 100px;" placeholder="Chi tiết lỗi: không có sub, lỗi link,..."></textarea>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
						<button type="button" class="btn btn-primary report-btn" id="report-btn">Báo lỗi</button>
					</div>
				</div>
			</div>
		</div>
		<?php //} ?>
		<div id="fb-root"></div>
		<script>(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s); js.id = id;
			js.src = "https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.6";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));</script>
		<div class="light-off"></div>