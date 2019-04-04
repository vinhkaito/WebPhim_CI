<button id="skinSwitch" class="btn btn-primary">Change Skin</button>
<?php $this->load->view('_partials/navbar'); ?>

<div class="container">
	<!-- <div class="page-header"><h1><?php echo $page_title; ?></h1></div> -->
	<section class="content">
		<?php $this->load->view('_partials/breadcrumb'); ?>
		<?php $this->load->view($inner_view); ?>
	</section>
</div>

<?php $this->load->view('_partials/footer'); ?>