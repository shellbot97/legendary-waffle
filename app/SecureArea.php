<?php 
	
	require_once __DIR__."/../helpers/ResponseHelper.php";

	class SecureArea
	{
		
		protected $response_helper;

		function __construct()
		{
		
        	$this->response_helper = new ResponseHelper();
		}
	}


?>