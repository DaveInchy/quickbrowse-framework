<nav class="navbar navbar-expand-lg fixed-top border-0">
  <a class="navbar-brand ml-5" href="<?=$QB->DOMAIN;?>"><?=$QB->ASSETS->PACKAGE->img('IMG-LOGO', '75px'); ?></a>
  
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarLinks" aria-controls="navbarLinks" aria-expanded="false" aria-label="Toggle navigation">
	<span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarLinks">
  
	<ul class="navbar-nav mr-auto">
	  <li class="nav-item active">
		<a class="nav-link" href="<?=$QB->DOMAIN;?>">Home</a>
	  </li>
	  <li class="nav-item">
		<a class="nav-link" href="<?=$QB->DOMAIN;?>/about">About</a>
	  </li>
	</ul>
	
	<ul class="navbar-nav ml-auto">
	  <li class="nav-item">
		<a href="https://docs.quickbrow.se/" class="btn btn-outline-light my-2 my-sm-0 mr-2 text-light">Documentation</a>
	  </li>
	  <li class="nav-item">
		<a href="https://quickbrow.se/downloads?refferal=<?=urlencode($QB->DOMAIN);?>" class="btn btn-outline-light my-2 my-sm-0 mr-5 text-light">Download</a>
	  </li>
	</ul>
	
  </div>
</nav>
