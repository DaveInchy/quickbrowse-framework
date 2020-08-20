<?php
if(!$QB->USER->is_logged_in()){
	//Send to login page. user is not logged in.
	header('Location: ' . $QUICKBROWSE->DOMAIN . '/403/');
	exit();
}else{
	$userdata = $QB->USER->get_user_data($QB->USER->get_session_data()['id']);
}

//DATA Arguments
$args['TYPE'] = 'DATA_NEWEST_LIMIT';
$args['LIMIT'] = '3';
$args['OFFSET'] = '0';

//DATA Requests
$posts = $QB->CRUD->data_read('posts', $args);

//Count users and posts
$posts_count = 0;
foreach($QB->CRUD->data_read('posts', Array('TYPE' => 'DATA_NEWEST')) as $row){
	$posts_count++;
}
$users_count = 0;
foreach($QB->USER->CRUD->data_read('users', Array('TYPE' => 'DATA_NEWEST')) as $row){
	$users_count++;
}

//Request Channel Statistics
$channel = $QB->YOUTUBE->return_data('channel', $QB->TEMPLATE->CHANNELID);
//print_r($channel);
$stats = $channel['stats'];
$video_count = $stats['videoCount'];
$subscriber_count = $stats['subscriberCount'];
$view_count = $stats['viewCount'];
?>