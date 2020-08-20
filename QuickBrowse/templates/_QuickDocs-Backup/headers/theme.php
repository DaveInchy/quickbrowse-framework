<?php
if(isset($_GET['set']) && !empty($_GET['set'])){
	$found = false;
	foreach($QB->THEMES as $theme){
		if($_GET['set'] == $theme){
			$found = true;
		}
	}
	if(!$found){
		$QB->PAGE->redirect('/theme/error/theme-' . $_GET['set'] . '-not-found');
	}
	$_SESSION['theme'] = 'BOOTSWATCH-' . $_GET['set'];
	$QB->PAGE->redirect('/home');
}else{
	$QB->PAGE->redirect('/theme/error/theme-not-set');
}
?>