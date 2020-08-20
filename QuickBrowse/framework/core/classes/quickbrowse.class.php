<?php

class QuickBrowse extends QuickBrowseSettings{
	
	//QuickBrowse Static Globals,
	//Used for QuickBrowse instances.
	public $ROOT = './QuickBrowse';
	public $ERROR_NOTICE = true;
	/* @var string ALLOW_MEM_PEAK used for big operations like database import */
	public $ALLOW_MEM_PEAK = "512M";
	public $PREPARED = false;
	
	//QuickBrowse Dynamic Globals.
	public $TEMPLATE_ROOT;
	public $FRONTEND_ROOT;
	public $ASSETS_URL;
	public $ASSETS_DIR;
	public $SESSION_ID;
	
	//QuickBrowse's included instances.
	//these are included during initialization.
	public $DATABASE;
	public $CRUD;
	public $ASSETS;
	public $PAGE;
	public $TEMPLATE;
	public $USER;
	
	//Default secured instances,
	//in case of leaking PHP memory.
	private $SECURED = Array(
		//QuickBrowse 
		'ASSETS',
		'CRUD',
		'USERS',
		'USER',
		
		//Database
		'DATABASE',
		'DB_USER',
		'DB_PASS',
		
		//Common
		'API_KEY',
		'PASSWORD',
		'ID',
		'KEY',
		'PUBLIC_KEY',
		'PRIVATE_KEY',
		'PUBLIC',
		'PRIVATE',
		'ERROR',
	);
	
	function __construct(){
		
		//0.1 START MICRO TIME TO CHECK PAGE LOAD.
		$this->START_TIME = microtime();
		
		//1.0 SET CUSTOM ERROR LOGGING EN SHUTDOWN BEHAVIOUR
		$this->add_instance('DEBUG', new Debug($this));
		if(!isset($this->DEBUG) || !$this->DEBUG) return false;
		
		//CHECK IF QUICKBROWSE NEEDS TO BE INSTALLED BEFORE INITIALIZING.
		if($this->install_quickbrowse()){
			$this->install(true);
		}else{
			//3.0 CHECKING QUICKBROWSE FILE files
			$this->DEBUG->log("Preparing QuickBrowse and checking program files.");
			if(!$this->check_quickbrowse_files()) $this->DEBUG->error(__METHOD__, 'Couldn\'t perform method on line: ' . __LINE__, E_USER_ERROR);
			
			//2.0 PREPARE DYNAMIC SETTINGS
			$this->DEBUG->log("Loading dynamic settings.");
			if(!$this->prepare_dynamic_settings()) $this->DEBUG->error(__METHOD__, 'Couldn\'t perform method on line: ' . __LINE__, E_USER_ERROR);
			
			//3.1 INITIALIZE AND SET QUICKBROWSE INSTANCES
			$this->DEBUG->log("Initializing and creating QuickBrowse instances.");
			if(!$this->initialize_quickbrowse()) $this->DEBUG->error(__METHOD__, 'Couldn\'t perform method on line: ' . __LINE__, E_USER_ERROR);
			
			$this->PREPARED = true;
			
			//5.0 SET HEADERS AND COMPRESSION
			$this->DEBUG->log("Initializing headers and compression.");
			if(!$this->set_headers()) $this->DEBUG->error(__METHOD__, 'Couldn\'t perform method on line: ' . __LINE__, E_USER_ERROR);
		
			//4.0 INITIALIZE CONFIGURED TEMPLATE
			$this->DEBUG->log("Preparing template (" . $this->TEMPLATE_DIR . ") and checking program files.");
			if(!$this->check_template_files()) $this->DEBUG->error(__METHOD__, 'Couldn\'t perform method on line: ' . __LINE__, E_USER_ERROR);
			
			//CHECK IF TEMPLATE NEEDS TO BE INSTALLED BEFORE INITIALIZING.
			if($this->install_template()){
				$this->install(false);
			}else{
				//4.1 INITIALIZING CONFIGURED TEMPLATE
				$this->DEBUG->log("Initializing template (" . $this->TEMPLATE_DIR . ").");
				if(!$this->initialize_template()) $this->DEBUG->error(__METHOD__, 'Couldn\'t perform method on line: ' . __LINE__, E_USER_ERROR);
			}
			
			//5.0 SET HEADERS AND COMPRESSION
			$this->DEBUG->log("Clearing some QuickBrowse instances.");
			if(!$this->clear()) $this->DEBUG->error(__METHOD__, 'Couldn\'t perform method on line: ' . __LINE__, E_USER_ERROR);
		}
		
		//0.1 START MICRO TIME TO CHECK PAGE LOAD.
		$this->END_TIME = microtime();
	}
	
	function add_instance($key, $value, $secured = true){
		$key = strtoupper($key);
		
		if(!isset($value)){
			if(isset($this->DEBUG))
				$this->DEBUG->error($key,"[" . $key . "] Failed to add " . $key . " Instance to QuickBrowse, value was apperently not set.");
			return false;
		}else{
		    $this->$key = $value;
		    try{
		        if(isset($this->DEBUG) && !is_object($value))
				    $this->DEBUG->log("[" . $key . "] Setting instance value to '" . $value . "'.");
            }catch (Exception $exception){
                if(isset($this->DEBUG))
                    $this->DEBUG->log("[" . $key . "] Couldn't change value to string.");
            }
		}
		
		if($secured){
			if(isset($this->DEBUG))
				$this->DEBUG->log("[" . $key . "] Making sure " . $key . " instance is secured for QuickBrowse client data.");
			if(!in_array($key, $this->SECURED)) array_push($this->SECURED, $key);
		}
		
		if(isset($this->DEBUG))
	        $this->DEBUG->log("[" . $key . "] Finished Indexing " . $key . " Instance to QuickBrowse.");
		return true;
	}
	
	function all_equal($arr, $value){
		return array_keys(array_flip($arr)) == array($value);
	}
	
	function return_bytes ($size_str){
		switch (substr ($size_str, -1)){
			case 'M': case 'm': return (int)$size_str * 1048576;
			case 'K': case 'k': return (int)$size_str * 1024;
			case 'G': case 'g': return (int)$size_str * 1073741824;
			default: return $size_str;
		}
	}
	
	function return_size($bytes, $precision = 2) { 
		$units = array('B', 'KB', 'MB', 'GB', 'TB'); 

		$bytes = max($bytes, 0); 
		$pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
		$pow = min($pow, count($units) - 1); 

		// Uncomment one of the following alternatives
		// $bytes /= pow(1024, $pow);
		// $bytes /= (1 << (10 * $pow)); 

		return round($bytes, $precision) . ' ' . $units[$pow]; 
	}
	
	function code_encode($code){
		$txt[1] = str_replace('&', '&amp'	, $code);
		$txt[2] = str_replace('<', '&lt'	, $txt[1]);
		$txt[3] = str_replace('>', '&gt'	, $txt[2]);
		$txt[4] = str_replace('$', '&#0036'	, $txt[3]);
		$txt[5] = str_replace('?', '&#0063'	, $txt[4]);
		$txt[6] = str_replace('#', '&#0035'	, $txt[5]);
		$txt[7] = str_replace('(', '&#0040'	, $txt[6]);
		$txt[8] = str_replace(')', '&#0041'	, $txt[7]);
		$txt[9] = str_replace('[', '&#0091'	, $txt[8]);
		$txt[10] = str_replace(']', '&#0093', $txt[9]);
		$txt[11] = str_replace('{', '&#0123', $txt[10]);
		$txt[12] = str_replace('}', '&#0125', $txt[11]);
		return $txt[4];
	}
	
	function code_decode($text){
		$txt[1] = str_replace('&amp'	, '&', $text);
		$txt[2] = str_replace('&lt'		, '<', $txt[1]);
		$txt[3] = str_replace('&gt'		, '>', $txt[2]);
		$txt[4] = str_replace('&#0036'	, '$', $txt[3]);
		$txt[5] = str_replace('&#0063'	, '?', $txt[4]);
		$txt[6] = str_replace('&#0035'	, '#', $txt[5]);
		$txt[7] = str_replace('&#0040'	, '(', $txt[6]);
		$txt[8] = str_replace('&#0041'	, ')', $txt[7]);
		$txt[9] = str_replace('&#0091'	, '[', $txt[8]);
		$txt[10] = str_replace('&#0093'	, ']', $txt[9]);
		$txt[11] = str_replace('&#0123'	, '{', $txt[10]);
		$txt[12] = str_replace('&#0125'	, '}', $txt[11]);
		return $txt[4];
	}
	 
	function client_json($load_user = false){
		
		$this->DEBUG->log("If first argument is true (loadUser == true) check if this->USER is added trough QB->add_instance().");
		if($load_user && isset($this->USER)){
			$this->DEBUG->log("Creating local variable from this->USER.");
			$HANDLER = (isset($this->USER) ? $this->USER : null);
			if($HANDLER == null){
				$this->DEBUG->log("this->USER is not set, skipping conversion...");
			}else{
			
				$this->DEBUG->log("Checking if this->USER logged in.");
				if($HANDLER->is_logged_in()){
					$this->DEBUG->log("this->USER is logged in, Start converting this->USER's Properties to an Array.");
					$user 					= $HANDLER->get_user_data($HANDLER->get_session_data()['id']);
					$user['loggedin'] 		= $HANDLER->is_logged_in();
					$user['public'] 		= $HANDLER->encrypt($user['private']);
					$user['private'] 		= 'Secured Property';
					$user['password'] 		= 'Secured Property';
				}else{
					$this->DEBUG->log("this->USER is not logged in, Creating dummy data.");
					$user					= Array();
					$user['loggedin'] 		= false;
					$user['id'] 			= '-1';
					$user['name'] 			= 'Dawqewqebhwqhiejkwql';
					$user['public'] 		= $HANDLER->encrypt('none');;
					$user['private'] 		= 'Secured Property';
					$user['password'] 		= 'Secured Property';
				}
				$user['session_id'] = session_id;
				$this->DEBUG->log("Finished converting this->USER's Properties to an Array.");
			
			}
		}
		
		$this->DEBUG->log("Start converting QuickBrowse's Properties/Objects to an Array.");
		
		$QB_OBJ = get_object_vars($this);
		$loop[1] = 0;
		foreach($QB_OBJ as $extention => $VALUE){
			if(is_object($VALUE)){
				$this->DEBUG->log("" . $loop[1] . "] Found QuickBrowse->" . $extention . " extention to be an Object, Securing if needed.");
				$isSecure = false;
				$loop[2] = 0;
				foreach($this->SECURED as $SECURE){
					if(strtoupper($SECURE) == $extention){
						$this->DEBUG->log("" . $loop[1] . ":" . $loop[2] . "] Securing QuickBrowse->" . $extention . " Object for QuickBrowseJS Client.");
						$QB_DATA[$extention] = 'Secured Object';
						$isSecure = true;
					}
					$loop[2]++;
				}
				if(!$isSecure){
					$this->DEBUG->log("" . $loop[1] . ":" . $loop[2] . "] Converting and Saving QuickBrowse->" . $extention . " Object to an Array.");
					$QB_DATA[$extention] = get_object_vars($VALUE);
					if(isset($QB_DATA[$extention]['ERROR'])){
						$this->DEBUG->log("\n[get_client_dataRemoving] Removing QuickBrowse's Properties that are useless for the QuickBrowseJS Client.");
						unset($QB_DATA[$extention]['ERROR']);
						unset($QB_DATA[$extention]['INFO']);
					}
				}
			}else{
				$this->DEBUG->log("" . $loop[1] . "] Found QuickBrowse->" . $extention . " extention to be a Property, Securing if needed.");
				$isSecure = false;
				$loop[2] = 0;
				foreach($this->SECURED as $SECURE){
					if(strtoupper($SECURE) == $extention){
						$this->DEBUG->log("" . $loop[1] . ":" . $loop[2] . "] Securing QuickBrowse->" . $extention . " Property for QuickBrowseJS Client.");
						$QB_DATA[$extention] = 'Secured ' . $extention . ' Property';
						$isSecure = true;
					}
					$loop[2]++;
				}
				if(!$isSecure){
					$this->DEBUG->log("" . $loop[1] . ":" . $loop[2] . "] Converting and Saving QuickBrowse->" . $extention . " Property to an Array.");
					$QB_DATA[$extention] = $VALUE;
				}
			}
			$loop[1]++;
		}
		
		$this->DEBUG->log("Finished converting QuickBrowse->Properties/Objects to an Array.");
		
		$this->DEBUG->log("Start formatting QuickBrowse into an filesd Array.");
		$RESULT = Array(
			'QB' => Array(
				'DATA' => $QB_DATA,
				'SESSION' => (isset($user) ? $user : session_id()),
				//'ASSETS' => (isset($this->ASSETS->ASSET) ? $this->ASSETS->ASSET : 'No assets found.'),
			)
		);
		
		$this->DEBUG->log("Start converting the Array to JSON for the QuickBrowseJS Client.");
		return json_encode($RESULT);
	}
	
	//@INFO, dont make public yet, causes for memory leaks. test first. MEM Leaks at first
	private function object_to_array($obj, $depth = 0) {
		try{
			$this->DEBUG->log('object_to_array', 'Start converting the Array to JSON for the QuickBrowseJS Client.');
			$current_mem_limit = ini_get('memory_limit');
			ini_set('memory_limit', $this->ALLOW_MEM_PEAK);
			
			$_arr = is_object($obj) ? get_object_vars($obj) : $obj;
			foreach ($_arr as $key => $val) {
				if($depth < 2){
					$depth++;
					$val = is_array($val) || is_object($val) ? $this->object_to_array($val, $depth) : $val;
				}
				$arr[$key] = $val;
			}
			ini_set('memory_limit', $current_mem);
		}catch(\Exception $e){
			$this->DEBUG->log( 'Caught an error: ' . $e->getMessage());
			return false;
		};
		return $arr;
	}
	
	private function prepare_dynamic_settings(){
		$QUICKBROWSE_DIR = str_replace('./', '', $this->ROOT);
		$this->ASSETS_URL = $this->USE_DOMAIN ? $this->DOMAIN . '/' . $QUICKBROWSE_DIR . '/assets/' : $this->ROOT . '/assets/';
		$this->ASSETS_DIR = $this->ROOT . '/assets/';
		$this->TEMPLATE_ROOT = $this->ROOT . '/templates/' . $this->TEMPLATE_DIR;
		$this->FRONTEND_ROOT = $this->USE_DOMAIN ? $this->DOMAIN . '/' . $this->TEMPLATE_ROOT : $this->TEMPLATE_ROOT;
		return true;
	}
	
	private function check_quickbrowse_files(){
		$dir = "/framework/core";
		$sources = Array(
		
		    "classes/installer.class.php",
		    
			"classes/debug.class.php",
			"classes/extension.class.php",
			"classes/quickbrowse.class.php",
			"classes/assets.class.php",
			"classes/database.class.php",
			"classes/crud.class.php",
			"classes/page.class.php",
			
			//"classes/client.class.php",
			//"classes/api.class.php",
			
			//"classes/user.class.php",
			//"classes/ssh.class.php",
			//"classes/youtube.class.php",
			
			"sample-config.php",
			"loader.php",
		);
		foreach($sources as $file){
			if(!file_exists($this->ROOT . $dir . '/' . $file)){
				$this->DEBUG->error(__METHOD__, "Couldn't find extention (" . $file . ") in directory (" . $this->ROOT . $dir . ").");
				return false;
			}
		}
		return true;
	}
	
	private function check_template_files(){
		$files = Array(
			"includes/header.php",
			"includes/require.php",
			"template.php",
			//"install.json",
		);
		foreach($files as $file){
			if(!file_exists($this->TEMPLATE_ROOT . '/' . $file)){
				$this->DEBUG->error('', "Couldn't find " . $file . " in template (" . $this->TEMPLATE_ROOT . ").");
				return false;
			}
		}
		return true;
	}
	
	private function install($is_qb){
		$QB = $this;
		if(!$is_qb){
			$this->DEBUG->log("Redirecting to start of template installer.");
			if(!isset($_GET['step'])){
				header('Location: setup/template/guide?step=start-tp-setup');
				exit();
			}
		}else{
			$this->DEBUG->log("Redirecting to start of QuickBrowse installer.");
			if(!isset($_GET['step'])){
				header('Location: setup/quickbrowse/guide?step=start-qb-setup');
				exit();
			}
		}
		include_once($this->ROOT . '/framework/setup/require.php');
		include_once($this->ROOT . '/framework/setup/header.php');
		include_once($this->ROOT . '/framework/setup/install.php');
		exit();
	}
	
	private function install_quickbrowse(){
		if(!file_exists($this->ROOT . '/config.php')){
			$this->DEBUG->log("Can't find QuickBrowse config.php, QuickBrowse should be installed.");
			return true;
		}
		return false;
	}
	
	private function install_template(){
		
		$json = $this->TEMPLATE_ROOT . '/install.json';
		
		if(!file_exists($json)){
			$this->DEBUG->log("Can't find install.json in current template. Template should be ready then..");
			return false;
		}
		
		$json = file_get_contents($json);
		$data = json_decode($json, true);
		
		return true;
	}
	
	private function initialize_quickbrowse(){
		
		if($this->LOAD_DB){
			$this->DATABASE = new Database($this->DB_USER, $this->DB_PASS, $this->DB_HOST, $this->DB_NAME, $this->USE_PDO, $this->DB_TYPE);
			if($this->DEBUG->obj_error($this->DATABASE)){
				$this->DEBUG->error('DATABASE', "Couldn't initialize QB->DATABASE, found an error on construct >\n" . $this->DATABASE->ERROR);
				return false;
			}
		
			$this->CRUD = new CRUD($this->DATABASE);
			if($this->DEBUG->obj_error($this->CRUD)){
				$this->DEBUG->error('CRUD', "Couldn't initialize QB->CRUD, found an error on construct >\n" . $this->CRUD->ERROR);
				return false;
			}
		}else{
			$this->DATABASE = null;
			$this->CRUD = null;
		}
		
		if($this->LOAD_ASSETS){
			$this->ASSETS = new ASSETS($this, $this->ASSETS_URL, $this->ASSETS_DIR, $this->USE_CDN);
			if($this->DEBUG->obj_error($this->ASSETS)){
				$this->DEBUG->error('ASSETS', "Couldn't initialize QB->ASSETS, found an error on construct >\n" . $this->ASSET->ERROR);
				return false;
			}
		}else{
			$this->ASSETS = null;
		}
		
		//@TODO Change all inits like this one.
		$this->add_instance("PAGE", new Page($this));
		if(!isset($this->PAGE) || !$this->PAGE){
			$this->DEBUG->error(__METHOD__, "Couldn't initialize new Page, error during construction -> Check the log for more information.");
			return false;
		}
		
		$this->add_instance("EXTENSION", new Extension($this));
		if(!isset($this->EXTENSION) || !$this->EXTENSION){
			$this->DEBUG->error(__METHOD__, "Couldn't initialize new Extension, error during construction -> Check the log for more information.");
			return false;
		}
		
		// $this->add_instance("USER", new UserHandler($this, $this->CRUD, 'users'));
		// if($this->DEBUG->obj_error($this->USER)){
		// 	$this->DEBUG->error('USER', "Couldn't initialize QB->USER, found an error on construct >\n" . $this->USER->ERROR);
		// 	return false;
		// }
		
		return true;
	}
	
	private function initialize_template(){
		$templateSettings = $this->TEMPLATE_ROOT . '/config.php';
		if(file_exists($templateSettings)){
			require_once($templateSettings);
			$this->add_instance('TEMPLATE', new TemplateSettings());
		}
			
		$QB = $this;
		include_once($this->TEMPLATE_ROOT . '/includes/require.php');
		include_once($this->TEMPLATE_ROOT . '/includes/header.php');
		include_once($this->TEMPLATE_ROOT . '/template.php');
		return true;
	}
	
	private function set_headers(){
		try{
			$this->DEBUG->log("Testing if client accepts gzip compression.");
			$client_accept = substr_count($_SERVER['HTTP_ACCEPT_ENCODING'], 'gzip');
			$result = false;
			if($this->USE_COMPRESSION && $client_accept){
				$this->DEBUG->log("Setting standard headers and gzip compression (compression level 3 of max 6).");
				if(ini_get('zlib.output_compression') != 'On' || headers_sent() === null){
					ini_set('zlib.output_compression', 'On');
					ini_set('zlib.output_compression_level', 3);
					$result = false;
				}
				if(headers_sent() === null){
					$result = ob_start("ob_gzhandler");
				}
			}
			if(!$result || !$this->USE_COMPRESSION || !$client_accept){
				ob_start();
			}
		}catch(\Exception $e){
			$this->DEBUG->error(__METHOD__, "Caught Exception: " . $e->getMessage() . "at" . __FILE__ . " on line " . __LINE__ . ", backtrace: " . __CLASS__ . "->" . __FUNCTION__, E_USER_ERROR);
			return false;
		}
		return true;
	}
	
	private function clear(){
		ob_end_flush();
		return true;
	}
	
}

?>
