<?php 

	require_once "ParentModel.php";

	class ArticleModel extends ParentModel
	{
		
		function __construct()
		{

			parent::__construct();
			$this->table_name = "article";
		}

		public function get_active_articles($filters=array())
		{

			$query = "select article_id, url, headline ";
			$query .= "from $this->table_name ";
			$query .= "where ";
			foreach ($filters as $column_name => $column_value) 
			{
			
				$query .= "$column_name = $column_value ";
				if (next($filters)) 
				{
					
					$query = " and ";	
				}
			}
			$query .= ";"; 

			$statement = $this->pdo->prepare($query);
			$statement->execute();
			$data = $statement->fetchAll(PDO::FETCH_ASSOC);
			return $data;
		}

		public function get_all_data($filters=array())
		{

			$query = "select a.article_id, a.url, a.headline, m.source as image, a.published_at, a.created_at, a.updated_at, lang.language_abbreviation, loc.location_abbreviation, aut.auther_name, aut.url as auther_url, p.publisher_name, mp.extra_params as publisher_media_params, mp.source as publisher_media_url, s.section_name, a.content, a.keywords ";
			$query .= " from articles a ";
			$query .= " left join media m on m.media_id = a.media_id ";
			$query .= " left join languages lang on lang.language_id = a.language_id ";
			$query .= " left join locations loc on loc.location_id = a.location_id ";
			$query .= " left join authers aut on aut.auther_id = a.auther_id ";
			$query .= " left join publishers p on p.publisher_id = a.publisher_id ";
			$query .= " left join media mp on mp.media_id = p.media_id ";
			$query .= " left join sections s on s.section_id = a.section_id ";

			$query .= "where ";

			foreach ($filters as $column_name => $column_value) 
			{
			
				$query .= "$column_name = $column_value ";
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
	}



?>