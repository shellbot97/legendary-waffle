<?php 

	require_once "ParentModel.php";

	class AutherModel extends ParentModel
	{
		
		function __construct()
		{

			parent::__construct();
			$this->table_name = "authers";
		}

		public function get_active_authers($filters=array())
		{

			$query = "select auther_id, auther_name, url ";
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
	}



?>