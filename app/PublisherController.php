<?php 

	require_once "SecureArea.php";
	require_once __DIR__."/../models/PublisherModel.php";

	class PublisherController extends SecureArea
	{
		
		function __construct()
		{

			parent::__construct();
			$this->publisher_model = new PublisherModel();
		}
		
		public function get_publishers($params=array())
		{

			$data = array();
			$data = $this->publisher_model->get_active_publishers(
				array(
					"is_active" => 1
				)
			);
			echo $this->response_helper->give_success_response_by_array($data);
		}
	}



?>