<?php
try{
	// Setup and Prepare useful variables before including template.php and page.

	// Create and adding Instances of Required Components to $QB.
	//$QB->add_instance('YOUTUBE', new YoutubeHandler('FAKE_KEYQ34Be_qlz2kdf8yui03dfg'));
	//$QB->add_instance('PHPMAILER', new PHPMailer());
	//$QB->add_instance('FUNCTIONS', new Functions());

	// Create and add Instance of UserHandler Component:
	//$UNIQUE	= '3X4MPL3;S7471C:UN1QU3-3NCRYP71ON2.S33D;IMPORTANT!NEVER_CHANGE_THIS_LATER';
	//$QB->add_instance('USER', new UserHandler($QB->CRUD, 'users', $UNIQUE, $QB->DOMAIN . '/signup', $QB->DOMAIN . '/signin', $QB->DOMAIN . '/dashboard/'));

	// Get URL data and overwrite to variables for usage:
	$URL_DATA = $QB->PAGE->data();
	if($URL_DATA != false){
		$URL_DIRS 	= $URL_DATA['URL_DIRS'];
		$URL_DEPTH 	= $URL_DATA['URL_DEPTH'];
		$URL_PATH	= $URL_DATA['URL_PATH'];
	}

	// Register simple links without sub-directories.
	$QB->PAGE->set_link('404', 'error.php');

	// Reload registered links, Also sets the correct page to $QB->PAGE.
	$QB->PAGE->reload();

	// Set page directories variables to include pages and headers from.
	$DIR_HEAD = $QB->TEMPLATE_ROOT . '/header/';
	$DIR_PAGE = $QB->TEMPLATE_ROOT . '/page/';
	$FILE_ERR = 'error.php';

	// Set $QB->THEME for later use in css(), this is the asset's name, look for a full list of assets on https://quickbrow.se/cdn/.
	// WARNING, if you want to use values from this header inside pages, you need to add an instance to quickbrowse. or else they wont be accessible.
	$QB->add_instance('THEME', "BOOTSWATCH-SKETCHY");

	// Preparing $QB->BLOGPOSTS with all posts from database if default database is loaded in QuickBrowse settings.
	//if($QB->LOAD_DB) $QB->add_instance('BLOGPOSTS', $QB->CRUD->data_read('posts', Array('TYPE' => 'DATA_NEWEST')));
}catch(\Exception $e){
	$QB->set_error(__FILE__, $e->getMessage());
}
?>
