<?php
//Request YOUTUBE uploads.
$vid = $QB->TEMPLATE->FEATURED;
if(isset($_GET['yid']) && !empty($_GET['yid'])){
	$vid = $_GET['yid'];
}
if(!empty($QB->PAGE->get_content())){
	$vid = $QB->PAGE->get_content();
}
if(!isset($vid) || $QB->PAGE->get_content() == "video"){
	$PAGE->redirect($QUICKBROWSE->DOMAIN . '/youtube/error/video-not-found');
}
?>