<header id="welcome" class="bg-sharp-gradient-red text-light center-2d-old height-100" style="background-image: url('https://quickbrow.se/QuickBrowse/assets/img/background/mountains-red.svg');">
	<div class="container text-center">
		<img data-wow-delay="0.5s" style="visibility:hidden;" width="150px" class="mx-auto wow flipInX" src="<?=$QB->ASSETS->get_asset('IMG-LOGO');?>" alt="QuickBrow.se Branding" />
		<h1 data-wow-duration="0.5s" data-wow-delay="1s" style="visibility:hidden;" class="wow zoomIn display-1 text-light text-truncate">QuickBrowse</h1>
		<p data-wow-duration="0.5s" data-wow-delay="1.5s" style="visibility:hidden;" class="lead wow zoomIn">
			<?=$QB->TEMPLATE->DESCRIPTION;?>
		</p>
		<a href="<?=$QUICKBROWSE->DOMAIN;?>/docs/get-started" class="animated zoomIn delay-2s my-3 btn btn-outline-light border-2 font-weight-bold">Get Started</a>
		<a href="<?=$QUICKBROWSE->DOMAIN;?>/signup/" class="animated zoomIn delay-2s my-3 btn btn-outline-light border-2 font-weight-bold">Create Account</a>
	</div>
</header>

<?=$QUICKBROWSE->ASSETS->PACKAGE->banner('download', 'bg-sharp-gradient-red');?>

<section id="features" class="bg-gradient-red">
	<div class="container">
	  <div class="row">
		<div class="col-md-8 mx-auto text-center">
		  <h2 class="text-light">Features</h2>
		  <p class="lead">From QuickBrowse version <span class="font-weight-bold text-dark"><?=$QUICKBROWSE->VERSION;?>+</span>.</p>
		  <div class="jumbotron p-5 text-left m-5 width-md-9 width-xl-6 center-1d bg-sharp-gradient-light">
			<table id="feature-list" class="list">
				<tr>
					<td><p class="mb-1 ml-2" style="font-size: 18px;">1.</p></td>
					<td><p class="mb-1 mr-2 ml-4 mt-1 wow fadeIn" data-wow-duration="3s" style="font-size: 18px;">Simple templating structure.</td>
				</tr>
				<tr>
					<td><p class="mb-1 ml-2 mt-1" style="font-size: 18px;">2.</p></td>
					<td><p class="mb-1 mr-2 ml-4 mt-1 wow fadeIn" data-wow-duration="2s" style="font-size: 18px;">Build-in CRUD without SQL queries.</p></td>
				</tr>
				<tr>
					<td><p class="mb-1 ml-2 mt-1" style="font-size: 18px;">3.</p></td>
					<td><p class="mb-1 mr-2 ml-4 mt-1 wow fadeIn" data-wow-duration="1.5s" style="font-size: 18px;">URL pipeline with useful functionality.</p></td>
				</tr>
				<tr>
					<td><p class="mb-1 ml-2 mt-1" style="font-size: 18px;">4.</p></td>
					<td><p class="mb-1 mr-2 ml-4 mt-1 wow fadeIn" data-wow-duration="2s" style="font-size: 18px;">Components like PHPMailer and Animate.css.</p></td>
				</tr>
				<tr>
					<td><p class="mb-1 ml-2 mt-1" style="font-size: 18px;">5.</p></td>
					<td><p class="mb-1 mr-2 ml-4 mt-1 wow fadeIn" data-wow-duration="1s" style="font-size: 18px;">Connected API's with Javscript &amp; PHP.</p></td>
				</tr>
				<tr>
					<td><p class="mb-1 ml-2 mt-1" style="font-size: 18px;">6.</p></td>
					<td><p class="mb-1 mr-2 ml-4 mt-1 wow fadeIn" data-wow-duration="3s" style="font-size: 18px;">Online documentation with helpful information.</p></td>
				</tr>
				<tr>
					<td><p class="mb-1 ml-2 mt-1" style="font-size: 18px;">7.</p></td>
					<td><p class="mb-1 mr-2 ml-4 mt-1 wow fadeIn" data-wow-duration="1s" style="font-size: 18px;">CSS / HTML snippets for lighting fast design.</p></td>
				</tr>
				<tr>
					<td><p class="mb-1 ml-2 mt-1" style="font-size: 18px;">8.</p></td>
					<td><p class="mb-1 mr-2 ml-4 mt-1 wow fadeIn" data-wow-duration="2s" style="font-size: 18px;">Own CDN for every asset included.</p></td>
				</tr>
			</table>
		  </div>
		  <p class="lead">More information about QuickBrowse's Features can be found at:<br><a href="<?=$QUICKBROWSE->DOMAIN;?>/docs/" class="text-light"><?=$QUICKBROWSE->DOMAIN;?>/docs/</a>.</p>
		</div>
	  </div>
	</div>
</section>

<?=$QUICKBROWSE->ASSETS->PACKAGE->banner('contact', 'bg-sharp-gradient-red');?>

<section id="download" class="bg-gradient-red">
	<div class="container">
	  <div class="row">
		<div class="col-md-8 mx-auto text-center">
			<?php
			//Include sidebar
			include_once($QUICKBROWSE->TEMPLATE_ROOT . '/includes/download-section.php');
			?>
		</div>
	  </div>
	</div>
</section>

<?=$QUICKBROWSE->ASSETS->PACKAGE->banner('download', 'bg-sharp-gradient-red');?>

<section id="tutorials" class="bg-gradient-red">
	<div class="container text-center">
	<h2 class="text-light">Tutorials</h2>
	<p class="lead text-light">We provide you with FREE QuickBrowse backend and front-end development video tutorials.</p>
	  <div class="row text-light">
		<?php
			//display uploads from playlist
			$QUICKBROWSE->ASSETS->PACKAGE->video_playlist('PLoYCgNOIyGAB_8_iq1cL8MVeun7cB6eNc', 4);
		?>
	  </div>
	  <div class="row text-light">
		<?php
			//display uploads from playlist
			$QUICKBROWSE->ASSETS->PACKAGE->video_playlist('PLRtjMdoYXLf47brThg9-nTj8HSq8cQ0ND', 8);
		?>
	  </div>
	</div>
</section>

<?=$QUICKBROWSE->ASSETS->PACKAGE->banner('contact', 'bg-gradient-red');?>

<section id="updates" class="bg-sharp-gradient-light">
	<div class="container">
		<div class="col-md-7 mx-auto">
		  <h2 class="text-primary">Latest Update</h2>
		  <p class="lead">Most recent update that've been uploaded to the blog.</p>
		  <?php
			//Display limited blog posts tagged with 'update'.
			$QB->HTML->blog_posts($QB->POSTS, $QB->USERS, 'update', 1, true, false);
		  ?>
		</div>
	</div>
</section>