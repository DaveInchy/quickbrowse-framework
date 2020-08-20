<header id="login" class="bg-space-purple center-2d-old height-100 text-center">
  <div class="py-4 jumbotron bg-light center-1d width-md-8 width-xl-3">
	<img width="150px" class="mx-auto" src="<?=$QUICKBROWSE->ASSETS->get_asset('IMG-LOGO');?>" alt="QuickBrowse Branding" />
	<h2 class="my-3 text-danger text-uppercase">Sign in</h2>
	<?=$QUICKBROWSE->ASSETS->PACKAGE->alert_danger($error);?>
	<form method="POST">

	  <div class="form-group">
		<input class="form-control" type="email" name="form_email" placeholder="Email"></input>
	  </div>
	  <div class="form-group">
		<input class="form-control" type="password" name="form_password" placeholder="Password"></input>
	  </div>

	  <button class="btn btn-block btn-danger" name="btn_login">Login</button>
	  <a class="btn btn-block btn-primary" href="<?=$QUICKBROWSE->DOMAIN;?>/signup/">Create Account</a>
	</div>
  </div>
</header>