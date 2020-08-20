<?php

class Debug{
	
	//Setup Properties
	public $ERR;
	public $LOG;
	
	//Setup Objects
	private $QB;
	
	//Setup Constructor
	function __construct($QUICKBROWSE){
		$this->QB = $QUICKBROWSE;
		
		$report = $this->QB->ERROR_NOTICE ? E_ALL : E_ALL & ~E_NOTICE;
		$report = !$this->QB->IS_LIVE ? $report : false;
		ini_set('error_reporting', $report);
		
		//This disables default error display on top of the page.
		ini_set('display_errors', false);
		
		set_error_handler(array($this, 'call_error'));
		register_shutdown_function(array($this, 'call_shutdown'));
		
		return true;
	}
	
	function call_shutdown($isCalled = false){
		$last = error_get_last();
		if(!$isCalled){
			$this->ERR = $this->ERR . "[SERVER][" . $this->return_error_type($last['type']) . "]" . $last['message'] . ' on line: ' . $last['line'] . ' @ ' . $last['file'] . ".\n";
		}
		if( isset($last) && $last['type'] == 64 | 16 | 4 | 1 | 256 | 2048 ){
			$isCalled 	= $isCalled ? "DEBUG" : "SERVER";
			$REQUEST 	= "\nSHUTDOWN CALLER: " . $isCalled . ";"
						. "\nERROR TYPE: " . $this->return_error_type($last['type']) . ";"
						. "\nMEMORY / PEAK: " . memory_get_usage() . " (" . $this->QB->return_size(memory_get_usage()) . ") / " . memory_get_peak_usage() . " (" . $this->QB->return_size(memory_get_peak_usage()) . ");"
						. "\nMEMORY LIMIT: " . $this->QB->return_bytes(ini_get('memory_limit')) . " (" . ini_get('memory_limit') . ");";
			$REQUEST 	= str_replace("\n", '<br>', $REQUEST);
			$ERROR	 	= str_replace("\n", '<br>', $this->ERR);
			$LOG		= str_replace("\n", '<br>', $this->LOG);
			if(!$this->QB->IS_LIVE){
				echo( 
				"<!DOCTYPE html>"
				. "<html>"
					. "<head>"
						. "<link rel=\"stylesheet\" href=\"http://quickbrow.se/QuickBrowse/assets/css/lib/bootstrap/bootstrap.min.css\">"
						. "<link rel=\"stylesheet\" href=\"http://quickbrow.se/QuickBrowse/assets/css/utility.css\">"
						. "<link rel=\"stylesheet\" href=\"http://quickbrow.se/QuickBrowse/assets/css/responsive.css\">"
					. "</head>"
					. "<body>"
						. "<div class=\"container-fluid bg-gradient-purple\" style=\"margin: 0; min-height: 100vh;\">"
							. "<div class=\"row\">"
								. "<div class=\"col-12\" style=\"padding: 30px 3em;\">"
									. "<h3>QuickBrowse " . $this->QB->VERSION . "</h3>"
									. "<p>" . $REQUEST . "</p>"
								. "</div>"
							. "</div>"
							. "<div class=\"row\">"
								. "<div class=\"col-12 col-lg-6\" style=\"padding: 30px 3em;\">"
									. "<h3>ERRORS:</h3>"
									. "<p>" . $ERROR . "</p>"
								. "</div>"
								. "<div class=\"col-12 col-lg-6\" style=\"padding: 30px 3em;\">"
									. "<div style=\"height: 450px; overflow: scroll;\">"
										. "<h3>LOG:</h3>"
										. "<p>" . $LOG . "</p>"
									. "</div>"
								. "</div>"
							. "</div>"
						. "</div>"
						. "<script src=\"http://quickbrow.se/QuickBrowse/assets/js/lib/jquery/jquery-slim.min.js\"></script>"
						. "<script src=\"http://quickbrow.se/QuickBrowse/assets/js/lib/bootstrap/bootstrap.js\"></script>"
					. "</body>"
				. "</html>"
				);
				
			}else{
				$message = "[FATAL ERROR]\n\nUSER MESSAGE: Please report what you did to crash the website to this domain's admin.\n\nADMIN MESSAGE: QuickBrowse recorded a fatal error, this is send to your account on our website if you have live error recording enabled.";
				$this->log($message);
				die($message);
			}
		}
	}
	
	function obj_error($object){
		if(empty($object->ERROR)) return false;
		$this->error(get_class($object), $object->ERROR);
		return true;
	}
	
	function log($log){
		$this->LOG = $this->LOG . "[LOG] " . $log . ".\n";
		return true;
	}
	
	function error($caller, $error, $type = E_USER_ERROR){
		trigger_error("[" . strtoupper($caller) . "] " . $error . ".", $type);
		return true;
	}
	
	private function call_error($err_code, $err_str, $err_file, $err_line){
		$this->ERR = $this->ERR . "[" . $this->return_error_type($err_code) . "]" . $err_str . ' on line: ' . $err_line . ' @ ' . $err_file . ".\n";
		if($this->QB->REPORT){
			if($err_code == 64 | 16 | 4 | 1 | 256 | 2048){
				$this->log("[" . $this->return_error_type($err_code) . "] Shutdown was called for: " . $err_str . " -> You can try and catch to handle it.");
				$this->call_shutdown(true);
			}else{
				$this->log("[" . $this->return_error_type($err_code) . "] Exception was thrown for: " . $err_str . " -> You can try and catch to handle it.");
				throw new ErrorException($err_str, null, $err_code, $err_file, $err_line);
			}
		}else{
			$this->log("[" . $this->return_error_type($err_code) . "] Exception was thrown for: " . $err_str . " -> You can try and catch to handle it.");
			throw new ErrorException($err_str, null, $err_code, $err_file, $err_line);
		}
	}
	
	private function return_error_type($code){
		switch($code){
			case 1:
				return "FATAL";
			break;
			
			case 2:
				return "WARNING";
			break;
			
			case 4:
				return "PARSE";
			break;
			
			case 8:
				return "NOTICE";
			break;
			
			case 16:
				return "CORE FATAL";
			break;
			
			case 32:
				return "CORE WARNING";
			break;
			
			case 64:
				return "COMPILE FATAL";
			break;
			
			case 128:
				return "COMPILE WARNING";
			break;
			
			case 256:
				return "USER FATAL";
			break;
			
			case 512:
				return "USER WARNING";
			break;
			
			case 1024:
				return "USER NOTICE";
			break;
			
			case 2048:
				return "STRICT";
			break;
			
			default:
				return "UNKNOWN:" . $code;
			break;
		}
		return false;
	}
	
}
	
?>
