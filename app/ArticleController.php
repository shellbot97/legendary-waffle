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
					exit();

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

					$article_id = "";

					$media_array = array(
						"media_type" => "image",
						"source" => $params['article_image_url'],
						"extra_params" => "[]"
					);

					$media_id = $this->article_model->insert_media($media_array);

					$article_data = array(

						"media_id" => $media_id,
						"url" => $params["article_url"],
						"headline" => $params["headline"],
						"published_at" => $params["publish_date"],
						"language_id" => $params["language_id"],
						"location_id" => $params["location_id"],
						"auther_id" => $params["auther_id"],
						"publisher_id" => $params["publisher_id"],
						"section_id" => $params["section_id"],
						"content" => $params["content"],
						"keywords" => $params["keywords"],
						"created_by" => $this->session_variable['user_id'],
					);
					
					$article_id = $this->article_model->insert_article($article_data);

					
					echo $this->response_helper->give_success_responce_boolean($article_id);
					exit();
					
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

		public function update_article($params=array())
		{

			
		}

	}



?>