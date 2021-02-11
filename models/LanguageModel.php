<?php 
	
	require_once "ParentModel.php";

	class LanguageModel extends ParentModel
	{
		
		function __construct()
		{

			parent::__construct();
			$this->table_name = "languages";
		}

		public function get_active_languages($filters=array())
		{

			$query = "select language_id, language_name, language_abbreviation ";
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