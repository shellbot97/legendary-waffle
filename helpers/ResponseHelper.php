<?php 

	class ResponseHelper
	{
		
		public function give_success_response_by_array($data=array())
		{

			if (!empty($data)) {
				return json_encode(array("status" => "Success", "status_code" => 200, "payload" => $data), JSON_PRETTY_PRINT);
			}else{
				return json_encode(array("status" => "Success", "status_code" => 204, "payload" => "No change"), JSON_PRETTY_PRINT);
			}
		}


		function give_500_error()
		{

			echo json_encode(array("status" => 0, "message" => "We are experiencing some unexpected technical difficulties. Feel free to notify us of the problem so that we can fix it."), JSON_PRETTY_PRINT);
			exit();
		}


		function echo_validation_errors($value='')
		{
			http_response_code(422);
			return json_encode(array("status" => "Failed", "status_code" => 422, "payload" => array('Errors' => $value)), JSON_PRETTY_PRINT);
		}


		function give_responce_401($error_message='')
		{
			if (!empty($error_message)) {
				http_response_code(401);
				return json_encode(array("status" => "Success", "status_code" => 401, "payload" => $error_message), JSON_PRETTY_PRINT);
			}else{
				http_response_code(401);
				return json_encode(array("status" => "Failed", "status_code" => 401, "payload" => "Unautherized"), JSON_PRETTY_PRINT);
			}
		}
	}


?>