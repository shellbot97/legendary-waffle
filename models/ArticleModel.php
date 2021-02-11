<?php 

	require_once "ParentModel.php";

	class ArticleModel extends ParentModel
	{
		
		function __construct()
		{

			parent::__construct();
			$this->table_name = "article";
		}

		public function get_article_meta_data($filters=array())
		{

			$query = "select a.article_id, a.url, a.headline ";
			$query .= "from articles as a";

			$query .= " left join media m on m.media_id = a.media_id ";
			$query .= " left join languages lang on lang.language_id = a.language_id ";
			$query .= " left join locations loc on loc.location_id = a.location_id ";
			$query .= " left join authers aut on aut.auther_id = a.auther_id ";
			$query .= " left join publishers p on p.publisher_id = a.publisher_id ";
			$query .= " left join media mp on mp.media_id = p.media_id ";
			$query .= " left join sections s on s.section_id = a.section_id ";

			$query .= "where a.is_active = 1 and ";

			foreach ($filters as $column_name => $column_value) 
			{
			
				$db_filter = $this->filter_column_mapper($column_name, $column_value);

				$query .= "(";
				foreach ($db_filter as $db_filter_key => $db_filter_value) 
				{
				
					if (is_array($db_filter_value)) 
					{
					
						$query .= "(";
						foreach ($db_filter_value as $multi_filter_value) 
						{
						
							$query .= "$db_filter_key like '%$multi_filter_value%' ";
							if (next($db_filter_value)) 
							{
								
								$query .= " or ";	
							}else{

								$query .= " ) ";
							}
						}


					}else
					{

						$query .= "$db_filter_key = '$db_filter_value' ";
					}
				}

				$query .= " ) ";

				if (next($filters)) 
				{
					
					$query .= " and ";	
				}
			}

			$query .= ";";
			
			$statement = $this->pdo->prepare($query);
			$statement->execute();
			$data = $statement->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		}

		public function get_all_data_by_article_id($article_id="")
		{

			$query = "select a.article_id, a.url, a.headline, m.source as image, a.published_at, a.created_at, a.updated_at, lang.language_abbreviation, loc.location_abbreviation, aut.auther_name, aut.url as auther_url, p.url as publisher_url, p.publisher_name, mp.extra_params as publisher_media_params, mp.source as publisher_media_url, s.section_name, a.content, a.keywords ";
			$query .= " from articles a ";
			$query .= " left join media m on m.media_id = a.media_id ";
			$query .= " left join languages lang on lang.language_id = a.language_id ";
			$query .= " left join locations loc on loc.location_id = a.location_id ";
			$query .= " left join authers aut on aut.auther_id = a.auther_id ";
			$query .= " left join publishers p on p.publisher_id = a.publisher_id ";
			$query .= " left join media mp on mp.media_id = p.media_id ";
			$query .= " left join sections s on s.section_id = a.section_id ";

			$query .= "where a.is_active = 1 and article_id = $article_id";

			$query .= ";"; 

			$statement = $this->pdo->prepare($query);
			$statement->execute();
			$data = $statement->fetch(PDO::FETCH_ASSOC);
			return $data;
		}

		private function filter_column_mapper($filter='', $value)
		{

			switch ($filter) {
				case 'id':
					$filter_array = array('a.article_id' => $value);
					break;

				case 'language':
					$filter_array = array("lang.language_abbreviation" => $value);
					break;

				case 'location':
					$filter_array = array("loc.location_abbreviation" => $value);
					break;

				case 'auther':
					$filter_array = array("aut.auther_name" => $value);
					break;

				case 'publisher':
					$filter_array = array("p.publisher_name" => $value);
					break;

				case 'dateCreated':
					$filter_array = array("a.created_at" => $value);
					break;

				case 'dateUpdated':
					$filter_array = array("a.updated_at" => $value);
					break;

				case 'datePublished':
					$filter_array = array("a.published_at" => $value);
					break;

				case 'headline':
					$filter_array = array("a.headline" => $value);
					break;

				case 'keywords':
					foreach (explode("|", $value) as $keyword_value) 
					{
						$filter_array['a.keywords'][] = $keyword_value;
					}
					break;

				case 'section':
					$filter_array = array("s.section_name" => $value);
					break;

				case 'generic':
					$filter_array = array(
						"lang.language_abbreviation" => $value,
						"loc.location_abbreviation" => $value,
						"aut.auther_name" => $value,
						"p.publisher_name" => $value,
						"a.headline" => $value,
					);
					break;
				
				default:
					$filter_array = array("" => "");
					break;
			}

			return $filter_array;
		}

		public function insert_media($insert_array=array())
		{

			$sql = "INSERT INTO media (source, extra_params, media_type) VALUES (:source, :extra_params, :media_type)";
			$stmt= $this->pdo->prepare($sql)->execute($insert_array);
			$id = $this->pdo->lastInsertId();
			return $id;
		}

		public function insert_article($insert_array=array())
		{

			$sql = "INSERT INTO articles (media_id, url, headline, published_at, language_id, location_id, auther_id, publisher_id, section_id, content, keywords, created_by) VALUES (:media_id, :url, :headline, :published_at, :language_id, :location_id, :auther_id, :publisher_id, :section_id, :content, :keywords, :created_by)";
			$stmt= $this->pdo->prepare($sql)->execute($insert_array);
			$id = $this->pdo->lastInsertId();
			return $id;
		}

		public function update_article_by_article_id($update_array=array(), $article_id="")
		{

			$query = "UPDATE articles set ";
			foreach ($update_array as $column_name => $column_value) 
			{
			
				$query .= " $column_name = :$column_name ";
				if (next($update_array)) {
					$query .= ", ";
				}
			}
			$query .= " where article_id= $article_id; ";

			$stmt= $this->pdo->prepare($query)->execute($update_array);
			return $stmt;
		}
	}



?>