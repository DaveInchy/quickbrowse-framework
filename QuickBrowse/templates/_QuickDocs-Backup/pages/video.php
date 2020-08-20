<header id="video" class="bg-sharp-gradient-purple py-5 height-100">
	<div class="container mt-5 pt-5 text-light">
		<?php $QUICKBROWSE->ASSETS->PACKAGE->video($vid, 'text-light'); ?>
	</div>
</header>

<?=$QUICKBROWSE->ASSETS->PACKAGE->banner('contact', 'bg-gradient-purple');?>

<section id="playlist" class="bg-sharp-gradient-light">
	<div class="container">
		<h3>Bootstrap Tutorials</h3>
		<div class="row">
			<?php $QUICKBROWSE->ASSETS->PACKAGE->video_playlist('PLRtjMdoYXLf47brThg9-nTj8HSq8cQ0ND', 50, 'text-dark'); ?>
		</div>
		<h3>Web-development beginners Tutorials</h3>
		<div class="row">
			<?php $QUICKBROWSE->ASSETS->PACKAGE->video_playlist('PLoYCgNOIyGAB_8_iq1cL8MVeun7cB6eNc', 30, 'text-dark'); ?>
		</div>
	</div>
</section>