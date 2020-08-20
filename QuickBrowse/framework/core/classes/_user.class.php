<?php

class UserHandler{
	
	public $ERROR = '';
	public $INFO = '';
	
	public $CRUD;
	private $QB;
	
	private $DASHBOARD_URL;
	private $REGISTER_URL;
	private $LOGIN_URL;
	
	//Secure properties
	private $TABLE;
	private $SEED;
	private $PUBLIC;
	private $PRIVATE;
	
	function __construct($QUICKBROWSE, $CRUD, $TABLE, $UNIQUE = '3.3.2:04-09-2019', $REGISTER = "./signup", $LOGIN = "./signin", $DASHBOARD = "./dashboard"){
		try{
			$this->QB = $QUICKBROWSE;
			$this->INFO = $this->INFO = "\n[UserHandler:Constructor] Start constructing UserHandler Object with CRUD Object using table = " . $TABLE . "."
										. "\n[UserHandler:Constructor] Setting UserHandler Object properties.";
			$this->CRUD = $CRUD;
			$this->TABLE = $TABLE;
			
			$this->DASHBOARD_URL = $DASHBOARD;
			$this->REGISTER_URL = $REGISTER;
			$this->LOGIN_URL = $LOGIN;
			
			$this->SEED = sha1($UNIQUE);
			$this->INFO = $this->INFO = "\n[UserHandler:Constructor] Finished constructing UserHandler Object with CRUD Object using table = " . $TABLE . " and unique = " . $UNIQUE . ".";
		}catch(\Exception $e){
			$this->QB->DEBUG->error('__userhandler' . __LINE__,  "Caught Exception: " . $e->getMessage() . "at" . __FILE__ . " on line " . __LINE__ . ", backtrace: " . __CLASS__ . "->" . __FUNCTION__);
			return false;
		}
		return true;
	}
	
	function get_session_data(){
		if($this->is_logged_in()){
			return $_SESSION['quickbrowse_user'];
		}
		return false;
	}
	
	function get_users_data(){
		$data = $this->CRUD->data_read($this->TABLE, Array('TYPE' => 'DATA_NEWEST'));
		return $data;
	}
	
	function get_user_data($id){
		$data = $this->get_users_data();
		foreach($data as $user){
			if($id == $user['id']){
				$data = $user;
				$fixed = Array();
				foreach($data as $key => $value){
					if(is_int($key)){
						unset($data[$key]);
					}else{
						$fixed[$key] = $value;
					}
				}
				return $fixed;
			}
		}
		return false;
	}
	
	function encrypt($content){
		if(!isset($content) || empty($content)){
			$this->ERROR = $this->ERROR . "\nEncryption failed, first argument; content was not valid.";
			return false;
		}
		$content = md5($this->SEED . $content);
		return $content;
	}

	function register($FIRST_NAME, $LAST_NAME, $EMAIL, $PASSWORD, $PASSWORD_CONFIRM){
		return false;
	}

	function login($EMAIL, $PASSWORD){
		$users = $this->get_users_data();
		$found = false;
		foreach($users as $user){
			if($user['email'] == $EMAIL && $user['password'] == $PASSWORD){
				$_SESSION['quickbrowse_user_logged'] = true;
				$_SESSION['quickbrowse_user'] = $user;
				return true;
			}
		}
		$this->ERROR = 'Wrong credentials, make sure you have created an account at <a href="' . $this->REGISTER_URL . '">Sign-up</a>.';
		return false;
	}

	function logout(){
		if($this->is_logged_in()){
			$_SESSION['quickbrowse_user_logged'] = false;
			$_SESSION['quickbrowse_user'] = null;
			return true;
		}
		return false;
	}

	function is_logged_in(){
		if(isset($_SESSION['quickbrowse_user_logged'])){
			if($_SESSION['quickbrowse_user_logged'] == true){
				return true;
			}
		}
		return false;
	}
}
?>
