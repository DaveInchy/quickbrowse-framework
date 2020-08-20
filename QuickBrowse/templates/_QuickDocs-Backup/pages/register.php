<?php
$error = 'Creating accounts has been disabled.';
?>
<header id="register" class="bg-space-purple center-2d-old height-100 text-center">
  <div class="py-4 jumbotron bg-light center-1d width-md-8 width-xl-3">
	<img width="150px" class="mx-auto" src="<?=$QUICKBROWSE->ASSETS->get_asset('IMG-LOGO');?>" alt="QuickBrowse Branding" />
	<h2 class="my-3 text-danger text-uppercase">Sign up</h2>
	<?=$QUICKBROWSE->ASSETS->PACKAGE->alert_danger($error);?>
	<form method="POST">

	  <div class="form-group">
		<div class="input-group">
			<input type="text" name="form_first_name" placeholder="First name" class="form-control">
			<input type="text" name="form_last_name" placeholder="Last name" class="form-control">
		</div>
	  </div>

	  <div class="form-group">
		<input class="form-control" type="email" name="form_email" placeholder="Choose a valid e-mail address"></input>
	  </div>

	  <div class="form-group">
		<input class="form-control" type="password" name="form_password" placeholder="Choose a password"></input>
	  </div>
	  <div class="form-group">
		<input class="form-control" type="password" name="form_password_confirm" placeholder="Confirm your password"></input>
	  </div>

	  <button class="btn btn-block btn-danger" type="submit" name="btn_register">Register</button>
	</div>
  </div>
</header>