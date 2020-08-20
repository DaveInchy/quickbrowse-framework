<?php
//Include whats on the dashboard page like header.
include_once($QUICKBROWSE->TEMPLATE_ROOT . '/pages/dashboard/users.php');
?>
<section id="create_user" class="bg-light">
	<div class="container">
		<div class="col-lg-8 mx-auto">
			<h1>Create</h1>
			<p class="lead">Add an User.</p>
			<?php
			//Display form create user.
			$QB->DISPLAY->form_users(false);
			?>
		</div>
	</div>
</section>