<div class="jumbotron bg-light text-dark py-4 px-4">
	<?php
	if(!$QB->USER->is_logged_in()){
		?>
		<label>You're not logged in.</label>
		<ul id="user" class="mb-0 pl-3">
			<li><a href="<?=$QUICKBROWSE->DOMAIN;?>/signup">Sign Up</a></li>
			<li><a href="<?=$QUICKBROWSE->DOMAIN;?>/signin">Sign In</a></li>
		</ul>
		<?php
	}else{
		?>
		<label>Hi, <?=$userdata['name'];?>.</label>
		<ul id="user" class="mb-0 pl-3">
			<li><a href="<?=$QUICKBROWSE->DOMAIN;?>/dashboard/account">Account</a></li>
			<li><a href="<?=$QUICKBROWSE->DOMAIN;?>/dashboard/index">Dashboard</a></li>
			<li><a href="<?=$QUICKBROWSE->DOMAIN;?>/logout">Logout</a></li>
		</ul>
		<?php
	}
	?>
</div>
<div class="jumbotron bg-light text-dark py-4 px-4">
	<label>Recent updates.</label>
	<ul id="updates" class="mb-0 pl-3">
		<?php
		$updates = Array();
		foreach($QB->POSTS as $post){
			//Select all tagged posts with tag: update.
			if($post['tag'] == 'update'){
				//Save them to a new array called $updates for later reference.
				$updates[$post['id']] = $post;
				?>
				<li class="mb-3"><a href="<?=$QB->DOMAIN;?>/blog/post/<?=$post['id'];?>/<?=str_replace("+", "-", urlencode($post['title']));?>"><?=$post['title'];?></a></li>
				<?php
			}
		}
		?>
	</ul>
</div>
<div class="jumbotron bg-light text-dark py-4 px-4">
	<label>Recent Posts.</label>
	<ul id="posts" class="mb-0 pl-3">
	<?php
	$recents = Array();
	foreach($QB->POSTS as $post){
		if($post['tag'] == 'test'){
			//Dont do anything with the test posts
		}
		if($post['tag'] == 'update' || $post['tag'] == 'post'){
			$recents[$post['id']] = $post;
			?>
			<li class="mb-3"><a href="<?=$QUICKBROWSE->DOMAIN;?>/blog/post/<?=$post['id'];?>/<?=str_replace("+", "-", urlencode($post['title']));?>"><?=$post['title'];?></a></li>
			<?php
		}
	}
	?>
	</ul>
</div>