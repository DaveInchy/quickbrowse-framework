<?=$QUICKBROWSE->ASSETS->PACKAGE->header('Blog', 'All blog posts and updates', 'bg-gradient-purple text-center');?>
<section id="blog">
	<div class="container">
		<div class="row">
			<div class="col-md-10 mx-auto">
				<h2>Blog</h2>
				<p class="lead">A list of all recent blog posts and updates.</p>
			</div>
		</div>
		<div class="row">
			<div class="col-md-7 ml-auto">

				<?php
				//Display limited blog posts, should work with index offset
				$QB->DISPLAY->blog_posts($posts, $QB->USERS, "", $args['LIMIT'], true, true);
				$QB->DISPLAY->pagination($CURRENT_INDEX, $INDEX_LIMIT, $args['LIMIT'], $TOTAL_ITEMS, $QUICKBROWSE->DOMAIN . '/blog/', $QUICKBROWSE->DOMAIN . '/blog/page/');
				?>

			</div>
			<div class="col-md-3 mr-auto d-none d-md-block">

				<?php
				//Include sidebar
				include_once($QB->TEMPLATE_ROOT . '/includes/blog-sidebar.php');
				?>

			</div>
		</div>
	</div>
</section>