<?php

	//ALWAYS START SESSIONS, IF SESSION ID IS SET CONTINUE SESSION
	isset($_GET['sid']) && !empty($_GET['sid']) ? session_start($_GET['sid']) : session_start();
	
	//REQUIRE QUICKBROWSE CONFIGURATION OR USE SAMPLE ONE
	file_exists(__DIR__ . '/../../config.php') ? require_once(__DIR__ . '/../../config.php') : require_once(__DIR__ . '/../../framework/core/sample-config.php');
	
	//REQUIRE QUICKBROWSE COMPONENTS
	//require_once(__DIR__ . '/../../framework/core/classes/api.class.php');
	require_once(__DIR__ . '/../../framework/core/classes/assets.class.php');
	//require_once(__DIR__ . '/../../framework/core/classes/client.class.php');
	require_once(__DIR__ . '/../../framework/core/classes/page.class.php');
	require_once(__DIR__ . '/../../framework/core/classes/database.class.php');
	require_once(__DIR__ . '/../../framework/core/classes/crud.class.php');
	
	//NOT REQUIRE UNFINISHED QUICKBROWSE COMPONENTS
	//require_once(__DIR__ . '/../../framework/core/classes/youtube.class.php');
	//require_once(__DIR__ . '/../../framework/core/classes/user.class.php');
	//require_once(__DIR__ . '/../../framework/core/classes/ssh.class.php');
	
	//REQUIRE MAIN COMPONENTS
	require_once(__DIR__ . '/../../framework/core/classes/debug.class.php');
	require_once(__DIR__ . '/../../framework/core/classes/extension.class.php');
	require_once(__DIR__ . '/../../framework/core/classes/quickbrowse.class.php');
	
	//RUN QUICKBROWSE
	$QB = new QuickBrowse();

?>
