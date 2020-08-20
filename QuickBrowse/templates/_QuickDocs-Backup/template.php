<!DOCTYPE html>
<html lang="en">

<head>

	<?=$QB->ASSETS->PACKAGE->meta('QuickBrow.se (' . $QUICKBROWSE->VERSION . ') - ' . $PAGE->get_page(false), 'QuickBrowse ' . $QUICKBROWSE->VERSION . ' (' . $TEMPLATE->TITLE . ' ' . $TEMPLATE->VERSION .')', $TEMPLATE->AUTHOR);?>
	
	<?=$QB->ASSETS->PACKAGE->icons();?>
	
	<?=$QB->ASSETS->PACKAGE->css($THEME);?>
	
	<!-- Template CSS -->
	<link type="text/css" href="<?=$QUICKBROWSE->FRONTEND_ROOT;?>/assets/css/lib/font-awesome.min.css?v=1.0" rel="stylesheet">
	<link type="text/css" href="<?=$QUICKBROWSE->FRONTEND_ROOT;?>/assets/css/lib/datatables.min.css?v=1.0" rel="stylesheet">
	<link type="text/css" href="<?=$QUICKBROWSE->FRONTEND_ROOT;?>/assets/css/lib/quill.snow.css?v=1.0" rel="stylesheet">
	<link type="text/css" href="<?=$QUICKBROWSE->FRONTEND_ROOT;?>/assets/css/style.css?v=1.0" rel="stylesheet">

</head>

<body id="page-top">
	<!-- Navigation -->
	<nav class="navbar navbar-expand-lg <?php if($dir[$dir_length] == 'dashboard'){ ?>absolute<?php }else { ?>fixed<?php } ?>-top py-1 border-0" id="mainNav">
		<div class="container-fluid">
			<!--<a class="navbar-brand js-scroll-trigger ml-0 text-capitalize text-danger" href="<?=$QUICKBROWSE->DOMAIN;?>">&lt/QuickBrowse></a>-->
			<a class="navbar-brand ml-0 mr-3 scrolled-false" href="<?=$QUICKBROWSE->DOMAIN;?>">
				<img width="75px" src="<?=$QB->ASSETS->get_asset('IMG-LOGO');?>" alt="QuickBrowse Branding">
				QuickBrowse
			</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse text-light text-center text-md-left py-2 py-md-0 scrolled-false" id="navbarResponsive">
				<ul class="navbar-nav ml-0">
					<li class="nav-item mr-2">
						<a class="nav-link" href="<?=$QUICKBROWSE->DOMAIN;?>/home/">Home</a>
					</li>
					<li class="nav-item mr-2">
						<a class="nav-link" href="<?=$QUICKBROWSE->DOMAIN;?>/blog/">Blog</a>
					</li>
					<li class="nav-item mr-2">
						<a class="nav-link" href="<?=$QUICKBROWSE->DOMAIN;?>/about/">About</a>
					</li>
				</ul>
				<ul class="navbar-nav ml-0">
				<?php
					$nav = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/nav/' . $PAGE->get_page();
					if(file_exists($nav)){
						include_once($nav);
					}
				?>
				</ul>
				<ul class="navbar-nav ml-auto">
					<li class="nav-item mr-2">
						<a class="nav-link" href="<?=$QUICKBROWSE->DOMAIN;?>/docs/">Docs</a>
					</li>
					<li class="nav-item mr-2">
						<a class="nav-link" href="<?=$QUICKBROWSE->DOMAIN;?>/cdn/">CDN</a>
					</li>
					<?php
						if(!$USER->is_logged_in()){
							?>
							<li class="nav-item mr-2">
								<a class="nav-link" href="<?=$QUICKBROWSE->DOMAIN;?>/signin/">Sign-in</a>
							</li>
							<?php
						}else{
							?>
							<li class="nav-item dropdown mr-2 <?php if($dir[$dir_length] == 'dashboard'){ ?>d-none<?php } ?>">
								<a class="nav-link dropdown-toggle" href="" id="dropdownAccount" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									<?=$USER->get_user_data($USER->get_session_data()['id'])['name'];?>
								</a>
								<div class="dropdown-menu" aria-labelledby="dropdownAccount">
									<a class="dropdown-item" href="<?=$QUICKBROWSE->DOMAIN;?>/dashboard/index">Dashboard</a>
									<a class="dropdown-item" href="<?=$QUICKBROWSE->DOMAIN;?>/dashboard/account">My Account</a>
									<div class="dropdown-divider"></div>
									<a class="dropdown-item" href="<?=$QUICKBROWSE->DOMAIN;?>/logout/">Logout</a>
								</div>
							</li>
							<?php
						}
					?>
					<li class="nav-item mr-0 text-danger">
						<a class="nav-link btn btn-sm btn-danger animated shake" style="color: #efefef !important;" href="<?=$QUICKBROWSE->DOMAIN;?>/downloads/">Downloads</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>

	<?php
	//Include active page, if it doesn't exist load the error page.
	$headers 	= $QUICKBROWSE->TEMPLATE_ROOT . '/headers/';
	$pages 		= $QUICKBROWSE->TEMPLATE_ROOT . '/pages/';
	$QB->PAGE->include($pages, $headers, '404.php');
	?>

	<!-- Footer -->
	<footer class="py-5 bg-light text-danger">
		<div class="container">
			<div class="row">
				<div class="col-12 col-lg-3">
					<a href="#page-top" class="js-scroll-trigger"><p class="my-4 my-lg-0 text-center text-lg-left text-danger text-uppercase" style="font-size: 1.75rem;"><i class="far fa-caret-square-up"></i> Go up</p></a>
				</div>
				<div class="col-12 col-lg-6">
					<p class="m-0 text-center">Copyright &copy; <a class="text-danger" href="<?=$QB->TEMPLATE->AUTHOR_URL;?>"><?=$QB->TEMPLATE->AUTHOR;?></a>.
					<br>Running on QuickBrowse <?=$QUICKBROWSE->VERSION;?>.</p>
				</div>
				<div class="col-12 col-lg-3">
					<p tabindex="0" data-container="body" data-toggle="popover" data-trigger="focus" data-placement="top" data-html="true" data-title="Bootswatch Themes" data-content="<?=$QB->HTML->list_group_themes($THEMES, $THEME);?>" class="my-4 my-lg-0 text-center text-lg-right text-danger text-uppercase" style="font-size: 1.75rem;">Themes <i class="fas fa-brush"></i></p>
				</div>
			</div>
		</div>
	</footer>

	<?=$QB->ASSETS->PACKAGE->js();?>

	<!-- JavaScript Addons -->
	<script type="application/javascript" src="<?=$QUICKBROWSE->FRONTEND_ROOT;?>/assets/js/lib/datatables.min.js?v=1.0"></script>
	<script type="application/javascript" src="<?=$QUICKBROWSE->FRONTEND_ROOT;?>/assets/js/lib/quill.min.js?v=1.0"></script>

	<!-- Template JS -->
	<script type="application/javascript" src="<?=$QUICKBROWSE->FRONTEND_ROOT;?>/assets/js/script.js?v=1.1"></script>

</body>

</html>
