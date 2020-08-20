<!DOCTYPE html>
<html lang="en">

	<head>

		<?=$QB->ASSETS->PACKAGE->meta($QB->TEMPLATE->TITLE . ' by ' . $QB->TEMPLATE->AUTHOR . ' - ' . $QB->PAGE->get_page(false), $QB->TEMPLATE->DESCRIPTION, $QB->TEMPLATE->AUTHOR);?>
		
		<?=$QB->ASSETS->PACKAGE->icons();?>
		
		<?=$QB->ASSETS->PACKAGE->css($QB->THEME);?>
		
		<style>
			.bg-mountain-purple{
				background-image: url('<?=$QB->ASSETS->get_asset('IMG-MOUNTAINS-PURPLE');?>');
				background-size: cover;
			}
		</style>
	  
	</head>
	<body>
		
		<?php include_once($QB->TEMPLATE_ROOT . '/includes/navbar.php'); ?>
	
		<?php
			// Includes active page
			$QB->PAGE->include($DIR_PAGE, $DIR_HEAD, $FILE_ERR);
		?>
		
		<?=$QB->ASSETS->PACKAGE->js();?>
	  
	</body>
</html>
