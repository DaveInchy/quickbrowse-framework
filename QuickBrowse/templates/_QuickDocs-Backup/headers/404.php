<?php
$error = 'page ' . $page . ' not found';
if($QB->PAGE->get_page(true) != 'error' || $dir[0] == 'error'){
	$error = str_replace('-', ' ', $QB->PAGE->get_page(true));
}
?>