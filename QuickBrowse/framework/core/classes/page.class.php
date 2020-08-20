<?php

class Page{
	
	private $QB;
	
	public $ERROR = '';
	public $INFO = '';
	
	private $PAGE;
	private $CONTENT = null;
	private $SUBDIR = Array();
	private $LINKED = Array(
		'home' => 'index.php'
	);
	
	function __construct($QUICKBROWSE){
		$this->QB = $QUICKBROWSE;
		if(!$this->set_page()){
			return false;
		}
		return true;
	}
	
	function include($dir_page, $dir_head, $file_err = 'error.php'){
		$QB = $this->QB;
		$QUICKBROWSE = $this->QB;
		if(isset($dir_page) && isset($dir_head) && !empty($dir_page) && !empty($dir_head)){
			
			$page = $dir_page . $this->get_page();
			$head = $dir_head . $this->get_page();
			$error = $dir_page . $file_err;
			
			$this->INFO = $this->INFO . "\n Trying to load page: " . $page . ".";
			
			if(!file_exists($page)){
				include_once($error);
			}else{
				if(file_exists($head)){
					include_once($head);
				}
				include_once($page);
			}
			
		}else{
			return false;
		}
		return true;
	}
	
	function reload(){
		if(!$this->set_page()){
			return false;
		}
		return true;
	}
	
	function data(){
		if(isset($this->SUBDIR) && !empty($this->SUBDIR)){
			foreach($this->SUBDIR as $subdir){
				$url_depth = 0;
				$url_path = '';
				$url_dirs[$url_depth] = $subdir;
				foreach($url_dirs as $dir){
					$url_depth++;
					$url_dirs[$url_depth] = $dir;
					$url_path = $dir . '/' . $url_path;
				}
				$url_dirs[0] = $this->get_page(false);
			}
			$DATA = Array(
				'URL_DIRS' => array_reverse($url_dirs),
				'URL_PATH' => $url_path,
				'URL_DEPTH' => $url_depth
			);
			return $DATA;
		}
		return false;
	}
	
	function redirect($url = 'https://quickbrow.se'){
		header('Location: ' . $url);
		exit;
	}
	
	function get_page($isfile = true){
		return $isfile ? $this->PAGE : str_replace('.php', '', $this->PAGE);
	}
	
	function set_content($content){
		$this->CONTENT = isset($content) && !empty($content) ? $content : false;
		return $this->CONTENT;
	}
	
	function get_content(){
		return isset($this->CONTENT) && !empty($this->CONTENT) ? $this->CONTENT : false;
	}
	
	function get_links(){
		return isset($this->LINKED) && !empty($this->LINKED) ? $this->LINKED : false;
	}
	
	function get_link($value, $fromfile = true){
		if(isset($value) && !empty($value)){
			foreach($this->get_links() as $page => $file){
				$result = $isfile ? $file : $page;
				if($result == $value){
					return isset($result) && !empty($result) ? $result : false;
				}
			}
		}
		return false;
	}
	
	function set_link($page, $file){
		if(!isset($this->LINKED[$page]) || empty($this->LINKED[$page])){
			$this->LINKED[$page] = $file;
			return $this->LINKED[$page];
		}
		return false;
	}
	
	private function set_page(){
		$url = $_SERVER["REQUEST_URI"];
		
		$defs = 1;
		$dirs = substr_count($url, '/');
		if($dirs > $defs){
			$first = true;
			for($defs; $defs < $dirs; $defs++){
				$this->QB->ASSETS->ROOT_URL = !$this->QB->USE_DOMAIN ? './.' . $this->QB->ASSETS->ROOT_URL : $this->QB->ASSETS->ROOT_URL;
				$this->QB->FRONTEND_ROOT = !$this->QB->USE_DOMAIN ? './.' . $this->QB->FRONTEND_ROOT : $this->QB->FRONTEND_ROOT;
				if($first){
					$this->SUBDIR[$defs] = strtok($url, '/');
					$first = false;
				}else{
					$this->SUBDIR[$defs] = strtok('/');
				}
			}
			$this->QB->ASSETS->reload_assets();
		}
		
		$page = strtok( basename($url) , '?');
		if(isset($page) && !empty($page)){
			$this->PAGE = $page . '.php';
			if(isset($this->LINKED[$page]) && !empty($this->LINKED[$page])){
				$this->PAGE = $this->LINKED[$page];
			}
		}else{
			$this->PAGE = 'index.php';
		}
		return true;
	}
	
}
	
?>
