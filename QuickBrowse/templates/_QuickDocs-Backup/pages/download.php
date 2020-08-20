<header id="download-message" class="bg-gradient-purple text-light">
	<div class="container text-center">
		<div class="col-lg-12">
			<h3 class="text-light text-truncate"><?=$message;?></h3>
			<p class="text-light font-weight-bold"><?=$error;?></p>
			<p class="lead">Please report problems at <a class="text-light" href="<?=$QUICKBROWSE->DOMAIN;?>/contact"><?=$QUICKBROWSE->DOMAIN;?>/contact</a>.<br>If you can't aquire the required files from this website, try to contact <a class="text-light" href="<?=$QB->TEMPLATE->AUTHOR_URL;?>"><?=$QB->TEMPLATE->AUTHOR_EMAIL;?></a>.</p>
		</div>
	</div>
</header>

<section id="download">
	<div class="container">
	  <div class="row">
		<div class="col-md-8 mx-auto">
		  <?php
			//Include sidebar
			include_once($QUICKBROWSE->TEMPLATE_ROOT . '/includes/download-section.php');
		  ?>
		</div>
	  </div>
	</div>
</section>