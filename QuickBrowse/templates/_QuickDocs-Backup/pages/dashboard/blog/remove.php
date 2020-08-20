<?php
//Include whats on the dashboard page like header.
include_once($QUICKBROWSE->TEMPLATE_ROOT . '/pages/dashboard/blog.php');
?>
<section id="remove" class="bg-light">
	<div class="container text-center">
		<h1>Removing post <?=$QB->PAGE->get_content();?></h1>
		<p class="lead">Are you sure you want to remove post id: <?=$QB->PAGE->get_content();?>.</p>
		<div class="row">
			<div class="col-6">
				<a href="./<?=$QB->PAGE->get_content();?>?action=no" class="btn btn-danger float-right">No</a>
			</div>
			<div class="col-6">
				<a href="./<?=$QB->PAGE->get_content();?>?action=yes" class="btn btn-success float-left">Yes</a>
			</div>
		</div>
	</div>
</section>