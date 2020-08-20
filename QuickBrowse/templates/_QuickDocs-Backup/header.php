<?php
//##NOTE## External connections to database are fking slow damnit.
//##NOTE## All variables that are not saved to $QB with add_instance() cannot be accessed trough $QB->PAGE->include();
//Fix for new QuickBrowse model 3.3.0+
$QUICKBROWSE = $QB;
$PAGE 		= $QB->PAGE;
$DATA 		= $QB->CRUD;
$CRUD		= $QB->CRUD;
$TEMPLATE 	= $QB->TEMPLATE;

//Load choose-able theme list
$THEMES = Array(
//	'bootstrap',
//	'cerulean',
//	'cosmo',
//	'cyborg',
//	'darkly',
//	'flatly',
	'journal',
//	'litera',
//	'lumen',
	'lux',
//	'materia',
//	'minty',
//	'pulse',
//	'sandstone',
//	'simplex',
	'sketchy',
//	'slate',
//	'solar',
//	'spacelab',
//	'superhero',
//	'united',
//	'yeti'
);
$QB->add_instance('THEMES', $THEMES, false);

//Load default or current theme
$THEME = isset($_SESSION['theme']) ? $_SESSION['theme'] : $QB->TEMPLATE->THEME;

//Get url and sub-directory data
$url_data 		= $QB->PAGE->data();
$dir 			= $url_data['URL_DIRS'];
$path 			= $url_data['URL_PATH'];
$dir_length 	= $url_data['URL_DEPTH'];
$page 			= $dir[$dir_length];
$QB->add_instance("URL_DATA", $QB->PAGE->data(), false);

//Register simple links without sub-directories.
$QB->PAGE->set_link('signup', 'register.php');
$QB->PAGE->set_link('sign-up', 'register.php');
$QB->PAGE->set_link('signin', 'login.php');
$QB->PAGE->set_link('sign-in', 'login.php');
$QB->PAGE->set_link('log-in', 'login.php');
$QB->PAGE->set_link('contact', 'about.php');

//Fix preg_match with or without "s".
$QB->PAGE->set_link('download', 'download.php');
$QB->PAGE->set_link('downloads', 'downloads.php');

//If current directory is post and the parent directory is blog, use the page as id
if($dir_length >= 1){
	if($dir[1] == 'post' && $dir[0] == 'blog' && isset($dir[2])){
		$QB->PAGE->set_link($page, 'post.php');
		$QB->PAGE->set_content($dir[2]);
	}
	if($dir[1] == 'page' && $dir[0] == 'blog'){
		$QB->PAGE->set_link($page, 'blog.php');
		$QB->PAGE->set_content($QB->PAGE->get_page(false));
	}

	//Register sub-directory links with content id
	if($dir[1] == 'video' && $dir[0] == 'youtube'){
		$QB->PAGE->set_link($page, 'video.php');
		$QB->PAGE->set_content($QB->PAGE->get_page(false));
	}
	if($dir[0] == 'download'){
		$QB->PAGE->set_link($page, 'download.php');
		$QB->PAGE->set_content($QB->PAGE->get_page(false));
	}

	//Register docs sub-directory links
	if($dir[0] == 'docs'){
		$QB->PAGE->set_link($page, 'docs.php');
		if($dir_length >= 2){
			$QB->PAGE->set_content($QB->PAGE->get_page(false));
		}
	}

	//Register dashboard sub-directory links
	if($dir[0] == 'dashboard'){
		//use different theme for dashboard
		$THEME = 'BOOTSWATCH-LUX';
		$QB->PAGE->set_link($page, 'dashboard.php');
		if($dir_length >= 2){
			$QB->PAGE->set_content($QB->PAGE->get_page(false));
		}
	}
}

$PAGE->reload();

//Set global Objects
$DB_USERS_USER	= 'doonline';
$DB_USERS_PASS	= 'h3tkdsh00';
$DB_USERS_SERV	= '85.214.95.254';
$DB_USERS_NAME	= 'doonline_users';
$DB_USERS 		= new Database($DB_USERS_USER, $DB_USERS_PASS, $DB_USERS_SERV, $DB_USERS_NAME);
$DATA_USERS 	= new CRUD($DB_USERS);
$QB->add_instance('USER', new UserHandler($QB, $DATA_USERS, 'users', 'QuickBrowse:Docs-3.4.2:05-09-2019'), true);

$APIKEY	= 'AIzaSyD88_hQf80cf3Nqnk5vRHoTtO2IXvoALew';
$QB->add_instance('YOUTUBE', new YoutubeHandler('AIzaSyD88_hQf80cf3Nqnk5vRHoTtO2IXvoALew'), true);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
$QB->add_instance('MAIL', new PHPMailer(), true);

$QB->add_instance('FUNCTIONS', new Functions(), true);
$QB->add_instance('DISPLAY', new Display($QB), true);

//To make sure USER wont get set elsewhere before loading it into QuickBrowseJS
$USER_HANDLE = $QB->USER;
//Fix for old tp
$USER = $QB->USER;

//get live userdata with Users Handler.
if($QB->USER->is_logged_in()){
	$user_session 	= $QB->USER->get_session_data();
	$id 			= $user_session['id'];
	$user_data 		= $QB->USER->get_user_data($id);
}

$QB->add_instance('USERS', $DATA_USERS->data_read('users', Array('TYPE' => 'DATA_NEWEST')), true);
$QB->add_instance('POSTS', $QB->CRUD->data_read('posts', Array('TYPE' => 'DATA_NEWEST')), true);

?>