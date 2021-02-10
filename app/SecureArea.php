<?php 
	
	require_once __DIR__."/../helpers/ResponseHelper.php";

	class SecureArea
	{
		
		protected $pdo;
		protected $response_helper;

		function __construct()
		{
		
			$ini_array = parse_ini_file(__DIR__."/../envs/local.ini");

			$this->pdo = new PDO("mysql:host=" . $ini_array["server"] . ";dbname=" . $ini_array["database"], $ini_array["username"], $ini_array["password"]);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        	$this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);

        	$this->response_helper = new ResponseHelper();
		}
	}


?>