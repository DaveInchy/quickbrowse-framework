<?php

//REQUIRE INCLUDED MODULES FROM QUICKBROWSE

	//REQUIRE MAIL HANDLER (PHPMAILER AUTOLOADER)
	require_once($QB->ROOT . '/php/lib/vendor/autoload.php');

	//REQUIRE YOUTUBE HANDLER
	require_once($QB->ROOT . '/php/lib/youtube.class.php');

	//REQUIRE USER HANDLER
	require_once($QB->ROOT . '/php/src/user.class.php');

//LOAD CUSTOM TEMPLATE CLASSES

	//INITIALIZE CUSTOM AND BASIC FUNCTIONS
	require_once($QB->TEMPLATE_ROOT . '/php/functions.class.php');
	$QB->add_instance('FUNCT', new Functions($QB));
	
	//EXTEND FUNCTIONS WITH CUSTOM DISPLAY CLASS
	require_once($QB->TEMPLATE_ROOT . '/php/display.class.php');
	$QB->add_instance('HTML', new Display($QB));
	
?>