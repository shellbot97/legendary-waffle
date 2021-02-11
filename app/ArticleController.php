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

					$formatted_data = array();
					$data = $this->article_model->get_all_data_by_article_id(
						$params['id']
					);

					if (!empty($data)) 
					{

						$formatted_data = array(

							"image" => $data["image"],
						    "url" => $data["url"],
						    "headline" => $data["headline"],
						    "dateCreated" => str_replace(" ", "T", $data["created_at"]),
						    "datePublished" => str_replace(" ", "T", $data["published_at"]),
						    "dateModified" => str_replace(" ", "T", $data["updated_at"]),
						    "inLanguage" => $data["language_abbreviation"],
						    "contentLocation" => array(
						            "name" => $data["location_abbreviation"],
						        ),

						    "author" => array(
						            "name" => $data["auther_name"],
						            "url" => $data["auther_url"],
						        ),

						    "publisher" => array
						        (
						            "name" => $data["publisher_name"],
						            "url" => $data["publisher_url"],
						            "logo" => array(
						                    "url" => $data["publisher_name"],
						                    "width" => json_decode($data["publisher_media_params"], true)['width'],
						                    "height" => json_decode($data["publisher_media_params"], true)['height'],
						                )
						        ),
						    "keywords" => explode("|", $data['keywords']),

						    "articleSection" => $data["section_name"],
						    "articleBody" => $data["content"],
						);
					}


					echo $this->response_helper->give_success_response_by_array($formatted_data);

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

			if (empty($params['id'])) 
			{
				
				echo $this->response_helper->echo_validation_errors(["id is required."]);
				exit();
			}

			$update_array = json_decode(file_get_contents('php://input'), true);
			$invalid_fields = $this->validator->validate_fields('updateArticle', $update_array);
			if (empty($invalid_fields)) 
			{
				try
				{

					$media_id = "";
					$article_data = array();

					if (!empty($update_array['article_image_url'])) 
					{

						$media_array = array(
							"media_type" => "image",
							"source" => $update_array['article_image_url'],
							"extra_params" => "[]"
						);

						$media_id = $this->article_model->insert_media($media_array);
						$article_data['media_id'] = $media_id;
					}
					

					$article_data["updated_by"] = $this->session_variable['user_id'];


					if(!empty($update_array["article_url"])){$article_data["url"] = $update_array["article_url"];}
					if(!empty($update_array["headline"])){$article_data["headline"] = $update_array["headline"];}
					if(!empty($update_array["publish_date"])){$article_data["published_at"] = $update_array["publish_date"];}
					if(!empty($update_array["language_id"])){$article_data["language_id"] = $update_array["language_id"];}
					if(!empty($update_array["location_id"])){$article_data["location_id"] = $update_array["location_id"];}
					if(!empty($update_array["auther_id"])){$article_data["auther_id"] = $update_array["auther_id"];}
					if(!empty($update_array["publisher_id"])){$article_data["publisher_id"] = $update_array["publisher_id"];}
					if(!empty($update_array["section_id"])){$article_data["section_id"] = $update_array["section_id"];}
					if(!empty($update_array["content"])){$article_data["content"] = $update_array["content"];}
					if(!empty($update_array["keywords"])){$article_data["keywords"] = $update_array["keywords"];}

					$article_id = $this->article_model->update_article_by_article_id($article_data, $params['id']);


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

		public function delete_article($params=array())
		{

			$invalid_fields = $this->validator->validate_fields('deleteArticle', $params);
			if (empty($invalid_fields)) 
			{
				try
				{

					$article_data = array("is_active" => 0);

					$article_id = $this->article_model->update_article_by_article_id($article_data, $params['id']);
					
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

	}



?>