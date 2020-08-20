<?php
if($QB->USER->is_logged_in()){
	$QB->USER->logout();
}
header('Location: ' . $QUICKBROWSE->DOMAIN . '/home/');
exit;
?>