<?php

//IMPORTANT: This file is required, and the class needs to be "TemplateSettings" to make sure its valid.
//IMPORTANT: These settings will be included into QuickBrowse by default as "$TEMPLATE".

//TIP: You can call these settings with for example: $TEMPLATE->VERSION.
//TIP: Look on https://quickbrowse.doonline.nl/ for the documentation and how to create settings for your template.

class TemplateSettings{
	
	//Template Information. (Default and required)
	public $VERSION 			= '2.1';
	public $TITLE 				= 'QuickDocs';
	public $DESCRIPTION 		= 'QuickBrowse is written with PHP 7 and build by &lt/doOnline>.<br>We created a framework where you don\'t have to screw around with tideous tasks,<br>like SQL Queries or Managing a clean workspace.<br>Build for web-developers by web-developers.';
	public $AUTHOR 				= '&lt/doOnline>';
	public $AUTHOR_URL			= 'https://doonline.nl';
	public $AUTHOR_EMAIL		= 'contact@doonline.nl';
	
	//Youtube Settings.
	public $CHANNELID 			= 'UCC_0E4Ps1r0hHOybaHJp47Q';
	public $FEATURED 			= 'FfkIWauxc9s';
	
	//Theme Settings. 
	public $THEME				= 'BOOTSWATCH-SKETCHY';
}

?>