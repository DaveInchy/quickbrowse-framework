<?php
//Check for url params, if they're present continue the postdata construction
function get_postdata($QB, $pid){
	$found = false;
	foreach($QB->POSTS as $post){
		if($pid == $post['id']){
			$found = true;
			$data['id'] = $post['id'];
			$data['title'] = $post['title'];
			$data['timestamp'] = $post['timestamp'];
			$data['thumbnail'] = $post['thumbnail'];
			$data['author'] = $post['author'];
			$data['content'] = $post['content'];
			$data['date'] = date('F jS, Y', $post['timestamp']);
			foreach($QB->USERS as $user){
				if($post['author'] == $user['id']){
					$data['author_name'] = $user['name'];
					break;
				}
			}
		}
	}
	if(!$found){
		return false;
	}
	return $data;
}
if(isset($_GET['pid']) && !empty($_GET['pid'])){
	$postid = $_GET['pid'];
	$postdata = get_postdata($QB, $postid);
}
if(!empty($QB->PAGE->get_content())){
	$postid = $QB->PAGE->get_content();
	$postdata = get_postdata($QB, $postid);
}
if(!$postdata || !isset($postid)){
	$QB->PAGE->redirect('/blog/error/' . $postid . '-not-found');
}
?>