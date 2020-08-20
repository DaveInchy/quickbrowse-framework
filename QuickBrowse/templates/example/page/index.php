<?=$QB->ASSETS->PACKAGE->header( 	'<img width="250px" src="' . $QB->ASSETS->get_asset('IMG-LOGO-DOONLINE-SM') . '" alt="brand logo"><br><span class="font-weight-light">' . $QB->TEMPLATE->TITLE . '</span>',
											'QuickBrowse web-development Framework<br><h6 class="text-light text-center font-weight-bold">PHP / HTML / CSS / JS</h6>',
											'bg-mountain-purple height-100 center-2d-old', 'text-light text-center');?>
											
<?=$QB->ASSETS->PACKAGE->banner('download', 'bg-sharp-gradient-purple', 'text-light wow bounce');?>

<section id="welcome" class="bg-gradient-purple text-light text-center">
	<div class="col-12 col-md-10 col-xl-8 mx-auto">
		<h3 class="text-light font-weight-light">Welcome to our example template.</h3>
		<p class="lead my-5 text-center">
			We have created a simple template for you, so you can explore QuickBrowse's functionality without reading the docs.<br>
			If you don't understand something about this web-development framework, make sure to check out our documentation:<br>
			<a href="https://quickbrow.se/docs/" class="btn btn-primary text-light mt-3">Docs</a>
		</p>
	</div>
</section>

<?=$QB->ASSETS->PACKAGE->banner('contact', 'bg-sharp-gradient-purple', 'text-light');?>