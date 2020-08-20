<?=$QUICKBROWSE->ASSETS->PACKAGE->header('Downloads', 'Pick a QuickBrowse version and a Template to start with', 'bg-gradient-purple text-center');?>
<section id="download" class="bg-light">
	<div class="container">
	  <div class="row">
		<div class="col-md-8 mx-auto">
		  <?php
			//Include sidebar
			include_once($QUICKBROWSE->TEMPLATE_ROOT . '/includes/download-section.php');
		  ?>
		</div>
	  </div>
	</div>
</section>