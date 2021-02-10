<?php 

	require_once "SecureArea.php";
	require_once __DIR__."/../models/LanguageModel.php";

	class LanguageController extends SecureArea
	{
		
		function __construct()
		{

			parent::__construct();
			$this->language_model = new LanguageModel();
		}
		
		public function get_languages($params=array())
		{

			$data = array();
			$data = $this->language_model->get_active_languages(
				array(
					"is_active" => 1
				)
			);
			echo $this->response_helper->give_success_response_by_array($data);
		}
	}



?>