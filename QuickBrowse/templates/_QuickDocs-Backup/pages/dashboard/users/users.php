<?php
//Include whats on the dashboard page like header.
include_once($QUICKBROWSE->TEMPLATE_ROOT . '/pages/dashboard/users.php');
?>
<section id="show-users-list" class="bg-light">
	<div class="container">
		<p class="lead">All registered users.</p>
		<?php
		//Display table registered users.
		$QB->DISPLAY->table_registered_users($QB->USERS);
		?>
	</div>
</section>