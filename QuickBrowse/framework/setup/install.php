<!DOCTYPE html>
<html lang="en">
	<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    
    <!-- Bootstrap and Theme -->
    <link rel="stylesheet" href="https://quickbrow.se/QuickBrowse/assets/css/lib/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="https://quickbrow.se/QuickBrowse/assets/bootswatch/lux.css">
    
    <!-- Animate.css Animations -->
    <link rel="stylesheet" href="https://quickbrow.se/QuickBrowse/assets/css/lib/animate/animate.css">
    
    <!-- QuickBrowse CSS -->
    <link rel="stylesheet" href="https://quickbrow.se/QuickBrowse/assets/css/responsive.css">
    <link rel="stylesheet" href="https://quickbrow.se/QuickBrowse/assets/css/utility.css">
	
	<style>
		input[type="text"]{
			border-bottom: 2px solid #333;
		}
	</style>
	
    <title><?=(!$QB->INSTALLER->IS_TP ? "QuickBrowse " . $QB->VERSION : $QB->TEMPLATE_DIR);?> - Install and Setup</title>
  </head>
  <body class="p-0 m-0">
	
	<div  style="z-index: -999; background-size: cover; background-image: url('https://quickbrow.se/QuickBrowse/assets/img/background/mountains-purple.svg');" class="height-100 width-100 fixed-top">
	</div>
  
	<div class="container py-5">
		<div class="jumbotron row mx-auto bg-sharp-gradient-dark p-5 my-3">
			<div class="col-md-5 center-2d-old text-center height-20">
				<div>
					<h1 class="text-light display-1 mb-4" style="font-size: 40px;"><?=(!$QB->INSTALLER->IS_TP ? "QUICKBROWSE": strtoupper(isset($QB->TEMPLATE_DIR) ? $QB->TEMPLATE_DIR : "TEMPLATE"));?></h1>
					<h4 class="m-0 text-light"><?=(!$QB->INSTALLER->IS_TP ? "QuickBrowse " . $QB->VERSION : $QB->TEMPLATE_DIR);?></h4>
					<p class="lead m-0">Setup &amp; Install <?=(!$QB->INSTALLER->IS_TP ? "QuickBrowse" : "Template");?></p>
				</div>
			</div>
			<div class="col-md-2 center-2d-old height-20">
				<div>
					<img src="https://quickbrow.se/QuickBrowse/assets/img/logo/logo.png" width="150px"/>
				</div>
			</div>
			<div class="col-md-5 center-2d-old height-20">
				<div class="text-center">
					<img width="220px;" src="https://quickbrow.se/QuickBrowse/assets/img/logo/logo-doonline-sm.png" alt="Quickbrowse Logo" />
					<img width="180px;" src="https://quickbrow.se/QuickBrowse/assets/img/logo/logo-webbouwerz-sm.png" alt="Webbouwerz Logo" />
				</div>
			</div>
		</div>
		<?php
	    if($debug){
		?>
		<pre class="row mx-auto p-5 my-3"><?php if(isset($_SESSION['quickbrowse_installer'])){ print_r($_SESSION['quickbrowse_installer']); } if(isset($QB->TEMPLATE_ROOT))?><?php print_r( $QB->INSTALLER->return_template_json_data($this->TEMPLATE_ROOT . '/install.json') ); ?><?php ; ?></pre>
		<?php
	    }
		?>
		<div class="jumbotron mx-auto p-5 my-3 text-dark" style="background-image: url('https://quickbrow.se/QuickBrowse/assets/img/pattern/figures.png'); background-repeat: repeat;">
			<span><h3 class="text-danger"><?=$QB->MESSAGE;?></h3><a href="./guide?step=restart" style="float: right;" class="btn btn-sm btn-primary mb-4">Restart</a></span>
		    <?php
		
			if($step == 'start-qb-setup'){ ?>
			
			<h3>Agreement: use terms and licensing for QuickBrowse</h3>
			<span><button onclick="showMore('read-eula', this)" class="btn my-3 mr-3 btn-outline-primary bg-sharp-gradient-light">Open</button> Read Agreement</span>
			<form id="read-eula" style="display: none; padding-bottom: 100px" method="POST">
				<hr>
				<h4>QuickBrowse MIT License</h4>
				<pre class="col-lg-12 mx-auto p-3 my-3 text-wrap text-justify"><?=str_replace("\n", "<br>", $QB->code_encode(file_exists($QB->ROOT . '/LICENSE') ? file_get_contents($QB->ROOT . '/LICENSE') : "No file found named LICENSE."));?></pre>
				<h4>QuickBrowse end user license agreement (EULA):</h4>
				<pre class="col-lg-12 mx-auto p-3 my-3 text-wrap text-justify"><?=str_replace("\n", "<br>", $QB->code_encode(file_exists($QB->ROOT . '/EULA') ? file_get_contents($QB->ROOT . '/EULA') : "No file found named EULA."));?></pre>
				
				<p>Notice: By clicking "Agree" you confirm that you have read and accepted QuickBrowse's EULA and Terms of use.</p>
				
				<button id="agree" style="float: right;" class="btn btn-lg btn-success" name="save_settings" type="submit">Agree</button>
				<button id="deny" style="float: left;" class="btn btn-lg btn-danger">Deny</button>
			
			</form>
		    <?php }
		
			if($step == 'set-qb-settings'){ ?>
			<h3>Step 1: Prepare QuickBrowse configuration.</h3>
			<span><button onclick="showMore('settings-quickbrowse', this)" class="btn my-3 mr-3 btn-outline-primary bg-sharp-gradient-light">Open</button> QuickBrowse Settings</span>
			<form id="settings-quickbrowse" style="display: none;" method="POST">
				<hr>
				<h3>Website</h3>

				<!-- Text input-->
				<div class="form-group ml-0">
				  <label class="col-md-12 control-label" for="domain">Domain</label>
				  <div class="col-md-12">
				  <input value="https://<?=$headers['Host'];?>" id="domain" name="domain" type="text" placeholder="https://localhost" class="form-control input-md" required="">
				  <span class="help-block">Under which domain is QuickBrowse being installed?</span>
				  </div>
				</div>
				
				<!-- Text input-->
				<div class="form-group ml-0">
				  <label class="col-md-12 control-label" for="key">QuickBrowse product-key (Buy at https://quickbrow.se)</label>
				  <div class="col-md-12">
				  <input value="none" id="key" name="qb_key" type="text" placeholder="fe16:3089:6e31:7fa9:2c65:510d:c44e:d869" class="form-control input-md" required="">
				  <span class="help-block">Which product-key should be installed? (Set to "none" if you have not paid for QuickBrowse)</span>
				  </div>
				</div>

				<!-- Multiple Radios -->
				<div class="form-group">
				  <label class="col-md-12 control-label" for="compression">Compression</label>
				  <div class="col-md-12">
				  <div class="radio ml-4">
					<label for="compression-0">
					  <input type="radio" name="use_compression" id="compression-0" value="true" checked="checked">
					  true (+/- 85% Content Compressed)
					</label>
					</div>
				  <div class="radio ml-4">
					<label for="compression-1">
					  <input type="radio" name="use_compression" id="compression-1" value="false">
					  false (Default)
					</label>
					</div>
				  </div>
				</div>

				<!-- Multiple Radios -->
				<div class="form-group">
				  <label class="col-md-12 control-label" for="live_production">In Production</label>
				  <div class="col-md-12">
				  <div class="radio ml-4">
					<label for="live_production-0">
					  <input type="radio" name="is_live" id="live_production-0" value="true">
					  Live (When your website is functional and can go "Live" for your visitors)
					</label>
					</div>
				  <div class="radio ml-4">
					<label for="live_production-1">
					  <input type="radio" name="is_live" id="live_production-1" value="false" checked="checked">
					  Not Live (Only for error reporting during Development)
					</label>
					</div>
				  </div>
				</div>

				<!-- Select Basic -->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="template_dir">Choose a Template</label>
				  <div class="col-md-8">
					<select id="template_dir" name="template_dir" class="form-control">
						<?php
							foreach (glob($QB->ROOT . "/templates/*") as $template) {
								$template =  basename($template);
								?>
								<option value="<?=$template;?>"><?=$template;?></option>
								<?php
							}
						?>
						?>
					</select>
				  </div>
				</div>
				
				<hr>
				<h3>Assets.</h3>

				<!-- Multiple Radios (inline) -->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="load_assets">Load assets</label>
				  <div class="col-md-4">
					<label class="radio-inline ml-3" for="load_assets-0">
					  <input type="radio" name="load_assets" id="load_assets-0" value="true" checked="checked">
					  true
					</label>
					<label class="radio-inline ml-5" for="load_assets-1">
					  <input type="radio" name="load_assets" id="load_assets-1" value="false">
					  false
					</label>
				  </div>
				</div>

				<!-- Multiple Checkboxes -->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="checkboxes">Select way of content-delivery<br>(None = Live filepath to assets without domain or cdn link.)</label>
				  <div class="col-md-4">
				  <div class="checkbox ml-3">
					<label for="checkboxes-0">
					  <input type="checkbox" name="use_cdn" id="checkboxes-0" value="true" checked="checked">
					  use CDN
					</label>
					</div>
				  <div class="checkbox ml-3">
					<label for="checkboxes-1">
					  <input type="checkbox" name="use_domain" id="checkboxes-1" value="true">
					  use Domain
					</label>
					</div>
				  </div>
				</div>
				<button id="save_settings" class="btn btn-block btn-lg bg-sharp-gradient-purple" name="save_settings" type="submit">Save this and move on to Database Settings.</button>
			</form>
		    <?php }
		
			if($step == 'set-db-connection'){ ?>
			<h3>Step 2: Prepare database configuration.</h3>
			<span><button onclick="showMore('database-quickbrowse', this)" class="btn my-3 mr-3 btn-outline-primary bg-sharp-gradient-light">Open</button> Database Settings</span>
			<form id="database-quickbrowse" style="display: none;" method="POST">
				<hr>
				<!-- Multiple Radios (inline) -->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="load_database">Load database</label>
				  <div class="col-md-4">
					<label class="radio-inline ml-3" for="load_database-0">
					  <input type="radio" name="load_database" id="load_database-0" value="true" checked="checked">
					  true
					</label>
					<label class="radio-inline ml-5" for="load_database-1">
					  <input type="radio" name="load_database" id="load_database-1" value="false">
					  false
					</label>
				  </div>
				</div>
				
				<!-- Multiple Radios -->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="use_pdo">PDO</label>
				  <div class="col-md-4">
				  <div class="radio ml-3">
					<label for="use_pdo-0">
					  <input type="radio" name="use_pdo" id="use_pdo-0" value="false" disabled>
					  Use PDO
					</label>
					</div>
				  <div class="radio ml-3">
					<label for="use_pdo-1">
					  <input type="radio" name="use_pdo" id="use_pdo-1" value="true" checked>
					  Use MySQLi
					</label>
					</div>
				  </div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="db_type">Type</label>  
				  <div class="col-md-8">
				  <input id="db_type" name="db_type" type="text" placeholder="mysql / sqlite / pgsql" class="form-control input-md" required="">
				  <span class="help-block">Database types: https://www.php.net/manual/en/pdo.drivers.php</span>  
				  </div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="db_host">Host</label>  
				  <div class="col-md-8">
				  <input id="db_host" name="db_host" type="text" placeholder="127.0.0.1 / localhost" class="form-control input-md" required="">
				  <span class="help-block">Database host adress.</span>  
				  </div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="db_name">Name</label>  
				  <div class="col-md-8">
				  <input id="db_name" name="db_name" type="text" placeholder="database_example" class="form-control input-md" required="">
				  <span class="help-block">Database name you want to connect to, like db_users or db_finance.</span>  
				  </div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="db_user">User</label>  
				  <div class="col-md-8">
				  <input id="db_user" name="db_user" type="text" placeholder="root / admin" class="form-control input-md" required="">
				  <span class="help-block">Username you got to login with to your database.</span>  
				  </div>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="col-md-4 control-label" for="db_password">Password</label>  
				  <div class="col-md-8">
				  <input id="db_password" name="db_password" type="text" placeholder="S0M3TH1N9" class="form-control input-md" required="">
				  <span class="help-block">Password you got to login with to your database.</span>  
				  </div>
				</div>
				
				<button id="save_settings" class="btn btn-block btn-lg bg-sharp-gradient-purple" name="save_settings" type="submit">Save Database Configuration</button>
				
			</form>
		    <?php }
			
			if($step == 'validate-db-connection'){ ?>
			<h3>Step 3: Connect to Database.</h3>
			<span><button onclick="showMore('database-test', this)" class="btn my-3 mr-3 btn-outline-primary bg-sharp-gradient-light">Open</button> Test Connection</span>
			<form id="database-test" style="display: none;" method="POST">
				<hr>
				<h3>Try Connecting to the Database, Make sure the configuration has been done Correctly</h3>
				<p class="lead">Trying to connect to <?=$QB->INSTALLER->get_post_data()['set-db-connection']['db_host'];?> with <?=$QB->INSTALLER->get_post_data()['set-db-connection']['db_type'];?> as <?=$QB->INSTALLER->get_post_data()['set-db-connection']['db_user'];?>.</p>
			
				<button id="save_settings" class="mt-4 btn btn-block btn-lg bg-sharp-gradient-purple" name="save_settings" type="submit">Test connection and save configuration.</button>
			
			</form>
		    <?php }
			
			if($step == 'finish-qb-setup'){ ?>
			<h3>Step 4: Finish QuickBrowse setup.</h3>
			<span><button onclick="showMore('save-quickbrowse', this)" class="btn my-3 mr-3 btn-outline-primary bg-sharp-gradient-light">Open</button> Save QuickBrowse</span>
			<form id="save-quickbrowse" style="display: none;" method="POST">
				<hr>
				<h3>Save configuration and finish QuickBrowse setup, Go to Template setup</h3>
				<p class="lead">This is what the file will look like:</p>
				
				<pre><?php print_r($QB->INSTALLER->encoded_modified_config());?></pre>
				
				<button id="save_settings" class="mt-4 btn btn-block btn-lg bg-sharp-gradient-purple" name="save_settings" type="submit">Finish QuickBrowse Setup.</button>
				
			</form>
		    <?php }
			
			if($step == 'start-tp-setup'){ ?>
			<h3>Step 5: Start template setup.</h3>
			<span><button onclick="showMore('start-tp-setup', this)" class="btn my-3 mr-3 btn-outline-primary bg-sharp-gradient-light">Open</button> Confirm Template</span>
			<form id="start-tp-setup" style="display: none;" method="POST">
				<hr>
				<h3>Do you want to start installing: <?=$QB->TEMPLATE_DIR;?>?</h3>
				<p>Make sure you selected the right template, otherwise change it in QuickBrowse's configuration file.</p>
				<p class="lead">Current template directory: <?=$QB->TEMPLATE_ROOT;?></p>
				
				<button id="save_settings" class="mt-4 btn btn-block btn-lg bg-sharp-gradient-purple" name="save_settings" type="submit">Start Installation.</button>
			</form>
		    <?php }
			
			if($step == 'set-tp-settings'){ ?>
			<h3>Step 6: Configure Template Settings.</h3>
			<span><button onclick="showMore('create-templatesettings', this)" class="btn my-3 mr-3 btn-outline-primary bg-sharp-gradient-light">Open</button> Configure Template</span>
			<form id="create-templatesettings" style="display: none;" method="POST">
				<hr>
				<h3>Configure template settings.</h3>
				
				<!--<p class="lead">JSON Data:</p>
				<pre><?php print_r( $QB->INSTALLER->return_template_json_data($this->TEMPLATE_ROOT . '/install.json')['SETTINGS'] ); ?></pre>-->

				<?php
					foreach($QB->INSTALLER->return_template_json_data($this->TEMPLATE_ROOT . '/install.json')['SETTINGS'] as $setting => $value){
						?>
						
						<!-- Text input-->
						<div class="form-group ml-0">
						  <label class="col-md-12 control-label" for="<?=$setting;?>"><?=$setting;?></label>
						  <div class="col-md-12">
							<input value="<?=$value;?>" id="<?=$setting;?>" name="<?=$setting;?>" type="text" placeholder="<?=$value;?>" class="form-control input-md" required="" />
						  </div>
						</div>
						
						<?php
					}
				?>
				
				<!--<a id="add_settings" class="my-2 btn btn-md btn-success" onclick="addSetting(this)">Add</a>-->
				
				<button id="save_settings" class="mt-4 btn btn-block btn-lg bg-sharp-gradient-purple" name="save_settings" type="submit">Save Template Configuration.</button>
				
			</form>
		    <?php }
			
			if($step == 'save-tp-settings'){ ?>
			<h3>Step 7: Save Template configuration.</h3>
			<span><button onclick="showMore('save-quickbrowse', this)" class="btn my-3 mr-3 btn-outline-primary bg-sharp-gradient-light">Open</button> Save Template</span>
			<form id="save-quickbrowse" style="display: none;" method="POST">
				<hr>
				<h3>Save Template config.php settings to template</h3>
				<p class="lead">This is what the file is supposed to look like:</p>
				
				<pre><?php print_r( $QB->INSTALLER->encoded_settings( $QB->INSTALLER->get_post_data()['set-tp-settings']) );?></pre>
				
				<button id="save_settings" class="mt-4 btn btn-block btn-lg bg-sharp-gradient-purple" name="save_settings" type="submit">Save Settings to file.</button>
				
			</form>
		    <?php }
			
			if($step == 'prepare-database'){ ?>
			<h3>Step 8: Preparing Database Install.</h3>
			<span><button onclick="showMore('prepare-database', this)" class="btn my-3 mr-3 btn-outline-primary bg-sharp-gradient-light">Open</button> Prepare Database</span>
			<form id="prepare-database" style="display: none;" method="POST">
				<hr>
				<h3>Prepare Database Installation</h3>
				
				<button id="save_settings" class="mt-4 btn btn-block btn-lg bg-sharp-gradient-purple" name="save_settings" type="submit">Prepare Database Structure.</button>
				
			</form>
		    <?php }
		
			if($step == 'install-database'){ ?>
			<h3>Step 9: Installing required and prepared Database structure.</h3>
			<span><button onclick="showMore('install-database', this)" class="btn my-3 mr-3 btn-outline-primary bg-sharp-gradient-light">Open</button> Install Database</span>
			<form id="install-database" style="display: none;" method="POST">
				<hr>
				<h3>Template Database Structure Installer</h3>
				
				<button id="save_settings" class="mt-4 btn btn-block btn-lg bg-sharp-gradient-purple" name="save_settings" type="submit">Create Database Structure.</button>
				
			</form>
		    <?php }
			
			if($step == 'select-packages'){ ?>
			<h3>Step 10: Selecting Composer Packages.</h3>
			<span><button onclick="showMore('select-packages', this)" class="btn my-3 mr-3 btn-outline-primary bg-sharp-gradient-light">Open</button> Select Packages</span>
			<form id="select-packages" style="display: none;" method="POST">
				<hr>
				<h3>About composer packages and QuickBrowse's package manager:</h3>
				<p>
				Composer is a PHP project dependency manager, sometimes called a package manager. It can install and update PHP-based packages and function libraries for a specific project.<br>
				QuickBrowse makes use of Composer to install required packages for each of the templates created with QuickBrowse, It is wrapped in QuickBrowse's framework to handle all packages without requiring you to know any of Composer's commands and makes it an automated process.<br>
				<br>
				Please select the packages that are required for the <?=$QB->TEMPLATE_DIR;?> template to make it function as wished, We also give you options to install extra libraries of code because we might think these are essential for web-development.<br>
				Required packages are always installed since they're required for the template to function properly. Any other packages you think will be useful are installed if you select them by clicking the checkboxes for a specific package.<br>
				<br>
				<span class="font-weight-bold text-primary">You can find more packages at <a href="https://packagist.org">packagist.org</a> or other repositories that work with Composer.</span><br>
				To find out more about composer go to <a href="https://getcomposer.org">getcomposer.org</a>...<br>
				</br>
				An example of a package could be "phpmailer/phpmailer" or "mollie/mollie-api-php", You can add these by filling in the text-box below and clicking the "add" button.<br>
				You MUST make sure the packages you require to be installed are correct, we recommend packages from packagist.org, currently we are limited to the Packagist repository, but we will add as many repositories as needed in future updates of QuickBrowse.<br>
				<br>
				<span class="font-weight-bold text-primary">You can manage composer packages with QuickBrowse by going to <a href="<?=$QB->DOMAIN . '/setup/packages/manage?step=select-packages&show=installed&guide=short';?>"><?=$QB->DOMAIN . '/setup/packages/manage';?></a> if live mode is disabled in QuickBrowse's configuration file.</span><br>
				</p>
				
				<br>
				<hr id="section-search">
				<br>
				<h3>Manage and Search for excluded Composer Packages for <?=$QB->TEMPLATE_DIR;?></h3>
				
				<div class="form-group ml-0 row">
				    <!-- <label class="control-label" for="package-search">Add a PHP packages compatible with composer</label> -->
				    <div class="col-10 px-0">
				        <input id="search" type="text" placeholder="fontawesome" class="form-control input-md mb-0"></input>
				    </div>
				    <div class="col-2 pr-0">
				        <a id="query" class="mb-3 btn btn-md btn-block bg-dark font-weight-bold text-light" onclick="findPackage();">Search</a>
				    </div>
			    </div>
				
				<div gradient-start="#eee" bg-gradient-end="#ddd" id="loading-placeholder" class="height-50 center-2d-old bg-light bg-gradient-dynamic" style="display: none">
				    <div class ="text-center">
				        <img class="animated infinite heartBeat slower" alt="loading..." src="https://quickbrow.se/QuickBrowse/assets/img/animated/broken-circle.svg"/>
				    </div>
				</div>
				
				<br>
				<hr id="section-select">
				<br>
				<h3>Required and Recommended Composer Packages for <?=$QB->TEMPLATE_DIR;?></h3>
				
				<table class="table" style="max-width: 100%; background-size: cover; background-repeat no-repeat; background-color: #eee; background-image: url('https://quickbrow.se/QuickBrowse/assets/img/background/mountains-light.svg');">
                    <thead>
                        <tr class="bg-dark text-light">
                          <th scope="col" style="text-align:center; padding: 10px;">
                            <input id="check-all" class="mt-1" type="checkbox"></input>
                          </th>
                          <th scope="col" style="padding: 10px;">Package</th>
                          <th scope="col" style="padding: 10px;">About</th>
                          <th scope="col" style="padding: 10px;">Source</th>
                          <th scope="col" style="padding: 10px;">Version</th>
                        </tr>
                    </thead>
                    <tbody>
                
                    <?php
                    //Loop trough required packages and get info from packagist api
                    $required = $QB->INSTALLER->return_template_json_data($QB->TEMPLATE_ROOT . '/install.json')['REQUIRED']['PACKAGES'];
                    
                    $recommended = Array(
                        // Back-end
                        "phpmailer/phpmailer",
                        "mollie/mollie-api-php",
                        "synacksa/casperjs-php",
                        "uctoo/tencent-ai",
                        
                        // Front-end
                        "ckeditor/ckeditor",
                        "panix/wgt-colorpicker",
                        "sorich87/bootstrap-tour",
                    );
                    
                    //list required packages
                    foreach($required as $package => $version){
                        $response = file_get_contents('https://packagist.org/packages/' . $package . '.json');
                        $data = $response ? json_decode($response, true) : false;
                        ?>
                        <tr class="text-light bg-sharp-gradient-red p-0">
                          <th style="padding: 10px; max-width: 30px" class="text-center">
                            <input name="<?=$data['package']['name'];?>" class="mt-1" type="checkbox" checked="true"  value="<?=$version;?>"></input>
                          </th>
                          <td class="text-truncate" style="padding: 10px; max-width: 100px"><small><a class="text-light" style="color: #eee;" href="https://packagist.org/packages/<?=$data['package']['name'];?>"><?=$data['package']['name'];?><a/></small></td>
                          <td class="text-truncate" style="padding: 10px; max-width: 225px"><small><?=$data['package']['description'];?></small></td>
                          <td class="text-lowercase text-truncate" style="padding: 10px; max-width: 125px"><small><a class="text-light" style="color: #eee;" href="<?=$data['package']['repository'];?>"><?=$data['package']['repository'];?></small></td>
                          <td style="padding: 10px; max-width: 30px"><small><?=$version;?></small></td>
                        </tr>
                        <?php
                    }
                    
                    //list recommended packages
                    foreach($recommended as $package){
                        $response = file_get_contents('https://packagist.org/packages/' . $package . '.json');
                        $data = $response ? json_decode($response, true) : false;
                        
                        $dupe = false;
                        foreach($required as $name => $version){
                            if($name == $package)
                                $dupe = true; 
                        }
                        
                        $latest = "1.0.0.0";
                        foreach($data['package']['versions'] as $vers => $row){
                            $count = 0;
                            $filter = str_replace('dev', '', $vers, $count) ? true : false;
                            $count > 0 ? $latest = $filter : $latest = $vers;
                        }
                        
                        if(!$dupe){
                            ?>
                            <tr class="text-primary font-weight-bolder p-0">
                              <th style="padding: 10px; max-width: 30px" class="text-center">
                                <input name="<?=$data['package']['name'];?>" class="mt-1" type="checkbox" value="<?=$latest;?>"></input>
                              </th>
                              <td class="text-truncate" style="padding: 10px; max-width: 125px"><small><a class="text-dark" style="color: #333;" href="https://packagist.org/packages/<?=$data['package']['name'];?>"><?=$data['package']['name'];?><a/></small></td>
                              <td class="text-truncate" style="padding: 10px; max-width: 225px"><small><?=$data['package']['description'];?></small></td>
                              <td class="text-lowercase text-truncate" style="padding: 10px; max-width: 150px"><small><a class="text-dark" style="color: #333;" href="<?=$data['package']['repository'];?>"><?=$data['package']['repository'];?></small></td>
                              <td style="padding: 10px; max-width: 50px"><small><?=$latest;?></small></td>
                            </tr>
                            <?php
                        }
                    }
                    
                    ?>
                    </tbody>
                </table>
				
				<button id="save_settings" class="mt-4 btn btn-block btn-lg bg-sharp-gradient-purple" name="save_settings" type="submit">Confirm package selection for Composer.</button>
				
			</form>
		    <?php }
		    
			if($step == 'install-packages'){ ?>
			<h3>Step 11: Install selected Composer Packages.</h3>
			<span><button onclick="showMore('install-packages', this)" class="btn my-3 mr-3 btn-outline-primary bg-sharp-gradient-light">Open</button> Install Packages</span>
			<form id="install-packages" style="display: none;" method="POST">
				<hr>
				<h3>Install selected Composer Packages</h3>
				
				<?php
				    //display table with all selected packages for install
				    //display <pre> box with output of exec() command.
				    //let the packages install one by one when pressing a aubmit
				    //button and loop to this page for exec() processing
				    //with var url = location.href + '?install=!package' for each package.
				?>
				
				<button id="save_settings" class="mt-4 btn btn-block btn-lg bg-sharp-gradient-purple" name="save_settings" type="submit">Install packages from Packagist.</button>
				
			</form>
		    <?php }
			
			if($step == 'finish-tp-setup'){ ?>
			<h3>Finishing Setup.</h3>
			<span><button onclick="showMore('finish-tp-setup', this)" class="btn my-3 mr-3 btn-outline-primary bg-sharp-gradient-light">Open</button> Finish Setup</span>
			<form id="finish-tp-setup" style="display: none;" method="POST">
				<hr>
				<h3>You've finished installing <?=$QB->TEMPLATE_DIR;?> template</h3>
				
				<button id="save_settings" class="mt-4 btn btn-block btn-lg bg-sharp-gradient-purple" name="save_settings" type="submit">Finish QuickBrowse and Template setup.</button>
				
			</form>
		    <?php } ?>
		</div>
	</div>

    <!-- Optional JavaScript -->
    <script src="https://quickbrow.se/QuickBrowse/assets/js/lib/jquery/jquery-slim.min.js"></script>
	<script src="https://quickbrow.se/QuickBrowse/assets/js/lib/bootstrap/bootstrap.js"></script>
	
	<!-- Optional Javascript WOW.JS -->
    <script src="https://quickbrow.se/QuickBrowse/assets/js/lib/wowjs/wow.min.js"></script>
	
	<script>
	    // generate url's with parameters etc.
	    var newURL = (param) => {
            this.getURL = (param) => {
                
                // get element with input value
                var value = document.getElementById(param).value;
                console.log('[getURL] retrieved value for query parameter...');
                console.log('[getURL] returned: ' + value);
                
                // generate a new href
                var href = this.setURL(param, value);
                console.log('[getURL] tried reloading href without page reloading...');
                console.log('[getURL] returned: ' + href.toString());
	            
	            //return href
	            return href;
            };
            this.setURL = (param, value) => {
                	                
                // remove window.location.href query parameters 
                var regex = new RegExp("&"+param+"=[^ &]\\w*", "gi");
                console.log('[setURL] formatted regex for matches in href...');
                console.log('[setURL] returned: ' + regex);
                
                // get current href and replace matching regex with empty space
                var href = window.location.href;
                var url = href.replace(regex, function(x){
                    var res = x;
                    if(confirm('Are you sure you want to search something else and throw away previous searches? this will be removed: ' + x)){
                        res = "";
                    }else{ 
                        res = x;
                    }
                    return res;
                });
                console.log('[setURL] replacing matching parts from ' + href.toString() + ' with regex ' + regex + '...');
                console.log('[setURL] returned: ' + url);
                
                // try to push url with query parameters to the browser
                if(url != false | undefined | 0){
	                history.pushState(null, "QuickBrowse's pushState() operation", url + '&' + param + '=' + value);
	                console.log('[setURL] pushed new href "' + url + '&' + param + '=' + value + '" to browser...');
	                console.log('[setURL] returned: ' + url);
	            }else{
	                console.log('[setURL] could not push replaced href to browser because replacing went wrong...');
                    console.log('[setURL] returned: false | undefined | 0');
	            }
                
                // return href
                return url;
            };
            // return reloaded url with query parameter
            return this.getURL(param);
        };
        
		var findPackage = () => {
		
	        // run url generator
	        var href = newURL('search');
	        
	        // return false if new url isn't set
	        if(href == false | undefined | 0){
	            return false;
	        }
	        
	        // show the loader
	        document.getElementById('loading-placeholder').style = 'display: block; background-color: attr(bg-gradient-start) !important;';
	        
	        // call packagist api list with packages with ajax
	        
	        // create a table element inside #search-result with result from call to api
	        
	        // hide the loader
		    // document.getElementById('loading-placeholder').style = 'display: hidden;';
		    
		    // return boolean
		    return true;
		};
		
		var showMore = (id, btn) => {
		
			var container = document.getElementById(id);
			var save = document.getElementById("save_settings");
			
			if($(container).is(':hidden')){
			
				$(container).show();
				$(btn).text('Close');
				$(btn).removeClass("bg-sharp-gradient-light").addClass("bg-gradient-dark");
				$(save).show();
				
			}else{
			
				$(container).hide();
				$(btn).text('Open');
				$(btn).removeClass("bg-gradient-dark").addClass("bg-sharp-gradient-light");
				
			}
			
			return true;
		};
	</script>
	
  </body>
</html>
