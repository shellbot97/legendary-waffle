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
		
		public function get_article($params=array())
		{

			$invalid_fields = $this->validator->validate_fields('getArticle', $params);
			if (empty($invalid_fields)) 
			{
				try
				{

					$data = array();
					$data = $this->article_model->get_all_data_by_article_id(
						$params['id']
					);
					echo $this->response_helper->give_success_response_by_array($data);

				}catch(Exception $ex)
				{

					$this->response_helper->give_500_error();
				}
			}else
			{

				echo $this->response_helper->echo_validation_errors($invalid_fields);
				exit();
			}
		}

		public function search_articles($params=array())
		{

			$invalid_fields = $this->validator->validate_fields('searchArticles', $params);
			if (empty($invalid_fields)) 
			{
				try
				{

					$data = array();

					$data = $this->article_model->get_article_meta_data(
						$params
					);
					echo $this->response_helper->give_success_response_by_array($data);
				}catch(Exception $ex)
				{

					$this->response_helper->give_500_error();
				}
			}else
			{

				echo $this->response_helper->echo_validation_errors($invalid_fields);
				exit();
			}
		}

		public function create_article($params=array())
		{

			$invalid_fields = $this->validator->validate_fields('createArticle', $params);
			if (empty($invalid_fields)) 
			{
				try
				{

					$data = array();

					
				}catch(Exception $ex)
				{

					$this->response_helper->give_500_error();
				}
			}else
			{

				echo $this->response_helper->echo_validation_errors($invalid_fields);
				exit();
			}
		}

	}



?>