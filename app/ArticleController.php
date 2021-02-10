<?php 

	require_once "SecureArea.php";
	require_once __DIR__."/../models/ArticleModel.php";

	class ArticleController extends SecureArea
	{
		
		function __construct()
		{

			parent::__construct();
			$this->article_model = new ArticleModel();
		}
		
		public function get_articles($params=array())
		{

			$data = array();
			$data = $this->article_model->get_all_data(
				array(
					"a.is_active" => 1
				)
			);
			echo $this->response_helper->give_success_response_by_array($data);
		}

		public function get_article($params=array())
		{

			
		}
	}



?>