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

			$query = "select url, headline ";
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
	}



?>