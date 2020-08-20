<?php
class QuickBrowseSettings{
	
	//QuickBrowse Settings.
	public $VERSION = "development-3.4.9";
	public $PREFIX = "dev:07-04-2020";
	public $REPORT = true;
	
	//License Argreement
	public $EULA = "accepted";
	
	//Website Settings.
	public $DOMAIN = "https://quickbrow.se";
	public $KEY = "PRIVATE_9TVCZ4L1D7U4_H3TKDSH00";
	public $TEMPLATE_DIR = "example";
	public $USE_COMPRESSION = true;
	public $IS_LIVE = false;
	
	//Assets Settings.
	public $LOAD_ASSETS = true;
	public $USE_CDN = false;
	public $USE_DOMAIN = false;
	
	//Main Database Settings.
	public $LOAD_DB = true;
	public $USE_PDO = false;
	public $DB_TYPE = "mysql";
	public $DB_HOST = "127.0.0.1";
	public $DB_NAME = "danny_quickbrowse_dev";
	public $DB_USER = "danny_qb";
	public $DB_PASS = "lBMJoB0kBN";
	
}
?>
