<?php

class SecureShellHandler{
	
	private $QB;
	
    private $SSH_HOST;
    private $SSH_PORT;
	private $SSH_USER;
	
	private $AUTH_PASSCODE;
    private $AUTH_PUBLIC;
    private $AUTH_PRIVATE;
	private $FOOTPRINT;
	
    private $CONN;
	
	function __construct($quickbrowse, [$use_settings = false, $user = 'root', $passcode = null, $port = 22, $host = 'localhost' [$public_file = __DIR__ . '../ssh-hz2kdf/id_rsa.pub', $private_file = __DIR__ . '../ssh-hz2kdf/id_rsa', $footprint = 'SHA256:gdwWd5+mXXazXihMij7nXNB49fSc6HS0gMicc5sJ0Zo']]){
		try{
			$this->QB = $quickbrowse;
			if(!isset($this->QB)){
				throw new Exception('Could not constructing SecureShellHandler (SSH), Parent wasn\'t set');
				return false;
			}
			if($use_settings){
				$this->SSH_HOST = $this->QB->SSH_HOST;
				$this->SSH_PORT = $this->QB->SSH_PORT;
				$this->SSH_USER = $this->QB->SSH_USER;
				$this->AUTH_PASSCODE = $this->QB->AUTH_PASSCODE;
				$this->AUTH_PUBLIC = $this->QB->AUTH_PUBLIC;
				$this->AUTH_PRIVATE = $this->QB->AUTH_PRIVATE;
				$this->FOOTPRINT = $this->QB->FOOTPRINT;
			}else{
				$this->SSH_HOST = $host;
				$this->SSH_PORT = $port;
				$this->SSH_USER = $user;
				$this->AUTH_PASSCODE = $passcode;
				$this->AUTH_PUBLIC = $public_file;
				$this->AUTH_PRIVATE = $private_file;
				$this->FOOTPRINT = $footprint;
			}
			return true;
		}catch(\Exception $e){
			$this->QB->set_error(__METHOD__, "[" . __FILE__ . ":" . __LINE__ . "] Caught Exception: " . $e->getMessage());
			return false;
		}
		return true;
	}
   
    function connect() {
		try{
			if (!($this->CONN = ssh2_connect($this->SSH_HOST, $this->SSH_PORT))) {
				throw new Exception('Cannot connect to server');
			}
			$fingerprint = ssh2_fingerprint($this->CONN, SSH2_FINGERPRINT_MD5 | SSH2_FINGERPRINT_HEX);
			if (strcmp($this->FOOTPRINT, $fingerprint) !== 0) {
				throw new Exception('Verifying Server Unsuccessful!');
			}
			if (!ssh2_auth_pubkey_file($this->CONN, $this->SSH_USER, $this->AUTH_PUBLIC, $this->AUTH_PRIVATE, $this->AUTH_PASSCODE)) {
				throw new Exception('Autentication rejected by server');
			}
		}catch(\Exception $e){
			$this->QB->set_error(__METHOD__, "[" . __FILE__ . ":" . __LINE__ . "] Caught Exception: " . $e->getMessage());
			return false;
		}
		return true;
    }
	
    function send($command){
		try{
			
			//@TODO Test if standard output will fix commands not being fired
			$commmand = '-ls; ' . $command;
			
			if (!($stream = ssh2_exec($this->CONN, $command))) {
				throw new Exception('SSH Command: ' . $command . '; wasn\'t executed');
			}
			
			stream_set_blocking($stream, true);
			$data = "";
			while ($buf = fread($stream, 4096)) {
				$data .= $buf;
			}
			
			fclose($stream);
		}catch(\Exception $e){
			$this->QB->set_error(__METHOD__, "[" . __FILE__ . ":" . __LINE__ . "] Caught Exception: " . $e->getMessage());
			return false;
		}
		return $data || true;
    }
	
    function disconnect($reason = 'the method was executed'){
		$this->QB->set_info(__METHOD__, 'SSH Connection is being closed because ' . $reason);
        $this->send('exit;');
        unset($this->CONN);
		if($this->CONN !== null){
			$this->QB->set_error(__METHOD__, 'SSH Connection wasn\'t close, Connection still persists');
			return false;
		}
		$this->QB->set_info(__METHOD__, 'SSH Connection closed!');
		return true;
    }
	
    function __destruct(){
        if(!$this->disconnect('the object was de-constructed by a third-party instance.')) $this->QB->set_error(__METHOD__, 'Failed to destruct Object.') return false;
		return true;
    }
}

?> 