<?php 
	require_once "SecureArea.php";
	require_once __DIR__."/../models/AutherModel.php";

	class AutherController extends SecureArea
	{
		
		function __construct()
		{

			parent::__construct();
			$this->auther_model = new AutherModel();
		}


		public function get_authers($params=array())
		{

			$data = array();
			$data = $this->auther_model->get_active_authers(
				array(
					"is_active" => 1
				)
			);
			echo $this->response_helper->give_success_response_by_array($data);
		}
	}


?>