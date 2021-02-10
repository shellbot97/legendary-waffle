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
	}


?>