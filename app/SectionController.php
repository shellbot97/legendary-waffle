<?php 

	require_once "SecureArea.php";
	require_once __DIR__."/../models/SectionModel.php";

	class SectionController extends SecureArea
	{
		
		function __construct()
		{

			parent::__construct();
			$this->section_model = new SectionModel();
		}
		
		public function get_sections($params=array())
		{

			$data = array();
			$data = $this->section_model->get_active_sections(
				array(
					"is_active" => 1
				)
			);
			echo $this->response_helper->give_success_response_by_array($data);
		}
	}



?>