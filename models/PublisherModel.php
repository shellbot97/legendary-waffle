<?php 
	require_once "ParentModel.php";

	class PublisherModel extends ParentModel
	{
		
		function __construct()
		{
			
			parent::__construct();
			$this->table_name = "publishers";
		}

		public function get_active_publishers($filters=array())
		{
			
			$query = "select publisher_id, publisher_name, url ";
			$query .= "from $this->table_name ";
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

		public function get_active_publishers_with_media($filters=array())
		{
			
			$query = "select p.publisher_id, p.publisher_name, p.url, m.source as media_source, m.extra_params as media_params ";
			$query .= "from publishers p ";
			$query .= " left join media m on m.media_id = p.media_id ";
			$query .= "where p.is_active = 1 ";

			if (!empty($filters)) 
			{

				$query .= " and ";
			}

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