<?php
try{
	
	//get apache headers for stuff like host
	$headers = apache_request_headers();
	
	//add instances needed for installer
	$QB->add_instance('THEME', "BOOTSWATCH-SKETCHY", false);
	$QB->add_instance('MESSAGE', "", false);
	
	//every step as part of the installer in an array
	$parts = Array(
	
		//QuickBrowse Setup START
		'start-qb-setup',
		'set-qb-settings',
		
		//@TODO Check if LOAD_DB is true, then
		'set-db-connection',
		'validate-db-connection',
		
		'finish-qb-setup',
		//QuickBrowse Setup END
		
		
		//Template Setup START
		
		//Confirm template
		'start-tp-setup',
		
		//Template Configuration
		'set-tp-settings',
		'save-tp-settings',
		
		//Database
		//'prepare-database',
		//'install-database',
		
		//Packages
		//@TODO 1. get list of templates install.json ["REQUIRED"]["PACKAGES"] <package>'s
		//@TODO 2. save current directory to $currentdir with getcwd()
		//@TODO 2. change current directory to $QB->ROOT . "/bin/composer/" with chdir()
		//@TODO 3. Use "php composer.phar require <package> && echo $?" to install foreach required packages
		//@TODO 3. Check if $output == 0, this tests if execution exitcode was 0
		//@TODO 4. Use "php composer.phar install && echo $?" to install dependencies of required packages
		//@TODO 4. Check if $output == 0, this tests if execution exitcode was 0
		//@TODO 5. change current directory to $currentdir with chdir()
		//useful: https://www.php.net/manual/en/function.chdir.php
		//useful: https://www.php.net/manual/en/function.getcwd.php
		//useful: https://www.php.net/manual/en/function.shell-exec.php
		//@NOTICE 6. PDO Functionality is somewhat wonky, try using mysql if you can.
		
		//Required Packages --> Currently de-activated since it's not finished
		//'select-packages',
		//'install-packages',
		//'result-packages',
		
		//Finish setup and display setup results
		'finish-tp-setup',
		//Template Setup END
		
	);
	
	//check for step get-variable, and if it exists set $step
	$step = isset($_GET['step']) ? $_GET['step'] : 'start-qb-setup';
	$debug = isset($_GET['debug']) ? true : false;
	
	//Add QuickInstall to Quickbrowse
	$QB->add_instance('INSTALLER', new QuickInstall($QB, (array_search($step, $parts) >= array_search("start-tp-setup", $parts) ? true : false) ), true);
	
	//check for step-finishing button clicks
	if(isset($_POST['save_settings'])){
		unset($_POST['save_settings']);
		$process = true;
		
		if($step == 'start-qb-setup'){
		
			$DATA['eula'] = "accepted";
			$process = $QB->INSTALLER->set_post_data($DATA, "license-agreement");
			
		}elseif($step == 'validate-db-connection'){
			
			$process = $QB->INSTALLER->test_connection();
			$DATA['connection'] = !$process ? 'FAILED': 'CONNECTED';
			$DATA['response'] = !$process ? $QB->INSTALLER->last_error(): "Connection established.";
			$QB->MESSAGE = !$process ? "Connection: " . $DATA['connection'] . ".\nResponse: " . $DATA['response'] . " <a href=\"./?step=set-db-connection\" class=\"btn btn-sm btn-danger\">Change</a>": $QB->MESSAGE;
			$QB->INSTALLER->set_post_data($DATA, $step);
			
		}elseif($step == 'finish-qb-setup'){
			$process = $QB->INSTALLER->decoded_modified_config();
			$process = $QB->INSTALLER->save_decoded_file($process, $QB->ROOT . "/", 'config');
			if($process){
				header("Location: /");
				exit();
			}else{
				$QB->MESSAGE = error_get_last()['message'];
				$QB->DEBUG->error(__FILE__, error_get_last()['message']);
			}
			
		}elseif($step == 'save-tp-settings'){
			
			$process = $QB->INSTALLER->decoded_settings($QB->INSTALLER->encoded_settings($QB->INSTALLER->get_post_data()['set-tp-settings']));
			$process = $QB->INSTALLER->save_decoded_file($process, $QB->TEMPLATE_ROOT . '/', 'config');
			$process == false ? $process = false && $QB->MESSAGE = error_get_last()['message'] : $process = true;
			
		}elseif($step == 'prepare-database'){
		
			//@TODO Prepare and import required .sql for install.
			$process = $QB->INSTALLER->prepare_database($QB->INSTALLER->return_template_json_data($QB->TEMPLATE_ROOT . '/install.json')['REQUIRED']['DATABASE']['FILE']);
			if(!$process){
				$QB->MESSAGE = error_get_last()['message'];
				
			}
		}elseif($step == 'install-database'){
		
			//@TODO Install required .sql file for database structure.
			$process = $QB->INSTALLER->install_database($QB->INSTALLER->return_template_json_data($QB->TEMPLATE_ROOT . '/install.json')['REQUIRED']['DATABASE']['FILE']);
			if(!$process){
				$QB->MESSAGE = error_get_last()['message'];
				
			}
		}elseif($step == 'install-packages'){
		
			$process = $QB->INSTALLER->install_packages($QB->INSTALLER->return_template_json_data($QB->TEMPLATE_ROOT . '/install.json')['REQUIRED']['PACKAGES']);
			if(!$process){
				$QB->MESSAGE = error_get_last()['message'];
				
			}
		}else{
			$QB->INSTALLER->set_post_data($_POST, $step);
		}
		
		//prepare next step based on current step and $parts array
	    $getNext = false;
	    $nextStep = 'start-qb-setup';
	    foreach($parts as $part){
		    if($getNext){
			    $nextStep = $part;
			    $getNext = false;
		    }
		    if($step == $part){
			    $getNext = true;
		    }
		}
		
		//Get result of steps, true is go to next, false is stay on step
		$result = !$process ? false: true;
		if($result){
			$url = $debug ? "?step=" . $nextStep . "&debug": "?step=" . $nextStep . "";
			header("Location: " . $url);
			exit();
		}
		
	}

}catch(\Exception $e){
	$QB->DEBUG->error(__FILE__, $e->getMessage(), E_USER_ERROR);
}
?>
