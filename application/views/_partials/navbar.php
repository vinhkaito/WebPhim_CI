<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
<div class="container">

	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</button>
		 <a class="navbar-brand" href="#">
		<img alt="logo" height="35" width="150" src="https://i.imgur.com/ZPJB21V.png">
		
	</div>

	<div class="navbar-collapse collapse">

		<ul class="nav navbar-nav">
			<?php foreach ($menu as $parent => $parent_params): ?>

				<?php if (empty($parent_params['children'])): ?>

					<?php $active = ($current_uri==$parent_params['url'] || $ctrler==$parent); ?>
					<li <?php if ($active) echo 'class="active"'; ?>>
						<a href='<?php echo $parent_params['url']; ?>'>
							<i class='<?php echo $parent_params['icon']; ?>'></i> <?php echo $parent_params['name']; ?>
						</a>
					</li>

				<?php else: ?>

					<?php $parent_active = ($ctrler==$parent); ?>
					<li class='dropdown <?php if ($parent_active) echo 'active'; ?>'>
						<a data-toggle='dropdown' class='dropdown-toggle' href='#'>
							<i class='<?php echo $parent_params['icon']; ?>'></i> <?php echo $parent_params['name']; ?> <span class='caret'></span>
						</a>
						<ul role='menu' class='dropdown-menu'>
							<?php foreach ($parent_params['children'] as $name => $url): ?>
								<li><a href='<?php echo $url; ?>'>  <?php echo $name; ?></a></li>
							<?php endforeach; ?>
						</ul>
					</li>

				<?php endif; ?>

			<?php endforeach; ?>
		</ul>

		<?php $this->load->view('_partials/language_switcher'); ?>
		<div class="navbar-form navbar-right form-search search-only">
            <i class="search-icon glyphicon glyphicon-search"></i>
            <input type="text" class="form-control search-query" autocomplete="on" onkeyup="ajaxSearch();">
        	<div class="searchResults"></div>
        </div>
	</div>

</div>
</nav>