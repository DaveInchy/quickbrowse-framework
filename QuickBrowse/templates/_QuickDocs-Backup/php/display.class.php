<?php
class Display extends Functions{
	
	private $QB;
	
	function __construct($QB){
		$this->QB = $QB;
	}

	private function replace_html_code($text){
		$txt[1] = str_replace('&', '&amp', $text);
		$txt[2] = str_replace('<', '&lt', $txt[1]);
		$txt[3] = str_replace('>', '&gt', $txt[2]);
		return $txt[3];
	}

	function code_from_txt($file, $showlines = true){
		?><pre class="bg-dark text-light"><?php
		$txt_lines = explode("\n", file_get_contents($file));
		$cnt_lines = 0;
		foreach($txt_lines as $line){
			$cnt_lines++;
			$data_line = '' . $cnt_lines . '';
			if(strlen($data_line) <= 1){
				$data_line = '0' . $data_line;
			}
			$line = $this->replace_html_code($line);
			?><span data-line-number="<?=$data_line;?>" class="line"><?=$line;?></span><?php
		}
		?></pre><?php
	}

	function lipsum(){
		return 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam pellentesque velit at vulputate cursus. Mauris vel turpis tortor. Nulla facilisi. Donec augue velit, blandit vitae consequat eu, gravida nec tellus. Donec tempus dui eu venenatis hendrerit. Morbi ac pretium arcu, et faucibus est. Cras congue non ante nec maximus. Nulla venenatis vel ipsum vehicula eleifend. Pellentesque consectetur mollis metus, sed congue enim. Aliquam fermentum neque eu mattis consectetur. Ut bibendum rutrum est eu gravida. Sed non consequat mi. ';
	}

	function blog_posts($posts, $users, $tag = "", $limit = '3', $show_thumbnail = true, $show_social_buttons = false){
		$QUICKBROWSE = $this->QB;
		$count = 0;
		try{
			foreach($posts as $post){
				//check if the post tag is the same as the given argument
				$tag_match = true;
				if(!empty($tag)){
					if($tag != $post['tag']){
						$tag_match = false;
					}
				}
				if($tag_match && $count < $limit){
					//Add count
					$count++;
					//find author name
					foreach($users as $user){
						if($user['id'] == $post['author']){
							$author = $user['name'];
							break;
						}
					}
					//format date from timestamp
					$date = date('F jS, Y', $post['timestamp']);

					//create a default thumbnail if none is given.
					$show_default_thumbnail = false;
					if($post['thumbnail'] == 'none' || empty($post['thumbnail']) || $post['thumbnail'] == false || !isset($post['thumbnail']) ){
						$show_default_thumbnail = true;
					}

					//output all posts.
					?>
						<div id="post_<?=$post['id'];?>" class="jumbotron bg-light py-4 pb-5">
							<?php if($show_thumbnail && !$show_default_thumbnail){ ?><img class="img-fluid my-3" width="100%;" style="border: 2px solid #eee; border-radius: .3em;" src="<?=$post['thumbnail'];?>" /><?php } ?>
							<?php if($show_thumbnail && $show_default_thumbnail){ ?><div class="my-3 center-2d py-5 height-40 width-10 bg-sharp-gradient-light" style="border: 2px solid #eee; border-radius: .3em;"><div><div class="center-2d"><?=$QUICKBROWSE->ASSETS->PACKAGE->img('IMG-LOGO', 125);?></div><h3 class="text-dark">&lt/QuickBrowse></h3></div></div><?php } ?>

							<a class="text-danger" href="<?=$QUICKBROWSE->DOMAIN;?>/blog/post/<?=$post['id'];?>/<?=str_replace("+", "-", urlencode($post['title']));?>">
								<h3 class="display-3 font-weight-bold text-danger" style="font-size: 36px;"><?=$post['title'];?></h3>
							</a>

							<div class="text-dark">
								<?=$post['content'];?>
							</div>

							<p class="text-dark font-weight-bold my-1 text-left mt-5">Author: <span class="text-secondary font-weight-normal"><?=$author;?></span></p>
							<p class="text-dark font-weight-bold my-1 text-left">Posted on: <span class="text-secondary font-weight-normal"><?=$date;?></span></p>
							<p class="text-dark font-weight-bold my-1 text-left">Tag: <span class="text-secondary font-weight-normal"><?=$post['tag'];?></span></p>

							<a data-wow-delay="0.5s" style="position: relative; bottom: 90px; right: 15px; visibility:hidden;" class="wow bounce rounded btn btn-md btn-danger float-right font-weight-bold" href="<?=$QUICKBROWSE->DOMAIN;?>/blog/post/<?=$post['id'];?>/<?=str_replace("+", "-", urlencode($post['title']));?>"><i class="display-1 px-2 pt-2 fas fa-book" style="font-size: 26px;"></i><br>Read</a>

							<?php
								if($show_social_buttons){
									?>
									<a data-wow-delay="1s" style="position: relative; bottom: 90px; right: 50px; visibility:hidden;" class="wow bounce rounded d-none d-sm-block btn btn-md btn-danger float-right font-weight-bold" href="<?=$QUICKBROWSE->DOMAIN;?>/blog/post/<?=$post['id'];?>/<?=str_replace("+", "-", urlencode($post['title']));?>"><i class="display-1 px-2 pt-2 fas fa-heart" style="font-size: 26px;"></i><br>Like</a>
									<a data-wow-delay="1.5s" style="position: relative; bottom: 90px; right: 85px; visibility:hidden;" class="wow bounce rounded d-none d-md-block btn btn-md btn-danger float-right font-weight-bold" href="<?=$QUICKBROWSE->DOMAIN;?>/blog/post/<?=$post['id'];?>/<?=str_replace("+", "-", urlencode($post['title']));?>"><i class="display-1 px-2 pt-2 fas fa-feather" style="font-size: 26px;"></i><br>React</a>
									<?php
								}
							?>
						</div>
					<?php
				}
			}
		}catch(Exception $e){
			$this->ERROR = $e->getMessage();
			return false;
		}
		return true;
	}

	function feature_video($vid){
		$QUICKBROWSE = $this->QB;
		$YOUTUBE = $this->QB->YOUTUBE;

		$videodata				= $YOUTUBE->get_raw_data('video', $vid);
		$videodata['youtube'] 	= $YOUTUBE->get_raw_data('youtube', $vid);
		if(!$videodata){
			$this->ERROR = $YOUTUBE->ERROR;
			return false;
		}
		?>
		<h2 class="text-truncate mb-3 "><?=$videodata['title'];?></h2>
		<div class="embed-responsive embed-responsive-16by9 text-center">
			<iframe class="embed-responsive-item" src="https://www.youtube.com/embed/<?=$vid;?>?autoplay=1&controls=0&enablejsapi=1&fs=0&modestbranding=1&start=0&iv_load_policy=3" frameborder="0" allowfullscreen></iframe>
		</div>
		<div class="row">
			<div class="col-8">
				<h3 class="mt-3 text-left">
					Author: <a class="text-secondary" href="<?=$videodata['author_url'];?>"><?=$videodata['author_name'];?></a>
				</h3>
			</div>
			<div class="col-4">
				<h3 class="mt-3 text-right">
					Views: <span class="text-secondary"><?=$videodata['youtube']['items'][0]['statistics']['viewCount'];?></span>
				</h3>
			</div>
		</div>
		<?php
		return $videodata;
	}

	function list_group_themes($themes_array, $active){
		?>
		<div class='list-group text-center'>
		<?php
			foreach($themes_array as $theme){
				if($active == $theme){
					?><a href='<?=$this->QB->DOMAIN;?>/theme?set=<?=$theme;?>' class='list-group-item list-group-item-action font-weight-bold text-uppercase active'><?=$theme;?></a><?php
				}else{
					?><a href='<?=$this->QB->DOMAIN;?>/theme?set=<?=$theme;?>' class='list-group-item list-group-item-action font-weight-bold text-uppercase'><?=$theme;?></a><?php
				}
			}
		?>
		</div>
		<?php
	}

	function table_blog_posts($posts, $users){
		$QUICKBROWSE = $this->QB;
		try{
			?>
			<table data-table="dashboard" class="table table-responsive table-striped table-hover" cellspacing="1" width="100%">
			  <thead>
				<tr class="table-primary">
				  <th scope="col" class="bg-primary"><a href="./create/"><h3 class="my-auto text-center text-light"><i class="fas fa-folder-plus"></i></h3></a></th>
				  <th scope="col"><h3 class="my-auto">Title</h3></th>
				  <th scope="col"><h3 class="my-auto">Tag</h3></th>
				  <th scope="col"><h3 class="my-auto">Author</h3></th>
				  <th scope="col"><h3 class="my-auto text-center">Update</h3></th>
				  <th scope="col"><h3 class="my-auto text-center">Delete</h3></th>
				</tr>
			  </thead>
			  <tbody>
				<?php
				foreach($posts as $post){
					//find author name
					foreach($users as $user){
						if($user['id'] == $post['author']){
							$author = $user['name'];
							break;
						}
					}
					//format date from timestamp
					$date = date('F jS, Y', $post['timestamp']);
					?>
					<tr id="row_<?=$post['id'];?>">
					  <th scope="row" class="bg-primary"><p class="lead text-center font-weight-bold text-light"><?=$post['id'];?></p></th>
					  <td class="p-1 pt-3" for="Title"><p class="ml-3 lead"><?=$post['title'];?></p></td>
					  <td class="p-1 pt-3" for="Tag"><p class="ml-3 lead"><?=$post['tag'];?></p></td>
					  <td class="p-1 pt-3" for="Author"><p class="ml-3 lead"><?=$author;?><br>(<?=$date;?>)</p></td>
					  <td for="Update" class="bg-success"><a href="./edit/<?=$post['id'];?>"><p class="lead my-auto text-center text-light"><i class="fas fa-pen"></i></p></td>
					  <td for="Delete" class="bg-danger"><a href="./remove/<?=$post['id'];?>"><p class="lead my-auto text-center text-light"><i class="fas fa-trash"></i></p></td>
					</tr>
					<?php
				}
				?>
			  </tbody>
			  <tfoot>
				<tr class="table-primary">
				  <th scope="col" class="bg-primary"><a href="./create"><h3 class="my-auto text-center text-light"><i class="fas fa-folder-plus"></i></h3></a></th>
				  <th scope="col"><h3 class="my-auto">Title</h3></th>
				  <th scope="col"><h3 class="my-auto">Tag</h3></th>
				  <th scope="col"><h3 class="my-auto">Author</h3></th>
				  <th scope="col"><h3 class="my-auto text-center">Update</h3></th>
				  <th scope="col"><h3 class="my-auto text-center">Delete</h3></th>
				</tr>
			  </tfoot>
			</table>
			<?php
		}catch(Exception $e){
			$this->ERROR = $e->getMessage();
			return false;
		}
		return true;
	}

	function table_registered_users($users){
		$QUICKBROWSE = $this->QB;
		try{
			?>
			<table data-table="dashboard" class="table table-responsive table-striped table-hover" cellspacing="1" width="100%">
			  <thead>
				<tr class="table-primary">
				  <th scope="col" class="bg-primary"><a href="./create/"><h3 class="my-auto text-center text-light"><i class="fas fa-user-plus"></i></h3></a></th>
				  <th scope="col"><h3 class="my-auto">Name</h3></th>
				  <th scope="col"><h3 class="my-auto">Email</h3></th>
				  <th scope="col"><h3 class="my-auto">Password</h3></th>
				  <th scope="col"><h3 class="my-auto text-center">Update</h3></th>
				  <th scope="col"><h3 class="my-auto text-center">Delete</h3></th>
				</tr>
			  </thead>
			  <tbody>
				<?php
				foreach($users as $user){
					if(isset($user['permissions']) && !empty($user['permissions'])){
						$rank = $user['permissions'];
						if($rank > 0){

							//People who are not banned will get stars as they go up in rank
							//$x = "<img class=\"mr-1\" style=\"width: 20px; height: 20px;\" src=\"data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAAABmJLR0QA/wD/AP+gvaeTAAADrUlEQVRo3u1ZS2sTURQuvhYufax8rJMmpk0mc8fuQiZUBV2GFl9oFVGwO6XqSlzYgt1ZsSLShS9QqgtrXYiIj4p1p9QfYO3KWsEmmUzSNNdzpiE1aZK5r6QiuXDoQDr3ft+595zz3TMtLc3RHM0hPWg8vtYySUfKJJdSUWM0aZKvyRj5BX+zji09T+Fv+D9WzNhNL7esWXXgVqe+A8ANALgZMMpp35NRo9+KGNsbDjyxL7g1Yeq3AERGAHi5ZRIxcnM+om1pCHjw+EFYdE4B8HL7mTCN7vqdc01bnzDJ7ToALzFYYxjXUgv+gLYxaRrj9QZftBh5jmsq83xDwRfNeEnjvg3yAStxbNInNceEjxMEt1zAmvohGS/mHvrBfJIxoXcJgZ83yWaYYFZ0YatHo/STx7H0CU2GxJxQii3keXHv3/cXCeCzzFwp07jBV2GhOsoUKevYsveLu9AjtQuZdEzbyVOsBqS8f8+/gkDurtwuoOxgS5sgshydIur9o+D9Sc8KAmi4MxIkZlA0uh8fUJXCi3QSx9OVwBd3oVN8F6xomLgSQLnrGlT7dcgsIWpfbKfZawG6cGcXXRxrpfSjpyr4vy3/yktzD3x0YShAM1faafpsiKbiYazALhVav8BSuJ7UOh75N2wgRQznxjWqZyPymKF4kama1fVMiNIJr3oCHyBT9QZdjpH+hYXAHItEyL9TSGICwJ8OscTBLAsBpvyPMaCExHsAfyrEGsi2MgLLMSFOIv/WS63jXKnVVnKESkgcCdP8a69AwHpF6sKsdBBXMrsvyE0A3+GvBQxBXCuNVrPsQICbQLa/TUDUMaRRlkK2QvuM+LkJLIwIaKMo6XOXEtB04p148UUrN4HF8VaBHdB1VjE3zTzxXh3EW5UgnvRUFXb4Dr7LQeAbczcPpSuX+qwk3EDrWIfD1OrWHK1UiUgt2VAhgK/W5UJjny/NQLlHvopXSEyZSKokE51jzkS2Fe3YxnelhI4AUwYabFs606M+R1WyVHAk6WSiwQDb2Y+R69x34t97OjaxXOqRQLo35C6FSxtXzjv4LkvLUbhvir3Kxje0ytoqURKXbWwNrxZ4SJtDSj5eAImnq0BgjEYi69Q1d6Hh2kDwz5Q1d0va64yZSfbYKPN8lY5dl0zLsYbO+SEdsDx9U2z3YYFRAN7GPI9pu/Ef+aA6FmTHtADwaZQH3BW2Lp+fQGRh0wn7NqjZ8eJRuNllCobPn53fQBKjqvwnPrM2R3P8B+MPN6PJQyDt9VwAAAAASUVORK5CYII=\">";
							if($rank > 0){
								$rank_color = 'secondary';
							}
							if($rank > 1){
								$rank_color = 'warning';
							}
							if($rank > 2){
								$rank_color = 'danger';
							}
							$badge = '<i class="text-' . $rank_color . ' fas fa-star"></i>';
							$badges = '';
							for($i = 0; $i < $rank; $i++){
								$badges = $badges . $badge;
							}


						}else{

							//Ban the people with lower then 1 permissions
							$banned = $user;
							die($user);
							if(!$DATA->data_delete('users', $banned['id'])){
								echo $DATA->ERROR;
							}else{
								$id = $DATA->data_create($banned, 'banned');
								if(!$id){
									echo $DATA->ERROR;
								}
							}

						}
					}
					?>
					<tr>
					  <th scope="row" class="bg-primary"><p class="lead my-auto text-center font-weight-bold text-light"><?=$user['id'];?></p></th>
					  <td class="p-1 pt-3" for="Name"><p class="lead ml-2"><span class="text-dark"><?=$user['name'];?></span><br>Rank: ( <?=$badges;?> )</p></td>
					  <td class="p-1 pt-3" for="Email"><p class="text-truncate"><?=$user['email'];?></p></td>
					  <td class="p-1 pt-3" for="Password"><p class="lead"><?=substr(md5($user['password']), 0, 10);?><br>(MD5-L10)</p></td>
					  <td for="Update" class="bg-success"><a href="./edit/<?=$user['id'];?>"><p class="lead my-auto text-center text-light"><i class="fas fa-pen"></i></p></td>
					  <td for="Delete" class="bg-danger"><a href="./remove/<?=$user['id'];?>"><p class="lead my-auto text-center text-light"><i class="fas fa-trash"></i></p></td>
					</tr>
					<?php
				}
				?>
			  </tbody>
			  <tfoot>
				<tr class="table-primary">
				  <th scope="col" class="bg-primary"><a href="./create"><h3 class="my-auto text-center text-light"><i class="fas fa-user-plus"></i></h3></a></th>
				  <th scope="col"><h3 class="my-auto">Name</h3></th>
				  <th scope="col"><h3 class="my-auto">Email</h3></th>
				  <th scope="col"><h3 class="my-auto">Password</h3></th>
				  <th scope="col"><h3 class="my-auto text-center">Update</h3></th>
				  <th scope="col"><h3 class="my-auto text-center">Delete</h3></th>
				</tr>
			  </tfoot>
			</table>
			<?php
		}catch(Exception $e){
			$this->ERROR = $e->getMessage();
			return false;
		}
		return true;
	}

	function form_blog_post($is_update, $id = 0, $POSTS){
		try{
			$form['id'] = $id;
			if($is_update && $id != 0){
				foreach($POSTS as $post){
					if($post['id'] == $id){
						$form = $post;
						$form['type'] = 'update';
					}
				}
			}else{
				$form['type'] = 'create';
				$form['title'] = '';
				$form['thumbnail'] = '';
				$form['content'] = '';
				$form['tag'] = '';
			}
			if(isset($_POST['form_submit'])){
				$data['title'] 			= $_POST['form_title'];
				$data['tag'] 			= $_POST['form_tag'];
				$data['content'] 		= $_POST['form_content'];
				if(!empty($_POST['form_thumbnail']) || isset($_POST['form_thumbnail'])){
					$data['thumbnail'] 	= $_POST['form_thumbnail'];
				}
				if(!$is_update){
					$data['author'] 	= $this->QB->USER->get_session_data()['id'];
					$data['timestamp'] 	= time();
					$result = $this->QB->CRUD->data_create($data, 'posts');
					if(!$result){
						echo('Error while creating data in table: posts.<br>ERROR:' . $this->QB->CRUD->ERROR);
					}
				}else{
					if(!$this->QB->CRUD->data_update($data, 'posts', $id)){
						echo('Error while updating data in table: posts.<br>ERROR:' . $this->QB->CRUD->ERROR);
					}
				}
				if(isset($result) && !empty($result)){
					$id = $result;
				}
				$this->QB->PAGE->redirect('/blog/post/' . $id . '/' . urlencode($_POST['form_title']));
			}
			?>
			<form class="row" method="POST">
				<?php
				if($is_update){
				?>
				<div class="input-group mb-3">
				  <div class="input-group-prepend d-none d-md-flex col-sm-3">
					<span class="input-group-text" style="width: 100%;" id="form_<?=$form['type'];?>_id">ID</span>
				  </div>
				  <input name="form_id" value="<?=$form['id'];?>" type="number" class="form-control" placeholder="0" aria-label="ID" aria-describedby="form_<?=$form['type'];?>_id">
				</div>
				<?php
				}
				?>
				<div class="input-group mb-3">
				  <div class="input-group-prepend d-none d-md-flex col-sm-3">
					<span class="input-group-text" style="width: 100%;" id="form_<?=$form['type'];?>_title">Title</span>
				  </div>
				  <input name="form_title" value="<?=$form['title'];?>" type="text" class="form-control" placeholder="Hello world" aria-label="Title" aria-describedby="form_<?=$form['type'];?>_title">
				</div>
				<div class="input-group mb-3">
				  <div class="input-group-prepend d-none d-md-flex col-sm-3">
					<span class="input-group-text" style="width: 100%;" id="form_<?=$form['type'];?>_thumbnail">Thumbnail</span>
				  </div>
				  <input name="form_thumbnail" value="<?=$form['thumbnail'];?>" type="text" class="form-control" placeholder="https://i.imgur.com/XzdNH9F.png" aria-label="thumbnail" aria-describedby="form_<?=$form['type'];?>_thumbnail">
				</div>
				<div class="input-group mb-3">
				  <div class="input-group-prepend d-none d-md-flex col-sm-3">
					<span class="input-group-text" style="width: 100%;" id="form_<?=$form['type'];?>_tag">Tag</span>
				  </div>
				  <input name="form_tag" value="<?=$form['tag'];?>" type="text" class="form-control" placeholder="post/update/announcement" aria-label="tag" aria-describedby="form_<?=$form['type'];?>_tag">
				</div>
				<div class="input-group col-sm-12 pr-0">
				  <!--<textarea style="min-height: 25vh;" name="form_content" class="form-control" placeholder="<?=$this->lipsum();?>" aria-label="Content" aria-describedby="form_<?=$form['type'];?>_content">
					<?=$form['content'];?>
				  </textarea>-->
				  <textarea class="d-none" name="form_content"></textarea>
				  <div id="form_content" class="form-control p-0 m-0"  aria-label="Content" aria-describedby="form_<?=$form['type'];?>_content">
					<?=$form['content'];?>
				  </div>
				</div>
				<button type="submit" name="form_submit" style="margin-top: 90px;" class="ml-3 btn btn-primary btn-block">Save</button>
			</form>
			<?php
		}catch(Exception $e){
			$this->ERROR = $e->getMessage();
			return false;
		}
		return true;
	}

	function form_users($is_update, $id = 0){
		global $DATA;
		$DATA = $this->QB->CRUD;
		global $PAGE;
		$PAGE = $this->QB->PAGE;
		global $DATA_USERS;
		$DATA_USERS = $this->QB->USER->CRUD;
		global $USER;
		$USER = $this->QB->USER;
		try{
			$form['id'] = $id;
			if($is_update && $id != 0){
				$form = $USER->get_user_data($id);
				$form['type'] = 'update';
			}else{
				$form['type'] = 'create';
				$form['name'] = '';
				$form['email'] = '';
				$form['password'] = '';
				$form['permissions'] = 1;
				$form['signature'] = 'QuickBrowse User';
			}
			if(isset($_POST['form_submit'])){
				if($is_update){
					$data = Array(
						'permissions' 	=> $_POST['form_permissions'],
						'name' 			=> $_POST['form_name'],
						'email' 		=> $_POST['form_email'],
						'password' 		=> $_POST['form_password'],
						'signature'		=> $_POST['form_signature']
					);
					//var_dump($data);
					if(!$DATA_USERS->data_update($data, 'users', $id)){
						die($DATA_USERS->ERROR);
					}
					$PAGE->redirect('/dashboard/users/');
				}else{
					$data = Array(
						'permissions' 	=> $_POST['form_permissions'],
						'name' 			=> $_POST['form_name'],
						'email' 		=> $_POST['form_email'],
						'password' 		=> $_POST['form_password'],
						'signature'		=> $_POST['form_signature']
					);
					//var_dump($data);
					$id = $DATA_USERS->data_create($data, 'users');
					if(!$id){
						die($DATA_USERS->ERROR);
					}
					$PAGE->redirect('/dashboard/users/');
				}
			}
			?>
			<form class="row" method="POST">
				<?php
				if($is_update){
				?>
				<div class="input-group mb-3">
				  <div class="input-group-prepend d-none d-md-flex col-sm-3">
					<span class="input-group-text" style="width: 100%;" id="form_<?=$form['type'];?>_id">ID</span>
				  </div>
				  <input name="form_id" value="<?=$form['id'];?>" type="number" class="form-control" placeholder="0" aria-label="ID" aria-describedby="form_<?=$form['type'];?>_id">
				</div>
				<?php
				}
				?>
				<div class="input-group mb-3">
				  <div class="input-group-prepend d-none d-md-flex col-sm-3">
					<span class="input-group-text" style="width: 100%;" id="form_<?=$form['type'];?>_name">Name</span>
				  </div>
				  <input name="form_name" value="<?=$form['name'];?>" type="text" class="form-control" placeholder="Ahmed Mohammed" aria-label="name" aria-describedby="form_<?=$form['type'];?>_name">
				</div>
				<div class="input-group mb-3">
				  <div class="input-group-prepend d-none d-md-flex col-sm-3">
					<span class="input-group-text" style="width: 100%;" id="form_<?=$form['type'];?>_email">Email</span>
				  </div>
				  <input name="form_email" value="<?=$form['email'];?>" type="email" class="form-control" placeholder="mail@domain.com" aria-label="email" aria-describedby="form_<?=$form['type'];?>_email">
				</div>
				<div class="input-group mb-3">
				  <div class="input-group-prepend d-none d-md-flex col-sm-3">
					<span class="input-group-text" style="width: 100%;" id="form_<?=$form['type'];?>_password">Password</span>
				  </div>
				  <input name="form_password" value="<?=$form['password'];?>" type="password" class="form-control" placeholder="Password" aria-label="password" aria-describedby="form_<?=$form['type'];?>_password">
				</div>
				<div class="input-group mb-3">
				  <div class="input-group-prepend d-none d-md-flex col-sm-3">
					<span class="input-group-text" style="width: 100%;" id="form_<?=$form['type'];?>_signature">Signature</span>
				  </div>
				  <input name="form_signature" value="<?=$form['signature'];?>" type="text" class="form-control" placeholder="QuickBrowse Developer" aria-label="signature" aria-describedby="form_<?=$form['type'];?>_signature">
				</div>
				<div class="input-group mb-3">
				  <div class="input-group-prepend d-none d-md-flex col-sm-3">
					<span class="input-group-text" style="width: 100%;" id="form_<?=$form['type'];?>_permissions">Permissions</span>
				  </div>
				  <input name="form_permissions" value="<?=$form['permissions'];?>" type="number" class="form-control" placeholder="1" min="0" max="3" aria-label="permissions" aria-describedby="form_<?=$form['type'];?>_permissions">
				</div>
				<button type="submit" name="form_submit" class="ml-0 ml-md-3 mt-3 btn btn-primary btn-block">Save</button>
			</form>
			<?php
		}catch(Exception $e){
			$this->ERROR = $e->getMessage();
			return false;
		}
		return true;
	}

	function pagination($CURRENT_INDEX = 0, $HARD_INDEX_LIMIT = 10, $ITEMS_PER_PAGE = 3, $TOTAL_ITEMS, $START_URL = './group/', $URL_INDEX = './group/page/'){
		?>
		<nav id="nav-pagination">
		  <ul class="pagination" style="justify-content: center;">
			<li class="page-item <?php if($CURRENT_INDEX + 1 <= 1){ echo 'disabled'; }?>">
			  <a class="page-link" href="<?=$START_URL;?>">First</a>
			</li>
			<li class="page-item <?php if($CURRENT_INDEX + 1 <= 1){ echo 'disabled'; }?>">
			  <a class="page-link" href="<?php if($CURRENT_INDEX <= 1){ echo $START_URL; }else{ echo $URL_INDEX . ($CURRENT_INDEX - 1); };?>"><i class="fas fa-chevron-left"></i></a>
			</li>
			<?php
			//set index limit based on how many posts there are
			$INDEX_LIMIT = ceil($TOTAL_ITEMS / $ITEMS_PER_PAGE);

			//check if there are not to many pages, hard limit from old $INDEX_LIMIT = 10?
			if($INDEX_LIMIT > $HARD_INDEX_LIMIT){
				$INDEX_LIMIT = $HARD_INDEX_LIMIT;
			}

			//Add amount of pages to the pagination bar
			for($i = 0; $i < $INDEX_LIMIT; $i++){
				$active = false;
				if($i == $CURRENT_INDEX){
					$active = true;
				}
				?>
				<li class="page-item <?php if($active){ echo 'active'; } ?>">
					<?php
					if($i <= 0){
						?><a class="page-link" href="<?=$START_URL;?>"><?=$i+1;?></a><?php
					}else{
						?><a class="page-link" href="<?=$URL_INDEX . $i;?>"><?=$i+1;?></a><?php
					}
					?>
				</li>
				<?php
			}
			?>
			<li class="page-item <?php if($CURRENT_INDEX + 1 >= $INDEX_LIMIT || $INDEX_LIMIT <= 1){ echo 'disabled'; }?>">
			  <a class="page-link" href="<?=$URL_INDEX . ($CURRENT_INDEX + 1);?>"><i class="fas fa-chevron-right"></i></a>
			</li>
			<li class="page-item <?php if($CURRENT_INDEX + 1 >= $INDEX_LIMIT){ echo 'disabled'; }?>">
			  <a class="page-link" href="<?=$URL_INDEX . ($INDEX_LIMIT - 1);?>">Last</a>
			</li>
		  </ul>
		</nav>
		<?php

	}

}
?>