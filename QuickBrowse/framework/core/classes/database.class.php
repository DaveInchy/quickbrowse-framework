<?php

class Database{
	
	public $ERROR;
	public $INFO;
	
	private $DB_SERVER;
	private $DB_USER;
	private $DB_PASSWORD;
	private $DB_NAME;
	private $DB_TYPE;
	private $USE_PDO;
	private $CONN;

	function __construct($db_user = "", $db_pass = "", $db_server = "", $db_name = "", $use_pdo = true, $db_type = "mysql"){
		
		try{
			if(isset($db_user) && !empty($db_user)
			&& isset($db_pass) && !empty($db_pass)
			&& isset($db_server) && !empty($db_server)
			&& isset($db_name) && !empty($db_name)
			){
				$this->INFO = $this->INFO . "Setting Database information.\n";
				$this->DB_USER = $db_user;
				$this->DB_PASSWORD = $db_pass;
				$this->DB_SERVER = $db_server;
				$this->DB_NAME = $db_name;
				$this->USE_PDO = $use_pdo;
				if($this->USE_PDO && isset($db_type)){
					$this->DB_TYPE = $db_type;
				}
			}else{
				$this->ERROR = $this->ERROR . "You need to give all four arguments in new Database(user, password, server, database)";
				return false;
			}
			$this->INFO = $this->INFO . "Saving connection to this Object.\n";
			$this->CONN = $this->connect();
			if(!$this->CONN){
				$this->ERROR = $this->ERROR . "Connection could not be saved, abort.\n";
				return false;
			}
		}catch(\Exception $e){
			$this->ERROR = $this->ERROR . "Constructor failed with error: " . $e->getMessage() . ".\n";
			return false;
		}
		return true;
	}
	
	function connect(){
		$con = null;
		if($this->USE_PDO){
			try{
				$con = new PDO($this->DB_TYPE . ":host=" . $this->DB_SERVER . ";dbname=" . $this->DB_NAME, $this->DB_USER, $this->DB_PASSWORD);
				if(!$con){
					$this->INFO = $this->INFO . "Make sure the database settings are correct.\n";
					$this->ERROR = $this->ERROR . "Connection failed with new PDO Object.\n";
					return false;
				}
			}catch(PDOException $e){
				$this->INFO = $this->INFO . "Make sure the database settings are correct.\n";
				$this->ERROR = $this->ERROR . "Connection failed ( " . $e->getMessage() . " ) \n";
				return false;
			}
		}else{
			$con = new mysqli($this->DB_SERVER, $this->DB_USER, $this->DB_PASSWORD, $this->DB_NAME);
			if($con->connect_errno){
				$this->INFO = $this->INFO . "Make sure the database settings are correct.\n";
				$this->ERROR = $this->ERROR . "Connection failed ( " . $con->connect_error . " ) \n";
				return false;
			}
		}
		$this->INFO = $this->INFO . "Connected to Database successfully";
		return $con;
	}
	
	function data_fetch($TABLE, $ARGS){
		
		$CONNECTION = $this->CONN;
		
		if(isset($TABLE)){
			if(isset($ARGS) && isset($ARGS["TYPE"])){
				switch($ARGS["TYPE"]){
					
					case "DATA_RANDOM":
						$this->INFO = $this->INFO . "Selecting all rows from " . $TABLE . " ordered by RAND().\n";
						$QUERY = "SELECT * FROM " . $TABLE . " ORDER BY RAND()";
					break;
					
					case "DATA_RANDOM_LIMIT":
						if(!isset($ARGS["LIMIT"]) || empty($ARGS["LIMIT"])){
							$this->ERROR = $this->ERROR . "Could not select " . $ARGS["LIMIT"] . " rows from " . $TABLE . ".\n";
							return false;
						}
						$this->INFO = $this->INFO . "Selecting " . $ARGS["LIMIT"] . " rows from " . $TABLE . " ordered by RAND().\n";
						$QUERY = "SELECT * FROM " . $TABLE . " ORDER BY RAND() LIMIT " . $ARGS["LIMIT"] . "";
					break;
					
					case "DATA_NEWEST":
						$this->INFO = $this->INFO . "Selecting all newest rows from " . $TABLE . ".\n";
						$QUERY = "SELECT * FROM " . $TABLE . " ORDER BY id DESC";
					break;
					
					case "DATA_OLDEST":
						$this->INFO = $this->INFO . "Selecting all oldest rows from " . $TABLE . ".\n";
						$QUERY = "SELECT * FROM " . $TABLE . " ORDER BY id ASC";
					break;
					
					case "DATA_NEWEST_LIMIT":
						if(!isset($ARGS["LIMIT"]) || empty($ARGS["LIMIT"])){
							$this->ERROR = $this->ERROR . "Could not select " . $ARGS["LIMIT"] . " newest rows from " . $TABLE . ".\n";
							return false;
						}
						$this->INFO = $this->INFO . "Selecting " . $ARGS["LIMIT"] . " newest rows from " . $TABLE . ".\n";
						$QUERY = "SELECT * FROM " . $TABLE . " ORDER BY id DESC LIMIT " . $ARGS["LIMIT"] . "";
					break;
					
					case "DATA_OLDEST_LIMIT":
						if(!isset($ARGS["LIMIT"]) || empty($ARGS["LIMIT"])){
							$this->ERROR = $this->ERROR . "Could not select " . $ARGS["LIMIT"] . " oldest rows from " . $TABLE . ".\n";
							return false;
						}
						$this->INFO = $this->INFO . "Selecting " . $ARGS["LIMIT"] . " oldest rows from " . $TABLE . ".\n";
						$QUERY = "SELECT * FROM " . $TABLE . " ORDER BY id ASC LIMIT " . $ARGS["LIMIT"] . "";
					break;
					
					case "DATA_NEWEST_OFFSET":
						if(!isset($ARGS["LIMIT"]) || empty($ARGS["LIMIT"]) || !isset($ARGS["OFFSET"]) || empty($ARGS["OFFSET"])){
							$this->ERROR = $this->ERROR . "Could not select newest offset rows (" . $ARGS["OFFSET"] . " to " . $ARGS["LIMIT"] . ") from " . $TABLE . ".\n";
							return false;
						}
						$this->INFO = $this->INFO . "Selecting newest offset rows (" . $ARGS["OFFSET"] . " to " . $ARGS["LIMIT"] . ") from " . $TABLE . ".\n";
						$QUERY = "SELECT * FROM " . $TABLE . " ORDER BY id DESC LIMIT " . $ARGS["LIMIT"] . " OFFSET " . $ARGS["OFFSET"] . "";
					break;
					
					case "DATA_OLDEST_OFFSET":
						if(!isset($ARGS["LIMIT"]) || empty($ARGS["LIMIT"]) || !isset($ARGS["OFFSET"]) || empty($ARGS["OFFSET"])){
							$this->ERROR = $this->ERROR . "Could not select oldest offset rows (" . $ARGS["OFFSET"] . " to " . $ARGS["LIMIT"] . ") from " . $TABLE . ".\n";
							return false;
						}
						$this->INFO = $this->INFO . "Selecting oldest offset rows (" . $ARGS["OFFSET"] . " to " . $ARGS["LIMIT"] . ") from " . $TABLE . ".\n";
						$QUERY = "SELECT * FROM " . $TABLE . " ORDER BY id ASC LIMIT " . $ARGS["LIMIT"] . " OFFSET " . $ARGS["OFFSET"] . "";
					break;
					
					default:
						$this->ERROR = $this->ERROR . "Theres no type argument (ARGS[\"TYPE\"]) called: " . $ARGS["TYPE"] . ".\n Make sure you are using capital letters.\n";
						return false;
					break;
					
				}
			}else{
				$this->ERROR = $this->ERROR . "Second argurment invalid in data_fetch(TABLE = \"posts\", ARGS = Array(\"TYPE\" => \"DATA_NEWEST\", \"LIMIT\" => \"0\", \"OFFSET\" => \"0\")).
				\n Make sure to use: " . '$ARGS["TYPE"] = "DATA_RANDOM"; for example.' . "Make sure you create an array with arguments like: " . '$ARGS["TYPE/LIMIT/OFFSET"] = value' . ".\n";
				$this->INFO = $this->INFO . "Selecting all rows from table: " . $TABLE . " newest first.\n";
				$QUERY = "SELECT * FROM " . $TABLE . " ORDER BY id DESC";
			}
			
			try{
				$this->INFO = $this->INFO . "Started query (" . $QUERY . ").\n";
				$RESULT = $CONNECTION->query($QUERY);
				if(!$RESULT){
					$this->INFO = $this->INFO . "This is not your fault, Contact us so we can repair this build.\n";
					$this->ERROR = $this->ERROR . "Failed doing query: (". $QUERY . ") --> MYSQL ERROR: " . mysqli_error($CONNECTION) . "";
					return false;
				}else{
					if($this->USE_PDO){
						while($DATA = $RESULT->fetchAll(PDO::FETCH_ASSOC)){
							$ARRAY[] = $DATA;
						}
						$this->INFO = "Finished query: (" . $QUERY . ").\n";
					}else{
						while($DATA = $RESULT->fetch_array()){
							$ARRAY[] = $DATA;
						}
						$this->INFO = "Finished query: (" . $QUERY . ").\n";
					}
					
					if(!isset($ARRAY) || empty($ARRAY)){
						$this->ERROR = $this->ERROR . "Result is empty, something still went wrong...\n";
						return false;
					}
					return $ARRAY;
				}
			}catch(Exception $e){
				$this->ERROR = $this->ERROR . "Caught exception: " . $e->getMessage() . ".\n";
				return false;
			}
		}else{
			$this->ERROR = $this->ERROR . "Missing first argument TABLE in data_fetch(TABLE = \"posts\", ARGS = Array(\"TYPE\" => \"DATA_NEWEST\", \"LIMIT\" => \"0\", \"OFFSET\" => \"0\")).\n";
			return false;
		}
		return false;
	}
	
	function data_create($CRUD, $TABLE){
		
		if(!isset($CRUD) || empty($CRUD)){
			$this->ERROR = $this->ERROR . "CRUD Object must be given to get latest row from.\n";
			return false;
		}
		
		$CONNECTION = $this->CONN;
		
		if($this->USE_PDO){
			$prep = $CONNECTION->prepare(
			"INSERT INTO :table() VALUES();"
			, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		}
		
		if(!$this->USE_PDO){
			$QUERY = "INSERT INTO " . $TABLE . "() VALUES()";
			if(!$CONNECTION->query($QUERY)){
				$this->ERROR = $this->ERROR . "Failed to query creation into: " . $TABLE . ".\n " . $CONNECTION->error . ".\n";
				return false;
			}
		}else{
			$result = $prep->execute(Array(":table" => $TABLE));
			if(!$result){
				$this->ERROR = $this->ERROR . "Failed to query creation into: " . $TABLE . ".\n PDO Failed.\n";
				return false;
			}
		}
		
		$ARGS["TYPE"] = "DATA_OLDEST";
		$DATA = $CRUD->data_read($TABLE, $ARGS);
		foreach($DATA as $ROW){
			$RID = $ROW["id"];
		}
		return $RID;
	}
	
	function data_insert($ARRAY, $ID, $TABLE){
		
		$CONNECTION = $this->CONN;
		
		if($this->USE_PDO){
			$prep = $CONNECTION->prepare(
			"UPDATE `:table` SET `:column` = ':input' WHERE `id` = :id;"
			, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
		}
		
		foreach($ARRAY as $KEY => $INPUT){
			
			$COLUMN = $KEY;
			
			if(!$this->USE_PDO){
				$QUERY = "UPDATE `" . $TABLE . "` SET `" . $COLUMN . "` = '" . mysqli_real_escape_string($CONNECTION, $INPUT) . "' WHERE `id` = '" . $ID . "'; ";
				if(!$CONNECTION->query($QUERY)){
					$this->ERROR = $this->ERROR . "Failed to query update for: " . $ID . ".\n " . $CONNECTION->error . ".\n";
					return false;
				}
			}else{
				$result = $prep->execute(Array(":table" => $TABLE, ":column" => $COLUMN, ":input" => $INPUT, ":id" => $ID));
				if(!$result){
					$this->ERROR = $this->ERROR . "Failed to query update for: " . $ID . ".\nPDO Failed.\n";
					return false;
				}
			}
			
			$this->INFO = $this->INFO . "Successfully updated " . $COLUMN . " for: " . $ID . ".\n";
		}
		return true;
	}
	
	//@TODO Create PDO execution. i probably forgot this and may be why quickbrow.se is suddently not able to delete posts
	function data_delete($ID, $TABLE){
		
		$CONNECTION = $this->CONN;
		
		$QUERY = "DELETE FROM " . $TABLE . " WHERE id = " . $ID;
		if(!$CONNECTION->query($QUERY)) {
			if(!$this->USE_PDO){
				$this->ERROR = $this->ERROR . "Failed to query delete for: " . $ID . ".\n " . $CONNECTION->error . ".\n";
			}
			return false;
		}
		$this->INFO = $this->INFO . "Successfully deleted id: " . $ID . " from table: " . $TABLE . ".\n";
		return true;
	}

}
	
?>
