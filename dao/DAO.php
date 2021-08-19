<?php

class DAO {

  // Properties
  	/*private static $dbHost = "mysql";
	private static $dbName = "hollylook";
	private static $dbUser = "root";
	private static $dbPass = "devine4life";*/  
	
	private static $dbHost = "ID309871_20192020.db.webhosting.be"; 
	private static $dbName = "ID309871_20192020"; 
	private static $dbUser = "ID309871_20192020";
	private static $dbPass = "!hollylookdb01";

	private static $sharedPDO;
	protected $pdo;

  // Constructor
	function __construct() {

		if(empty(self::$sharedPDO)) {
			self::$sharedPDO = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName, self::$dbUser, self::$dbPass);
			self::$sharedPDO->exec("SET CHARACTER SET utf8");
			self::$sharedPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			self::$sharedPDO->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
		}

		$this->pdo =& self::$sharedPDO;

	}

  // Methods

}

 ?>
