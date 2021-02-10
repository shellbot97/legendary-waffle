<?php 

	require_once "SecureArea.php";
	require_once __DIR__."/../models/LocationModel.php";

	class LocationController extends SecureArea
	{
		
		function __construct()
		{

			parent::__construct();
			$this->location_model = new LocationModel();
		}
		
		public function get_locations($params=array())
		{

			$data = array();
			$data = $this->location_model->get_active_locations(
				array(
					"is_active" => 1
				)
			);
			echo $this->response_helper->give_success_response_by_array($data);
		}
	}



?>