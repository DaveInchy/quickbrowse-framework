<?php

class CRUD{
	
	public $ERROR = '';
	public $INFO = '';
	
	private $DATABASE;
	
	function __construct($DATABASE){
		try{
			$this->INFO = $this->INFO = "\n Setting database Object to this->DATABASE.";
			$this->DATABASE = $DATABASE;
		}catch(\Exception $e){
			$this->ERROR = $this->ERROR . "[__CRUD]Caught Exception: " . $e->getMessage() . "at" . __FILE__ . " on line " . __LINE__ . ", backtrace: " . __CLASS__ . "->" . __FUNCTION__;
			return false;
		}
		return true;
	}
	
	function data_create($ARRAY, $TABLE){
		
		$DATABASE = $this->DATABASE;
		
		$id = $DATABASE->data_create($this, $TABLE);
		if(!$id){
			$this->ERROR = $this->ERROR . '\n Failed to execute $DATABASE->data_create() function and get $id.';
			return false;
		}
		
		if(!$DATABASE->data_insert($ARRAY, $id, $TABLE)){
			$this->ERROR = $this->ERROR . '\n Failed to execute $this->data_create() function.';
			$this->ERROR = $this->ERROR . "\n " . $DATABASE->ERROR;
			return false;
		}
		return $id;

	}
	
	function data_read($TABLE, $ARGS){
		
		$DATABASE = $this->DATABASE;
		
		if(!isset($ARGS)){
			$ARGS['TYPE'] = 'DATA_NEWEST';
		}	
		
		$data = $DATABASE->data_fetch($TABLE, $ARGS);
		if(!$data){
			$this->ERROR = $this->ERROR . ".\n " . $DATABASE->ERROR;
		}else{
			return $data;
		}
		return false;
		
	}
	
	function data_update($ARRAY, $TABLE, $ID){
		
		$DATABASE = $this->DATABASE;
		
		if(!$DATABASE->data_insert($ARRAY, $ID, $TABLE)){
			$this->ERROR = $this->ERROR . '\n Failed to execute data_update() function.';
			$this->ERROR = $this->ERROR . ".\n " . $DATABASE->ERROR;
			return false;
		}
		return true;
		
	}
	
	function data_delete($TABLE, $ID){
		
		$DATABASE = $this->DATABASE;
		
		if(!$DATABASE->data_delete($ID, $TABLE)){
			$this->ERROR = $this->ERROR . '\n Failed to execute data_delete() function.';
			return false;
		}
		return true;
		
	}
	
}
	
?>