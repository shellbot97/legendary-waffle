<?php 
	
	require_once __DIR__."/../helpers/ResponseHelper.php";
	require_once __DIR__."/../helpers/Validator.php";
	require_once __DIR__."/../models/AuthModel.php";

	class SecureArea
	{
		
		protected $response_helper;
		protected $validator;
		protected $session_variable;
		private $header;

		function __construct()
		{
		
			set_error_handler(array(&$this, 'exceptions_error_handler'));

        	$this->response_helper = new ResponseHelper();
        	$this->validator = new Validator();
        	$this->auth_model = new AuthModel();
        	$this->header = apache_request_headers();

        	$this->autherize_access();

		}


		public function autherize_access()
		{

			if (empty($this->header['Auth'])) 
        	{
        	
        		echo $this->response_helper->give_responce_401("Unautherised access");
        		exit();
        	}

        	$token = $this->auth_model->get_active_session_by_session_id($this->header['Auth']);
        	if (empty($token)) 
        	{
        	
        		echo $this->response_helper->give_responce_401("Unautherised access");
        		exit();
        	}else{

        		$data = json_decode($token[0]['data'], true);
        		$this->session_variable = $data;
        	}
		}

		public function exceptions_error_handler($severity, $message, $filename, $lineno) 
		{
			
			if (error_reporting() == 0) {
				return;
			}
			if (error_reporting() & $severity) {
				throw new ErrorException($message, 0, $severity, $filename, $lineno);
			}
		}
	}


?>