<?php
//Include whats on the dashboard page like header.
include_once($QUICKBROWSE->TEMPLATE_ROOT . '/pages/dashboard/blog.php');
?>
<section id="show-posts-list" class="bg-light">
	<div class="container">
		<p class="lead">All blog posts.</p>
		<?php
		//Display table blog posts.
		$QB->DISPLAY->table_blog_posts($QB->POSTS, $QB->USERS);
		?>
	</div>
</section>