<?php
//Include whats on the dashboard page like header.
include_once($QUICKBROWSE->TEMPLATE_ROOT . '/pages/dashboard/blog.php');
?>
<section id="edit_post" class="bg-light">
	<div class="container">
		<div class="col-lg-8 mx-auto">
			<h1>Update</h1>
			<p class="lead">Edit blog post id: <?=$QB->PAGE->get_content();?>.</p>
			<?php
			//Display form create blog post.
			$QB->DISPLAY->form_blog_post(true, $QB->PAGE->get_content(), $QB->POSTS);
			?>
		</div>
	</div>
</section>