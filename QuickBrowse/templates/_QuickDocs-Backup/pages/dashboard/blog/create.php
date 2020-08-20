<?php
//Include whats on the dashboard page like header.
include_once($QUICKBROWSE->TEMPLATE_ROOT . '/pages/dashboard/blog.php');
?>
<section id="create_post" class="bg-light">
	<div class="container">
		<div class="col-lg-8 mx-auto">
			<h1>Create</h1>
			<p class="lead">Write a blog post.</p>
			<?php
			//Display form create blog post.
			$QB->DISPLAY->form_blog_post(false, 0, $QB->POSTS);
			?>
		</div>
	</div>
</section>