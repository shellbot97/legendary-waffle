<?php 

	
	require_once __DIR__."/../models/AuthModel.php";
	require_once __DIR__."/../helpers/ResponseHelper.php";
	require_once __DIR__."/../helpers/Validator.php";

	class LoginController
	{
		
		function __construct()
		{

			$this->auth_model = new AuthModel();
			$this->response_helper = new ResponseHelper();
        	$this->validator = new Validator();
        	set_error_handler(array(&$this, 'exceptions_error_handler'));
		}
		
		public function get_login_infp($params=array())
		{

			$invalid_fields = $this->validator->validate_fields('login', $params);
			$final_result = array(
				"session_token" => "",
				"username" => "",
				"message" => "Failure"
			);

			if (empty($invalid_fields)) 
			{
				try
				{

					$data = array();
					$data = $this->auth_model->get_active_users_by_username_password(
						array(
							"user_name" => $params['username'],
							"user_password" => md5($params['password']),
							"is_active" => 1
						)
					);

					if (!empty($data)) 
					{
					
						$session_data = $this->auth_model->insert_session($data[0]['user_id']);

						$final_result['session_token'] = $session_data;
						$final_result['username'] = $data[0]['user_name'];
						$final_result['message'] = "Success";
					}

					echo $this->response_helper->give_success_response_by_array($final_result);
				}catch(Exception $ex)
				{

					$this->response_helper->give_500_error();
				}
			}else
			{

				echo echo_validation_errors($invalid_fields);
				exit();
			}

			
		}

		public function exceptions_error_handler($severity, $message, $filename, $lineno) {
			if (error_reporting() == 0) {
				return;
			}
			if (error_reporting() & $severity) {
				throw new ErrorException($message, 0, $severity, $filename, $lineno);
			}
		}
	}



?>