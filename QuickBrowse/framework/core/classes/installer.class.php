<?php
/**
*This class ...
*and ...
*
*@version 3.4.6
*/
class QuickInstall{
	
	//* @var null|object $QB */
	private $QB;
	//* @var string $'_FILE_NAME */
	private $CONFIG_FILE_NAME = "config.php";
	//* @var string $EMPTY_CONFIG_FILE */
	private $EMPTY_CONFIG_FILE = "/framework/core/sample-config.php";
	//* @var boolean $IS_TP */
	public $IS_TP;
	
	/**
	*This is the installers constructor ...
	*it will be run only when installer is active ...
	*
	*@param object $QUICKBROWSE
	*@param bool $IS_TEMPLATE
	*/
	public function __construct(object $QUICKBROWSE, bool $IS_TEMPLATE = false){
		$this->QB = $QUICKBROWSE;
		$this->IS_TP = $IS_TEMPLATE;
		return true;
	}
	
	/**
	*This method ...
	*and ...
	*
	*@param string $content
	*@param string $location
	*@param string $filename
	*@return true|false
	*/
	public function get_post_data(){
		return $_SESSION['quickbrowse_installer'];
	}
	
	/**
	*This method ...
	*and ...
	*
	*@param string $content
	*@param string $location
	*@param string $filename
	*@return true|false
	*/
	public function set_post_data($data, $index){
		if($_SESSION['quickbrowse_installer'][$index] = $data){
			return true;
		}
		return false;
	}
	
	public function install_packages(){
        return false;
    }
	
	private function package_command(string $type = "test", string $arg = "--version"){
	    $working_dir = getcwd();
	    chdir($this->QB->PACKAGES_ROOT);
	    switch($type){
	        case "require":
	            $cmd = 'bash shell/require.sh ' . $arg;
	        break;
	        
	        default:
	            $cmd = 'mkdir ' . $this->QB->PACKAGES_ROOT . '/' . md5(rand(0, 999));
	        break;
	    }
	    $c = 0;
	    do {
	        $this->QB->DEBUG->log("Executing shell script for handling packages: " . $c);
	        $c++;
	    } while ( $exec = shell_exec($cmd) );
	    $result = $exec != false || $exec != 0 ? true : false;
	    
	    chdir($working_dir);
	    echo $c;
	    
	    return $result;
	} 
	
    public function select_packages($packages){
        $result = !isset($packages) ? true : false;
        if($result){
            foreach( $packages as $package ){
                $result = $this->package_command('require', $package);
                $result ? $this->QB->DEBUG->log("Successfully required package '" . $package . "' via CLI shell.") : $this->QB->DEBUG->error(__METHOD__, "failed to require PHP package '" . $package . "' via CLI shell.". E_USER_ERROR);
            }
        }
        return $result;
    }
	
	/**
	*This method ...
	*and ...
	*
	*@param string $content
	*@param string $location
	*@param string $filename
	*@return true|false
	*/
	public function remove_post_data(){
		unset($_SESSION['quickbrowse_installer']);
		return true;
	}
	
	/**
	*This method ...
	*and ...
	*
	*@param string $content
	*@param string $location
	*@param string $filename
	*@return true|false
	*/
	public function test_connection(){
		$DB = new Database(
			$this->get_post_data()['set-db-connection']['db_user'],
			$this->get_post_data()['set-db-connection']['db_password'],
			$this->get_post_data()['set-db-connection']['db_host'],
			$this->get_post_data()['set-db-connection']['db_name'],
			$this->get_post_data()['set-db-connection']['use_pdo'],
			$this->get_post_data()['set-db-connection']['db_type']
		);
		
		$result = $this->QB->DEBUG->obj_error($DB) ? false: true;
		if(!$result){
			$this->ERROR = $DB->ERROR;
			return false; 
		}
		return true;
	}
	
	/**
	*This method ...
	*and ...
	*
	*@param string $content
	*@param string $location
	*@param string $filename
	*@return true|false
	*/
	public function save_decoded_file( string $content, string $location, string $filename = "saved"){
		if(!isset($content)) return false;
		try{
	        $loc = $location . '/' . $filename . '.php';
	        $file = file_put_contents($loc, $content);
	        if(!$file) die();
		}catch(\Exception $e){
			if(isset($this->QB->DEBUG))
				$this->QB->DEBUG->error(__METHOD__, "Something wen't wrong while saving QuickbrowseSettings config.php -> " . $e->getMessage()) && $this->QB->DEBUG->call_shutdown(true);
			return false;
		}
		return true;
	}
	
	public function return_template_json_data(string $file = "install.json"){
		try{
			
			if(!file_exists($file))
				return false;
			
			$file = file_get_contents($file);
			$data = json_decode($file, true);
			
			if(!is_array($data))
				return false;
		}catch(\Exception $e){
			if(isset($this->QB->DEBUG))
				$this->QB->DEBUG->error(__METHOD__, "Something wen't wrong while returning install.json array data -> " . $e->getMessage()) && $this->QB->DEBUG->call_shutdown(true);
			return false;
		}
		return $data;
	}
	
	public function decoded_settings(string $encoded_content){
		try{
			
			$decoded = $this->QB->code_decode($encoded_content);
		
		}catch(\Exception $e){
			if(isset($this->QB->DEBUG))
				$this->QB->DEBUG->error(__METHOD__, "Something wen't wrong while preparing new settings.php -> " . $e->getMessage()) && $this->QB->DEBUG->call_shutdown(true);
			return false;
		}
		return $decoded;
	}
	
	public function encoded_settings(array $array){
		try{
			
			if(!is_array($array)){
				if(isset($this->QB->DEBUG))
					$this->QB->DEBUG->error(__METHOD__, "Given argument is no array. returning false.", E_USER_ERROR);
				return false;
			}
			
			$content = "";
			
			foreach($array as $key => $val){
				$content = $content . "\n	public &#0036" . strtoupper($key) . ' = ' . (!is_bool($val) ? '"' . $val . '"' : $val) . ';' ;
			}
			
			$content = "&lt?php\nclass TemplateSettings{\n" . $content . "\n\n}\n?&gt";
		
		}catch(\Exception $e){
			if(isset($this->QB->DEBUG))
				$this->QB->DEBUG->error(__METHOD__, "Something wen't wrong while generating new config.php -> " . $e->getMessage()) && $this->QB->DEBUG->call_shutdown(true);
			return false;
		}
		return $content;
	}
	
	public function decoded_modified_config(){
		try{
			
			$file = $this->QB->ROOT . $this->EMPTY_CONFIG_FILE;
			
			if(!file_exists($file)){
				return false;
			}
			
			$content = $this->encoded_modified_config();
			
			$decoded = $this->QB->code_decode($content);
			
		}catch(\Exception $e){
			if(isset($this->QB->DEBUG))
				$this->QB->DEBUG->error(__METHOD__, "Something wen't wrong while preparing new settings.php -> " . $e->getMessage(), E_USER_ERROR);
			return false;
		}
		return $decoded;
	}
	
	public function encoded_modified_config(){
		try{
			
			$file = $this->QB->ROOT . $this->EMPTY_CONFIG_FILE;
			
			if(!file_exists($file)){
				return false;
			}
			
			$encoded = $this->QB->code_encode(file_get_contents($file));
			
			$content = str_replace('&#0036DOMAIN;', '&#0036DOMAIN = "' . $this->get_post_data()['set-qb-settings']['domain'] . '";', $encoded);
			$content = str_replace('&#0036KEY;', '&#0036KEY = "' . $this->get_post_data()['set-qb-settings']['qb_key'] . '";', $content);
			$content = str_replace('&#0036TEMPLATE_DIR;', '&#0036TEMPLATE_DIR = "' . $this->get_post_data()['set-qb-settings']['template_dir'] . '";', $content);
			$content = str_replace('&#0036USE_COMPRESSION;', '&#0036USE_COMPRESSION = ' . $this->get_post_data()['set-qb-settings']['use_compression'] . ';', $content);
			$content = str_replace('&#0036IS_LIVE;', '&#0036IS_LIVE = ' . $this->get_post_data()['set-qb-settings']['is_live'] . ';', $content);
			
			$content = str_replace('&#0036LOAD_ASSETS;', '&#0036LOAD_ASSETS = ' . $this->get_post_data()['set-qb-settings']['load_assets'] . ';', $content);
			$content = isset($this->get_post_data()['set-qb-settings']['use_cdn']) ? str_replace('&#0036USE_CDN;', '&#0036USE_CDN = ' . $this->get_post_data()['set-qb-settings']['use_cdn'] . ';', $content): str_replace('&#0036USE_CDN;', '&#0036USE_CDN = false;', $content);
			$content = isset($this->get_post_data()['set-qb-settings']['use_domain']) ? str_replace('&#0036USE_DOMAIN;', '&#0036USE_DOMAIN = ' . $this->get_post_data()['set-qb-settings']['use_domain'] . ';', $content): str_replace('&#0036USE_DOMAIN;', '&#0036USE_DOMAIN = false;', $content);
			
			$content = str_replace('&#0036LOAD_DB;', '&#0036LOAD_DB = ' . $this->get_post_data()['set-db-connection']['load_database'] . ';', $content);
			$content = str_replace('&#0036USE_PDO;', '&#0036USE_PDO = ' . $this->get_post_data()['set-db-connection']['use_pdo'] . ';', $content);
			$content = str_replace('&#0036DB_TYPE;', '&#0036DB_TYPE = "' . $this->get_post_data()['set-db-connection']['db_type'] . '";', $content);
			$content = str_replace('&#0036DB_HOST;', '&#0036DB_HOST = "' . $this->get_post_data()['set-db-connection']['db_host'] . '";', $content);
			$content = str_replace('&#0036DB_NAME;', '&#0036DB_NAME = "' . $this->get_post_data()['set-db-connection']['db_name'] . '";', $content);
			$content = str_replace('&#0036DB_USER;', '&#0036DB_USER = "' . $this->get_post_data()['set-db-connection']['db_user'] . '";', $content);
			$content = str_replace('&#0036DB_PASS;', '&#0036DB_PASS = "' . $this->get_post_data()['set-db-connection']['db_password'] . '";', $content);
			
			$content = str_replace('&#0036EULA;', '&#0036EULA = "' . $this->get_post_data()['license-agreement']['eula'] . '";', $content);
			
		}catch(\Exception $e){
			$this->QB->DEBUG->error(__METHOD__, "Something wen't wrong while preparing new settings.php -> " . $e->getMessage(), E_USER_ERROR);
			return false;
		}
		return $content;
	}
	
}
	
?>
