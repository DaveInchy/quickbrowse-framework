<?php
	$pages = $QUICKBROWSE->TEMPLATE_ROOT . '/pages/dashboard/' . $QB->PAGE->get_page(false) . '.php';
	$headers = $QUICKBROWSE->TEMPLATE_ROOT . '/headers/dashboard.php';
	
	$url_data 		= $QB->URL_DATA;
	$dir 			= $url_data['URL_DIRS'];
	$path 			= $url_data['URL_PATH'];
	$dir_length 	= $url_data['URL_DEPTH'];
	
	if($dir_length >= 2){
		$type = $dir[1];
		$action = $dir[2];
		$id = $QB->PAGE->get_content();
		$pages = $QUICKBROWSE->TEMPLATE_ROOT . '/pages/dashboard/' . $type . '/' . $action . '.php';
	}
?>
<nav class="navbar navbar-dark sticky-top bg-gradient-red flex-nowrap" style="top: 93px;">
	<a class="navbar-brand col-sm-3 col-md-2 mr-0" href="<?=$QUICKBROWSE->DOMAIN;?>/dashboard/index">Dashboard</a>
	<div class="input-group mr-3">
		<input class="d-sm-block d-none form-control form-control-dark" type="text" placeholder="Search" aria-label="Search">
		<button class="d-sm-block d-none btn btn-dark btn-md bg-gradient-dark" style="max-height: 45px; border-radius: 0px;">Search</button>
	</div>
	<a class="btn btn-dark bg-gradient-dark" style="max-height: 45px;" href="<?=$QUICKBROWSE->DOMAIN;?>/logout">Logout</a>
</nav>

<div class="container-fluid" style="margin-top: 93px;">
  <div class="row">
	<nav class="col-md-2 d-none d-md-block bg-gradient-light sidebar pt-3">
	  <div class="sidebar-sticky">
		<ul class="nav flex-column">
		  <li class="nav-item">
			<a class="nav-link active" href="<?=$QUICKBROWSE->DOMAIN;?>/dashboard/index">
			  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
			  Home
			</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="<?=$QUICKBROWSE->DOMAIN;?>/dashboard/blog/">
			  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
			  Blog
			</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="<?=$QUICKBROWSE->DOMAIN;?>/dashboard/users/">
			  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
			  Users
			</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="<?=$QUICKBROWSE->DOMAIN;?>/dashboard/stats/">
			  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bar-chart-2"><line x1="18" y1="20" x2="18" y2="10"></line><line x1="12" y1="20" x2="12" y2="4"></line><line x1="6" y1="20" x2="6" y2="14"></line></svg>
			  Stats
			</a>
		  </li>
		  <!--
		  <li class="nav-item">
			<a class="nav-link" href="<?=$QUICKBROWSE->DOMAIN;?>/dashboard/products/">
			  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-cart"><circle cx="9" cy="21" r="1"></circle><circle cx="20" cy="21" r="1"></circle><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path></svg>
			  Products
			</a>
		  </li>
		  <li class="nav-item">
			<a class="nav-link" href="<?=$QUICKBROWSE->DOMAIN;?>/dashboard/tasks/">
			  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
			  Tasks
			</a>
		  </li>
		  -->
		</ul>

		<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
		  <span>Blog</span>
		  <a class="d-flex align-items-center text-muted" href="<?=$QUICKBROWSE->DOMAIN;?>/dashboard/blog/">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
		  </a>
		</h6>
		<ul class="nav flex-column">
		  <li class="nav-item mb-3">
			<a class="nav-link" href="<?=$QUICKBROWSE->DOMAIN;?>/dashboard/updates/">
			  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
			  Updates
			</a>
		  </li>
		  <?php
			foreach($QB->POSTS as $post){
				?>
				  <li class="nav-item width-10">
					<a class="nav-link text-truncate" href="<?=$QUICKBROWSE->DOMAIN;?>/blog/post/<?=$post['id'];?>/">
					  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file"><path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path><polyline points="13 2 13 9 20 9"></polyline></svg>
					  <?=$post['title'];?>
					</a>
				  </li>
				<?php
			}
		  ?>
		</ul>
	  </div>
	</nav>

	<main role="main" class="col-md-9 ml-auto col-lg-10 p-0"><div style="position: absolute; inset: 0px; overflow: hidden; pointer-events: none; visibility: hidden; z-index: -1;" class="chartjs-size-monitor"><div class="chartjs-size-monitor-expand" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:1000000px;height:1000000px;left:0;top:0"></div></div><div class="chartjs-size-monitor-shrink" style="position:absolute;left:0;top:0;right:0;bottom:0;overflow:hidden;pointer-events:none;visibility:hidden;z-index:-1;"><div style="position:absolute;width:200%;height:200%;left:0; top:0"></div></div></div>

	  <?php include_once($pages); ?>

	</main>
  </div>
</div>