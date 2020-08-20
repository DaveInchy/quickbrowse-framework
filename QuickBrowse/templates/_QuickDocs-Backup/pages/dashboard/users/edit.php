<?php
//Include whats on the dashboard page like header.
include_once($QUICKBROWSE->TEMPLATE_ROOT . '/pages/dashboard/users.php');
?>
<section id="edit_user" class="bg-light">
	<div class="container">
		<div class="col-lg-8 mx-auto">
			<h1>Update</h1>
			<p class="lead">Edit user id: <?=$QB->PAGE->get_content();?>.</p>
			<?php
			//Display form create blog post.
			$QB->DISPLAY->form_users(true, $QB->PAGE->get_content());
			?>
		</div>
	</div>
</section>