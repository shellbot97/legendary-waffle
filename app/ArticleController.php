<?php 

	require_once "SecureArea.php";
	require_once __DIR__."/../models/ArticleModel.php";

	class ArticleController extends SecureArea
	{
		
		function __construct()
		{

			parent::__construct();
			$this->article_model = new ArticlerModel();
		}
		
		public function get_article($params=array())
		{

			$data = array();
			$data = $this->rticle_model->get_active_article(
				array(
					"is_active" => 1
				)
			);
			echo $this->response_helper->give_success_response_by_array($data);
		}
	}



?>