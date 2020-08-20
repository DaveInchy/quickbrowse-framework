<?php

//------------------------\\//------------------------------------------------\\//------------------------------------------------\\//------------------------\\
// Author: 		DoOnline
// Contact: 	contact@doonline.nl
// Version: 	1.1
// Class: 		Functions() (functions.class.php)
// Required: 	None
// Location:	Template
//------------------------\\//------------------------------------------------\\//------------------------------------------------\\//------------------------\\

class Functions{
	
	public $DEBUG = false;
	public $ERROR = '';
	public $INFO = '';
	
	function count_data($data){
		$c = 0;
		foreach($data as $item){
			$c++;
		}
		return $c;
	}
	
}