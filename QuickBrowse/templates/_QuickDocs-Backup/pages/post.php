<section id="post">
	<div class="container">
		<div class="row">
			<div class="col-md-10 mx-auto">
				<h2>Post <small class="text-capitalize">by <?=$postdata['author_name'];?></small></h2>
				<p class="lead">Posted on <?=$postdata['date'];?></p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-7 ml-auto">
				<div class="jumbotron bg-light pt-4">
					<h3 class="text-danger pt-3 font-weight-bold display-3" style="font-size: 36px;"><?=$postdata['title'];?></h3>
					<?php
					if(!empty($postdata['thumbnail']) && isset($postdata['thumbnail']) && $postdata['thumbnail'] != 'none'){
						?><img class="img-fluid my-3" style="border: 0px solid white; border-radius: .5em;" src="<?=$postdata['thumbnail'];?>" /><?php
					}else{
						?><div class="my-3 center-2d py-5 height-40 width-10 bg-sharp-gradient-light" style="border: 2px solid #eee; border-radius: .3em;"><div><div class="center-2d"><?=$QUICKBROWSE->ASSETS->PACKAGE->img('IMG-LOGO', 125);?></div><h3>&lt/QuickBrowse></h3></div></div><?php
					}
					?>
					<div class="text-dark">
						<?=$postdata['content'];?>
					</div>
				</div>
			</div>
			<div class="col-md-3 mr-auto d-none d-md-block">
				<?php
				//Include sidebar
				include_once($QUICKBROWSE->TEMPLATE_ROOT . '/includes/blog-sidebar.php');
				?>
			</div>
		</div>
	</div>
</section>