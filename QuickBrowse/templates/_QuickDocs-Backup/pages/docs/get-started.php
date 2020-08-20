<?php
	//include downloads
	include($QUICKBROWSE->TEMPLATE_ROOT . '/includes/download-section.php');
?>
<hr>
<h3>File-structure for QuickBrowse</h3>
<p class="lead">When you first unpack QuickBrowse, these are the files you end up with.<br>QuickBrowse will check for the required files and valid settings for both QuickBrowse and the Template you are using.</p>
<p class="text-primary m-0">Root ( * Required, + QuickBrowse Files, - Extra Files)</p>
<ul>
	<li class="text-danger">QuickBrowse +</li>
	<ul>
		<li class="text-danger">php +</li>
		<ul>
			<li class="text-danger">handler +</li>
			<ul>
				<li class="text-danger">mail +</li>
					<ul>
						<li class="text-danger">composer -</li>
						<li class="text-danger">phpmailer -</li>
						<li>autoload.php</li>
					</ul>
				<li>user.class.php</li>
				<li>youtube.class.php</li>
			</ul>
			<li>data.class.php *</li>
			<li>database.class.php *</li>
			<li>page.class.php *</li>
			<li>quickbrowse.class.php *</li>
		</ul>
		<li class="text-danger">templates +</li>
		<ul>
			<li class="text-danger">ExampleTemplate -</li>
			<li class="text-danger">QuickTube -</li>
		</ul>
		<li>quickbrowse.php *</li>
		<li>settings.php *</li>
	</ul>
	<li>.htaccess *</li>
	<li>index.php *</li>
</ul>
<hr>
<h3>File-structure for Templates</h3>
<p class="lead">Some files are required and some files are placed in guidelines.<br>Templates are placed within the "templates" directory in QuickBrowse.</p>
<p class="text-primary m-0">ExampleTemplate ( * Required, + QuickBrowse Files, - Extra Files)</p>
<ul>
	<li class="text-danger">assets -</li>
	<li class="text-danger">headers -</li>
	<li class="text-danger">includes -</li>
	<li class="text-danger">pages -</li>
	<li class="text-danger">php -</li>
	<li>header.php *</li>
	<li>require.php *</li>
	<li>settings.php *</li>
	<li>template.php *</li>
</ul>
<hr>
<h3>Making a Template</h3>
<p class="lead">Some Tips and Examples for a simple Template.</p>
<p>1. Make sure the directory your template is in is filled in on the settings.php in the QuickBrowse directory.</p>
<p>2. Name your template directory the same as you've done in step 1 so Quickbrowse can find your template.</p>
<p>3. Create the required files for your template including template.php, header.php, settings.php &amp require.php. You can also download a template and use these files. Make sure the your directory is named correctly.</p>
<h4 class="text-lowercase">settings.php</h4>
<small>Required for basic and possibly advanced settings to give your template. these default settings are required:</small>
<?php
	//Display raw code for settings.php
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/template/settings.php.txt';
	$QB->DISPLAY->code_from_txt($file);
?>
<h4 class="text-lowercase">template.php</h4>
<small>Required as base for your pages, normally you would include the navbar and footer here so it gets show on every page</small>
<?php
	//Display raw code for template.php
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/template/template.php.txt';
	$QB->DISPLAY->code_from_txt($file);
?>
<h4 class="text-lowercase">header.php</h4>
<small>Required as php preloader before your template.php and pages get included.</small>
<?php
	//Display raw code for header.php
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/template/header.php.txt';
	$QB->DISPLAY->code_from_txt($file);
?>
<h4 class="text-lowercase">require.php</h4>
<small>Required to load (included) modules or classes into your template. This is a basic example:</small>
<?php
	//Display raw code for require.php
	$file = $QUICKBROWSE->TEMPLATE_ROOT . '/includes/code/template/require.php.txt';
	$QB->DISPLAY->code_from_txt($file);
?>
<p>4. Make sure your settings.php is filled in correctly for both QuickBrowse and your Template so QuickBrowse won't display an array with errors. (You are required to connect to a mysql database in order to load your Template successfully).</p>
<p>5. Well done your template is created! go to <a href="./index">https://quickbrowse.doonline.nl/docs/</a> for more insight in QuickBrowse's Functionality and Modules(Classes).</p>
<hr>
<?php
	//include downloads
	include($QUICKBROWSE->TEMPLATE_ROOT . '/includes/download-section.php');
?>