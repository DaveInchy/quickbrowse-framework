<?php
//Pagination data
$INDEX_LIMIT 	= '13';
$CURRENT_INDEX 	= '0';
$TOTAL_ITEMS 	= $QB->FUNCTIONS->count_data($QB->POSTS);

//Check if index is set within the url.
if(!empty($QB->PAGE->get_content()) && $QB->PAGE->get_content() >= 0){
	$CURRENT_INDEX = $QB->PAGE->get_content();
}

//Setup DATA arguments.
$args['TYPE']	= 'DATA_NEWEST_OFFSET';
$args['LIMIT']	= '2';
$args['OFFSET']	= $CURRENT_INDEX * $args['LIMIT'];

//If OFFSET is 0, please use DATA_NEWEST_LIMIT without the OFFSET argument
if($args['OFFSET'] <= 0){
	$args['TYPE'] = 'DATA_NEWEST_LIMIT';
}

//Call DATA with arguments
$posts = $QB->CRUD->data_read('posts', $args);
?>