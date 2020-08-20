<?=$QUICKBROWSE->ASSETS->PACKAGE->header('About', 'About the QuickBrowse web-developer framework', 'bg-gradient-purple text-center');?>
<section id="about">
	<div class="container">
		<div class="row jumbotron bg-gradient-background bg-sharp-gradient-purple" bg-gradient-start="#fefefe" bg-gradient-end="#3e3e3e" bg-img-url="<?=$QUICKBROWSE->ASSETS->get_asset('IMG-SPACE');?>">
			<div class="col-12 col-lg-6 mx-auto ml-md-auto text-center py-5">
				<h2 class="text-truncate mb-5"><?=$QUICKBROWSE->ASSETS->PACKAGE->img('IMG-LOGO-DOONLINE-SM', "50%");?></h2>
				<p>
				Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.<br>
				<br>
				Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo.<br>
				<br>
				Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus.
				</p>
			</div>
			<div class="col-12 col-lg-6 padding-y-10 pb-0">
				<?=$QUICKBROWSE->ASSETS->PACKAGE->alert_danger($error);?>
				<?=$QUICKBROWSE->ASSETS->PACKAGE->alert_success($success);?>
				<form method="POST" class="<?php if(!$QB->USER->is_logged_in()){ echo 'transparent-25'; } ?>">
					<div class="form-group">
					  <label for="ContactEmail">Your email address:</label>
					  <input name="contact_email" type="email" class="form-control" id="ContactEmail" aria-describedby="emailHelp" placeholder="contact@quickbrow.se" <?php if($QB->USER->is_logged_in()){ ?>value="<?=$userdata['email'];?>" <?php } ?>>
					</div>
					<div class="form-group">
					  <label for="ContactCategory">Subject category:</label>
					  <select name="contact_subject" type="text" class="form-control" id="ContactCategory">
						<option value="question">Question</option>
						<option value="suggestion">Suggestion</option>
						<option value="technical">Technical</option>
						<option value="support">Support</option>
					  </select>
					</div>
					<div class="form-group">
					  <label for="ContentText">Content:</label>
					  <textarea name="contact_content" type="text" class="form-control" id="ContentText" rows="3"></textarea>
					</div>
					<button name="contact_submit" type="submit" class="btn btn-outline-light btn-block">Send</button>
				</form>
			</div>
		</div>
	</div>
</section>
<section id="about-thanks" class="bg-sharp-gradient-light">
	<div class="container text-center">
		<h2>Thanks to</h2>
		<p class="lead mb-5">QuickBrowse is filled, used and build by many great people and projects, We're thankful for the people who provide us with great content and help. They make templates, Update QuickBrowse and are helping us with their assets to make a complete web-developer framework.</p>
		<div class="row">
			<div class="col-md-3 text-center pr-md-3">
				<div class="jumbotron bg-gradient-blue">
					<a href="https://doonline.nl/"><?=$QUICKBROWSE->ASSETS->PACKAGE->img('IMG-LOGO-DOONLINE-SM', "100%");?></a>
					<p class="mt-3">DoOnline is the company behind QuickBrowse, They started this project back in 2016 and are the main developers for QuickBrowse releases and future updates.</p>
				</div>
			</div>
			<div class="col-md-3 text-center px-md-3">
				<div class="jumbotron bg-gradient-red">
					<a href="https://webbouwerz.nl/"><?=$QUICKBROWSE->ASSETS->PACKAGE->img('IMG-LOGO-WEBBOUWERZ-SM', "100%");?></a>
					<p class="mt-3">Webbouwerz has been designing templates since QuickBrowse was barely a framework. They created one of the biggest QuickBrowse websites: <a href="https://autotheoriexl.nl" class="text-light">https://autotheoriexl.nl</a>.</p>
				</div>
			</div>
			<div class="col-md-3 text-center px-md-3">
				<div class="jumbotron bg-gradient-purple">
					<a href="https://getbootstrap.com/"><?=$QUICKBROWSE->ASSETS->PACKAGE->img('IMG-LOGO-BOOTSTRAP-SM', "100%");?></a>
					<p class="mt-3">Bootstrap is a grid/asset framework with a easy to use structure, QuickBrowse uses this as base for developing websites. Visit <a href="https://getbootstrap.com/" class="text-light">https://getbootstrap.com/</a>.</p>
				</div>
			</div>
			<div class="col-md-3 text-center pl-md-3">
				<div class="jumbotron bg-gradient-green">
					<a href="https://bootswatch.com/"><?=$QUICKBROWSE->ASSETS->PACKAGE->img('IMG-LOGO-BOOTSWATCH-SM', "100%");?></a>
					<p class="mt-3">Bootswatch is loved by front-end developers that work with Bootstrap, Bootswatch provides many css themes for Bootstrap websites. You can visit <a href="https://bootswatch.com/" class="text-light">https://bootswatch.com/</a>.</p>
				</div>
			</div>
		</div>
	</div>
</section>
<section id="about-license">
	<div class="container">
		<div class="col-lg-12 mx-auto jumbotron bg-light">
			<h2>QuickBrowse License</h2>
			<p class="lead">The QuickBrowse PHP Framework is Licensed under MIT.</p>
			<p>
			QuickBrowse PHP Framework - (https://QuickBrow.se).<br>
			Copyright 2016-2019 doOnline.nl,<br>
			Licensed under MIT (LICENSE.TXT).<br>
			CONTRIBUTORS: D. van Dooijeweert & Diego Ronca.<br>
			DOCUMENTATION: https://QUICKBROW.SE/DOCS/.<br>
			<br>
			Copyright 2016-2019 doOnline.nl<br>
			<br>
			Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), 
			to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, 
			and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:<br> 
			<br>
			The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.<br>
			<br>
			THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
			FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER 
			LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER 
			DEALINGS IN THE SOFTWARE.
			</p>
		</div>
	</div>
</section>